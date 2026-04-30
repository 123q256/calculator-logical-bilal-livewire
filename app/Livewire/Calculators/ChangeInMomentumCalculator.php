<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class ChangeInMomentumCalculator extends Component
{
    public $operation = '1';
    public $mass = 12;
    public $mass_unit = 'kg';
    public $i_velocity = 1200;
    public $i_velocity_unit = 'm/s';
    public $f_velocity = 1200;
    public $f_velocity_unit = 'm/s';
    public $c_velocity = 1200;
    public $c_velocity_unit = 'm/s';
    public $force = 1200;
    public $force_unit = 'N';
    public $time = 15;
    public $time_unit = 'sec';

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
            $this->operation = $inputs->operation ?? '1';
            $this->mass = $inputs->mass ?? 12;
            $this->mass_unit = $inputs->mass_unit ?? 'kg';
            $this->i_velocity = $inputs->i_velocity ?? 1200;
            $this->i_velocity_unit = $inputs->i_velocity_unit ?? 'm/s';
            $this->f_velocity = $inputs->f_velocity ?? 1200;
            $this->f_velocity_unit = $inputs->f_velocity_unit ?? 'm/s';
            $this->c_velocity = $inputs->c_velocity ?? 1200;
            $this->c_velocity_unit = $inputs->c_velocity_unit ?? 'm/s';
            $this->force = $inputs->force ?? 1200;
            $this->force_unit = $inputs->force_unit ?? 'N';
            $this->time = $inputs->time ?? 15;
            $this->time_unit = $inputs->time_unit ?? 'sec';
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

        $this->operation = '1';
        $this->mass = 12;
        $this->mass_unit = 'kg';
        $this->i_velocity = 1200;
        $this->i_velocity_unit = 'm/s';
        $this->f_velocity = 1200;
        $this->f_velocity_unit = 'm/s';
        $this->c_velocity = 1200;
        $this->c_velocity_unit = 'm/s';
        $this->force = 1200;
        $this->force_unit = 'N';
        $this->time = 15;
        $this->time_unit = 'sec';

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
            'operation'       => $this->operation,
            'mass'            => $this->mass,
            'mass_unit'       => $this->mass_unit,
            'i_velocity'      => $this->i_velocity,
            'i_velocity_unit' => $this->i_velocity_unit,
            'f_velocity'      => $this->f_velocity,
            'f_velocity_unit' => $this->f_velocity_unit,
            'c_velocity'      => $this->c_velocity,
            'c_velocity_unit' => $this->c_velocity_unit,
            'force'           => $this->force,
            'force_unit'      => $this->force_unit,
            'time'            => $this->time,
            'time_unit'       => $this->time_unit,
        ];

        $model = new Physics();
        $result = $model->change($request);

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
        return view('livewire.calculators.change-in-momentum-calculator');
    }
}
