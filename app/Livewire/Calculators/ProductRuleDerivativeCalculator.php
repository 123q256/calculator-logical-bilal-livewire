<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class ProductRuleDerivativeCalculator extends Component
{
    public $EnterEq = '(5x^5-3x)(3x^{7}+2)';
    public $with = 'x';
    public $how = '1';

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
            $this->EnterEq = $inputs['EnterEq'] ?? '(5x^5-3x)(3x^{7}+2)';
            $this->with = $inputs['with'] ?? 'x';
            $this->how = $inputs['how'] ?? '1';
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->EnterEq = '(5x^5-3x)(3x^{7}+2)';
        $this->with = 'x';
        $this->how = '1';

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
            'how' => $this->how,
        ]);

        $model = new Math();
        $result = $model->product(request());
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'EnterEq' => $this->EnterEq,
                'with' => $this->with,
                'how' => $this->how,
            ]);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof rerenderMath === 'function') {
                            rerenderMath();
                        } else if (typeof MJrerender === 'function') {
                            MJrerender();
                        } else if (typeof MathJax !== 'undefined') {
                            if (typeof MathJax.typesetPromise === 'function') MathJax.typesetPromise();
                            else if (typeof MathJax.typeset === 'function') MathJax.typeset();
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
            $this->dispatch('math-updated');
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.product-rule-derivative-calculator');
    }
}
