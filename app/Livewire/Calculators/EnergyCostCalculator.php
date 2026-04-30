<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class EnergyCostCalculator extends Component
{
    public $appliance = 600;
    public $power = 500;
    public $power_units = 'watts (W)';
    public $hours_per_day = 8;
    public $cost = 15;
    public $cost_units = '/cent';
    public $currancy = '$';

    public $dropdowns = [];

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->cost_units = $this->currancy . '/cent';
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->appliance = $inputs->appliance ?? 600;
            $this->power = $inputs->power ?? 500;
            $this->power_units = $inputs->power_units ?? 'watts (W)';
            $this->hours_per_day = $inputs->hours_per_day ?? 8;
            $this->cost = $inputs->cost ?? 15;
            $this->cost_units = $inputs->cost_units ?? ($this->currancy . '/cent');
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'appliance') {
            $this->power = $this->appliance;
        }

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

        $this->appliance = 600;
        $this->power = 500;
        $this->power_units = 'watts (W)';
        $this->hours_per_day = 8;
        $this->cost = 15;
        $this->cost_units = $this->currancy . '/cent';

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
            'appliance'     => (float)$this->appliance,
            'power'         => (float)$this->power,
            'power_units'   => $this->power_units,
            'hours_per_day' => (float)$this->hours_per_day,
            'cost'          => (float)$this->cost,
            'cost_units'    => $this->cost_units,
            'currancy'      => $this->currancy,
        ];

        $model = new Physics();
        $result = $model->energy($request);
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
        return view('livewire.calculators.energy-cost-calculator');
    }
}
