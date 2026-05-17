<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class NewtonsMethodCalculator extends Component
{
    public $fx = 'x^2';
    public $fx1 = '';
    public $x0 = '5';
    public $iter = '20';
    public $round = '4';

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
            $this->fx = $inputs['fx'] ?? $this->fx;
            $this->fx1 = $inputs['fx1'] ?? $this->fx1;
            $this->x0 = $inputs['x0'] ?? $this->x0;
            $this->iter = $inputs['iter'] ?? $this->iter;
            $this->round = $inputs['round'] ?? $this->round;
        }
    }

    public function resetForm()
    {
        $this->fx = 'x^2';
        $this->fx1 = '';
        $this->x0 = '5';
        $this->iter = '20';
        $this->round = '4';

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
            'fx' => $this->fx,
            'fx1' => $this->fx1,
            'x0' => $this->x0,
            'iter' => $this->iter,
            'round' => $this->round,
        ];

        // Construct request compatibility layer
        $request = (object)$inputs;

        $model = new Math();
        $result = $model->newtons($request);

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
        return view('livewire.calculators.newtons-method-calculator');
    }
}
