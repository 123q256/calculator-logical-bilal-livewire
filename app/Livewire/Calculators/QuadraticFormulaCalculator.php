<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class QuadraticFormulaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $a = 2;
    public $b = -6;
    public $c = -13;
    public $formula = '1';
    public $method = '2';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['a'])) $this->a = $inputs['a'];
            if (isset($inputs['b'])) $this->b = $inputs['b'];
            if (isset($inputs['c'])) $this->c = $inputs['c'];
            if (isset($inputs['formula'])) $this->formula = $inputs['formula'];
            if (isset($inputs['method'])) $this->method = $inputs['method'];
        }
    }

  public function resetForm()
    {
        $this->a = 2;
        $this->b = -6;
        $this->c = -13;
        $this->formula = '1';
        $this->method = '2';
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
        $request = (object)[
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'formula' => $this->formula,
            'method' => $this->method,
        ];

        $model = new Math();
        $result = $model->quadratic($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Calculate chart data
            $A = $this->a;
            $B = $result['B'];
            $C = $result['C'];
            $firstx = ($B * (-1)) / ($this->a * 2);
            $startX = $firstx - 10;
            $endX = $firstx + 10;
            $chartData = [];
            for ($x = $startX; $x <= $endX; $x += 0.5) {
                $y = ($A * pow($x, 2)) + ($B * $x) + $C;
                $chartData[] = [(float)$x, (float)round($y, 4)];
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
                $this->dispatch('chart-update', $result['chartData']);
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof window.MJrerender === 'function') window.MJrerender();
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
        return view('livewire.calculators.quadratic-formula-calculator');
    }
}
