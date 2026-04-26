<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class HorsepowerCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $method = '1';
    public $weight = '12';
    public $unit_w = 'lbs';
    public $time = '12';
    public $unit_t = 'sec';
    public $speed = '12';
    public $unit_s = 'mph';
    public $force = '12';
    public $for_u = 'N';
    public $distance = '12';
    public $dis_u = 'm';
    public $btime = '12';
    public $unit_bt = 'sec';
    public $to = '1'; // Calculation type for RPM method
    public $rpm = '00';
    public $tor = '00';
    public $hors = '00';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
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
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->method = '1';
        $this->weight = '12';
        $this->unit_w = 'lbs';
        $this->time = '12';
        $this->unit_t = 'sec';
        $this->speed = '12';
        $this->unit_s = 'mph';
        $this->force = '12';
        $this->for_u = 'N';
        $this->distance = '12';
        $this->dis_u = 'm';
        $this->btime = '12';
        $this->unit_bt = 'sec';
        $this->to = '1';
        $this->rpm = '00';
        $this->tor = '00';
        $this->hors = '00';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'method' => $this->method,
            'weight' => $this->weight,
            'unit_w' => $this->unit_w,
            'time' => $this->time,
            'unit_t' => $this->unit_t,
            'speed' => $this->speed,
            'unit_s' => $this->unit_s,
            'force' => $this->force,
            'for_u' => $this->for_u,
            'distance' => $this->distance,
            'dis_u' => $this->dis_u,
            'btime' => $this->btime,
            'unit_bt' => $this->unit_bt,
            'to' => $this->to,
            'rpm' => $this->rpm,
            'tor' => $this->tor,
            'hors' => $this->hors,
        ];

        $request = (object)$requestData;
        $model = new Physics();
        $result = $model->horsepower($request);

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

        return view('livewire.calculators.horsepower-calculator');
    }
}
