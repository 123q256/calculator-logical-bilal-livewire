<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class BatteryLifeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $battery_capacity = 12;
    public $battery_units = 'Ah';
    public $discharge_safety = 20;
    public $device_con1 = 5;
    public $device_con1_units = 'µA';
    public $awake_time = 5;
    public $awake_time_units = 'sec';
    public $device_con2 = 5;
    public $device_con2_units = 'mA';
    public $sleep_time = 5;
    public $sleep_time_units = 'mA';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->battery_capacity = $inputs->battery_capacity ?? 12;
            $this->battery_units = $inputs->battery_units ?? 'Ah';
            $this->discharge_safety = $inputs->discharge_safety ?? 20;
            $this->device_con1 = $inputs->device_con1 ?? 5;
            $this->device_con1_units = $inputs->device_con1_units ?? 'µA';
            $this->awake_time = $inputs->awake_time ?? 5;
            $this->awake_time_units = $inputs->awake_time_units ?? 'sec';
            $this->device_con2 = $inputs->device_con2 ?? 5;
            $this->device_con2_units = $inputs->device_con2_units ?? 'mA';
            $this->sleep_time = $inputs->sleep_time ?? 5;
            $this->sleep_time_units = $inputs->sleep_time_units ?? 'mA';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->battery_capacity = 12;
        $this->battery_units = 'Ah';
        $this->discharge_safety = 20;
        $this->device_con1 = 5;
        $this->device_con1_units = 'µA';
        $this->awake_time = 5;
        $this->awake_time_units = 'sec';
        $this->device_con2 = 5;
        $this->device_con2_units = 'mA';
        $this->sleep_time = 5;
        $this->sleep_time_units = 'mA';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $request = (object)[
            'battery_capacity'  => $this->battery_capacity,
            'battery_units'     => $this->battery_units,
            'discharge_safety'  => $this->discharge_safety,
            'device_con1'       => $this->device_con1,
            'device_con1_units' => $this->device_con1_units,
            'awake_time'        => $this->awake_time,
            'awake_time_units'  => $this->awake_time_units,
            'device_con2'       => $this->device_con2,
            'device_con2_units' => $this->device_con2_units,
            'sleep_time'        => $this->sleep_time,
            'sleep_time_units'  => $this->sleep_time_units,
        ];

        $model = new EverydayLife();
        $result = $model->battery($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->current());
            }

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
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.battery-life-calculator');
    }
}
