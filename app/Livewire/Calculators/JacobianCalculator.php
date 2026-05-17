<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class JacobianCalculator extends Component
{
    public $xu_var = 'u';
    public $xu = 'u^2-v^3';
    public $yv_var = 'v';
    public $yv = 'u^2+v^3';
    public $zw_var = 'w';
    public $zw = 'u^2+v^3+w';
    public $calc_type = 'two'; // Renamed to prevent collision with mount parameter

    public $error = null;
    public $detail = null;
    public $layout_type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->layout_type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->xu_var = $inputs['xu_var'] ?? $this->xu_var;
            $this->xu = $inputs['xu'] ?? $this->xu;
            $this->yv_var = $inputs['yv_var'] ?? $this->yv_var;
            $this->yv = $inputs['yv'] ?? $this->yv;
            $this->zw_var = $inputs['zw_var'] ?? $this->zw_var;
            $this->zw = $inputs['zw'] ?? $this->zw;
            $this->calc_type = $inputs['calc_type'] ?? $this->calc_type;
        }
    }

    public function resetForm()
    {
        $this->xu_var = 'u';
        $this->xu = 'u^2-v^3';
        $this->yv_var = 'v';
        $this->yv = 'u^2+v^3';
        $this->zw_var = 'w';
        $this->zw = 'u^2+v^3+w';
        $this->calc_type = 'two';

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
        if (empty($this->xu) || empty($this->yv)) {
            $this->error = 'The Equation fields are required.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        if ($this->calc_type === 'three' && empty($this->zw)) {
            $this->error = 'The third Equation field is required for 3 variables.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $inputs = [
            'xu_var' => $this->xu_var,
            'xu' => $this->xu,
            'yv_var' => $this->yv_var,
            'yv' => $this->yv,
            'zw_var' => $this->zw_var,
            'zw' => $this->zw,
            'calc_type' => $this->calc_type,
            'type' => $this->calc_type, // Passed to request as 'type' to remain fully compatible with Math::jacobian
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->jacobian($request);

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
        return view('livewire.calculators.jacobian-calculator');
    }
}
