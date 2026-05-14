<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class PediatricDoseCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $calc_type = 'first'; // Mode: first, second, third, fourth
    public $dose = 10;
    public $dose_unit = 'mg/kg';
    public $dose_unit2 = 'mg/m²';
    public $dose_unit3 = 'mg/day';
    public $weight = 120;
    public $weight_unit = 'kg';
    public $bsa = 13;
    public $child_age = 13;
    public $mass = 120;
    public $mass_unit = 'mg';
    public $per = 5;
    public $per_unit = 'ml';
    public $dose_frequency = 'qD';

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
        $this->detail = null;
        $this->error = null;
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->detail = null;
        $this->error = null;
    }

    public function setType($value)
    {
        $this->calc_type = $value;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->calc_type = 'first';
        $this->dose = 10;
        $this->dose_unit = 'mg/kg';
        $this->dose_unit2 = 'mg/m²';
        $this->dose_unit3 = 'mg/day';
        $this->weight = 120;
        $this->weight_unit = 'kg';
        $this->bsa = 13;
        $this->child_age = 13;
        $this->mass = 120;
        $this->mass_unit = 'mg';
        $this->per = 5;
        $this->per_unit = 'ml';
        $this->dose_frequency = 'qD';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'type' => $this->calc_type,
            'dose' => $this->dose,
            'dose_unit' => $this->dose_unit,
            'dose_unit2' => $this->dose_unit2,
            'dose_unit3' => $this->dose_unit3,
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit,
            'bsa' => $this->bsa,
            'child_age' => $this->child_age,
            'mass' => $this->mass,
            'mass_unit' => $this->mass_unit,
            'per' => $this->per,
            'per_unit' => $this->per_unit,
            'dose_frequency' => $this->dose_frequency,
        ];

        $request = new \Illuminate\Http\Request($requestData);
        $model = new Health();
        $result = $model->pediatric($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.pediatric-dose-calculator');
    }
}
