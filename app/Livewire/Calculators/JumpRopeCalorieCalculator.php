<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class JumpRopeCalorieCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $age = '23';
    public $gender = '1'; // 1: Male, 2: Female
    public $height_ft = '5';
    public $height_in = '12';
    public $height_cm = '182';
    public $unit_h = 'ft/in';
    public $operations = '8.8'; // MET value
    public $first = '72'; // Weight
    public $units1 = 'kg'; // Weight unit
    public $second = '45'; // Duration
    public $units2 = 'min'; // Duration unit

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

    public function updated($propertyName)
    {
        // Clear results when any input changes
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->age = '23';
        $this->gender = '1';
        $this->height_ft = '5';
        $this->height_in = '12';
        $this->height_cm = '182';
        $this->unit_h = 'ft/in';
        $this->operations = '8.8';
        $this->first = '72';
        $this->units1 = 'kg';
        $this->second = '45';
        $this->units2 = 'min';

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
            'age'        => (float)$this->age,
            'gender'     => $this->gender,
            'height_ft'  => (float)$this->height_ft,
            'height_in'  => (float)$this->height_in,
            'height_cm'  => (float)$this->height_cm,
            'unit_ft_in' => $this->unit_h,
            'operations' => (float)$this->operations,
            'first'      => (float)$this->first,
            'units1'     => $this->units1,
            'second'     => (float)$this->second,
            'units2'     => $this->units2,
        ];

        $model = new Health();
        $result = $model->jump($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.jump-rope-calorie-calculator');
    }
}
