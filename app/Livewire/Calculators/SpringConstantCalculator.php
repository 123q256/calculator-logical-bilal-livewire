<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class SpringConstantCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $selection = '1';
    public $spring_constant = '4';
    public $spring_displacement = '45';
    public $spring_force = '4';
    public $spring_displacement_unit = 'cm';

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
        if (in_array($propertyName, ['selection', 'spring_constant', 'spring_displacement', 'spring_force', 'spring_displacement_unit'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'selection' => 'required',
        ];

        if ($this->selection == '1') {
            $rules['spring_constant'] = 'required|numeric';
            $rules['spring_displacement'] = 'required|numeric';
        } elseif ($this->selection == '2') {
            $rules['spring_force'] = 'required|numeric';
            $rules['spring_displacement'] = 'required|numeric';
        } elseif ($this->selection == '3') {
            $rules['spring_force'] = 'required|numeric';
            $rules['spring_constant'] = 'required|numeric';
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter valid numbers.',
        ]);

        $requestData = [
            'selection' => $this->selection,
            'spring_constant' => $this->spring_constant,
            'spring_displacement' => $this->spring_displacement,
            'spring_force' => $this->spring_force,
            'spring_displacement_unit' => $this->spring_displacement_unit,
        ];

        $model = new Physics();
        $result = $model->spring((object)$requestData);

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
        $this->spring_constant = '4';
        $this->spring_displacement = '45';
        $this->spring_force = '4';
        $this->spring_displacement_unit = 'cm';

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

        return view('livewire.calculators.spring-constant-calculator');
    }
}
