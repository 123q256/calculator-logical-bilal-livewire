<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class SpeedDistanceTimeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $operations = '3';
    public $first = '7';
    public $f_unit = 'inch per second';
    public $second = '7';
    public $s_unit = 'inch';
    public $third = '8';
    public $t_unit = 'year';

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

    public function updatedOperations()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $rules = [
            'operations' => 'required',
        ];

        if ($this->operations == '3') { // Find Speed
            $rules['second'] = 'required|numeric';
            $rules['third'] = $this->t_unit == 'hhmmss' ? 'required' : 'required|numeric';
        } elseif ($this->operations == '4') { // Find Distance
            $rules['first'] = 'required|numeric';
            $rules['third'] = $this->t_unit == 'hhmmss' ? 'required' : 'required|numeric';
        } elseif ($this->operations == '5') { // Find Time
            $rules['first'] = 'required|numeric';
            $rules['second'] = 'required|numeric';
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter a valid number.',
        ]);

        $requestData = [
            'operations' => $this->operations,
            'first' => $this->first,
            'f_unit' => $this->f_unit,
            'second' => $this->second,
            's_unit' => $this->s_unit,
            'third' => $this->third,
            't_unit' => $this->t_unit,
        ];

        $model = new Physics();
        $result = $model->speed((object)$requestData);

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

        $this->operations = '3';
        $this->first = '7';
        $this->f_unit = 'inch per second';
        $this->second = '7';
        $this->s_unit = 'inch';
        $this->third = '8';
        $this->t_unit = 'year';

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

        return view('livewire.calculators.speed-distance-time-calculator');
    }
}
