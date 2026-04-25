<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class MlToMolesCalculator extends Component
{
    // Default Values
    public $volume = 5;
    public $volume_unit = 'mL';
    public $molarity = 7;
    public $molarity_unit = 'M';

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
        $property = $type . '_unit';
        if (property_exists($this, $property)) {
            $this->$property = $unit;
        }
        $this->showDropdown = null;
    }

    public function resetForm()
    {
        $this->volume = 5;
        $this->volume_unit = 'mL';
        $this->molarity = 7;
        $this->molarity_unit = 'M';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            'volume' => $this->volume,
            'volume_unit' => $this->volume_unit,
            'molarity' => $this->molarity,
            'molarity_unit' => $this->molarity_unit,
        ];

        $model = new Chemistry();
        $result = $model->ml($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
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
            $this->error = $result['error'] ?? 'Please check your input.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.ml-to-moles-calculator');
    }
}
