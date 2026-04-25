<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class MolecularFormulaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $no1 = 1;
    public $opt1 = "1000@@Gram Per Mole";
    public $no2 = 1;
    public $opt2 = "1@@Kilogram";

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if(isset($inputs->no1)){
                $this->no1 = $inputs->no1;
                $this->opt1 = $inputs->opt1;
                $this->no2 = $inputs->no2;
                $this->opt2 = $inputs->opt2;
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['no1', 'opt1', 'no2', 'opt2', 'error', 'detail']);
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
            'no1' => $this->no1,
            'opt1' => $this->opt1,
            'no2' => $this->no2,
            'opt2' => $this->opt2,
        ];

        $model = new Chemistry();
        $result = $model->molecular($request);
        
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
        return view('livewire.calculators.molecular-formula-calculator');
    }
}
