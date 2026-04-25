<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class StoichiometryCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $eq = 'Fe + O2 = Fe2O3';
    public $reactants = [];
    public $products = [];
    public $limiting_reagent = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        // Initial example
        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
            $this->parseResult();
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;
        $this->reactants = [];
        $this->products = [];
    }

    public function calculate()
    {
        $this->validate(['eq' => 'required']);

        $request = (object)[
            'eq' => $this->eq,
        ];

        $model = new Chemistry();
        $result = $model->stoichiometry($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            $this->parseResult();

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    protected function parseResult()
    {
        if (!$this->detail) return;

        // Handle different separators: '=', '→', '->', or 'rightarrow'
        $be = $this->detail['be'];
        $separator = '=';
        if (strpos($be, 'rightarrow') !== false) $separator = 'rightarrow';
        elseif (strpos($be, '→') !== false) $separator = '→';
        elseif (strpos($be, '->') !== false) $separator = '->';

        $sides = explode($separator, $be);
        if (count($sides) != 2) return;

        $model = new Chemistry();

        $this->reactants = $this->parseSide($sides[0], $model);
        $this->products = $this->parseSide($sides[1], $model);
        $this->limiting_reagent = null;
    }

    protected function parseSide($side, $model)
    {
        $species = [];
        $parts = explode('+', $side);
        foreach ($parts as $part) {
            $part = trim($part);
            if (preg_match('/^(\d*)\s*(.*)$/', $part, $matches)) {
                $coeff = $matches[1] === '' ? 1 : (int)$matches[1];
                $formula = trim($matches[2]);
                $molar_mass = $model->calculateMolarMass($formula);
                
                $species[] = [
                    'formula' => $formula,
                    'coeff' => $coeff,
                    'molar_mass' => $molar_mass,
                    'moles' => '',
                    'weight' => '',
                ];
            }
        }
        return $species;
    }

    public function updatedReactants($value, $key)
    {
        // $key will be like "0.moles" or "1.weight"
        $parts = explode('.', $key);
        if (count($parts) < 2) return;
        
        $index = (int)$parts[0];
        $field = $parts[1];

        if (!is_numeric($value) || $value === '') return;

        $r = $this->reactants[$index];
        if ($field == 'weight') {
            $this->reactants[$index]['moles'] = (float)$value / (float)$r['molar_mass'];
        } elseif ($field == 'moles') {
            $this->reactants[$index]['weight'] = (float)$value * (float)$r['molar_mass'];
        }

        $this->recalculateAll($index, 'reactant');
    }

    public function updatedProducts($value, $key)
    {
        // $key will be like "0.moles" or "1.weight"
        $parts = explode('.', $key);
        if (count($parts) < 2) return;
        
        $index = (int)$parts[0];
        $field = $parts[1];

        if (!is_numeric($value) || $value === '') return;

        $p = $this->products[$index];
        if ($field == 'weight') {
            $this->products[$index]['moles'] = (float)$value / (float)$p['molar_mass'];
        } elseif ($field == 'moles') {
            $this->products[$index]['weight'] = (float)$value * (float)$p['molar_mass'];
        }

        $this->recalculateAll($index, 'product');
    }

    protected function recalculateAll($base_index, $base_type)
    {
        if ($base_type == 'reactant') {
            $base_mole = (float)$this->reactants[$base_index]['moles'];
            $base_coeff = (float)$this->reactants[$base_index]['coeff'];
        } else {
            $base_mole = (float)$this->products[$base_index]['moles'];
            $base_coeff = (float)$this->products[$base_index]['coeff'];
        }

        if ($base_coeff == 0) return;

        foreach ($this->reactants as $i => $r) {
            if ($base_type == 'reactant' && $i == $base_index) continue;
            $new_moles = ($r['coeff'] / $base_coeff) * $base_mole;
            $this->reactants[$i]['moles'] = $new_moles;
            $this->reactants[$i]['weight'] = $new_moles * $r['molar_mass'];
        }

        foreach ($this->products as $i => $p) {
            if ($base_type == 'product' && $i == $base_index) continue;
            $new_moles = ($p['coeff'] / $base_coeff) * $base_mole;
            $this->products[$i]['moles'] = $new_moles;
            $this->products[$i]['weight'] = $new_moles * $p['molar_mass'];
        }
    }

    public function formatFormula($formula)
    {
        return preg_replace('/(\d+)/', '<sub>$1</sub>', $formula);
    }

    public function formatEquation($equation)
    {
        // 1. Identify separator
        $separator = '=';
        if (strpos($equation, 'rightarrow') !== false) $separator = 'rightarrow';
        elseif (strpos($equation, '→') !== false) $separator = '→';
        elseif (strpos($equation, '->') !== false) $separator = '->';

        $sides = explode($separator, $equation);
        if (count($sides) != 2) return $equation;

        $formattedReactants = $this->formatSide($sides[0]);
        $formattedProducts = $this->formatSide($sides[1]);

        return $formattedReactants . ' <span class="text-green-500 mx-4 text-4xl">→</span> ' . $formattedProducts;
    }

    protected function formatSide($side)
    {
        $formattedTerms = [];
        $terms = explode('+', $side);
        foreach ($terms as $term) {
            $term = trim($term);
            // Match coefficient and formula
            if (preg_match('/^(\d*)\s*(.*)$/', $term, $matches)) {
                $coeff = $matches[1];
                $formula = $matches[2];
                
                $f_coeff = $coeff !== '' ? '<span class="text-blue-600">'.$coeff.'</span>' : '';
                $f_formula = $this->formatFormulaWithColors($formula);
                
                $formattedTerms[] = $f_coeff . $f_formula;
            }
        }
        return implode(' <span class="text-gray-400">+</span> ', $formattedTerms);
    }

    protected function formatFormulaWithColors($formula)
    {
        // Format elements (Red) and subscripts (Light Blue)
        // Example: Fe2O3 -> <span class="text-red-500">Fe</span><sub class="text-blue-400">2</sub><span class="text-red-500">O</span><sub class="text-blue-400">3</sub>
        
        // Match elements and their counts
        $result = preg_replace_callback('/([A-Z][a-z]*)(\d*)/', function($m) {
            $element = '<span class="text-red-500">' . $m[1] . '</span>';
            $count = ($m[2] !== '') ? '<sub class="text-blue-400">' . $m[2] . '</sub>' : '';
            return $element . $count;
        }, $formula);

        return $result;
    }

    public function render()
    {
        return view('livewire.calculators.stoichiometry-calculator');
    }
}
