<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class GravityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $calculation_type = '1';
    public $mass_one = '7';
    public $mass_one_unit = 'g';
    public $mass_two = '7';
    public $mass_two_unit = 'g';
    public $gravitational_force = '13';
    public $gravitational_force_unit = 'N';
    public $distance = '13';
    public $distance_unit = 'nm';
    public $constant = '6.6743';
    public $latitude = '37.16802';
    public $height = '13';
    public $height_unit = 'ft';

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
        }
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['detail', 'error', 'calculation_type', 'mass_one', 'mass_two', 'gravitational_force', 'distance', 'constant', 'latitude', 'height']);
        
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'calculate' => $this->calculation_type,
            'mass_one' => $this->mass_one,
            'mass_one_unit' => $this->mass_one_unit,
            'mass_two' => $this->mass_two,
            'mass_two_unit' => $this->mass_two_unit,
            'gravitational_force' => $this->gravitational_force,
            'gravitational_force_unit' => $this->gravitational_force_unit,
            'distance' => $this->distance,
            'distance_unit' => $this->distance_unit,
            'constant' => $this->constant,
            'latitude' => $this->latitude,
            'height' => $this->height,
            'height_unit' => $this->height_unit,
        ];

        $model = new Physics();
        $result = $model->gravity((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }
            $this->detail = $result;
            $this->error = null;

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
        return view('livewire.calculators.gravity-calculator');
    }
}
