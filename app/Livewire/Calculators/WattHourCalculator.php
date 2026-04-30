<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class WattHourCalculator extends Component
{
    public $volt = 5;
    public $volt_unit = 'V';
    public $charge = 7;
    public $charge_unit = 'C';
    public $power = 3;
    public $power_unit = 'mW';
    public $hour = 9;
    public $hour_unit = 'ms';

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
            $this->volt = $inputs->volt ?? 5;
            $this->volt_unit = $inputs->volt_unit ?? 'V';
            $this->charge = $inputs->charge ?? 7;
            $this->charge_unit = $inputs->charge_unit ?? 'C';
            $this->power = $inputs->power ?? 3;
            $this->power_unit = $inputs->power_unit ?? 'mW';
            $this->hour = $inputs->hour ?? 9;
            $this->hour_unit = $inputs->hour_unit ?? 'ms';
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

        $this->volt = 5;
        $this->volt_unit = 'V';
        $this->charge = 7;
        $this->charge_unit = 'C';
        $this->power = 3;
        $this->power_unit = 'mW';
        $this->hour = 9;
        $this->hour_unit = 'ms';

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
            'volt'        => (float)$this->volt,
            'volt_unit'   => $this->volt_unit,
            'charge'      => (float)$this->charge,
            'charge_unit' => $this->charge_unit,
            'power'       => (float)$this->power,
            'power_unit'  => $this->power_unit,
            'hour'        => (float)$this->hour,
            'hour_unit'   => $this->hour_unit,
        ];

        $model = new Physics();
        $result = $model->watt_hour($request);

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
  
        return view('livewire.calculators.watt-hour-calculator');
    }
}
