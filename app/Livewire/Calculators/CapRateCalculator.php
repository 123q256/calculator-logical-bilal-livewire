<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class CapRateCalculator extends Component
{
    public $prop_val = 200000;
    public $ann_grs_inc = 30000;
    public $op_exp = 12;
    public $op_exp_unit = '%';
    public $vac_rate = 10;
    
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->prop_val = $inputs->prop_val ?? $this->prop_val;
            $this->ann_grs_inc = $inputs->ann_grs_inc ?? $this->ann_grs_inc;
            $this->op_exp = $inputs->op_exp ?? $this->op_exp;
            $this->op_exp_unit = $inputs->op_exp_unit ?? $this->op_exp_unit;
            $this->vac_rate = $inputs->vac_rate ?? $this->vac_rate;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->prop_val = 200000;
        $this->ann_grs_inc = 30000;
        $this->op_exp = 12;
        $this->op_exp_unit = '%';
        $this->vac_rate = 10;
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'prop_val' => $this->prop_val,
            'ann_grs_inc' => $this->ann_grs_inc,
            'op_exp' => $this->op_exp,
            'op_exp_unit' => $this->op_exp_unit,
            'vac_rate' => $this->vac_rate,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->cap($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

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
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
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

        return view('livewire.calculators.cap-rate-calculator');
    }
}
