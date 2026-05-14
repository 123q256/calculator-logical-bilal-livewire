<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;
use Carbon\Carbon;

class BulkingCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $unit_type = 'imperial';
    public $gender = 'Male';
    public $age = 25;
    public $height_ft = 68; // Default 5'8"
    public $height_cm = 175.26;
    public $weight = 170;
    public $weight1 = 10;
    public $activity = 'sedentary';
    public $surplus = '0.10';
    public $stype = 'Incal';
    public $kal_day = 250;
    public $per_cal = 10;
    public $start;
    public $target;
    public $percent = '';
    public $macro_split = '1';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->start = date('Y-m-d');
        $this->target = date('Y-m-d', strtotime('+90 days'));
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function setUnitType($value)
    {
        $this->unit_type = $value;
        if ($value === 'imperial') {
            $this->weight = 170;
            $this->weight1 = 10;
            $this->height_ft = 68;
        } else {
            $this->weight = 77.1;
            $this->weight1 = 4.5;
            $this->height_cm = 175.26;
        }
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'macro_split') {
            $this->detail = null;
            $this->error = null;
        } else {
            $this->updateMacros();
        }
    }

    public function updateMacros()
    {
        if (!$this->detail) return;

        $cal = (float)$this->detail['CaloriesDaily'];
        $fat = 0; $po = 0; $cb = 0;

        switch ($this->macro_split) {
            case '1': // Moderate (30/20/50)
                $fat = round(($cal / 9) * 0.2);
                $po = round(($cal / 4) * 0.3);
                $cb = round(($cal / 4) * 0.5);
                break;
            case '2': // Lower Carb (40/20/40)
                $fat = round(($cal / 9) * 0.2);
                $po = round(($cal / 4) * 0.4);
                $cb = round(($cal / 4) * 0.4);
                break;
            case '3': // Higher Carb (30/30/40)
                $fat = round(($cal / 9) * 0.3);
                $po = round(($cal / 4) * 0.3);
                $cb = round(($cal / 4) * 0.4);
                break;
            case '4': // Higher Protein (45/35/20)
                $fat = round(($cal / 9) * 0.35);
                $po = round(($cal / 4) * 0.45);
                $cb = round(($cal / 4) * 0.2);
                break;
            case '5': // Keto (25/70/5)
                $fat = round(($cal / 9) * 0.7);
                $po = round(($cal / 4) * 0.25);
                $cb = round(($cal / 4) * 0.05);
                break;
        }

        $this->detail['fat'] = $fat;
        $this->detail['po'] = $po;
        $this->detail['cb'] = $cb;
        
        $this->dispatch('macros-updated', fat: $fat, po: $po, cb: $cb);
    }

    public function resetForm()
    {
        $this->reset(['unit_type', 'gender', 'age', 'height_ft', 'height_cm', 'weight', 'weight1', 'activity', 'surplus', 'stype', 'kal_day', 'per_cal', 'percent', 'macro_split', 'detail', 'error']);
        $this->start = date('Y-m-d');
        $this->target = date('Y-m-d', strtotime('+90 days'));

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
        $this->error = null;

        $request = (object)[
            'unit_type' => $this->unit_type,
            'gender'    => $this->gender,
            'age'       => (float)$this->age,
            'height_ft' => (float)$this->height_ft,
            'height_cm' => (float)$this->height_cm,
            'weight'    => (float)$this->weight,
            'weight1'   => (float)$this->weight1,
            'activity'  => $this->activity,
            'surplus'   => $this->surplus,
            'stype'     => $this->stype,
            'kal_day'   => (float)$this->kal_day,
            'per_cal'   => (float)$this->per_cal,
            'start'     => $this->start,
            'target'    => $this->target,
            'percent'   => $this->percent ? (float)$this->percent : '',
            'macro'     => $this->macro_split,
        ];

        $model = new Health();
        $result = $model->bulking($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            // Add want parameter for weight projection logic in blade/JS
            $this->detail['want'] = '2'; 

            // Prepare Chart Data for Alpine
            $dates = [];
            $weights = [];
            $currentWeight = (float)$this->weight;
            $dailyGain = (float)$result['PoundsDaily'];
            $days = (int)$result['days'];

            for ($i = 0; $i <= $days; $i++) {
                $date = date('d M', strtotime($this->start . " +$i days"));
                $dates[] = $date;
                $weights[] = round($currentWeight, 2);
                $currentWeight += $dailyGain;
            }

            $this->detail['weightChartLabels'] = $dates;
            $this->detail['weightChartData'] = $weights;
            $this->detail['macroChartData'] = [
                ['name' => 'CARBS', 'y' => (int)$result['cb'], 'color' => '#623a6c'],
                ['name' => 'PROTEIN', 'y' => (int)$result['po'], 'color' => '#b04c7a'],
                ['name' => 'FATS', 'y' => (int)$result['fat'], 'color' => '#e06f85'],
            ];

            session()->flash('calculator_result', $this->detail);
            session()->flash('calculator_back_inputs', (array)$request);
            
            $this->dispatch('results-calculated', 
                weightLabels: $dates, 
                weightData: $weights,
                fat: $result['fat'],
                po: $result['po'],
                cb: $result['cb']
            );

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            return;
        }

        $this->error = $result['error'] ?? 'Please check your inputs.';
        $this->detail = null;
    }

    public function render()
    {
        return view('livewire.calculators.bulking-calculator', [
            'device' => 'desktop' // Assuming desktop for padding logic as per legacy
        ]);
    }
}
