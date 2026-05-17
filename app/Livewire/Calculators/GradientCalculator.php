<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class GradientCalculator extends Component
{
    public $gradient_type = 'two';
    public $EnterEq = 'x^2+y^3';
    public $x = '1';
    public $y = '3';
    public $z = '2';

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
            $this->gradient_type = $inputs['type'] ?? $this->gradient_type;
            $this->EnterEq = $inputs['EnterEq'] ?? $this->EnterEq;
            $this->x = $inputs['x'] ?? $this->x;
            $this->y = $inputs['y'] ?? $this->y;
            $this->z = $inputs['z'] ?? $this->z;
        }
    }

    public function setDimension($dimension)
    {
        $this->gradient_type = $dimension;
        if ($dimension === 'three') {
            $this->EnterEq = 'x^2+y^3+z^4';
        } else {
            $this->EnterEq = 'x^2+y^3';
        }
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->gradient_type = 'two';
        $this->EnterEq = 'x^2+y^3';
        $this->x = '1';
        $this->y = '3';
        $this->z = '2';

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
        $inputs = [
            'type' => $this->gradient_type,
            'EnterEq' => $this->EnterEq,
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->gradient($request);

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
                        if (typeof MJrerender === 'function') {
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
        return view('livewire.calculators.gradient-calculator');
    }
}
