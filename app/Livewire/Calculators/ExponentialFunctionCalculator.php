<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class ExponentialFunctionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $renderCount = 0;

    public $t1 = 2;
    public $y1 = 4;
    public $t2 = 5;
    public $y2 = 5;
    public $point_optional = null;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->t1 = $inputs['t1'] ?? 2;
            $this->y1 = $inputs['y1'] ?? 4;
            $this->t2 = $inputs['t2'] ?? 5;
            $this->y2 = $inputs['y2'] ?? 5;
            $this->point_optional = $inputs['point_optional'] ?? null;
        }
    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;
        $this->reset(['t1', 'y1', 't2', 'y2', 'point_optional']);

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
            't1' => $this->t1,
            'y1' => $this->y1,
            't2' => $this->t2,
            'y2' => $this->y2,
            'point_optional' => $this->point_optional,
        ];

        $model = new Math();
        $result = $model->exponet_function($request);

        if (is_array($result)) {
            foreach ($result as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $result[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $result[$key] = 'INF';
                    }
                }
            }
        }

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->renderCount++;
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
                        if (typeof MJrerender === 'function') {
                            MJrerender();
                        } else if (typeof MathJax !== 'undefined') {
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
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
        return view('livewire.calculators.exponential-function-calculator');
    }
}
