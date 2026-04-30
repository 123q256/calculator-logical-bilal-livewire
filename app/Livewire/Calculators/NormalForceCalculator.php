<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class NormalForceCalculator extends Component
{
    public $surface = 'inclined';
    public $external = 'no';
    public $mass = 45;
    public $mass_units = 'kg';
    public $outside_force = 45;
    public $outside_force_units = 'N';
    public $angle = 30;
    public $angle_units = 'deg';

    public $dropdowns = [];

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
            $this->surface = $inputs->surface ?? 'inclined';
            $this->external = $inputs->external ?? 'no';
            $this->mass = $inputs->mass ?? 45;
            $this->mass_units = $inputs->mass_units ?? 'kg';
            $this->outside_force = $inputs->outside_force ?? 45;
            $this->outside_force_units = $inputs->outside_force_units ?? 'N';
            $this->angle = $inputs->angle ?? 30;
            $this->angle_units = $inputs->angle_units ?? 'deg';
        }
    }

    public function updated($propertyName)
    {
        if (strpos($propertyName, 'dropdowns') === false) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($id)
    {
        $this->dropdowns[$id] = !($this->dropdowns[$id] ?? false);
    }

    public function setUnit($property, $unit, $dropdownId = null)
    {
        $this->{$property} = $unit;
        if ($dropdownId) {
            $this->dropdowns[$dropdownId] = false;
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->surface = 'inclined';
        $this->external = 'no';
        $this->mass = 45;
        $this->mass_units = 'kg';
        $this->outside_force = 45;
        $this->outside_force_units = 'N';
        $this->angle = 30;
        $this->angle_units = 'deg';

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
            'surface'             => $this->surface,
            'external'            => $this->external,
            'mass'                => (float)$this->mass,
            'mass_units'          => $this->mass_units,
            'outside_force'       => (float)$this->outside_force,
            'outside_force_units' => $this->outside_force_units,
            'angle'               => (float)$this->angle,
            'angle_units'         => $this->angle_units,
        ];

        $model = new Physics();
        $result = $model->normal($request);

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
        return view('livewire.calculators.normal-force-calculator');
    }
}
