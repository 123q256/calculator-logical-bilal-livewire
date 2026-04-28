<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class CentripetalForceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $calculation_type = '4'; // Default to Centripetal Force
    public $mass = '10';
    public $mass_unit = 'kg';
    public $radius = '2';
    public $radius_unit = 'm';
    public $t_velocity = '5';
    public $t_velocity_unit = 'm/s';
    public $c_force = '125';
    public $c_force_unit = 'N';
    public $angular_velocity = '2.5';
    public $angular_velocity_unit = 'rad/s';
    public $centripetal_acceleration = '12.5';
    public $centripetal_acceleration_unit = 'm/s²';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        $this->detail = session('calculator_result');
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        } 
    }

    public function toggleDropdown($dropdown)
    {
        if ($this->openDropdown === $dropdown) {
            $this->openDropdown = null;
        } else {
            $this->openDropdown = $dropdown;
        }
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->openDropdown = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'calculation_type') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->calculation_type = '4';
        $this->mass = '10';
        $this->mass_unit = 'kg';
        $this->radius = '2';
        $this->radius_unit = 'm';
        $this->t_velocity = '5';
        $this->t_velocity_unit = 'm/s';
        $this->c_force = '125';
        $this->c_force_unit = 'N';
        $this->angular_velocity = '2.5';
        $this->angular_velocity_unit = 'rad/s';
        $this->centripetal_acceleration = '12.5';
        $this->centripetal_acceleration_unit = 'm/s²';

        $this->detail = null;
        $this->error = null;
        
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }

    }

    public function calculate()
    {
        $requestData = [
            'find' => $this->calculation_type,
            'mass' => $this->mass,
            'mass_unit' => $this->mass_unit,
            'radius' => $this->radius,
            'radius_unit' => $this->radius_unit,
            't_velocity' => $this->t_velocity,
            't_velocity_unit' => $this->t_velocity_unit,
            'c_force' => $this->c_force,
            'c_force_unit' => $this->c_force_unit,
            'angular_velocity' => $this->angular_velocity,
            'angular_velocity_unit' => $this->angular_velocity_unit,
            'centripetal_acceleration' => $this->centripetal_acceleration,
            'centripetal_acceleration_unit' => $this->centripetal_acceleration_unit,
        ];

        $model = new Physics();
        $result = $model->centripetal((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }
            $this->detail = $result;
            $this->error = null;

            $this->dispatch('mathRendered');

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
        }
    }

    public function render()
    {
        return view('livewire.calculators.centripetal-force-calculator');
    }
}
