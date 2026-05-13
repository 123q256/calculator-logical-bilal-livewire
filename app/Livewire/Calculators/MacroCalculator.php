<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class MacroCalculator extends Component
{
    public $age = '25';
    public $gender = 'Male';
    public $height_ft = '5';
    public $height_in = '9';
    public $height_cm = '175';
    public $unit_ft_in = 'ft/in';
    public $weight = '158';
    public $unit = 'lbs';
    public $meal = 'all';
    public $goal = 'Maintain';
    public $activity = 'Sedentary';
    public $formula = '2nd';
    public $percent = '';

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
            $this->age = $inputs['age'] ?? '25';
            $this->gender = $inputs['gender'] ?? 'Male';
            $this->height_ft = $inputs['height-ft'] ?? '5';
            $this->height_in = $inputs['height-in'] ?? '9';
            $this->height_cm = $inputs['height-cm'] ?? '175';
            $this->unit_ft_in = $inputs['unit_ft_in'] ?? 'ft/in';
            $this->weight = $inputs['weight'] ?? '158';
            $this->unit = $inputs['unit'] ?? 'lbs';
            $this->meal = $inputs['meal'] ?? 'all';
            $this->goal = $inputs['goal'] ?? 'Maintain';
            $this->activity = $inputs['activity'] ?? 'Sedentary';
            $this->formula = $inputs['formula'] ?? '2nd';
            $this->percent = $inputs['percent'] ?? '';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['age', 'gender', 'height_ft', 'height_in', 'height_cm', 'unit_ft_in', 'weight', 'unit', 'meal', 'goal', 'activity', 'formula', 'percent', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $requestData = [
            'age' => $this->age,
            'gender' => $this->gender,
            'height-ft' => $this->height_ft,
            'height-in' => $this->height_in,
            'height-cm' => $this->height_cm,
            'unit_ft_in' => $this->unit_ft_in,
            'weight' => $this->weight,
            'unit' => $this->unit,
            'meal' => $this->meal,
            'goal' => $this->goal,
            'activity' => $this->activity,
            'formula' => $this->formula,
            'percent' => $this->percent,
        ];

        // Create an object that supports both property access and toArray()
        $request = new class($requestData) {
            private $data;
            public function __construct($data) {
                $this->data = $data;
                foreach ($data as $key => $value) {
                    $this->{$key} = $value;
                }
            }
            public function toArray() {
                return $this->data;
            }
        };

        $model = new Health();
        $result = $model->macro($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                        if (typeof drawChart === 'function') drawChart();
                    }, 100);
                JS);
            }
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
        return view('livewire.calculators.macro-calculator');
    }
}
