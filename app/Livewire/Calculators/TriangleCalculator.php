<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class TriangleCalculator extends Component
{
    public $a = '5';
    public $b = '13';
    public $c = '';
    public $A = '';
    public $B = '';
    public $C = '45';
    public $unit = '1';
    public $device = 'desktop';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->device = is_numeric(strpos(strtolower(request()->header('User-Agent', '')), 'mobile')) ? 'mobile' : 'desktop';
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->a = $inputs['a'] ?? $this->a;
            $this->b = $inputs['b'] ?? $this->b;
            $this->c = $inputs['c'] ?? $this->c;
            $this->A = $inputs['A'] ?? $this->A;
            $this->B = $inputs['B'] ?? $this->B;
            $this->C = $inputs['C'] ?? $this->C;
            $this->unit = $inputs['unit'] ?? $this->unit;
        }
    }

    public function resetForm()
    {
        $this->a = '5';
        $this->b = '13';
        $this->c = '';
        $this->A = '';
        $this->B = '';
        $this->C = '45';
        $this->unit = '1';

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
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'A' => $this->A,
            'B' => $this->B,
            'C' => $this->C,
            'unit' => $this->unit,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->triangle($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Apply float formatting guard to prevent corrupt component payload errors
            foreach ($result as $key => $value) {
                if (is_float($value)) {
                    if (is_nan($value)) {
                        $result[$key] = 'NAN';
                    } else {
                        $result[$key] = (string)round($value, 10);
                    }
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
                $this->dispatch('math-updated');
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

        $this->error = $result['error'] ?? "Please check your inputs.";
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
        return view('livewire.calculators.triangle-calculator');
    }
}
