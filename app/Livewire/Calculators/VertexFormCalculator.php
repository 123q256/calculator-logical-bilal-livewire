<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class VertexFormCalculator extends Component
{
    public $vertex_type = 'standard';
    public $a1 = '';
    public $b1 = '';
    public $c1 = '';
    public $a = '12';
    public $b = '';
    public $c = '';
    public $renderCount = 0;

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
            $this->vertex_type = $inputs['type'] ?? $this->vertex_type;
            $this->a1 = $inputs['a1'] ?? $this->a1;
            $this->b1 = $inputs['b1'] ?? $this->b1;
            $this->c1 = $inputs['c1'] ?? $this->c1;
            $this->a = $inputs['a'] ?? $this->a;
            $this->b = $inputs['b'] ?? $this->b;
            $this->c = $inputs['c'] ?? $this->c;
        }
    }

    public function setVertexType($vertexType)
    {
        $this->vertex_type = $vertexType;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->vertex_type = 'standard';
        $this->a1 = '';
        $this->b1 = '';
        $this->c1 = '';
        $this->a = '12';
        $this->b = '';
        $this->c = '';
        $this->renderCount = 0;

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
        if ($this->vertex_type === 'standard') {
            if (empty($this->a1) || $this->a1 == 0) {
                $this->error = 'Enter a, In quadratic equation a is not equal 0';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        } else {
            if (empty($this->a) || $this->a == 0) {
                $this->error = 'Enter a, In vertex equation a is not equal 0';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        }

        $inputs = [
            'type' => $this->vertex_type,
            'a1' => $this->a1,
            'b1' => $this->b1,
            'c1' => $this->c1,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->vertex($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Apply float formatting guard to prevent corrupt component payload errors
            foreach ($result as $key => $value) {
                if (is_float($value)) {
                    $result[$key] = round($value, 10);
                }
            }

            $this->renderCount++;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $inputs);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('chartUpdated');
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
        return view('livewire.calculators.vertex-form-calculator');
    }
}
