<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class CfuCalculator extends Component
{
    // Default Values
    public $nc = 9;
    public $df = 7;
    public $volume = 10;
    public $volume_units = 'mm³';

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
        $property = $type . '_units';
        if (property_exists($this, $property)) {
            $this->$property = $unit;
        }
        $this->showDropdown = null;
    }

    public function resetForm()
    {
        $this->nc = 9;
        $this->df = 7;
        $this->volume = 10;
        $this->volume_units = 'mm³';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            'nc' => $this->nc,
            'df' => $this->df,
            'volume' => $this->volume,
            'volume_units' => $this->volume_units,
        ];

        $model = new Chemistry();
        $result = $model->cfu($request);

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
        return view('livewire.calculators.cfu-calculator');
    }
}
