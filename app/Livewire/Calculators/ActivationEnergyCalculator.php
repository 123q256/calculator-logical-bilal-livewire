<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class ActivationEnergyCalculator extends Component
{
    // Default Values
    public $temperature = 100;
    public $tempUnit = 'celsius';
    public $rate = 100;
    public $rateUnits = 'sec';
    public $const = 8;
    public $constUnits = 'sec';

    public $showDropdown = null;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
    }

    public function toggleOverlay($id)
    {
        $this->showDropdown = ($this->showDropdown === $id) ? null : $id;
    }

    public function setUnit($type, $unit)
    {
        $property = $type; // Use the property name directly as passed
        if (property_exists($this, $property)) {
            $this->$property = $unit;
        }
        $this->showDropdown = null;
    }

    public function resetForm()
    {
        $this->temperature = 100;
        $this->tempUnit = 'celsius';
        $this->rate = 100;
        $this->rateUnits = 'sec';
        $this->const = 8;
        $this->constUnits = 'sec';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            'temperature' => $this->temperature,
            'tempUnit' => $this->tempUnit,
            'rate' => $this->rate,
            'rateUnits' => $this->rateUnits,
            'const' => $this->const,
            'constUnits' => $this->constUnits,
        ];

        $model = new Chemistry();
        $result = $model->activation($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            $this->dispatch('result-updated');
            
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
            $this->error = $result['error'] ?? 'Please check your input.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.activation-energy-calculator');
    }
}
