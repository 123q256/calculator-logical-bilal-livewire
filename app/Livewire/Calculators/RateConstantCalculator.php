<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class RateConstantCalculator extends Component
{
    // Properties
    public $unit_x = 'uni';
    public $module_x = '1';
    public $module_y = '1';
    public $module_z = '1';

    public $con_a = 3;
    public $unit_a = 'M';
    public $half_a = 2;
    public $time_a = 'sec';

    public $con_b = 3;
    public $unit_b = 'M';
    public $half_b = 2;
    public $time_b = 'sec';

    public $con_c = 3;
    public $unit_c = 'M';
    public $half_c = 2;
    public $time_c = 'sec';

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
        
        if ($propertyName === 'unit_x') {
            if ($this->unit_x === 'uni') {
                $this->module_x = '1';
            }
        }
    }

    public function resetForm()
    {
        $this->unit_x = 'uni';
        $this->module_x = '1';
        $this->module_y = '1';
        $this->module_z = '1';
        $this->con_a = 3;
        $this->unit_a = 'M';
        $this->half_a = 2;
        $this->time_a = 'sec';
        $this->con_b = 3;
        $this->unit_b = 'M';
        $this->half_b = 2;
        $this->time_b = 'sec';
        $this->con_c = 3;
        $this->unit_c = 'M';
        $this->half_c = 2;
        $this->time_c = 'sec';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        // Must pass ALL variables to the model, otherwise it returns "Please check your input."
        $request = (object)[
            'unit_x' => $this->unit_x,
            'module_x' => $this->module_x,
            'module_y' => $this->module_y,
            'module_z' => $this->module_z,
            'unit_a' => $this->unit_a,
            'unit_b' => $this->unit_b,
            'unit_c' => $this->unit_c,
            'time_a' => $this->time_a,
            'time_b' => $this->time_b,
            'time_c' => $this->time_c,
            'half_a' => $this->half_a,
            'half_b' => $this->half_b,
            'half_c' => $this->half_c,
            'con_a' => $this->con_a,
            'con_b' => $this->con_b,
            'con_c' => $this->con_c,
        ];

        $model = new Chemistry();
        $result = $model->rate($request);
        
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
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.rate-constant-calculator');
    }
}
