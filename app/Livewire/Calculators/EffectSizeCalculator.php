<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class EffectSizeCalculator extends Component
{
    public $effect_type = 'cohen';
    public $ronding = '4';

    // Cohen's d - one-sample
    public $c_x1 = '3';
    public $c_s = '5';
    public $c_pm = '10';

    // Cohen's d - two-sample
    public $x1 = '2';
    public $x2 = '8';
    public $n1 = '10';
    public $n2 = '20';
    public $s1 = '5';
    public $s2 = '3';

    // Cohen's h
    public $p1 = '0.5';
    public $p2 = '0.6';

    // Phi
    public $ph_x2 = '2';
    public $ph_n1 = '10';

    // Cramer's V
    public $cr_x2 = '2';
    public $cr_n1 = '10';
    public $row = '3';
    public $col = '4';

    // R2 and f2
    public $ssr = '5';
    public $sst = '10';

    // Eta2 and f2
    public $ssg = '5';
    public $et_sst = '8';

    // R2 to f2 (Uses r2_input below)
    public $r2f_input = '0.5';

    // f2 to R2
    public $f2r_input = '5';

    // d & r
    public $t_value = '5';
    public $df = '8';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->effect_type = $inputs->effect_type ?? 'cohen';
            $this->ronding = $inputs->ronding ?? '4';
            $this->c_x1 = $inputs->c_x1 ?? '3';
            $this->c_s = $inputs->c_s ?? '5';
            $this->c_pm = $inputs->c_pm ?? '10';
            $this->x1 = $inputs->x1 ?? '2';
            $this->x2 = $inputs->x2 ?? '8';
            $this->n1 = $inputs->n1 ?? '10';
            $this->n2 = $inputs->n2 ?? '20';
            $this->s1 = $inputs->s1 ?? '5';
            $this->s2 = $inputs->s2 ?? '3';
            $this->p1 = $inputs->p1 ?? '0.5';
            $this->p2 = $inputs->p2 ?? '0.6';
            $this->ph_x2 = $inputs->ph_x2 ?? '2';
            $this->ph_n1 = $inputs->ph_n1 ?? '10';
            $this->cr_x2 = $inputs->cr_x2 ?? '2';
            $this->cr_n1 = $inputs->cr_n1 ?? '10';
            $this->row = $inputs->row ?? '3';
            $this->col = $inputs->col ?? '4';
            $this->ssr = $inputs->ssr ?? '5';
            $this->sst = $inputs->sst ?? '10';
            $this->ssg = $inputs->ssg ?? '5';
            $this->et_sst = $inputs->et_sst ?? '8';
            $this->r2f_input = $inputs->r2f ?? '0.5';
            $this->f2r_input = $inputs->f2r ?? '5';
            $this->t_value = $inputs->t_value ?? '5';
            $this->df = $inputs->df ?? '8';
        }
    }

    public function resetForm()
    {
        $this->effect_type = 'cohen';
        $this->ronding = '4';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'effect_type' => $this->effect_type,
            'ronding' => $this->ronding,
            'c_x1' => $this->c_x1,
            'c_s' => $this->c_s,
            'c_pm' => $this->c_pm,
            'x1' => $this->x1,
            'x2' => $this->x2,
            'n1' => $this->n1,
            'n2' => $this->n2,
            's1' => $this->s1,
            's2' => $this->s2,
            'p1' => $this->p1,
            'p2' => $this->p2,
            'ph_x2' => $this->ph_x2,
            'ph_n1' => $this->ph_n1,
            'cr_x2' => $this->cr_x2,
            'cr_n1' => $this->cr_n1,
            'row' => $this->row,
            'col' => $this->col,
            'ssr' => $this->ssr,
            'sst' => $this->sst,
            'ssg' => $this->ssg,
            'et_sst' => $this->et_sst,
            'r2f' => $this->r2f_input,
            'f2r' => $this->f2r_input,
            't_value' => $this->t_value,
            'df' => $this->df,
        ];

        $model = new Statistics();
        $result = $model->effect($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.effect-size-calculator');
    }
}
