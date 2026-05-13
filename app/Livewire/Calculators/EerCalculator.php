<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class EerCalculator extends Component
{
    public $gender = 'Male';
    public $age = '25';
    public $child_age = '25';
    public $trim = '1st';
    public $period = '1st6';
    public $lac = '1st';
    public $height_ft = '5';
    public $height_in = '10';
    public $height_cm = '175';
    public $unit_ft_in = 'ft/in';
    public $weight = '160';
    public $unit = 'lbs';
    public $activity = 'Sedentary';
    public $goal = 'maintain';

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
            $this->gender = $inputs['gender'] ?? 'Male';
            $this->age = $inputs['age'] ?? '25';
            $this->child_age = $inputs['child_age'] ?? '25';
            $this->trim = $inputs['trim'] ?? '1st';
            $this->period = $inputs['period'] ?? '1st6';
            $this->lac = $inputs['lac'] ?? '1st';
            $this->height_ft = $inputs['height-ft'] ?? '5';
            $this->height_in = $inputs['height-in'] ?? '10';
            $this->height_cm = $inputs['height-cm'] ?? '175';
            $this->unit_ft_in = $inputs['unit_ft_in'] ?? 'ft/in';
            $this->weight = $inputs['weight'] ?? '160';
            $this->unit = $inputs['unit'] ?? 'lbs';
            $this->activity = $inputs['activity'] ?? 'Sedentary';
            $this->goal = $inputs['goal'] ?? 'maintain';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['gender', 'age', 'child_age', 'trim', 'period', 'lac', 'height_ft', 'height_in', 'height_cm', 'unit_ft_in', 'weight', 'unit', 'activity', 'goal', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $request = (object)[
            'gender' => $this->gender,
            'age' => $this->age,
            'child_age' => $this->child_age,
            'trim' => $this->trim,
            'period' => $this->period,
            'lac' => $this->lac,
            'height-ft' => $this->height_ft,
            'height-in' => $this->height_in,
            'height-cm' => $this->height_cm,
            'unit_ft_in' => $this->unit_ft_in,
            'weight' => $this->weight,
            'unit' => $this->unit,
            'activity' => $this->activity,
            'goal' => $this->goal,
        ];

        $model = new Health();
        $result = $model->eer($request);

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
        return view('livewire.calculators.eer-calculator');
    }
}
