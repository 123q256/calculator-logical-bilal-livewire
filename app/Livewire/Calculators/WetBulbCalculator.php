<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class WetBulbCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $temp = '17';
    public $temp_unit = '°C';
    public $hum = '65';
    public $temp1 = '17';
    public $temp1_unit = '°C';

    public $ans_unit = '°C';
    public $outdoor_unit = '°C';
    public $indoor_unit = '°C';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

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

    public function setUnit($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        $this->openDropdown = null;
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['temp', 'temp_unit', 'hum', 'temp1', 'temp1_unit'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'temp' => 'required|numeric',
            'hum' => 'required|numeric|min:0|max:100',
            'temp1' => 'nullable|numeric',
        ];

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter valid numbers.',
            'min' => 'Humidity must be at least 0.',
            'max' => 'Humidity must not exceed 100.',
        ]);

        $requestData = [
            'temp' => $this->temp,
            'temp_unit' => $this->temp_unit,
            'hum' => $this->hum,
            'temp1' => $this->temp1,
            'temp1_unit' => $this->temp1_unit,
        ];

        $model = new Physics();
        $result = $model->wet((object)$requestData);

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

        $this->temp = '17';
        $this->temp_unit = '°C';
        $this->hum = '65';
        $this->temp1 = '17';
        $this->temp1_unit = '°C';
        
        $this->ans_unit = '°C';
        $this->outdoor_unit = '°C';
        $this->indoor_unit = '°C';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
    }

    public function getConvertedValue($value, $unit)
    {
        if ($unit == '°F') {
            return $value * (9 / 5) + 32;
        } elseif ($unit == 'K') {
            return $value + 273.15;
        }
        return $value;
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

        return view('livewire.calculators.wet-bulb-calculator');
    }
}
