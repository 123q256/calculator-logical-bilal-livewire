<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class OrthocenterCalculator extends Component
{
    public $x1 = '4';
    public $y1 = '3';
    public $x2 = '7';
    public $y2 = '5';
    public $x3 = '9';
    public $y3 = '1';

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
            $this->x1 = $inputs['x1'] ?? '4';
            $this->y1 = $inputs['y1'] ?? '3';
            $this->x2 = $inputs['x2'] ?? '7';
            $this->y2 = $inputs['y2'] ?? '5';
            $this->x3 = $inputs['x3'] ?? '9';
            $this->y3 = $inputs['y3'] ?? '1';
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->x1 = '4';
        $this->y1 = '3';
        $this->x2 = '7';
        $this->y2 = '5';
        $this->x3 = '9';
        $this->y3 = '1';

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
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x2' => $this->x2,
            'y2' => $this->y2,
            'x3' => $this->x3,
            'y3' => $this->y3,
        ]);

        $model = new Math();
        $result = $model->orthocenter(request());

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'x1' => $this->x1,
                'y1' => $this->y1,
                'x2' => $this->x2,
                'y2' => $this->y2,
                'x3' => $this->x3,
                'y3' => $this->y3,
            ]);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.orthocenter-calculator');
    }
}
