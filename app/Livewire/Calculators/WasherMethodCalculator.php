<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class WasherMethodCalculator extends Component
{
    public $EnterEq = 'x-2';
    public $EnterEq1 = '-2';
    public $ub = 3;
    public $lb = 2;

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
            $this->EnterEq = $inputs['EnterEq'] ?? $this->EnterEq;
            $this->EnterEq1 = $inputs['EnterEq1'] ?? $this->EnterEq1;
            $this->ub = $inputs['ub'] ?? $this->ub;
            $this->lb = $inputs['lb'] ?? $this->lb;
        }
    }

    public function resetForm()
    {
        $this->EnterEq = 'x-2';
        $this->EnterEq1 = '-2';
        $this->ub = 3;
        $this->lb = 2;

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
        if (empty($this->EnterEq) || empty($this->EnterEq1)) {
            $this->error = 'Please enter valid equations for f(x) and g(x).';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        if (!is_numeric($this->ub) || !is_numeric($this->lb)) {
            $this->error = 'Upper and lower bounds must be valid numbers.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $inputs = [
            'EnterEq' => $this->EnterEq,
            'EnterEq1' => $this->EnterEq1,
            'ub' => $this->ub,
            'lb' => $this->lb,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->washer($request);
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
                        if (typeof convertLegacyMathScripts === 'function') {
                            convertLegacyMathScripts();
                        }
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
        return view('livewire.calculators.washer-method-calculator');
    }
}
