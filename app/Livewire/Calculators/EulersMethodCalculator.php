<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class EulersMethodCalculator extends Component
{
    public $EnterEq = '(x^2+4y)^(1/2)';
    public $steps = 'h';
    public $size = '0.2';
    public $ini = '0';
    public $con = '3';
    public $find = '1';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->EnterEq = $inputs['EnterEq'] ?? $this->EnterEq;
            $this->steps = $inputs['steps'] ?? $this->steps;
            $this->size = $inputs['size'] ?? $this->size;
            $this->ini = $inputs['ini'] ?? $this->ini;
            $this->con = $inputs['con'] ?? $this->con;
            $this->find = $inputs['find'] ?? $this->find;
        }
    }

    public function resetForm()
    {
        $this->EnterEq = '(x^2+4y)^(1/2)';
        $this->steps = 'h';
        $this->size = '0.2';
        $this->ini = '0';
        $this->con = '3';
        $this->find = '1';

        $this->error = null;
        $this->detail = null;

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
        $this->detail = null;
        $this->error = null;

        // Automatically set input presets based on step type choice
        if ($propertyName === 'steps') {
            if ($this->steps === 'h') {
                $this->size = '0.2';
            } else {
                $this->size = '3';
            }
        }
    }

    public function calculate()
    {
        $inputs = [
            'EnterEq' => $this->EnterEq,
            'steps' => $this->steps,
            'size' => $this->size,
            'ini' => $this->ini,
            'con' => $this->con,
            'find' => $this->find,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->eulers($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Apply float formatting guard to prevent corrupt component payload errors
            foreach ($result as $key => $value) {
                if (is_float($value)) {
                    $result[$key] = (string)round($value, 10);
                }
            }

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $inputs);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        } else if (typeof MJrerender === 'function') {
                            MJrerender();
                        }
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
            return;
        }

        $this->error = $result['error'] ?? 'Please! Check Your Input.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
        return view('livewire.calculators.eulers-method-calculator');
    }
}
