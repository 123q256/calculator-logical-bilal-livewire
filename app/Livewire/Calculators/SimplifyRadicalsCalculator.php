<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SimplifyRadicalsCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $expression_unit = '1';
    public $num1 = '5';
    public $num2 = '7';
    public $num3 = '7';
    public $num4 = '7';
    public $num5 = '7';
    public $num6 = '7';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->expression_unit = $inputs['expression_unit'] ?? '1';
            $this->num1 = $inputs['num1'] ?? '5';
            $this->num2 = $inputs['num2'] ?? '7';
            $this->num3 = $inputs['num3'] ?? '7';
            $this->num4 = $inputs['num4'] ?? '7';
            $this->num5 = $inputs['num5'] ?? '7';
            $this->num6 = $inputs['num6'] ?? '7';
        }
    }

    public function resetForm()
    {
        $this->expression_unit = '1';
        $this->num1 = '5';
        $this->num2 = '7';
        $this->num3 = '7';
        $this->num4 = '7';
        $this->num5 = '7';
        $this->num6 = '7';
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
        $request = \Illuminate\Http\Request::create('', 'POST', [
            'expression_unit' => $this->expression_unit,
            'num1' => $this->num1,
            'num2' => $this->num2,
            'num3' => $this->num3,
            'num4' => $this->num4,
            'num5' => $this->num5,
            'num6' => $this->num6,
        ]);

        $model = new Math();
        $result = $model->simplify_radicals($request);

        if (is_array($result)) {
            foreach ($result as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $result[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $result[$key] = 'INF';
                    }
                }
            }
        }

        if (!empty($result) && !isset($result['error'])) {
            $result['RESULT'] = 1;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'expression_unit' => $this->expression_unit,
                'num1' => $this->num1,
                'num2' => $this->num2,
                'num3' => $this->num3,
                'num4' => $this->num4,
                'num5' => $this->num5,
                'num6' => $this->num6,
            ]);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js("
                    setTimeout(() => {
                        if (typeof calculate === 'function') {
                            calculate({$result['num1']}, {$result['num2']}, {$result['num4']}, {$result['num5']}, {$result['num3']}, {$result['num6']}, {$result['expression_unit']});
                        }
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                ");
            }
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result') && $this->detail) {
            $result = $this->detail;
            $this->js("
                setTimeout(() => {
                    if (typeof calculate === 'function') {
                        calculate({$result['num1']}, {$result['num2']}, {$result['num4']}, {$result['num5']}, {$result['num3']}, {$result['num6']}, {$result['expression_unit']});
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            ");
        }
        return view('livewire.calculators.simplify-radicals-calculator');
    }
}
