<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class FractionExponentCalculator extends Component
{
    public $x = '25';
    public $n = '1';
    public $d = '5';
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
            $this->x = $inputs['x'] ?? $this->x;
            $this->n = $inputs['n'] ?? $this->n;
            $this->d = $inputs['d'] ?? $this->d;
        }
    }

  public function resetForm()
    {
        $this->x = '25';
        $this->n = '1';
        $this->d = '5';
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
        session()->forget([
            'calculator_result',
            'validation_error'
        ]);
    }

    public function calculate()
    {
        $x_val = $this->x;
        if (is_numeric($x_val)) {
            $x_val = ($x_val == (int)$x_val) ? (int)$x_val : (float)$x_val;
        }
        $n_val = $this->n;
        if (is_numeric($n_val)) {
            $n_val = ($n_val == (int)$n_val) ? (int)$n_val : (float)$n_val;
        }
        $d_val = $this->d;
        if (is_numeric($d_val)) {
            $d_val = ($d_val == (int)$d_val) ? (int)$d_val : (float)$d_val;
        }

        $request = (object)[
            'x' => $x_val,
            'n' => $n_val,
            'd' => $d_val,
        ];

        $model = new Math();
        $result = $model->frac_exp($request);

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
        return view('livewire.calculators.fraction-exponent-calculator');
    }
}
