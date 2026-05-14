<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class HeightPercentileCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $gender = '1';       // 1=male, 0=female
    public $age = 15;
    public $age_unit = 'years'; // Default to years
    public $unit_h = 'ft/in';   // Unit toggle: ft/in, ft, in, cm, m
    public $height_ft = 4;
    public $height_in = 10;
    public $height_cm = '';     // Used for single unit inputs

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
        if (in_array($propertyName, ['gender', 'age', 'age_unit', 'unit_h', 'height_ft', 'height_in', 'height_cm'])) {
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->gender = '1';
        $this->age = 15;
        $this->age_unit = 'years';
        $this->unit_h = 'ft/in';
        $this->height_ft = 4;
        $this->height_in = 10;
        $this->height_cm = '';

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
        if (!is_numeric($this->age)) {
            $this->error = 'Please enter a valid age.';
            return;
        }

        $request = (object)[
            'gender'     => $this->gender,
            'age'        => $this->age,
            'age_unit'   => $this->age_unit,
            'unit_ft_in' => $this->unit_h,
            'height_ft'  => $this->height_ft,
            'height_in'  => $this->height_in,
            'height_cm'  => $this->height_cm,
        ];

        $model = new Health();
        $result = $model->height($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
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
        return view('livewire.calculators.height-percentile-calculator');
    }
}
