<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class ElectricFieldCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Mode selection
    public $selection = '1'; // 1: Single, 2: Multiple
    public $selection3 = '1'; // 1: E, 2: r, 3: q
    public $per = '1';

    // Single charge fields
    public $charge = '8';
    public $c_unit = 'μC';
    public $distance = '8';
    public $d_unit = 'nm';
    public $electric_field = '2';

    // Multiple charges (Superposition)
    public $charge1 = [];
    public $charge_unit = [];
    public $distance1 = [];
    public $distance_unit = [];
    public $num_charges = 2;

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        // Initialize multiple charges
        for ($i = 0; $i < 10; $i++) {
            $this->charge1[$i] = '';
            $this->charge_unit[$i] = 'μC';
            $this->distance1[$i] = '';
            $this->distance_unit[$i] = 'nm';
        }

        if (session()->has('calculator_result')) {
            $this->detail = session()->pull('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session()->pull('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function toggleDropdown($id)
    {
        $this->openDropdown = ($this->openDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $index, $value)
    {
        if ($index === null) {
            $this->$field = $value;
        } else {
            $this->{$field}[$index] = $value;
        }
        $this->openDropdown = null;
    }

    public function addCharge()
    {
        if ($this->num_charges < 10) {
            $this->num_charges++;
        } else {
            $this->dispatch('alert', ['message' => 'Maximum 10 charges allowed.']);
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['selection', 'selection3', 'per', 'charge', 'c_unit', 'distance', 'd_unit', 'electric_field']) || str_starts_with($propertyName, 'charge1.') || str_starts_with($propertyName, 'distance1.')) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'selection' => 'required',
            'per' => 'required|numeric',
        ];

        if ($this->selection == '1') {
            if ($this->selection3 == '1') { // E
                $rules['charge'] = 'required|numeric';
                $rules['distance'] = 'required|numeric|gt:0';
            } elseif ($this->selection3 == '2') { // r
                $rules['charge'] = 'required|numeric';
                $rules['electric_field'] = 'required|numeric|gt:0';
            } elseif ($this->selection3 == '3') { // q
                $rules['distance'] = 'required|numeric|gt:0';
                $rules['electric_field'] = 'required|numeric';
            }
        } else { // Multiple
            for ($i = 0; $i < $this->num_charges; $i++) {
                $rules["charge1.$i"] = 'required|numeric';
                $rules["distance1.$i"] = 'required|numeric|gt:0';
            }
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter valid numbers.',
            'gt' => 'Value must be greater than zero.',
        ]);

        $requestData = [
            'selection' => $this->selection,
            'selection3' => $this->selection3,
            'per' => $this->per,
            'charge' => $this->charge,
            'c_unit' => $this->c_unit,
            'distance' => $this->distance,
            'd_unit' => $this->d_unit,
            'electric_field' => $this->electric_field,
            'charge1' => array_slice($this->charge1, 0, $this->num_charges),
            'distance1' => array_slice($this->distance1, 0, $this->num_charges),
            'charge_unit' => array_slice($this->charge_unit, 0, $this->num_charges),
            'distance_unit' => array_slice($this->distance_unit, 0, $this->num_charges),
        ];

        $model = new Physics();
        $result = $model->electric($requestData);

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

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selection = '1';
        $this->selection3 = '1';
        $this->per = '1';
        $this->charge = '8';
        $this->c_unit = 'μC';
        $this->distance = '8';
        $this->d_unit = 'nm';
        $this->electric_field = '2';
        $this->num_charges = 2;

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
    }

    public function render()
    {
        if (session()->pull('scroll_to_result')) {
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

        return view('livewire.calculators.electric-field-calculator');
    }
}
