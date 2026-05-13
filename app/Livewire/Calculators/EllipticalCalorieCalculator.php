<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class EllipticalCalorieCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $weight = 75;
    public $weight_unit = 'kg';
    public $time = 1800; // default 30 mins in seconds
    public $unit_hrs_min = 'min'; // 'sec', 'min', 'hrs', 'hrs/min'
    public $hour = 0;
    public $min = 30;
    public $effort_unit = 'Moderate (MET = 4.9)';
    public $effort = 4.9;

    // UI state
    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'showDropdown') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function updatedEffortUnit($value)
    {
        $metMap = [
            "Light (MET = 4.6)"         => 4.6,
            "Moderate (MET = 4.9)"      => 4.9,
            "Vigorous (MET = 5.7)"      => 5.7,
            "Custom (enter MET value)"  => 4.9,
        ];
        $this->effort = $metMap[$value] ?? 4.9;
    }

    public function toggleOverlay($id)
    {
        $this->showDropdown = ($this->showDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->showDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['weight', 'weight_unit', 'time', 'unit_hrs_min', 'hour', 'min', 'effort_unit', 'effort', 'detail', 'error', 'showDropdown']);
        
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
        $this->error = null;

        $request = (object)[
            'weight'       => (float)$this->weight,
            'weight_unit'  => $this->weight_unit,
            'hour'         => (float)$this->hour,
            'unit_hrs_min' => $this->unit_hrs_min,
            'min'          => (float)$this->min,
            'time'         => (float)$this->time,
            'effort_unit'  => $this->effort_unit,
            'effort'       => (float)$this->effort,
        ];

        $model = new Health();
        $result = $model->elliptical($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            return;
        }

        $this->error = $result['error'] ?? 'Please check your inputs.';
        $this->detail = null;
    }

    public function render()
    {
        return view('livewire.calculators.elliptical-calorie-calculator');
    }
}
