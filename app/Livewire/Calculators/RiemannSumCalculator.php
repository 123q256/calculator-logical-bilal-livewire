<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class RiemannSumCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Riemann inputs
    public $EnterEq = '(x^2+4)^(1/2)';
    public $with = 'x';
    public $lb = '1';
    public $ub = '4';
    public $n = '5';
    public $sum_type = '1';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        if (is_array($this->detail)) {
            foreach ($this->detail as $key => $value) {
                if (is_float($value)) {
                    $this->detail[$key] = (string)round($value, 10);
                }
            }
        }
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->EnterEq = $inputs['EnterEq'] ?? '(x^2+4)^(1/2)';
            $this->with = $inputs['with'] ?? 'x';
            $this->lb = $inputs['lb'] ?? '1';
            $this->ub = $inputs['ub'] ?? '4';
            $this->n = $inputs['n'] ?? '5';
            $this->sum_type = $inputs['type'] ?? '1';
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->EnterEq = '(x^2+4)^(1/2)';
        $this->with = 'x';
        $this->lb = '1';
        $this->ub = '4';
        $this->n = '5';
        $this->sum_type = '1';

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
        $inputs = [
            'EnterEq' => $this->EnterEq,
            'with' => $this->with,
            'lb' => $this->lb,
            'ub' => $this->ub,
            'n' => $this->n,
            'type' => $this->sum_type,
        ];

        // Construct request compatibility layer with all() method and __get magic method
        $request = new class($inputs) {
            private $inputs;
            public function __construct($inputs) {
                $this->inputs = $inputs;
            }
            public function all() {
                return $this->inputs;
            }
            public function __get($name) {
                return $this->inputs[$name] ?? null;
            }
        };

        $model = new Math();
        $result = $model->riemann($request);

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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.riemann-sum-calculator');
    }
}
