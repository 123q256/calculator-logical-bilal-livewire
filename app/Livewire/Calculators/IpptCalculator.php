<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class IpptCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $gender = 'Male';
    public $ippt_type = 'NSM'; // Renamed from 'type' to avoid conflict with 'type' property
    public $age = 25;
    public $push = 20;
    public $sit = 30;
    public $time = 0; // Index for male run time
    public $time_fe = 0; // Index for female run time

    public $male_times = [
        "8:30","8:40","8:50","9:00","9:10","9:20","9:30","9:40","9:50","10:00","10:10","10:20","10:30","10:40","10:50","11:00","11:10","11:20","11:30","11:40","11:50","12:00","12:10","12:20","12:30","12:40","12:50","13:00","13:10","13:20","13:30","13:40","13:50","14:00","14:10","14:20","14:30","14:40","14:50","15:00","15:10","15:20","15:30","15:40","15:50","16:00","16:10","16:20","16:30","16:40","16:50","17:00","17:10","17:20","17:30","17:40","17:50","18:00","18:10","18:20"
    ];

    public $female_times = [
        "10:00","10:10","10:20","10:30","10:40","10:50","11:00","11:10","11:20","11:30","11:40","11:50","12:00","12:10","12:20","12:30","12:40","12:50","13:00","13:10","13:20","13:30","13:40","13:50","14:00","14:10","14:20","14:30","14:40","14:50","15:00","15:10","15:20","15:30","15:40","15:50","16:00","16:10","16:20","16:30","16:40","16:50","17:00","17:10","17:20","17:30","17:40","17:50","18:00","18:10","18:20","18:30","18:40","18:50","19:00","19:10","19:20","19:30","19:40","19:50","20:00","20:10","20:20","20:30","20:40","20:50","21:00","21:10","21:20","21:30","21:40","21:50","22:00","22:10"
    ];

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

    public function updatedGender()
    {
        $this->detail = null;
        $this->time = 0;
        $this->time_fe = 0;
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['age', 'push', 'sit', 'ippt_type', 'time', 'time_fe'])) {
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->gender = 'Male';
        $this->ippt_type = 'NSM';
        $this->age = 25;
        $this->push = 20;
        $this->sit = 30;
        $this->time = 0;
        $this->time_fe = 0;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        return redirect()->to(url()->current());
    }

    public function calculate()
    {
        $request = (object)[
            'gender' => $this->gender,
            'type'   => $this->ippt_type,
            'age'    => $this->age,
            'push'   => $this->push,
            'sit'    => $this->sit,
            'time'   => $this->time,
            'time_fe' => $this->time_fe,
        ];

        // Store the actual time string for display in the result table
        $request->time_value = $this->gender === 'Male' 
            ? ($this->male_times[$this->time] ?? '') 
            : ($this->female_times[$this->time_fe] ?? '');

        $model = new Health();
        $result = $model->ippt($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $result['request'] = $request;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
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
        return view('livewire.calculators.ippt-calculator');
    }
}
