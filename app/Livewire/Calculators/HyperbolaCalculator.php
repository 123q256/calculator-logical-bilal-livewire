<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class HyperbolaCalculator extends Component
{
    public $x = 1;
    public $y = 4;
    public $a = 7;
    public $b = 11;

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
            $this->x = $inputs['x'] ?? $this->x;
            $this->y = $inputs['y'] ?? $this->y;
            $this->a = $inputs['a'] ?? $this->a;
            $this->b = $inputs['b'] ?? $this->b;
        }
    }

    public function resetForm()
    {
        $this->x = 1;
        $this->y = 4;
        $this->a = 7;
        $this->b = 11;

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
        if (!is_numeric($this->x) || !is_numeric($this->y) || !is_numeric($this->a) || !is_numeric($this->b)) {
            $this->error = 'Please enter valid numbers for all inputs.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        if ($this->a < 1 || $this->b < 1) {
            $this->error = 'Parameters a and b must be at least 1.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $inputs = [
            'x' => $this->x,
            'y' => $this->y,
            'a' => $this->a,
            'b' => $this->b,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        // Populate $_POST superglobal just in case legacy models try to access it
        $_POST['x'] = $this->x;
        $_POST['y'] = $this->y;
        $_POST['a'] = $this->a;
        $_POST['b'] = $this->b;

        $model = new Math();
        $result = $model->hyperbola($request);

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
        return view('livewire.calculators.hyperbola-calculator');
    }
}
