<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class RatioCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $a;
    public $b;
    public $c;
    public $c1;
    public $d;
    public $e;
    public $f;
    public $i = 2;
    public $ratio_of = 'r2';
    public $method = '0';
    public $method1 = '0';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->a = $inputs['a'] ?? null;
            $this->b = $inputs['b'] ?? null;
            $this->c = $inputs['c'] ?? null;
            $this->c1 = $inputs['c1'] ?? null;
            $this->d = $inputs['d'] ?? null;
            $this->e = $inputs['e'] ?? null;
            $this->f = $inputs['f'] ?? null;
            $this->i = $inputs['i'] ?? 2;
            $this->ratio_of = $inputs['ratio_of'] ?? 'r2';
            $this->method = $inputs['method'] ?? '0';
            $this->method1 = $inputs['method1'] ?? '0';
        }
    }

    public function resetForm()
    {
        $this->a = null;
        $this->b = null;
        $this->c = null;
        $this->c1 = null;
        $this->d = null;
        $this->e = null;
        $this->f = null;
        $this->i = 2;
        $this->ratio_of = 'r2';
        $this->method = '0';
        $this->method1 = '0';
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

    public function updatedRatioOf()
    {
        $this->c = null;
        $this->c1 = null;
        $this->d = null;
        $this->e = null;
        $this->f = null;
        $this->i = 2;
        $this->detail = null;
        $this->error = null;
    }

    public function updatedMethod()
    {
        $this->c = null;
        $this->c1 = null;
        $this->d = null;
        $this->e = null;
        $this->f = null;
        $this->i = 2;
        $this->detail = null;
        $this->error = null;
    }

    public function updatedMethod1()
    {
        $this->c = null;
        $this->c1 = null;
        $this->d = null;
        $this->e = null;
        $this->f = null;
        $this->i = 2;
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'c1' => $this->c1,
            'd' => $this->d,
            'e' => $this->e,
            'f' => $this->f,
            'i' => $this->i,
            'ratio_of' => $this->ratio_of,
            'method' => $this->method,
            'method1' => $this->method1,
        ];

        $model = new Math();
        $result = $model->ratio($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Prepare Chart Data
            $res_a = $result['a_val'] ?? $result['a_val1'] ?? $result['a_val2'] ?? $result['a_val3'] ?? $result['a_val4'] ?? $result['a_val5'] ?? $result['a_val6'] ?? $this->a;
            $res_b = $result['b_val'] ?? $result['b_val1'] ?? $result['b_val2'] ?? $result['b_val3'] ?? $result['b_val4'] ?? $result['b_val5'] ?? $result['b_val6'] ?? $this->b;
            $res_c1 = $result['c_val1'] ?? $result['c_val2'] ?? $result['c_val3'] ?? $result['c_val4'] ?? $result['c_val5'] ?? $result['c_val6'] ?? $this->c1;

            $chartData = [
                ['name' => 'Part A', 'y' => (float)$res_a],
                ['name' => 'Part B', 'y' => (float)$res_b],
            ];
            if (isset($result['r3'])) {
                $chartData[] = ['name' => 'Part C', 'y' => (float)$res_c1];
            }
            $result['chartData'] = json_encode($chartData);

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;
            
            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('chart-updated', $chartData);
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
        if (session('scroll_to_result') || $this->detail) {
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
        return view('livewire.calculators.ratio-calculator');
    }
}
