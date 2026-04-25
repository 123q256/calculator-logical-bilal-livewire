<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class StpCalculator extends Component
{
    // Default Values
    public $volume = 5;
    public $volume_units = 'l';
    public $temp = 350;
    public $temp_units = 'K';
    public $pressure = 850;
    public $pressure_units = 'Torr';

    public $showDropdown = null; // For handling custom dropdown overlays

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
        if ($this->showDropdown === $id) {
            $this->showDropdown = null;
        } else {
            $this->showDropdown = $id;
        }
    }

    public function setUnit($type, $unit)
    {
        $property = $type . '_units';
        if (property_exists($this, $property)) {
            $this->$property = $unit;
        }
        $this->showDropdown = null;
    }

    public function resetForm()
    {
        $this->volume = 5;
        $this->volume_units = 'l';
        $this->temp = 350;
        $this->temp_units = 'K';
        $this->pressure = 850;
        $this->pressure_units = 'Torr';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            'volume' => $this->volume,
            'volume_units' => $this->volume_units,
            'temp' => $this->temp,
            'temp_units' => $this->temp_units,
            'pressure' => $this->pressure,
            'pressure_units' => $this->pressure_units,
        ];

        $model = new Chemistry();
        $result = $model->stp($request);

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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.stp-calculator');
    }
}
