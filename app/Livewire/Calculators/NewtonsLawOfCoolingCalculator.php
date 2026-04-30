<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class NewtonsLawOfCoolingCalculator extends Component
{
    public $ambient = 20;
    public $ambient_units = '°C';
    public $initial_temperature = 3;
    public $initial_temp_units = '°C';
    public $area = 3;
    public $area_units = 'mm²';
    public $heat_capacity = 4;
    public $heat_capacity_units = 'J/K';
    public $heat_transfer_co = 4;
    public $heat_transfer_co_units = 'W/(m²·K)';
    public $temp_after = 4;
    public $temp_after_units = 'sec';

    public $dropdowns = [];

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->ambient = $inputs->ambient ?? 20;
            $this->ambient_units = $inputs->ambient_units ?? '°C';
            $this->initial_temperature = $inputs->initial_temperature ?? 3;
            $this->initial_temp_units = $inputs->initial_temp_units ?? '°C';
            $this->area = $inputs->area ?? 3;
            $this->area_units = $inputs->area_units ?? 'mm²';
            $this->heat_capacity = $inputs->heat_capacity ?? 4;
            $this->heat_capacity_units = $inputs->heat_capacity_units ?? 'J/K';
            $this->heat_transfer_co = $inputs->heat_transfer_co ?? 4;
            $this->heat_transfer_co_units = $inputs->heat_transfer_co_units ?? 'W/(m²·K)';
            $this->temp_after = $inputs->temp_after ?? 4;
            $this->temp_after_units = $inputs->temp_after_units ?? 'sec';
        }
    }

    public function updated($propertyName)
    {
        if (strpos($propertyName, 'dropdowns') === false) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($id)
    {
        $this->dropdowns[$id] = !($this->dropdowns[$id] ?? false);
    }

    public function setUnit($property, $unit, $dropdownId = null)
    {
        $this->{$property} = $unit;
        if ($dropdownId) {
            $this->dropdowns[$dropdownId] = false;
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->ambient = 20;
        $this->ambient_units = '°C';
        $this->initial_temperature = 3;
        $this->initial_temp_units = '°C';
        $this->area = 3;
        $this->area_units = 'mm²';
        $this->heat_capacity = 4;
        $this->heat_capacity_units = 'J/K';
        $this->heat_transfer_co = 4;
        $this->heat_transfer_co_units = 'W/(m²·K)';
        $this->temp_after = 4;
        $this->temp_after_units = 'sec';

        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'ambient'                => (float)$this->ambient,
            'ambient_units'          => $this->ambient_units,
            'initial_temperature'    => (float)$this->initial_temperature,
            'initial_temp_units'     => $this->initial_temp_units,
            'area'                   => (float)$this->area,
            'area_units'             => $this->area_units,
            'heat_capacity'          => (float)$this->heat_capacity,
            'heat_capacity_units'    => $this->heat_capacity_units,
            'heat_transfer_co'       => (float)$this->heat_transfer_co,
            'heat_transfer_co_units' => $this->heat_transfer_co_units,
            'temp_after'             => (float)$this->temp_after,
            'temp_after_units'       => $this->temp_after_units,
        ];

        $model = new Physics();
        $result = $model->newtons($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
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
            session()->flash('validation_error', $this->error);
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
     
        return view('livewire.calculators.newtons-law-of-cooling-calculator');
    }
}
