<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class RationalizeTheDenominatorCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $type_mode = 'first';
    public $operations = '1';
    public $a = '15';
    public $b = '13';
    public $n = '11';
    public $c = '7';
    public $d = '5';
    public $m = '4';
    public $x = '7';
    public $y = '13';
    public $k = '5';
    public $u = '5';
    public $z = '1';
    public $n1 = 'x^3-2x+1';
    public $d1 = 'x^2-1';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->type_mode = $inputs['type'] ?? $this->type_mode;
            $this->operations = $inputs['operations'] ?? $this->operations;
            $this->a = $inputs['a'] ?? $this->a;
            $this->b = $inputs['b'] ?? $this->b;
            $this->n = $inputs['n'] ?? $this->n;
            $this->c = $inputs['c'] ?? $this->c;
            $this->d = $inputs['d'] ?? $this->d;
            $this->m = $inputs['m'] ?? $this->m;
            $this->x = $inputs['x'] ?? $this->x;
            $this->y = $inputs['y'] ?? $this->y;
            $this->k = $inputs['k'] ?? $this->k;
            $this->u = $inputs['u'] ?? $this->u;
            $this->z = $inputs['z'] ?? $this->z;
            $this->n1 = $inputs['n1'] ?? $this->n1;
            $this->d1 = $inputs['d1'] ?? $this->d1;
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->type_mode = 'first';
        $this->operations = '1';
        $this->a = '15';
        $this->b = '13';
        $this->n = '11';
        $this->c = '7';
        $this->d = '5';
        $this->m = '4';
        $this->x = '7';
        $this->y = '13';
        $this->k = '5';
        $this->u = '5';
        $this->z = '1';
        $this->n1 = 'x^3-2x+1';
        $this->d1 = 'x^2-1';

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
        $requestData = [
            'type' => $this->type_mode,
            'operations' => $this->operations,
            'a' => $this->a,
            'b' => $this->b,
            'n' => $this->n,
            'c' => $this->c,
            'd' => $this->d,
            'm' => $this->m,
            'x' => $this->x,
            'y' => $this->y,
            'k' => $this->k,
            'u' => $this->u,
            'z' => $this->z,
            'n1' => $this->n1,
            'd1' => $this->d1,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->rationalize($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;

                if ($this->type_mode === 'first') {
                    $ops = $result['operations'] ?? 1;
                    $ra  = $result['a'] ?? 1;
                    $rb  = $result['b'] ?? 1;
                    $rc  = $result['c'] ?? 1;
                    $rd  = $result['d'] ?? 1;
                    $rn  = $result['n'] ?? 2;
                    $rm  = $result['m'] ?? 2;
                    $rx  = $result['x'] ?? 1;
                    $ry  = $result['y'] ?? 1;
                    $rk  = $result['k'] ?? 2;
                    $rz  = $result['z'] ?? 1;
                    $ru  = $result['u'] ?? 1;

                    $this->js(<<<JS
                        window._rtd_operations = {$ops};
                        window._rtd_a = {$ra};
                        window._rtd_b = {$rb};
                        window._rtd_c = {$rc};
                        window._rtd_d = {$rd};
                        window._rtd_n = {$rn};
                        window._rtd_m = {$rm};
                        window._rtd_x = {$rx};
                        window._rtd_y = {$ry};
                        window._rtd_k = {$rk};
                        window._rtd_z = {$rz};
                        window._rtd_u = {$ru};
                        setTimeout(() => {
                            if (typeof \$ !== 'undefined' && typeof calculate === 'function') {
                                \$('.all_result').empty();
                                \$('.main_jawab').empty();
                                calculate();
                            }
                            if (typeof MJrerender === 'function') MJrerender();
                            const el = document.getElementById('result-section');
                            if (el) {
                                const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                                window.scrollTo({ top: offset, behavior: 'smooth' });
                            }
                        }, 300);
                    JS);
                } else {
                    $this->js(<<<'JS'
                        setTimeout(() => {
                            if (typeof MJrerender === 'function') MJrerender();
                            const el = document.getElementById('result-section');
                            if (el) {
                                const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                                window.scrollTo({ top: offset, behavior: 'smooth' });
                            }
                        }, 150);
                    JS);
                }
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
        return view('livewire.calculators.rationalize-the-denominator-calculator');
    }
}
