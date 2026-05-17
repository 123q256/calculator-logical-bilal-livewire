<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class MaclaurinSeriesCalculator extends Component
{
    public $EnterEq = '(x^2+4)^(1/2)';
    public $with = 'x';
    public $n = '4';
    public $find = '';

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
            $this->with = $inputs['with'] ?? $this->with;
            $this->n = $inputs['n'] ?? $this->n;
            $this->find = $inputs['find'] ?? $this->find;
        }
    }

    public function resetForm()
    {
        $this->EnterEq = '(x^2+4)^(1/2)';
        $this->with = 'x';
        $this->n = '4';
        $this->find = '';

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
        if (empty($this->EnterEq)) {
            $this->error = 'The Equation field is required.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        if (empty($this->n)) {
            $this->error = 'The degree n is required.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $inputs = [
            'EnterEq' => $this->EnterEq,
            'with' => $this->with,
            'n' => $this->n,
            'find' => $this->find,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->maclaurin($request);

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
                $this->dispatch('math-updated');
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
        return view('livewire.calculators.maclaurin-series-calculator');
    }
}
