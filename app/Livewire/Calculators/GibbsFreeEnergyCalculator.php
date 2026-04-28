<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class GibbsFreeEnergyCalculator extends Component
{
    // Default Values
    public $enthalpy = 50;
    public $enthalpy_units = 'KJ';
    public $entropy = 45;
    public $entropy_units = 'KJ';
    public $temperature = 30;
    public $t_units = 'K';

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
        $property = $type; // Directly set the property name
        if (property_exists($this, $property)) {
            $this->$property = $unit;
        }
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->enthalpy = 50;
        $this->enthalpy_units = 'KJ';
        $this->entropy = 45;
        $this->entropy_units = 'KJ';
        $this->temperature = 30;
        $this->t_units = 'K';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            'enthalpy' => $this->enthalpy,
            'enthalpy_units' => $this->enthalpy_units,
            'entropy' => $this->entropy,
            'entropy_units' => $this->entropy_units,
            'temperature' => $this->temperature,
            't_units' => $this->t_units,
        ];

        $model = new Chemistry();
        $result = $model->gibbs($request);

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
             if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.gibbs-free-energy-calculator');
    }
}
