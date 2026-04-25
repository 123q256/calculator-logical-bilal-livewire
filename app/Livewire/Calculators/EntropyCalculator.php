<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class EntropyCalculator extends Component
{
    // Mode
    public $point_unit = 'entropy change for a reaction';
    public $base_unit = 'volume';

    // Section 1: Reaction
    public $products = 80;
    public $products_unit = 'j/mol*K';
    public $reactants = 8;
    public $reactants_unit = 'j/mol*K';

    // Section 2: Gibbs
    public $enthalpy = 80;
    public $enthalpy_unit = 'j';
    public $temperature = 80;
    public $temperature_unit = '°C';
    public $entropy = 80;
    public $entropy_unit = 'j/K';

    // Section 3: Isothermal
    public $moles = 80;
    public $initial = 12;
    public $initial_unit = 'mm³';
    public $pre_one_unit = 'Pa';
    public $final = 12;
    public $final_unit = 'mm³';
    public $pre_two_unit = 'Pa';

    public $showDropdown = null;
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        // Initialize defaults if needed
        if(isset($this->lang['11'])) {
            $this->point_unit = $this->lang['11']; // Default to first mode
        }
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
        
        // Handle mode-specific defaults
        if ($propertyName === 'point_unit') {
            $this->showDropdown = null;
        }
    }

    public function resetForm()
    {
        $this->point_unit = $this->lang['11'] ?? 'entropy change for a reaction';
        $this->base_unit = 'volume';
        $this->products = 80;
        $this->products_unit = 'j/mol*K';
        $this->reactants = 8;
        $this->reactants_unit = 'j/mol*K';
        $this->enthalpy = 80;
        $this->enthalpy_unit = 'j';
        $this->temperature = 80;
        $this->temperature_unit = '°C';
        $this->entropy = 80;
        $this->entropy_unit = 'j/K';
        $this->moles = 80;
        $this->initial = 12;
        $this->initial_unit = 'mm³';
        $this->pre_one_unit = 'Pa';
        $this->final = 12;
        $this->final_unit = 'mm³';
        $this->pre_two_unit = 'Pa';
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            'point_unit' => $this->point_unit,
            'products' => $this->products,
            'products_unit' => $this->products_unit,
            'reactants' => $this->reactants,
            'reactants_unit' => $this->reactants_unit,
            'enthalpy' => $this->enthalpy,
            'enthalpy_unit' => $this->enthalpy_unit,
            'temperature' => $this->temperature,
            'temperature_unit' => $this->temperature_unit,
            'entropy' => $this->entropy,
            'entropy_unit' => $this->entropy_unit,
            'base_unit' => $this->base_unit,
            'moles' => $this->moles,
            'initial' => $this->initial,
            'initial_unit' => $this->initial_unit,
            'pre_one_unit' => $this->pre_one_unit,
            'final' => $this->final,
            'final_unit' => $this->final_unit,
            'pre_two_unit' => $this->pre_two_unit,
        ];

        $model = new Chemistry();
        $result = $model->entropy($request);
        
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
        return view('livewire.calculators.entropy-calculator');
    }
}
