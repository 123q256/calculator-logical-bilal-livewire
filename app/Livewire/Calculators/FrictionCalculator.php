<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class FrictionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $calculation_type = '1';
    public $fr_co = '0.2';
    public $force = '12';
    public $force_unit = 'N';
    public $fr = '12';
    public $fr_unit = 'N';
    public $mass = '13';
    public $plane = '30';
    public $gravity = '9.81';

    public $openDropdown = null;

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
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'calculation_type') {
            $this->detail = null;
        }
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['detail', 'error', 'calculation_type', 'fr_co', 'force', 'fr', 'mass', 'plane', 'gravity']);
        
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'calculate' => $this->calculation_type,
            'fr_co' => $this->fr_co,
            'force' => $this->force,
            'force_unit' => $this->force_unit,
            'fr' => $this->fr,
            'fr_unit' => $this->fr_unit,
            'mass' => $this->mass,
            'plane' => $this->plane,
            'gravity' => $this->gravity,
        ];

        $model = new Physics();
        $result = $model->friction((object)$requestData);

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
        return view('livewire.calculators.friction-calculator');
    }
}
