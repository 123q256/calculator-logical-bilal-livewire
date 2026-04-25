<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class VaporPressureCalculator extends Component
{
    // Default Values
    public $t1 = 298;
    public $t1_units = '°C';
    public $t2 = 298;
    public $t2_units = '°C';
    public $p1 = 298;
    public $p1_units = 'Pa';
    public $deltaHvap = 40000;
    public $deltaHvap_units = 'J';
    public $x_sol = 0.98;
    public $p_sol = 47.1;
    public $p_sol_units = 'Pa';

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
        $this->t1 = 298;
        $this->t1_units = '°C';
        $this->t2 = 298;
        $this->t2_units = '°C';
        $this->p1 = 298;
        $this->p1_units = 'Pa';
        $this->deltaHvap = 40000;
        $this->deltaHvap_units = 'J';
        $this->x_sol = 0.98;
        $this->p_sol = 47.1;
        $this->p_sol_units = 'Pa';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            't1' => $this->t1,
            't1_units' => $this->t1_units,
            't2' => $this->t2,
            't2_units' => $this->t2_units,
            'p1' => $this->p1,
            'p1_units' => $this->p1_units,
            'deltaHvap' => $this->deltaHvap,
            'deltaHvap_units' => $this->deltaHvap_units,
            'x_sol' => $this->x_sol,
            'p_sol' => $this->p_sol,
            'p_sol_units' => $this->p_sol_units,
        ];

        $model = new Chemistry();
        $result = $model->vapor($request);
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
        return view('livewire.calculators.vapor-pressure-calculator');
    }
}
