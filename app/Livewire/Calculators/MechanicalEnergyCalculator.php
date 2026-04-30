<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class MechanicalEnergyCalculator extends Component
{
    public $mass = 1200;
    public $mass_unit = 'kg';
    public $velocity = 1200;
    public $velocity_unit = 'm/s';
    public $height = 1200;
    public $height_unit = 'm';
    public $engergyunit = 1;

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
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->mass = 1200;
        $this->mass_unit = 'kg';
        $this->velocity = 1200;
        $this->velocity_unit = 'm/s';
        $this->height = 1200;
        $this->height_unit = 'm';
        $this->engergyunit = 1;

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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;

        $this->js(<<<'JS'
            setTimeout(() => {
                if (typeof MathJax !== 'undefined') {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            }, 100);
        JS);
    }

    public function calculate()
    {
        $request = (object)[
            'mass'          => $this->mass,
            'mass_unit'     => $this->mass_unit,
            'velocity'      => $this->velocity,
            'velocity_unit' => $this->velocity_unit,
            'height'        => $this->height,
            'height_unit'   => $this->height_unit,
            'engergyunit'   => $this->engergyunit,
        ];

        $model = new Physics();
        $result = $model->mechanical($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

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
        }

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            session()->flash('validation_error', $this->error);
            return redirect()->to(url()->previous() ?? '/');
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

        return view('livewire.calculators.mechanical-energy-calculator');
    }
}

