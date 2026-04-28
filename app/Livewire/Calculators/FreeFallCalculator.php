<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class FreeFallCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $selection = '1';
    public $acceleration = '9.80665';
    public $a_unit = 'm/s²';
    public $velocity = '0';
    public $v_unit = 'm/s²'; // Wait, model uses v_unit for initial velocity, usually m/s
    public $height = '100';
    public $h_unit = 'm';
    public $time = '1';
    public $t_unit = 'sec';
    public $velocity_one = '10';
    public $v_one_unit = 'm/s²';

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
        if (in_array($propertyName, ['selection', 'acceleration', 'a_unit', 'velocity', 'v_unit', 'height', 'h_unit', 'time', 't_unit', 'velocity_one', 'v_one_unit'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'selection' => 'required',
            'acceleration' => 'required|numeric|gt:0',
            'velocity' => 'required|numeric',
        ];

        if ($this->selection == '1') {
            $rules['height'] = 'required|numeric|gt:0';
        } elseif ($this->selection == '2') {
            $rules['time'] = 'required|numeric|gt:0';
        } elseif ($this->selection == '3') {
            $rules['velocity_one'] = 'required|numeric';
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter valid numbers.',
            'gt' => 'Value must be greater than zero.',
        ]);

        $requestData = [
            'selection' => $this->selection,
            'acceleration' => $this->acceleration,
            'a_unit' => $this->a_unit,
            'velocity' => $this->velocity,
            'v_unit' => $this->v_unit,
            'height' => $this->height,
            'h_unit' => $this->h_unit,
            'time' => $this->time,
            't_unit' => $this->t_unit,
            'velocity_one' => $this->velocity_one,
            'v_one_unit' => $this->v_one_unit,
        ];

        $model = new Physics();
        $result = $model->free((object)$requestData);

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
        $this->acceleration = '9.80665';
        $this->a_unit = 'm/s²';
        $this->velocity = '0';
        $this->v_unit = 'm/s²';
        $this->height = '100';
        $this->h_unit = 'm';
        $this->time = '1';
        $this->t_unit = 'sec';
        $this->velocity_one = '10';
        $this->v_one_unit = 'm/s²';

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

        return view('livewire.calculators.free-fall-calculator');
    }
}
