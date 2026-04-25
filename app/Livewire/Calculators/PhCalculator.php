<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class PhCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Main mode selector
    public $chemical_selection = '1'; // 1=Acid, 2=Base, 3=Acid by mass, 4=Base by mass, 5=H+/OH-/pOH

    // Chemical name (Ka value or Ka&MM value depending on mode)
    public $chemical_name = '0.000018';

    // Concentration field
    public $concentration = 4;
    public $con_units = 'M';

    // Weight field (modes 3 & 4)
    public $f_length = 4;
    public $fl_units = 'ng';

    // Volume field (modes 3 & 4)
    public $post_space = 4;
    public $po_units = 'mm³';

    // Operation for mode 5 ([H+], pOH, [OH-])
    public $operation = '1';

    // pOH input for mode 5 when operation=2
    public $second = 7;

    // Dynamic chemical options
    public $chemical_options = [];

    private static $acids = [
        '0.000018' => 'Acetic acid - CH₃COOH',
        '0.0069' => 'Arsenic acid - H₃AsO₄',
        '0.00000000059' => 'Arsenious acid - H₃AsO₃',
        '0.000065' => 'Benzoic acid - C₆H₅COOH',
        '0.00000000058' => 'Boric acid - H₃BO₃',
        '0.00000045' => 'Carbonic acid - H₂CO₃',
        '0.0007447' => 'Citric acid - C₃H₅O(COOH)₃',
        '0.00018' => 'Formic acid - HCOOH',
        '0.00000000072' => 'Hydrocyanic acid - HCN',
        '0.00063' => 'Hydrofluoric acid - HF',
        '0.0000001' => 'Hydrosulfuric acid - H₂S',
        '10000000' => 'Hydrochloric acid - HCl',
        '0.00000005' => 'Hypochlorous acid - HClO',
        '1' => 'Perchloric acid - HClO₄',
        '0.011' => 'Chlorous acid - HClO₂',
        '1000' => 'Sulfuric acid - H₂SO₄',
        '0.015' => 'Sulfurous acid - H₂SO₃',
        '27.5' => 'Nitric acid - HNO₃',
        '0.00051' => 'Nitrous acid - HNO₂',
        '0.00000000013' => 'Phenol - C₆H₅OH',
        '0.0069_p' => 'Phosphoric acid - H₃PO₄',
        '0.05' => 'Phosphorous acid - H₃PO₃',
    ];

    private static $bases = [
        '0.63' => 'sodium hydroxide - NaOH',
        '0.00000000043' => 'aniline - C₆H₅NH₂',
        '0.000018' => 'ammonia - NH₃',
        '0.0025' => 'magnesium hydroxide - Mg(OH)₂',
        '0.00013' => 'iron (II) hydroxide - Fe(OH)₂',
        '2.3' => 'lithium hydroxide - LiOH',
        '0.0000000014' => 'aluminium hydroxide - Al(OH)₃',
    ];

    private static $acids_by_mass = [
        '0.000018&60.052' => 'Acetic acid - CH₃COOH',
        '0.0069&141.94' => 'Arsenic acid - H₃AsO₄',
        '0.00000000059&125.94' => 'Arsenious acid - H₃AsO₃',
        '0.000065&122.123' => 'Benzoic acid - C₆H₅COOH',
        '0.00000000058&61.83' => 'Boric acid - H₃BO₃',
        '0.00000045&62.024' => 'Carbonic acid - H₂CO₃',
        '0.0007447&192.124' => 'Citric acid - C₃H₅O(COOH)₃',
        '0.00018&46.025' => 'Formic acid - HCOOH',
        '0.00000000072&27.0253' => 'Hydrocyanic acid - HCN',
        '0.00063&20.0063' => 'Hydrofluoric acid - HF',
        '0.0000001&34.0809' => 'Hydrosulfuric acid - H₂S',
        '10000000&36.46' => 'Hydrochloric acid - HCl',
        '0.00000005&52.46' => 'Hypochlorous acid - HClO',
        '1&100.46' => 'Perchloric acid - HClO₄',
        '0.011&68.46' => 'Chlorous acid - HClO₂',
        '1000&98.079' => 'Sulfuric acid - H₂SO₄',
        '0.015&82.07' => 'Sulfurous acid - H₂SO₃',
        '27.5&63.01' => 'Nitric acid - HNO₃',
        '0.00051&47.013' => 'Nitrous acid - HNO₂',
        '0.00000000013&94.11' => 'Phenol - C₆H₅OH',
        '0.0069&97.994' => 'Phosphoric acid - H₃PO₄',
        '0.05&82' => 'Phosphorous acid - H₃PO₃',
    ];

    private static $bases_by_mass = [
        '0.63&39.997' => 'sodium hydroxide - NaOH',
        '0.00000000043&93.13' => 'aniline - C₆H₅NH₂',
        '0.000018&17.031' => 'ammonia - NH₃',
        '0.0025&58.3197' => 'magnesium hydroxide - Mg(OH)₂',
        '0.00013&89.86' => 'iron (II) hydroxide - Fe(OH)₂',
        '2.3&23.95' => 'lithium hydroxide - LiOH',
        '0.0000000014&78' => 'aluminium hydroxide - Al(OH)₃',
    ];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $this->updateChemicalOptions();

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs->chemical_selection)) {
                $this->chemical_selection = $inputs->chemical_selection;
                $this->updateChemicalOptions();
                $this->chemical_name = $inputs->chemical_name ?? $this->chemical_name;
                $this->concentration = $inputs->concentration;
                $this->con_units = $inputs->con_units;
                $this->f_length = $inputs->f_length;
                $this->fl_units = $inputs->fl_units;
                $this->post_space = $inputs->post_space;
                $this->po_units = $inputs->po_units;
                $this->operation = $inputs->operation;
                $this->second = $inputs->second;
            }
        }
    }

    public function updatedChemicalSelection()
    {
        $this->updateChemicalOptions();
        if (!empty($this->chemical_options)) {
            $this->chemical_name = array_key_first($this->chemical_options);
        }
    }

    public function updateChemicalOptions()
    {
        if ($this->chemical_selection == '1') {
            $this->chemical_options = self::$acids;
        } elseif ($this->chemical_selection == '2') {
            $this->chemical_options = self::$bases;
        } elseif ($this->chemical_selection == '3') {
            $this->chemical_options = self::$acids_by_mass;
        } elseif ($this->chemical_selection == '4') {
            $this->chemical_options = self::$bases_by_mass;
        } else {
            $this->chemical_options = [];
        }
    }

    public function resetForm()
    {
        $this->reset([
            'chemical_selection', 'chemical_name', 'concentration', 'con_units',
            'f_length', 'fl_units', 'post_space', 'po_units', 'operation', 'second',
            'error', 'detail'
        ]);
        $this->updateChemicalOptions();
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
            'chemical_selection' => $this->chemical_selection,
            'chemical_name'      => $this->chemical_name,
            'concentration'      => $this->concentration,
            'con_units'          => $this->con_units,
            'f_length'           => $this->f_length,
            'fl_units'           => $this->fl_units,
            'post_space'         => $this->post_space,
            'po_units'           => $this->po_units,
            'operation'          => $this->operation,
            'second'             => $this->second,
        ];

        $model = new Chemistry();
        $result = $model->ph($request);

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
        return view('livewire.calculators.ph-calculator');
    }
}
