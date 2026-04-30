<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class TimeDilationCalculator extends Component
{
    public $interval = 5;
    public $interval_one = 9;
    public $interval_sec = 7;
    public $interval_unit = 'sec';
    public $velocity = 8;
    public $velocity_unit = 'km/s';

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
            $this->interval = $inputs->interval ?? 5;
            $this->interval_one = $inputs->interval_one ?? 9;
            $this->interval_sec = $inputs->interval_sec ?? 7;
            $this->interval_unit = $inputs->interval_unit ?? 'sec';
            $this->velocity = $inputs->velocity ?? 8;
            $this->velocity_unit = $inputs->velocity_unit ?? 'km/s';
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

        $this->interval = 5;
        $this->interval_one = 9;
        $this->interval_sec = 7;
        $this->interval_unit = 'sec';
        $this->velocity = 8;
        $this->velocity_unit = 'km/s';

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
            'interval'      => (float)$this->interval,
            'interval_one'  => (float)$this->interval_one,
            'interval_sec'  => (float)$this->interval_sec,
            'interval_unit' => $this->interval_unit,
            'velocity'      => (float)$this->velocity,
            'velocity_unit' => $this->velocity_unit,
        ];

        $model = new Physics();
        $result = $model->time_dilation($request);

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
   
        return view('livewire.calculators.time-dilation-calculator');
    }
}
