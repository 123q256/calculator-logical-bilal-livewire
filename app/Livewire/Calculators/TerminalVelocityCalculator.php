<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class TerminalVelocityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $shapes = '1';
    public $mass = '75';
    public $mass_unit = 'kg';
    public $area = '75';
    public $area_unit = 'm²';
    public $drag_coefficient = '0.47';
    public $density = '75';
    public $density_unit = 'kg/m³';
    public $gravity = '75';
    public $gravity_unit = 'm/s²';

    public $openDropdown = null;
    public $shapeImage = '';

    protected $shapeData = [
        '1' => ['dc' => '0.47', 'img' => 'sph.png'],
        '2' => ['dc' => '0.389', 'img' => 'golfball.svg'],
        '3' => ['dc' => '0.3275', 'img' => 'baseball.svg'],
        '4' => ['dc' => '0.42', 'img' => 'halfsphere.png'],
        '5' => ['dc' => '1.05', 'img' => 'cubee.png'],
        '6' => ['dc' => '0.8', 'img' => 'angledcube.png'],
        '7' => ['dc' => '0.04', 'img' => 'streamlinedbody.png'],
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
        
        $this->updateShapeInfo();
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
        $this->detail = null;
    }

    public function updatedShapes()
    {
        $this->updateShapeInfo();
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName != 'shapes') {
            $this->detail = null;
            $this->error = null;
        }
    }

    protected function updateShapeInfo()
    {
        if (isset($this->shapeData[$this->shapes])) {
            $this->drag_coefficient = $this->shapeData[$this->shapes]['dc'];
            $this->shapeImage = url('images/' . $this->shapeData[$this->shapes]['img']);
        }
    }

    public function resetForm()
    {
        $this->reset(['detail', 'error', 'mass', 'area', 'drag_coefficient', 'density', 'gravity', 'shapes']);
        $this->updateShapeInfo();
        
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'shapes' => $this->shapes,
            'mass' => $this->mass,
            'mass_unit' => $this->mass_unit,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'drag_coefficient' => $this->drag_coefficient,
            'density' => $this->density,
            'density_unit' => $this->density_unit,
            'gravity' => $this->gravity,
            'gravity_unit' => $this->gravity_unit,
        ];

        $model = new Physics();
        $result = $model->terminal($requestData);

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
        return view('livewire.calculators.terminal-velocity-calculator');
    }
}
