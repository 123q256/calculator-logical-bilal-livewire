<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class StepsToCaloriesCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $weight = '170';
    public $w_unit = 'kg';
    public $height_ft = '5';
    public $height_in = '9';
    public $height_cm = '175.26';
    public $unit_h = 'ft/in'; // This maps to unit_ft_in in model
    public $steps = '400';
    public $speed = '0.9';

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
        $this->weight = '170';
        $this->w_unit = 'kg';
        $this->height_ft = '5';
        $this->height_in = '9';
        $this->height_cm = '175.26';
        $this->unit_h = 'ft/in';
        $this->steps = '400';
        $this->speed = '0.9';

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
            'weight'     => (float)$this->weight,
            'w_unit'     => $this->w_unit,
            'height_ft'  => (float)$this->height_ft,
            'height_in'  => (float)$this->height_in,
            'height_cm'  => (float)$this->height_cm,
            'unit_ft_in' => $this->unit_h,
            'steps'      => (float)$this->steps,
            'speed'      => (float)$this->speed,
        ];

        $model = new Health();
        $result = $model->steps($request);

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
        return view('livewire.calculators.steps-to-calories-calculator');
    }
}
