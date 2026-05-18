<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SimpsonsRuleCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $EnterEq = '(x^2+4)^(1/2)';
    public $with = 'x';
    public $lb = 1;
    public $ub = 4;
    public $n = 6;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->EnterEq = $inputs['EnterEq'] ?? '(x^2+4)^(1/2)';
            $this->with = $inputs['with'] ?? 'x';
            $this->lb = $inputs['lb'] ?? 1;
            $this->ub = $inputs['ub'] ?? 4;
            $this->n = $inputs['n'] ?? 6;
        } else {
            $this->EnterEq = '(x^2+4)^(1/2)';
            $this->with = 'x';
            $this->lb = 1;
            $this->ub = 4;
            $this->n = 6;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->EnterEq = '(x^2+4)^(1/2)';
        $this->with = 'x';
        $this->lb = 1;
        $this->ub = 4;
        $this->n = 6;

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
        request()->merge([
            'EnterEq' => $this->EnterEq,
            'with' => $this->with,
            'lb' => $this->lb,
            'ub' => $this->ub,
            'n' => $this->n,
        ]);

        $model = new Math();
        $result = $model->simpsons(request());

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'EnterEq' => $this->EnterEq,
                'with' => $this->with,
                'lb' => $this->lb,
                'ub' => $this->ub,
                'n' => $this->n,
            ]);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');
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

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.simpsons-rule-calculator');
    }
}
