<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class RationalExpressionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $to = '1';
    public $to_cal = 'two';
    public $n1 = 'x^2-2x+1';
    public $d1 = 'x^2-1';
    public $n11 = 'x^2-13';
    public $d11 = 'x^3-26';
    public $action = 'plus';
    public $n22 = 'x^3-3';
    public $d22 = 'x-2';
    public $n13 = 'x^2-13';
    public $d13 = 'x^3-26';
    public $action1 = 'plus';
    public $n23 = 'x^3-3';
    public $d23 = 'x-2';
    public $action2 = 'plus';
    public $n33 = '2x^3+12-3x';
    public $d33 = '3x-5';
    public $expr = '(x^2+3)/(2x+1)-(x+1)/(3x+2)';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->to = $inputs['to'] ?? '1';
            $this->to_cal = $inputs['to_cal'] ?? 'two';
            $this->n1 = $inputs['n1'] ?? 'x^2-2x+1';
            $this->d1 = $inputs['d1'] ?? 'x^2-1';
            $this->n11 = $inputs['n11'] ?? 'x^2-13';
            $this->d11 = $inputs['d11'] ?? 'x^3-26';
            $this->action = $inputs['action'] ?? 'plus';
            $this->n22 = $inputs['n22'] ?? 'x^3-3';
            $this->d22 = $inputs['d22'] ?? 'x-2';
            $this->n13 = $inputs['n13'] ?? 'x^2-13';
            $this->d13 = $inputs['d13'] ?? 'x^3-26';
            $this->action1 = $inputs['action1'] ?? 'plus';
            $this->n23 = $inputs['n23'] ?? 'x^3-3';
            $this->d23 = $inputs['d23'] ?? 'x-2';
            $this->action2 = $inputs['action2'] ?? 'plus';
            $this->n33 = $inputs['n33'] ?? '2x^3+12-3x';
            $this->d33 = $inputs['d33'] ?? '3x-5';
            $this->expr = $inputs['expr'] ?? '(x^2+3)/(2x+1)-(x+1)/(3x+2)';
        } else {
            $this->to = '1';
            $this->to_cal = 'two';
            $this->n1 = 'x^2-2x+1';
            $this->d1 = 'x^2-1';
            $this->n11 = 'x^2-13';
            $this->d11 = 'x^3-26';
            $this->action = 'plus';
            $this->n22 = 'x^3-3';
            $this->d22 = 'x-2';
            $this->n13 = 'x^2-13';
            $this->d13 = 'x^3-26';
            $this->action1 = 'plus';
            $this->n23 = 'x^3-3';
            $this->d23 = 'x-2';
            $this->action2 = 'plus';
            $this->n33 = '2x^3+12-3x';
            $this->d33 = '3x-5';
            $this->expr = '(x^2+3)/(2x+1)-(x+1)/(3x+2)';
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->to = '1';
        $this->to_cal = 'two';
        $this->n1 = 'x^2-2x+1';
        $this->d1 = 'x^2-1';
        $this->n11 = 'x^2-13';
        $this->d11 = 'x^3-26';
        $this->action = 'plus';
        $this->n22 = 'x^3-3';
        $this->d22 = 'x-2';
        $this->n13 = 'x^2-13';
        $this->d13 = 'x^3-26';
        $this->action1 = 'plus';
        $this->n23 = 'x^3-3';
        $this->d23 = 'x-2';
        $this->action2 = 'plus';
        $this->n33 = '2x^3+12-3x';
        $this->d33 = '3x-5';
        $this->expr = '(x^2+3)/(2x+1)-(x+1)/(3x+2)';

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
        request()->replace(array_merge(request()->all(), [
            'to' => $this->to,
            'to_cal' => $this->to_cal,
            'n1' => $this->to == '2' && $this->to_cal == 'three' ? $this->n13 : $this->n1,
            'd1' => $this->to == '2' && $this->to_cal == 'three' ? $this->d13 : $this->d1,
            'n2' => $this->n23,
            'd2' => $this->d23,
            'n3' => $this->n33,
            'd3' => $this->d33,
            'acrion1' => $this->action1,
            'acrion2' => $this->action2,
            'n11' => $this->n11,
            'd11' => $this->d11,
            'action' => $this->action,
            'n22' => $this->n22,
            'd22' => $this->d22,
            'n13' => $this->n13,
            'd13' => $this->d13,
            'action1' => $this->action1,
            'n23' => $this->n23,
            'd23' => $this->d23,
            'action2' => $this->action2,
            'n33' => $this->n33,
            'd33' => $this->d33,
            'expr' => $this->expr,
        ]));

        $model = new Math();
        $result = $model->rational(request());
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'to' => $this->to,
                'to_cal' => $this->to_cal,
                'n1' => $this->n1,
                'd1' => $this->d1,
                'n11' => $this->n11,
                'd11' => $this->d11,
                'action' => $this->action,
                'n22' => $this->n22,
                'd22' => $this->d22,
                'n13' => $this->n13,
                'd13' => $this->d13,
                'action1' => $this->action1,
                'n23' => $this->n23,
                'd23' => $this->d23,
                'action2' => $this->action2,
                'n33' => $this->n33,
                'd33' => $this->d33,
                'expr' => $this->expr,
            ]);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');
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
        return view('livewire.calculators.rational-expression-calculator');
    }
}
