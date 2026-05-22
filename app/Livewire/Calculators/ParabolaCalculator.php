<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class ParabolaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $from = '1';
    public $a = 2;
    public $b = -6;
    public $c = -13;
    public $h1 = 3;
    public $k1 = 4;
    public $x11 = 2;
    public $y11 = 3;
    public $x1 = 0;
    public $y1 = 3;
    public $x2 = 1;
    public $y2 = 2;
    public $x3 = 2;
    public $y3 = 3;
    public $axis = 'x';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->from = $inputs['from'] ?? '1';
            $this->a = $inputs['a'] ?? 2;
            $this->b = $inputs['b'] ?? -6;
            $this->c = $inputs['c'] ?? -13;
            $this->h1 = $inputs['h1'] ?? 3;
            $this->k1 = $inputs['k1'] ?? 4;
            $this->x11 = $inputs['x11'] ?? 2;
            $this->y11 = $inputs['y11'] ?? 3;
            $this->x1 = $inputs['x1'] ?? 0;
            $this->y1 = $inputs['y1'] ?? 3;
            $this->x2 = $inputs['x2'] ?? 1;
            $this->y2 = $inputs['y2'] ?? 2;
            $this->x3 = $inputs['x3'] ?? 2;
            $this->y3 = $inputs['y3'] ?? 3;
            $this->axis = $inputs['axis'] ?? 'x';
        }
    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;

        $this->from = '1';
        $this->a = 2;
        $this->b = -6;
        $this->c = -13;
        $this->h1 = 3;
        $this->k1 = 4;
        $this->x11 = 2;
        $this->y11 = 3;
        $this->x1 = 0;
        $this->y1 = 3;
        $this->x2 = 1;
        $this->y2 = 2;
        $this->x3 = 2;
        $this->y3 = 3;
        $this->axis = 'x';

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
            'from' => $this->from,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'h1' => $this->h1,
            'k1' => $this->k1,
            'x11' => $this->x11,
            'y11' => $this->y11,
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x2' => $this->x2,
            'y2' => $this->y2,
            'x3' => $this->x3,
            'y3' => $this->y3,
            'axis' => $this->axis,
        ];

        $model = new Math();
        $result = $model->parabola($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
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
        return view('livewire.calculators.parabola-calculator');
    }
}
