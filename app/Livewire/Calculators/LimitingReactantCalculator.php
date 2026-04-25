<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class LimitingReactantCalculator extends Component
{
    public $eq = 'Fe + O2 = Fe2O3';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'eq') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public $reactants = [];
    public $products = [];
    public $mode = 'limiting';
    public $limiting_message = '';

    public function setEquation($value)
    {
        $this->eq = $value;
        $this->detail = null;
        $this->error = null;
        $this->reactants = [];
        $this->products = [];
    }

    public function loadExample()
    {
        $examples = ['H2 + O2 = H2O', 'CH4 + O2 = CO2 + H2O', 'Mg + HCl = MgCl2 + H2', 'C6H12O6 + O2 = CO2 + H2O', 'NH3 + O2 = NO + H2O', 'Fe + O2 = Fe2O3'];
        $this->setEquation($examples[array_rand($examples)]);
    }

    public function calculate()
    {
        if (empty($this->eq)) {
            $this->error = 'Please enter an equation.';
            return;
        }

        $request = (object)[
            'eq' => $this->eq,
        ];

        $model = new Chemistry();
        $result = $model->chemical($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            $this->parseBalancedEquation($result['be']);
            
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Please check your input.';
            $this->detail = null;
        }
    }

    // --- Backend Stoichiometry Logic ---

    public function updatedReactants($value, $key)
    {
        $this->handleInputUpdate('reactants', $key, $value);
    }

    private function handleInputUpdate($group, $keyPath, $value)
    {
        if ($value === '' || !is_numeric($value)) return;
        
        list($index, $field) = explode('.', $keyPath);
        $index = intval($index);
        
        $this->calculateLimitingReagent($index, $field, floatval($value));
    }

    private function calculateLimitingReagent($sourceIndex, $sourceField, $value)
    {
        $molarMass = floatval($this->reactants[$sourceIndex]['molar_mass']);
        
        if ($sourceField === 'moles') {
            $this->reactants[$sourceIndex]['weight'] = round($value * $molarMass, 6);
        } else {
            $this->reactants[$sourceIndex]['moles'] = round($value / $molarMass, 6);
        }

        $allFilled = true;
        $minFactor = INF;
        $limitingReactantName = '';

        foreach ($this->reactants as $r) {
            if ($r['moles'] === '' || !is_numeric($r['moles'])) {
                $allFilled = false;
                break;
            }
            $factor = floatval($r['moles']) / floatval($r['coeff']);
            if ($factor < $minFactor) {
                $minFactor = $factor;
                $limitingReactantName = $r['formula'];
            }
        }

        if ($allFilled) {
            $this->limiting_message = "The Limiting reagent is " . $limitingReactantName;
            foreach ($this->products as &$p) {
                $moles = $minFactor * $p['coeff'];
                $p['moles'] = round($moles, 6);
                $p['weight'] = round($moles * $p['molar_mass'], 6);
            }
        } else {
            $this->limiting_message = '';
            foreach ($this->products as &$p) {
                $p['moles'] = '';
                $p['weight'] = '';
            }
        }
    }

    private function parseBalancedEquation($be)
    {
        $this->reactants = [];
        $this->products = [];
        
        $sides = explode(' rightarrow ', $be);
        if (count($sides) != 2) return;
        
        $reactantsStr = explode(' + ', $sides[0]);
        $productsStr = explode(' + ', $sides[1]);
        
        foreach ($reactantsStr as $r) {
            $this->reactants[] = $this->parseCompound(trim($r));
        }
        foreach ($productsStr as $p) {
            $this->products[] = $this->parseCompound(trim($p));
        }
    }

    private function parseCompound($str)
    {
        preg_match('/^(\d*)(.*)$/', $str, $matches);
        $coeff = empty($matches[1]) ? 1 : intval($matches[1]);
        $formula = $matches[2];
        $molarMass = $this->calculateMolarMass($formula);
        
        return [
            'formula' => $formula,
            'coeff' => $coeff,
            'molar_mass' => $molarMass,
            'moles' => '',
            'weight' => ''
        ];
    }

    private function calculateMolarMass($formula)
    {
        $symb = ['H', 'He', 'Li', 'Be', 'B', 'C', 'N', 'O', 'F', 'Ne', 'Na', 'Mg', 'Al', 'Si', 'P', 'S', 'Cl', 'Ar', 'K', 'Ca', 'Sc', 'Ti', 'V', 'Cr', 'Mn', 'Fe', 'Co', 'Ni', 'Cu', 'Zn', 'Ga', 'Ge', 'As', 'Se', 'Br', 'Kr', 'Rb', 'Sr', 'Y', 'Zr', 'Nb', 'Mo', 'Tc', 'Ru', 'Rh', 'Pd', 'Ag', 'Cd', 'In', 'Sn', 'Sb', 'Te', 'I', 'Xe', 'Cs', 'Ba', 'La', 'Ce', 'Pr', 'Nd', 'Pm', 'Sm', 'Eu', 'Gd', 'Tb', 'Dy', 'Ho', 'Er', 'Tm', 'Yb', 'Lu', 'Hf', 'Ta', 'W', 'Re', 'Os', 'Ir', 'Pt', 'Au', 'Hg', 'Tl', 'Pb', 'Bi', 'Po', 'At', 'Rn', 'Fr', 'Ra', 'Ac', 'Th', 'Pa', 'U', 'Np', 'Pu', 'Am', 'Cm', 'Bk', 'Cf', 'Es', 'Fm', 'Md', 'No', 'Lr', 'Rf', 'Db', 'Sg', 'Bh', 'Hs', 'Mt', 'Ds', 'Rg', 'Cn'];
        $aweight = ['1.00794', '4.002602', '6.941', '9.012182', '10.811', '12.0107', '14.0067', '15.9994', '18.9984032', '20.1797', '22.9897693', '24.305', '26.9815386', '28.0855', '30.973762', '32.065', '35.453', '39.948', '39.0983', '40.078', '44.955912', '47.867', '50.9415', '51.9961', '54.938045', '55.845', '58.933195', '58.6934', '63.546', '65.38', '69.723', '72.63', '74.9216', '78.96', '79.904', '83.798', '85.4678', '87.62', '88.90585', '91.224', '92.90638', '95.96', '98', '101.07', '102.9055', '106.42', '107.8682', '112.411', '114.818', '118.71', '121.76', '127.6', '126.90447', '131.293', '132.9054519', '137.327', '138.90547', '140.116', '140.90765', '144.242', '145', '150.36', '151.964', '157.25', '158.92535', '162.5', '164.93032', '167.259', '168.93421', '173.054', '174.9668', '178.49', '180.94788', '183.84', '186.207', '190.23', '192.217', '195.084', '196.966569', '200.59', '204.3833', '207.2', '208.9804', '209', '210', '222', '223', '226', '227', '232.03806', '231.03588', '238.02891', '237', '244', '243', '247', '247', '251', '252', '257', '258', '259', '262', '267', '268', '271', '272', '270', '276', '281', '280', '285', '284', '289', '288', '293', '294', '294'];
        
        $weights = [];
        foreach ($symb as $index => $s) {
            $weights[$s] = floatval($aweight[$index]);
        }

        $expanded = preg_replace_callback('/\(([^)]+)\)(\d*)/', function($m) {
            $mult = empty($m[2]) ? 1 : intval($m[2]);
            return preg_replace_callback('/([A-Z][a-z]?)(\d*)/', function($m2) use ($mult) {
                $c = empty($m2[2]) ? 1 : intval($m2[2]);
                return $m2[1] . ($c * $mult);
            }, $m[1]);
        }, $formula);

        $mass = 0;
        preg_match_all('/([A-Z][a-z]?)(\d*)/', $expanded, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $element = $match[1];
            $count = empty($match[2]) ? 1 : intval($match[2]);
            if (isset($weights[$element])) {
                $mass += $weights[$element] * $count;
            }
        }
        return round($mass, 4);
    }

    public function render()
    {
        return view('livewire.calculators.limiting-reactant-calculator');
    }
}
