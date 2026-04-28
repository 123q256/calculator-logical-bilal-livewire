<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class QuarterMileCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $equation = '1';
    public $selection = '1';
    public $power = '2';
    public $power_unit = 'watts (W)';
    public $powers = '2';
    public $sample_unit = ''; // Will be set in mount
    public $weight = '2';
    public $weight_unit = '(kg)';
    public $trap = '23';
    public $et = '2';

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

        // Initialize sample_unit if not set
        if (!$this->sample_unit) {
            $this->sample_unit = $lang['18'] ?? 'Wheel horsepower';
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
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['detail', 'error', 'equation', 'selection', 'power', 'powers', 'weight', 'trap', 'et']);
        $this->detail = null;
        $this->error = null;
        
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'equation' => $this->equation,
            'selection' => $this->selection,
            'power' => $this->power,
            'power_unit' => $this->power_unit,
            'sample_unit' => $this->sample_unit,
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit,
            'trap' => $this->trap,
            'et' => $this->et,
        ];

        $model = new Physics();
        $result = $model->quarter((object)$requestData);

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
        return view('livewire.calculators.quarter-mile-calculator');
    }
}
