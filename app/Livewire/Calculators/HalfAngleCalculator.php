<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class HalfAngleCalculator extends Component
{
    public $cal = 'angle';
    public $angle = '60';
    public $angle_unit = 'deg';
    public $func = '0.5';
    public $showUnitDropdown = false;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function getUnitLabel()
    {
        if ($this->angle_unit === 'rad') return 'rad';
        if ($this->angle_unit === 'pirad') return '* π rad';
        return 'deg';
    }

    public function getFuncLabel()
    {
        if ($this->cal === 'sinx') return 'sin(x)';
        if ($this->cal === 'cosx') return 'cos(x)';
        if ($this->cal === 'tanx') return 'tan(x)';
        if ($this->cal === 'sinx_2') return 'sin(x/2)';
        if ($this->cal === 'cosx_2') return 'cos(x/2)';
        return 'sin(x)';
    }

    public function setUnit($unit)
    {
        $this->angle_unit = $unit;
        $this->showUnitDropdown = false;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal = $inputs['cal'] ?? $this->cal;
            $this->angle = $inputs['angle'] ?? $this->angle;
            $this->angle_unit = $inputs['angle_unit'] ?? $this->angle_unit;
            $this->func = $inputs['func'] ?? $this->func;
        }
    }

    public function resetForm()
    {
        $this->cal = 'angle';
        $this->angle = '60';
        $this->angle_unit = 'deg';
        $this->func = '0.5';
        
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
            'cal' => $this->cal,
            'angle' => $this->angle,
            'angle_unit' => $this->angle_unit,
            'func' => $this->func,
        ];

        // Construct request compatibility layer
        $request = (object)$inputs;

        $model = new Math();
        $result = $model->half($request);

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
        return view('livewire.calculators.half-angle-calculator');
    }
}
