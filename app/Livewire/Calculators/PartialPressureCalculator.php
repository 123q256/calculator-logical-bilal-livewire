<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class PartialPressureCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Properties
    public $formula = '1';
    public $to_cal1 = '1';
    public $total = 8;
    public $total_unit = 'Pa';
    public $mole = null;
    public $partial = 8;
    public $part_unit = 'Pa';
    
    public $to_cal2 = '1';
    public $amole = null;
    public $temp = null;
    public $temp_unit = '°C';
    public $volume = null;
    public $vol_unit = 'mm³';
    public $partial1 = 8;
    public $part_unit1 = 'Pa';
    
    public $to_cal3 = '1';
    public $gas = '1';
    public $cons = null;
    public $conc = null;
    public $conc_unit = 'M';
    public $partial2 = null;
    public $part_unit2 = 'Pa';
    
    public $to_cal4 = '1';
    public $gas1 = '1';
    public $cons1 = null;
    public $cons1_unit2 = 'Pa';
    public $mole1 = null;
    public $partial3 = null;
    public $part_unit3 = 'Pa';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if(isset($inputs->formula)){
                foreach (get_object_vars($inputs) as $key => $val) {
                    if (property_exists($this, $key)) {
                        $this->$key = $val;
                    }
                }
            }
        }
    }

    public function resetForm()
    {
        $this->reset([
            'formula', 'to_cal1', 'total', 'total_unit', 'mole', 'partial', 'part_unit',
            'to_cal2', 'amole', 'temp', 'temp_unit', 'volume', 'vol_unit', 'partial1', 'part_unit1',
            'to_cal3', 'gas', 'cons', 'conc', 'conc_unit', 'partial2', 'part_unit2',
            'to_cal4', 'gas1', 'cons1', 'cons1_unit2', 'mole1', 'partial3', 'part_unit3',
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

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['formula', 'to_cal1', 'to_cal2', 'to_cal3', 'to_cal4'])) {
            $this->detail = null;
            $this->error = null;
            session()->forget(['calculator_result', 'scroll_to_result']);
        }
    }

    public function calculate()
    {
        $request = (object)[
            'formula' => $this->formula,
            'to_cal1' => $this->to_cal1,
            'total' => $this->total,
            'total_unit' => $this->total_unit,
            'mole' => $this->mole,
            'partial' => $this->partial,
            'part_unit' => $this->part_unit,
            'to_cal2' => $this->to_cal2,
            'amole' => $this->amole,
            'temp' => $this->temp,
            'temp_unit' => $this->temp_unit,
            'volume' => $this->volume,
            'vol_unit' => $this->vol_unit,
            'partial1' => $this->partial1,
            'part_unit1' => $this->part_unit1,
            'to_cal3' => $this->to_cal3,
            'gas' => $this->gas,
            'cons' => $this->cons,
            'conc' => $this->conc,
            'conc_unit' => $this->conc_unit,
            'partial2' => $this->partial2,
            'part_unit2' => $this->part_unit2,
            'to_cal4' => $this->to_cal4,
            'gas1' => $this->gas1,
            'cons1' => $this->cons1,
            'cons1_unit2' => $this->cons1_unit2,
            'mole1' => $this->mole1,
            'partial3' => $this->partial3,
            'part_unit3' => $this->part_unit3,
        ];

        $model = new Chemistry();
        $result = $model->partial($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            foreach($result as $key => $val) {
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
        return view('livewire.calculators.partial-pressure-calculator');
    }
}
