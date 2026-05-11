<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class FfmiCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $gender = 'Male';
    public $weight = '';
    public $height_ft = '';
    public $height_in = '';
    public $height_cm = '';
    public $percent = '';
    public $unit = 'lbs';
    public $unit_h = 'ft/in';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->gender = $inputs->gender ?? $this->gender;
            $this->weight = $inputs->weight ?? $this->weight;
            $this->height_ft = $inputs->height_ft ?? $this->height_ft;
            $this->height_in = $inputs->height_in ?? $this->height_in;
            $this->height_cm = $inputs->height_cm ?? $this->height_cm;
            $this->percent = $inputs->percent ?? $this->percent;
            $this->unit = $inputs->unit ?? $this->unit;
            $this->unit_h = $inputs->unit_ft_in ?? $this->unit_h;
        }
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->gender = 'Male';
        $this->weight = '';
        $this->height_ft = '';
        $this->height_in = '';
        $this->height_cm = '';
        $this->percent = '';
        $this->unit = 'lbs';
        $this->unit_h = 'ft/in';

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
        $request = (object) [
            'gender' => $this->gender,
            'weight' => (float)$this->weight,
            'height_ft' => (float)$this->height_ft,
            'height_in' => (float)$this->height_in,
            'height_cm' => (float)$this->height_cm,
            'percent' => (float)$this->percent,
            'unit' => $this->unit,
            'unit_ft_in' => $this->unit_h,
        ];

        // Basic validation to prevent DivisionByZero
        if ($request->unit_ft_in == 'ft/in') {
            if ($request->height_ft <= 0 && $request->height_in <= 0) {
                $this->error = 'Please provide a valid height.';
                return;
            }
        } else {
            if ($request->height_cm <= 0) {
                $this->error = 'Please provide a valid height.';
                return;
            }
        }

        if ($request->weight <= 0) {
            $this->error = 'Please provide a valid weight.';
            return;
        }

        $model = new Health();
        $result = $model->ffmi($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
        }
        return view('livewire.calculators.ffmi-calculator');
    }
}
