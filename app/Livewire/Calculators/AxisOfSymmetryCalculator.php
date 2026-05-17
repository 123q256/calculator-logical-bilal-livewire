<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class AxisOfSymmetryCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $eq = '2x^2+5x-1';
    public $renderCount = 0;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->eq = $inputs['eq'] ?? '2x^2+5x-1';
        }

        $request = request();
        if ($request->has('eq')) {
            $this->eq = $request->eq;
        }
    }

    public function resetForm()
    {
        $this->eq = '2x^2+5x-1';
        $this->error = null;
        $this->detail = null;
        $this->renderCount = 0;

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
    }

    public function calculate()
    {
        $request = request();
        $request->merge([
            'eq' => $this->eq,
        ]);

        $model = new Math();
        $result = $model->axis($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $a_val = floatval($result['coeff_a']);
            $b_val = floatval($result['coeff_b']);
            $c_val = floatval($result['coeff_c']);
            
            $x_vertex = -$b_val / (2 * $a_val);
            $y_vertex = $a_val * pow($x_vertex, 2) + $b_val * $x_vertex + $c_val;

            if ($a_val > 0) {
                $bounds = [$x_vertex - 10, $y_vertex + 18, $x_vertex + 10, $y_vertex - 2];
            } else {
                $bounds = [$x_vertex - 10, $y_vertex + 2, $x_vertex + 10, $y_vertex - 18];
            }

            $result['chartData'] = json_encode([
                'box1' => [
                    'bounds' => $bounds,
                    'p1' => [$x_vertex, $y_vertex],
                    'p2' => [$x_vertex, $y_vertex + 5],
                    'a' => $a_val,
                    'b' => $b_val,
                    'c' => $c_val
                ]
            ]);

            $this->renderCount++;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', ['eq' => $this->eq]);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MathJax !== 'undefined' && MathJax.Hub && typeof MathJax.Hub.Queue === 'function') {
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
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

        $this->error = $result['error'] ?? 'Please check your input.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    if (typeof MathJax !== 'undefined' && MathJax.Hub && typeof MathJax.Hub.Queue === 'function') {
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.axis-of-symmetry-calculator');
    }
}
