<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class CoulombsLawCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $choose = '1';
    public $selection1 = '1'; // Used when choose == 2
    public $selection2 = '1'; // Used when choose == 1
    
    public $charge_one = '7';
    public $charge_one_unit = 'pC';
    public $charge_two = '7';
    public $charge_two_unit = 'pC';
    public $charge_three = '7';
    public $charge_three_unit = 'pC';
    
    public $distance = '7';
    public $distance_unit = 'nm';
    
    public $force = '7';
    public $force_unit = 'mN';
    
    public $constant = '8.98755';

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
        if (in_array($propertyName, ['choose', 'selection1', 'selection2'])) {
            $this->detail = null;
        }
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['detail', 'error', 'choose', 'selection1', 'selection2', 'charge_one', 'charge_two', 'charge_three', 'distance', 'force', 'constant']);
        
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'choose' => $this->choose,
            'selection1' => $this->selection1,
            'selection2' => $this->selection2,
            'charge_one' => $this->charge_one,
            'charge_one_unit' => $this->charge_one_unit,
            'charge_two' => $this->charge_two,
            'charge_two_unit' => $this->charge_two_unit,
            'charge_three' => $this->charge_three,
            'charge_three_unit' => $this->charge_three_unit,
            'distance' => $this->distance,
            'distance_unit' => $this->distance_unit,
            'force' => $this->force,
            'force_unit' => $this->force_unit,
            'constant' => $this->constant,
        ];

        $model = new Physics();
        $result = $model->coulombs((object)$requestData);

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
        return view('livewire.calculators.coulombs-law-calculator');
    }
}
