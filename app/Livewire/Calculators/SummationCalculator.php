<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SummationCalculator extends Component
{
    public $cal_meth = 'simple_sum';
    public $nums = '1,2,3,4,5';
    public $eq = 'x^2';
    public $x = '1';
    public $n = '5';

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
            $this->cal_meth = $inputs['cal_meth'] ?? $this->cal_meth;
            $this->nums = $inputs['nums'] ?? $this->nums;
            $this->eq = $inputs['eq'] ?? $this->eq;
            $this->x = $inputs['x'] ?? $this->x;
            $this->n = $inputs['n'] ?? $this->n;
        }
    }

    public function resetForm()
    {
        $this->cal_meth = 'simple_sum';
        $this->nums = '1,2,3,4,5';
        $this->eq = 'x^2';
        $this->x = '1';
        $this->n = '5';

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
        if ($this->cal_meth === 'simple_sum') {
            if (empty($this->nums)) {
                $this->error = 'The Numbers field is required.';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        } else {
            if (empty($this->eq) || empty($this->x) || empty($this->n)) {
                $this->error = 'Please fill out all the equation parameters.';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        }

        $inputs = [
            'cal_meth' => $this->cal_meth,
            'nums' => $this->nums,
            'eq' => $this->eq,
            'x' => $this->x,
            'n' => $this->n,
        ];

        // Populate $_POST superglobal to support direct reading in legacy Math::summation
        $_POST['cal_meth'] = $this->cal_meth;
        $_POST['nums'] = $this->nums;
        $_POST['eq'] = $this->eq;
        $_POST['x'] = $this->x;
        $_POST['n'] = $this->n;

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->summation($request);

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
        return view('livewire.calculators.summation-calculator');
    }
}
