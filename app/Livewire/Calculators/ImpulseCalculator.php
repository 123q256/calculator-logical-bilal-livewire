<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class ImpulseCalculator extends Component
{
    public $calculation = '1';
    public $impulse = 1200;
    public $j_units = 'dyn·s';
    public $force = 1200;
    public $f_units = 'dyn';
    public $time = 5;
    public $t_units = 'sec';
    public $impulse_ans_units = 'dyn·s';
    public $force_ans_units = 'dyn';
    public $time_ans_units = 'sec';

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
            $this->calculation = $inputs->calculation ?? '1';
            $this->impulse = $inputs->impulse ?? 1200;
            $this->j_units = $inputs->j_units ?? 'dyn·s';
            $this->force = $inputs->force ?? 1200;
            $this->f_units = $inputs->f_units ?? 'dyn';
            $this->time = $inputs->time ?? 5;
            $this->t_units = $inputs->t_units ?? 'sec';
            $this->impulse_ans_units = $inputs->impulse_ans_units ?? 'dyn·s';
            $this->force_ans_units = $inputs->force_ans_units ?? 'dyn';
            $this->time_ans_units = $inputs->time_ans_units ?? 'sec';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->calculation = '1';
        $this->impulse = 1200;
        $this->j_units = 'dyn·s';
        $this->force = 1200;
        $this->f_units = 'dyn';
        $this->time = 5;
        $this->t_units = 'sec';
        $this->impulse_ans_units = 'dyn·s';
        $this->force_ans_units = 'dyn';
        $this->time_ans_units = 'sec';

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
            'calculation'       => $this->calculation,
            'impulse'           => $this->impulse,
            'j_units'           => $this->j_units,
            'force'             => $this->force,
            'f_units'           => $this->f_units,
            'time'              => $this->time,
            't_units'           => $this->t_units,
            'impulse_ans_units' => $this->impulse_ans_units,
            'force_ans_units'   => $this->force_ans_units,
            'time_ans_units'    => $this->time_ans_units,
        ];

        $model = new Physics();
        $result = $model->impulse($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    if (typeof MathJax !== 'undefined') {
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
        }
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
    
        return view('livewire.calculators.impulse-calculator');
    }
}
