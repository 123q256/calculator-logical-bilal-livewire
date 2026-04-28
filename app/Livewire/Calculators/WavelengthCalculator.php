<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class WavelengthCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $find = 'wavelength';
    public $preset = '299792458';
    public $velocity = '299792458';
    public $velocity_unit = 'ms';
    public $frequency = '6';
    public $frequency_unit = 'hz';
    public $wavelength = '6';
    public $wavelength_unit = 'm';

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
        if ($propertyName === 'preset') {
            if ($this->preset !== 'custom') {
                $this->velocity = $this->preset;
                $this->velocity_unit = 'ms';
            }
        }

        if ($propertyName === 'velocity') {
            $presets = ['299792458', '299702547', '225238511', '199861639', '343', '355', '60', '1210', '3240', '4540', '4600', '6320'];
            if (!in_array($this->velocity, $presets)) {
                $this->preset = 'custom';
            } else {
                $this->preset = $this->velocity;
            }
        }

        if (in_array($propertyName, ['find', 'velocity', 'velocity_unit', 'frequency', 'frequency_unit', 'wavelength', 'wavelength_unit'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'find' => 'required',
        ];

        if ($this->find === 'wavelength') {
            $rules['frequency'] = 'required|numeric';
            $rules['velocity'] = 'required|numeric';
        } elseif ($this->find === 'frequency') {
            $rules['wavelength'] = 'required|numeric';
            $rules['velocity'] = 'required|numeric';
        } elseif ($this->find === 'velocity') {
            $rules['wavelength'] = 'required|numeric';
            $rules['frequency'] = 'required|numeric';
        }

        $this->validate($rules, [
            'required' => 'Please fill all required fields.',
            'numeric' => 'Please enter a valid number.',
        ]);

        $requestData = [
            'find' => $this->find,
            'velocity' => $this->velocity,
            'velocity_unit' => $this->velocity_unit,
            'frequency' => $this->frequency,
            'frequency_unit' => $this->frequency_unit,
            'wavelength' => $this->wavelength,
            'wavelength_unit' => $this->wavelength_unit,
        ];

        $model = new Physics();
        $result = $model->wavelength((object)$requestData);

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
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->find = 'wavelength';
        $this->preset = '299792458';
        $this->velocity = '299792458';
        $this->velocity_unit = 'ms';
        $this->frequency = '6';
        $this->wavelength = '6';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
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

        return view('livewire.calculators.wavelength-calculator');
    }
}
