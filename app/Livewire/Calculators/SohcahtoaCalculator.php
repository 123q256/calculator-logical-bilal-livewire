<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SohcahtoaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $len_a = '';
    public $len_b = '';
    public $len_c = '';
    public $angle_alpha = '';
    public $angle_beta = '';
    public $angle_alpha_unit = 'deg';
    public $angle_beta_unit = 'deg';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->len_a = $inputs['len_a'] ?? $this->len_a;
            $this->len_b = $inputs['len_b'] ?? $this->len_b;
            $this->len_c = $inputs['len_c'] ?? $this->len_c;
            $this->angle_alpha = $inputs['angle_alpha'] ?? $this->angle_alpha;
            $this->angle_beta = $inputs['angle_beta'] ?? $this->angle_beta;
            $this->angle_alpha_unit = $inputs['angle_alpha_unit'] ?? $this->angle_alpha_unit;
            $this->angle_beta_unit = $inputs['angle_beta_unit'] ?? $this->angle_beta_unit;
        }
    }

  public function resetForm()
    {
        $this->len_a = '';
        $this->len_b = '';
        $this->len_c = '';
        $this->angle_alpha = '';
        $this->angle_beta = '';
        $this->angle_alpha_unit = 'deg';
        $this->angle_beta_unit = 'deg';

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
            'len_a' => $this->len_a,
            'len_a_unit' => 'cm',
            'len_b' => $this->len_b,
            'len_b_unit' => 'cm',
            'len_c' => $this->len_c,
            'len_c_unit' => 'cm',
            'area' => '',
            'area_unit' => 'cm²',
            'angle_alpha' => $this->angle_alpha,
            'angle_beta' => $this->angle_beta,
            'angle_alpha_unit' => $this->angle_alpha_unit,
            'angle_beta_unit' => $this->angle_beta_unit,
        ];

        $model = new Math();
        $result = $model->sohcahtoa($request);

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
        return view('livewire.calculators.sohcahtoa-calculator');
    }
}
