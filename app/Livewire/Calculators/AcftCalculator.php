<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class AcftCalculator extends Component
{
    public $type = 'calculator';
    public $lang = [];
    public $detail = null;
    public $error = null;

    // Inputs
    public $unit_type = '1';
    public $test_units = '1'; // 1: Leg Tuck, 2: Plank
    public $deadlift = '80';
    public $standing_power_throw = '3.2';
    public $hand_release = '13';
    public $sprint_min = '2';
    public $sprint_sec = '51';
    public $plank_min = '4';
    public $plank_sec = '13';
    public $mile_min = '13';
    public $mile_sec = '30';
    public $leg_tuck = '0';

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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'unit_type' => $this->unit_type,
            'test_units' => $this->test_units,
            'deadlift' => $this->deadlift,
            'standing_power_throw' => $this->standing_power_throw,
            'hand_release' => $this->hand_release,
            'sprint_min' => $this->sprint_min,
            'sprint_sec' => $this->sprint_sec,
            'plank_min' => $this->plank_min,
            'plank_sec' => $this->plank_sec,
            'mile_min' => $this->mile_min,
            'mile_sec' => $this->mile_sec,
            'leg_tuck' => $this->leg_tuck,
        ];

        $model = new Health();
        $result = $model->acft($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            
            $this->detail = $result;
            $this->error = null;

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.acft-calculator');
    }
}
