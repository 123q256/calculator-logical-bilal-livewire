<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class EscapeVelocityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $find = '1';
    public $planet = '1';
    public $mass = '1.989E30';
    public $mass_unit = 'kg';
    public $radius = '6.96E5';
    public $radius_unit = 'm';
    public $orbit = '1.9E9';
    public $galaxy_mass = '2.8E41';
    public $gravity = '6.67438E-11';
    public $escape_velocity = '7';
    public $escape_unit = 'm/s';

    public $openDropdown = null;

    protected $planetData = [
        '1' => ['mass' => '1.989E30', 'radius' => '6.96E5', 'orbit' => '1.9E9', 'galaxy_mass' => '2.8E41', 'gravity' => '6.67438E-11'],
        '2' => ['mass' => '3.302E23', 'radius' => '2.4397E3', 'orbit' => '0.38710', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '3' => ['mass' => '4.869E24', 'radius' => '6.0518E3', 'orbit' => '0.72333', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '4' => ['mass' => '5.974E24', 'radius' => '6.37815E3', 'orbit' => '1.00', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '5' => ['mass' => '7.347673E22', 'radius' => '1.73715E3', 'orbit' => '0.00256955', 'galaxy_mass' => '5.974E24', 'gravity' => '6.67438E-11'],
        '6' => ['mass' => '6.419E23', 'radius' => '3.3972E3', 'orbit' => '1.52366', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '7' => ['mass' => '3.510E10', 'radius' => '0.165', 'orbit' => '1.324', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '8' => ['mass' => '9.445E20', 'radius' => '476.2', 'orbit' => '2.766', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '9' => ['mass' => '1.899E27', 'radius' => '7.1492E4', 'orbit' => '5.20336', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '10' => ['mass' => '5.688E26', 'radius' => '6.0268E4', 'orbit' => '9.53707', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '11' => ['mass' => '8.683E25', 'radius' => '2.5559E4', 'orbit' => '19.19138', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
        '12' => ['mass' => '1.024E26', 'radius' => '2.4786E4', 'orbit' => '30.06896', 'galaxy_mass' => '1.989E30', 'gravity' => '6.67438E-11'],
    ];

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
        if ($propertyName == 'find') {
            $this->detail = null;
        }
        $this->error = null;
    }

    public function updatedPlanet($value)
    {
        if (isset($this->planetData[$value])) {
            $data = $this->planetData[$value];
            $this->mass = $data['mass'];
            $this->radius = $data['radius'];
            $this->orbit = $data['orbit'];
            $this->galaxy_mass = $data['galaxy_mass'];
            $this->gravity = $data['gravity'];
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->reset(['detail', 'error', 'find', 'planet', 'mass', 'radius', 'orbit', 'galaxy_mass', 'gravity', 'escape_velocity']);
        $this->updatedPlanet('1');
        
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'find' => $this->find,
            'planet' => $this->planet,
            'mass' => $this->mass,
            'mass_unit' => $this->mass_unit,
            'radius' => $this->radius,
            'radius_unit' => $this->radius_unit,
            'orbit' => $this->orbit,
            'galaxy_mass' => $this->galaxy_mass,
            'gravity' => $this->gravity,
            'escape_velocity' => $this->escape_velocity,
            'escape_unit' => $this->escape_unit,
        ];

        $model = new Physics();
        $result = $model->escape((object)$requestData);

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
        return view('livewire.calculators.escape-velocity-calculator');
    }
}
