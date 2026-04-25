<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class SolutionDilutionCalculator extends Component
{
    public $concentration = 4;
    public $concentration_unit = 'M';
    public $volume = 45;
    public $volume_unit = 'l';
    public $final = 3;
    public $final_unit = 'M';

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
        if (property_exists($this, $type)) {
            $this->$type = $unit;
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
        $this->concentration = 4;
        $this->concentration_unit = 'M';
        $this->volume = 45;
        $this->volume_unit = 'l';
        $this->final = 3;
        $this->final_unit = 'M';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            'concentration' => $this->concentration,
            'concentration_unit' => $this->concentration_unit,
            'volume' => $this->volume,
            'volume_unit' => $this->volume_unit,
            'final' => $this->final,
            'final_unit' => $this->final_unit,
        ];

        $model = new Chemistry();
        $result = $model->solution($request);
        
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
        return view('livewire.calculators.solution-dilution-calculator');
    }
}
