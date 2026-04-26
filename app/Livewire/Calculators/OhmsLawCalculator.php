<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class OhmsLawCalculator extends Component
{
    public $voltage = '';
    public $unit_v = 'V';
    public $current = '';
    public $unit_i = 'A';
    public $resistance = '';
    public $unit_r = 'Ω';
    public $power = '';
    public $unit_p = 'W';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            $this->voltage = $inputs['voltage'] ?? '';
            $this->unit_v = $inputs['unit_v'] ?? 'V';
            $this->current = $inputs['current'] ?? '';
            $this->unit_i = $inputs['unit_i'] ?? 'A';
            $this->resistance = $inputs['resistance'] ?? '';
            $this->unit_r = $inputs['unit_r'] ?? 'Ω';
            $this->power = $inputs['power'] ?? '';
            $this->unit_p = $inputs['unit_p'] ?? 'W';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function toggleOverlay($name)
    {
        $this->showDropdown = ($this->showDropdown === $name) ? null : $name;
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->voltage = '';
        $this->unit_v = 'V';
        $this->current = '';
        $this->unit_i = 'A';
        $this->resistance = '';
        $this->unit_r = 'Ω';
        $this->power = '';
        $this->unit_p = 'W';
        $this->detail = null;
        $this->error = null;

        session()->forget([
            'calculator_result',
            'calculator_back_inputs'
        ]);
    }

    public function calculate()
    {
        $requestData = [
            'voltage' => $this->voltage,
            'unit_v' => $this->unit_v,
            'current' => $this->current,
            'unit_i' => $this->unit_i,
            'resistance' => $this->resistance,
            'unit_r' => $this->unit_r,
            'power' => $this->power,
            'unit_p' => $this->unit_p,
        ];

        $request = (object)$requestData;

        $model = new Physics();
        $result = $model->ohms($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->current());
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Please enter exactly two values.';
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
        return view('livewire.calculators.ohms-law-calculator');
    }
}
