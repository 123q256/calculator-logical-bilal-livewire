<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class EquilibriumConstantCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $selection = '1'; // 1 = concentration, 2 = equation+pressure

    // Mode 1: concentration inputs
    public $concentration_one = 8;
    public $concentration_one_unit = 'M';
    public $a = 3;
    public $concentration_two = 4;
    public $concentration_two_unit = 'M';
    public $b = 5;
    public $concentration_three = 4;
    public $concentration_three_unit = 'M';
    public $c = 7;
    public $concentration_four = 8;
    public $concentration_four_unit = 'M';
    public $d = 9;

    // Mode 2: equation + pressure
    public $chemical_equation = '4NO2 + O2 = 2N2O5';
    public $total_pressure = 1.00794;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs->selection)) {
                $this->selection              = $inputs->selection;
                $this->concentration_one      = $inputs->concentration_one;
                $this->concentration_one_unit = $inputs->concentration_one_unit;
                $this->a                      = $inputs->a;
                $this->concentration_two      = $inputs->concentration_two;
                $this->concentration_two_unit = $inputs->concentration_two_unit;
                $this->b                      = $inputs->b;
                $this->concentration_three    = $inputs->concentration_three;
                $this->concentration_three_unit = $inputs->concentration_three_unit;
                $this->c                      = $inputs->c;
                $this->concentration_four     = $inputs->concentration_four;
                $this->concentration_four_unit = $inputs->concentration_four_unit;
                $this->d                      = $inputs->d;
                $this->chemical_equation      = $inputs->chemical_equation;
                $this->total_pressure         = $inputs->total_pressure;
            }
        }
    }

    public function updatedSelection()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset([
            'selection',
            'concentration_one', 'concentration_one_unit', 'a',
            'concentration_two', 'concentration_two_unit', 'b',
            'concentration_three', 'concentration_three_unit', 'c',
            'concentration_four', 'concentration_four_unit', 'd',
            'chemical_equation', 'total_pressure',
            'error', 'detail'
        ]);
        $this->resetErrorBag();
        $this->resetValidation();

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'selection'               => $this->selection,
            'concentration_one'       => $this->concentration_one,
            'concentration_one_unit'  => $this->concentration_one_unit,
            'a'                       => $this->a,
            'concentration_two'       => $this->concentration_two,
            'concentration_two_unit'  => $this->concentration_two_unit,
            'b'                       => $this->b,
            'concentration_three'     => $this->concentration_three,
            'concentration_three_unit'=> $this->concentration_three_unit,
            'c'                       => $this->c,
            'concentration_four'      => $this->concentration_four,
            'concentration_four_unit' => $this->concentration_four_unit,
            'd'                       => $this->d,
            'chemical_equation'       => $this->chemical_equation,
            'total_pressure'          => $this->total_pressure,
        ];

        $model = new Chemistry();
        
        if ($this->selection == '1') {
            $result = $model->equilibrium($request);
        } else {
            // Mode 2: Manual Equation Balancing in PHP
            try {
                $result = $this->calculateMode2();
            } catch (\Exception $e) {
                $result = ['RESULT' => 0, 'error' => $e->getMessage()];
            }
        }

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            foreach ($result as $key => $val) {
                if (is_float($val) && is_infinite($val)) {
                    $result[$key] = 'Infinity';
                } elseif (is_float($val) && is_nan($val)) {
                    $result[$key] = 'Undefined (NaN)';
                }
            }
            $this->detail = $result;
            $this->error = null;
            $this->dispatch('calculation-completed');

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    private function calculateMode2()
    {
        $eqn = $this->parseEquation($this->chemical_equation);
        $elements = $eqn['elements'];
        $left = $eqn['left'];
        $right = $eqn['right'];

        // Build Matrix
        $rows = count($elements);
        $cols = count($left) + count($right);
        $matrix = array_fill(0, $rows, array_fill(0, $cols + 1, 0));

        foreach ($elements as $i => $el) {
            foreach ($left as $j => $term) {
                $matrix[$i][$j] = $this->countElementInTerm($term, $el);
            }
            foreach ($right as $j => $term) {
                $matrix[$i][count($left) + $j] = -$this->countElementInTerm($term, $el);
            }
        }

        // Solve Matrix
        $coeffs = $this->solveMatrix($matrix, $rows, $cols);

        // Process Results
        $total_pressure = floatval($this->total_pressure);
        $reactant_data = [];
        $product_data = [];
        $total_moles = 0;

        $symb = ['H', 'He', 'Li', 'Be', 'B', 'C', 'N', 'O', 'F', 'Ne', 'Na', 'Mg', 'Al', 'Si', 'P', 'S', 'Cl', 'Ar', 'K', 'Ca', 'Sc', 'Ti', 'V', 'Cr', 'Mn', 'Fe', 'Co', 'Ni', 'Cu', 'Zn', 'Ga', 'Ge', 'As', 'Se', 'Br', 'Kr', 'Rb', 'Sr', 'Y', 'Zr', 'Nb', 'Mo', 'Tc', 'Ru', 'Rh', 'Pd', 'Ag', 'Cd', 'In', 'Sn', 'Sb', 'Te', 'I', 'Xe', 'Cs', 'Ba', 'La', 'Ce', 'Pr', 'Nd', 'Pm', 'Sm', 'Eu', 'Gd', 'Tb', 'Dy', 'Ho', 'Er', 'Tm', 'Yb', 'Lu', 'Hf', 'Ta', 'W', 'Re', 'Os', 'Ir', 'Pt', 'Au', 'Hg', 'Tl', 'Pb', 'Bi', 'Po', 'At', 'Rn', 'Fr', 'Ra', 'Ac', 'Th', 'Pa', 'U', 'Np', 'Pu', 'Am', 'Cm', 'Bk', 'Cf', 'Es', 'Fm', 'Md', 'No', 'Lr', 'Rf', 'Db', 'Sg', 'Bh', 'Hs', 'Mt', 'Ds', 'Rg', 'Cn', 'Uut', 'Uuq', 'Uup', 'Uuh', 'Uus', 'Uuo'];
        $aweight = ['1.00794', '4.002602', '6.941', '9.012182', '10.811', '12.0107', '14.0067', '15.9994', '18.9984032', '20.1797', '22.9897693', '24.305', '26.9815386', '28.0855', '30.973762', '32.065', '35.453', '39.948', '39.0983', '40.078', '44.955912', '47.867', '50.9415', '51.9961', '54.938045', '55.845', '58.933195', '58.6934', '63.546', '65.38', '69.723', '72.63', '74.9216', '78.96', '79.904', '83.798', '85.4678', '87.62', '88.90585', '91.224', '92.90638', '95.96', '98', '101.07', '102.9055', '106.42', '107.8682', '112.411', '114.818', '118.71', '121.76', '127.6', '126.90447', '131.293', '132.9054519', '137.327', '138.90547', '140.116', '140.90765', '144.242', '145', '150.36', '151.964', '157.25', '158.92535', '162.5', '164.93032', '167.259', '168.93421', '173.054', '174.9668', '178.49', '180.94788', '183.84', '186.207', '190.23', '192.217', '195.084', '196.966569', '200.59', '204.3833', '207.2', '208.9804', '209', '210', '222', '223', '226', '227', '232.03806', '231.03588', '238.02891', '237', '244', '243', '247', '247', '251', '252', '257', '258', '259', '262', '267', '268', '271', '272', '270', '276', '281', '280', '285', '284', '289', '288', '293', '294', '294'];
        $weights = array_combine($symb, $aweight);

        $r_pressures_prod = 1;
        $p_pressures_prod = 1;

        $r_count = count($left);
        $p_count = count($right);

        // Calculate molar masses and moles
        foreach ($left as $i => $term) {
            $mm = $this->calculateMolarMass($term, $weights);
            $moles = $coeffs[$i] * $mm;
            $reactant_data[] = ['name' => $term['raw'], 'ratio' => $coeffs[$i], 'mm' => $mm, 'moles' => $moles];
            $total_moles += $moles;
        }
        foreach ($right as $i => $term) {
            $mm = $this->calculateMolarMass($term, $weights);
            $moles = $coeffs[$r_count + $i] * $mm;
            $product_data[] = ['name' => $term['raw'], 'ratio' => $coeffs[$r_count + $i], 'mm' => $mm, 'moles' => $moles];
            $total_moles += $moles;
        }

        if ($total_moles == 0) throw new \Exception("Calculation error: Total moles zero.");

        // Calculate partial pressures and Kp
        foreach ($reactant_data as $i => &$data) {
            $data['fraction'] = $data['moles'] / $total_moles;
            $data['partial'] = $data['fraction'] * $total_pressure;
            $r_pressures_prod *= pow($data['partial'], $data['ratio']);
        }
        foreach ($product_data as $i => &$data) {
            $data['fraction'] = $data['moles'] / $total_moles;
            $data['partial'] = $data['fraction'] * $total_pressure;
            $p_pressures_prod *= pow($data['partial'], $data['ratio']);
        }

        $kp = ($r_pressures_prod != 0) ? ($p_pressures_prod / $r_pressures_prod) : 0;

        // Build HTML for equation
        $eqn_html = '';
        foreach ($left as $i => $term) {
            if ($i > 0) $eqn_html .= ' + ';
            if ($coeffs[$i] > 1) $eqn_html .= '<b style="color:blue">'.$coeffs[$i].'</b> ';
            $eqn_html .= $this->termToHtml($term);
        }
        $eqn_html .= ' <b style="color:green; font-size:24px">&rarr;</b> ';
        foreach ($right as $i => $term) {
            if ($i > 0) $eqn_html .= ' + ';
            if ($coeffs[$r_count + $i] > 1) $eqn_html .= '<b style="color:blue">'.$coeffs[$r_count + $i].'</b> ';
            $eqn_html .= $this->termToHtml($term);
        }

        return [
            'RESULT' => 1,
            'kp' => $kp,
            'eqn_html' => $eqn_html,
            'reactants' => $reactant_data,
            'products' => $product_data,
        ];
    }

    private function parseEquation($str)
    {
        $input = str_replace(' ', '', $str);
        if (strpos($input, '=') === false) throw new \Exception("Equation must contain '=' sign.");
        $sides = explode('=', $input);
        
        $left = $this->parseSide($sides[0]);
        $right = $this->parseSide($sides[1]);
        
        $elements = [];
        foreach ($left as $term) {
            foreach ($term['items'] as $item) $this->getElementsFromItem($item, $elements);
        }
        foreach ($right as $term) {
            foreach ($term['items'] as $item) $this->getElementsFromItem($item, $elements);
        }
        
        return [
            'left' => $left,
            'right' => $right,
            'elements' => array_values(array_unique($elements))
        ];
    }

    private function parseSide($str)
    {
        $terms = explode('+', $str);
        $parsed = [];
        foreach ($terms as $t) {
            $parsed[] = $this->parseTerm($t);
        }
        return $parsed;
    }

    private function parseTerm($str)
    {
        $raw = $t = $str;
        $items = [];
        // Regex to match Elements (e.g., Fe, Cl, Na) or Groups in parens
        // Simplified for this context
        preg_match_all('/([A-Z][a-z]*)(\d*)|(\()|(\))(\d*)/', $t, $matches, PREG_SET_ORDER);
        
        // This is a simplified parser, but good enough for common chemicals
        foreach ($matches as $m) {
            if (!empty($m[1])) {
                $items[] = ['type' => 'elem', 'name' => $m[1], 'count' => empty($m[2]) ? 1 : intval($m[2])];
            }
        }
        return ['items' => $items, 'raw' => $raw];
    }

    private function getElementsFromItem($item, &$elements)
    {
        if ($item['type'] == 'elem') $elements[] = $item['name'];
    }

    private function countElementInTerm($term, $name)
    {
        $sum = 0;
        foreach ($term['items'] as $item) {
            if ($item['type'] == 'elem' && $item['name'] == $name) $sum += $item['count'];
        }
        return $sum;
    }

    private function calculateMolarMass($term, $weights)
    {
        $total = 0;
        foreach ($term['items'] as $item) {
            if (isset($weights[$item['name']])) {
                $total += $weights[$item['name']] * $item['count'];
            }
        }
        return $total;
    }

    private function termToHtml($term)
    {
        $html = '';
        foreach ($term['items'] as $item) {
            $html .= $item['name'];
            if ($item['count'] > 1) $html .= '<sub>'.$item['count'].'</sub>';
        }
        return $html;
    }

    private function solveMatrix($matrix, $rows, $cols)
    {
        // Gaussian Elimination
        $r = 0; $c = 0;
        while ($r < $rows && $c < $cols) {
            $pivot = $r;
            while ($pivot < $rows && abs($matrix[$pivot][$c]) < 1e-10) $pivot++;
            if ($pivot == $rows) { $c++; continue; }
            $temp = $matrix[$r]; $matrix[$r] = $matrix[$pivot]; $matrix[$pivot] = $temp;
            $val = $matrix[$r][$c];
            for ($i = 0; $i < $rows; $i++) {
                if ($i != $r) {
                    $factor = $matrix[$i][$c] / $val;
                    for ($j = $c; $j <= $cols; $j++) $matrix[$i][$j] -= $factor * $matrix[$r][$j];
                }
            }
            $r++; $c++;
        }

        $coeffs = array_fill(0, $cols, 0);
        $coeffs[$cols - 1] = 120; // Multiple to avoid decimals
        for ($i = $cols - 2; $i >= 0; $i--) {
            $sum = 0;
            for ($j = $i + 1; $j < $cols; $j++) {
                if (isset($matrix[$i][$j])) $sum += $matrix[$i][$j] * $coeffs[$j];
            }
            if (isset($matrix[$i][$i]) && abs($matrix[$i][$i]) > 1e-10) {
                $coeffs[$i] = -$sum / $matrix[$i][$i];
            }
        }

        // Normalize
        $g = $coeffs[0];
        foreach ($coeffs as $val) $g = $this->gcd(round($val), $g);
        return array_map(function($v) use ($g) { return abs(round($v / $g)); }, $coeffs);
    }

    private function gcd($a, $b) { 
        $a = abs($a); $b = abs($b); 
        while ($b) { $a %= $b; $t = $a; $a = $b; $b = $t; } 
        return $a ?: 1; 
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.equilibrium-constant-calculator');
    }
}
