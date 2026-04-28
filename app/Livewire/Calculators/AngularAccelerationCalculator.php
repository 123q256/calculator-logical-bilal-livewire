<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class AngularAccelerationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $find = '0';
    
    // Mode 0: Linear Relation
    public $select1 = 'angular_acceleration';
    public $ta = '5';
    public $ta_unit = 'm/s²';
    public $ra = '5';
    public $ra_unit = 'mm';
    public $aa = '50';

    // Mode 1: Time/Velocity Relation
    public $select3 = 'angular_acceleration_three';
    public $inv = '5';
    public $inv_unit = 'rad/s';
    public $fnv = '5';
    public $fnv_unit = 'rad/s';
    public $time = '5';
    public $time_unit = 'sec';

    // Mode 2: Torque/Moment Relation
    public $select2 = 'angular_acceleration_two';
    public $torque = '50';
    public $moment = '50';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

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
        $this->detail = null; // Hide result when unit changes
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->find = '0';
        $this->select1 = 'angular_acceleration';
        $this->ta = '5';
        $this->ta_unit = 'm/s²';
        $this->ra = '5';
        $this->ra_unit = 'mm';
        $this->aa = '50';
        $this->select3 = 'angular_acceleration_three';
        $this->inv = '5';
        $this->inv_unit = 'rad/s';
        $this->fnv = '5';
        $this->fnv_unit = 'rad/s';
        $this->time = '5';
        $this->time_unit = 'sec';
        $this->select2 = 'angular_acceleration_two';
        $this->torque = '50';
        $this->moment = '50';

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
            'find' => $this->find,
            'select1' => $this->select1,
            'ta' => $this->ta,
            'ta_unit' => $this->ta_unit,
            'ra' => $this->ra,
            'ra_unit' => $this->ra_unit,
            'aa' => $this->aa,
            'select2' => $this->select2,
            'torque' => $this->torque,
            'moment' => $this->moment,
            'select3' => $this->select3,
            'inv' => $this->inv,
            'inv_unit' => $this->inv_unit,
            'fnv' => $this->fnv,
            'fnv_unit' => $this->fnv_unit,
            'time' => $this->time,
            'time_unit' => $this->time_unit,
        ];

        $model = new Physics();
        $result = $model->angular_acceleration((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);

                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->dispatch('initKaTeX');
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.angular-acceleration-calculator');
    }
}
