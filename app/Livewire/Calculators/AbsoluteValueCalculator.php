<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class AbsoluteValueCalculator extends Component
{
    public $calc_type = 'm1'; // 'm1' for absolute value, 'm2' for equation solver
    public $n = '-5';
    public $eq = '|3x+1|';
    public $n1 = '4';
    public $var = 'x';

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
            $this->calc_type = $inputs['type'] ?? $this->calc_type;
            $this->n = $inputs['n'] ?? $this->n;
            $this->eq = $inputs['eq'] ?? $this->eq;
            $this->n1 = $inputs['n1'] ?? $this->n1;
            $this->var = $inputs['var'] ?? $this->var;
        }
    }

    public function resetForm()
    {
        $this->calc_type = 'm1';
        $this->n = '-5';
        $this->eq = '|3x+1|';
        $this->n1 = '4';
        $this->var = 'x';

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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        // Validation check before model call
        if ($this->calc_type === 'm1') {
            if (!is_numeric($this->n)) {
                $this->error = 'Please enter a valid number.';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        } else {
            if (empty($this->eq) || !is_numeric($this->n1)) {
                $this->error = 'Please enter a valid equation and equation limit.';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        }

        $inputs = [
            'type' => $this->calc_type,
            'n' => $this->n,
            'eq' => $this->eq,
            'n1' => $this->n1,
            'var' => $this->var,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->absolute($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Apply float formatting guard to prevent corrupt component payload errors
            foreach ($result as $key => $value) {
                if (is_float($value)) {
                    $result[$key] = round($value, 10);
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
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
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

        $this->error = $result['error'] ?? 'Please check your inputs.';
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
        return view('livewire.calculators.absolute-value-calculator');
    }
}
