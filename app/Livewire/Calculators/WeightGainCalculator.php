<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class WeightGainCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $unit_type = 'lbs'; // lbs (Imperial) or kg (Metric)
    public $gender = 'Male';
    public $age = 25;
    public $height_ft = '68'; // Value in inches for the dropdown
    public $height_cm = 175.26;
    public $weight = 170;
    public $weight1 = 10; // I want to gain ...
    public $activity = 'sedentary';
    public $surplus = '0.10';
    public $stype = 'Incal'; // Custom surplus type: Incal (Fixed) or per_cal (%)
    public $kal_day = 500;
    public $per_cal = 10;
    public $percent = ''; // Body fat %
    public $start;
    public $target;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        $this->start = date('Y-m-d');
        $this->target = date('Y-m-d', strtotime("+90 days"));

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

    public function setUnitType($value)
    {
        $this->unit_type = $value;
        if ($value === 'kg') {
            // Convert default weight 170 lbs to ~77 kg if needed, or just let user type.
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->unit_type = 'lbs';
        $this->gender = 'Male';
        $this->age = 25;
        $this->height_ft = '68';
        $this->height_cm = 175.26;
        $this->weight = 170;
        $this->weight1 = 10;
        $this->activity = 'sedentary';
        $this->surplus = '0.10';
        $this->stype = 'Incal';
        $this->kal_day = 500;
        $this->per_cal = 10;
        $this->percent = '';
        $this->start = date('Y-m-d');
        $this->target = date('Y-m-d', strtotime("+90 days"));

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
            'age' => $this->age,
            'height_ft' => $this->height_ft,
            'height_cm' => $this->height_cm,
            'weight' => $this->weight,
            'per_cal' => $this->per_cal,
            'gender' => $this->gender,
            'percent' => $this->percent,
            'activity' => $this->activity,
            'stype' => $this->stype,
            'start' => $this->start,
            'target' => $this->target,
            'weight1' => $this->weight1,
            'surplus' => $this->surplus,
            'kal_day' => $this->kal_day,
            'unit_type' => ($this->unit_type === 'lbs' ? 'imperial' : 'metric'),
        ];

        $request = new \Illuminate\Http\Request($requestData);
        $model = new Health();
        $result = $model->weightgain($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('initCharts', detail: $result, weight: $this->weight);
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
            if ($this->detail) {
                $this->dispatch('initCharts', detail: $this->detail, weight: $this->weight);
            }
        }
        return view('livewire.calculators.weight-gain-calculator');
    }
}
