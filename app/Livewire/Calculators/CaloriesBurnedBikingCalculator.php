<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class CaloriesBurnedBikingCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $age = 25;
    public $operations = 'No';
    public $activity = '4'; // Default to "Bicycling, leisure" which is MET 4
    public $first = 13; // Power
    public $units1 = 'mW';
    public $second = 160; // Weight
    public $units2 = 'lbs';
    public $height_ft = 5;
    public $height_in = 9;
    public $height_cm = 175.26;
    public $unit_ft_in = 'ft/in';
    public $gender = 'male';
    public $met = 4;
    public $third = 60; // Duration
    public $units3 = 'min';

    // UI State
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
        // Auto-update MET when activity changes
        if ($propertyName === 'activity') {
            $this->met = $this->activity;
        }

        if ($propertyName !== 'showDropdown') {
            $this->detail = null;
            $this->error = null;
        }
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
        $this->reset(['age', 'operations', 'activity', 'first', 'units1', 'second', 'units2', 'height_ft', 'height_in', 'height_cm', 'unit_ft_in', 'gender', 'met', 'third', 'units3', 'detail', 'error', 'showDropdown']);
        
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
            'operations'   => $this->operations,
            'activity'     => $this->activity,
            'first'        => (float)$this->first,
            'units1'       => $this->units1,
            'second'       => (float)$this->second,
            'units2'       => $this->units2,
            'third'        => (float)$this->third,
            'units3'       => $this->units3,
            'met'          => (float)$this->met,
            'height_ft'    => (float)$this->height_ft,
            'height_in'    => (float)$this->height_in,
            'height_cm'    => (float)$this->height_cm,
            'unit_ft_in'   => $this->unit_ft_in,
            'gender'       => $this->gender,
            'age'          => (float)$this->age,
        ];

        $model = new Health();
        $result = $model->cal_bike($request);

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
        return view('livewire.calculators.calories-burned-biking-calculator');
    }
}
