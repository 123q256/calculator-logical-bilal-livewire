<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class WeightWatchersPointsCalculator extends Component
{
    public $type = 'calculator';
    public $lang = [];
    public $detail = null;
    public $error = null;

    // Inputs
    public $selection = '1'; // Method Selection
    
    // Sec 1 (PointsPlus)
    public $fe = '50';
    public $fe_unit = 'cal';
    public $sf = '100';
    public $sf_unit = 'g';
    public $sgr = '100';
    public $sgr_unit = 'g';
    public $ptn = '150';
    public $ptn_unit = 'g';

    // Sec 2 (SmartPoints)
    public $ptn2 = '150';
    public $ptn2_unit = 'g';
    public $carbo = '150';
    public $carbo_unit = 'g';
    public $fat = '150';
    public $fat_unit = 'g';
    public $fiber = '150';
    public $fiber_unit = 'g';

    // Sec 3 (Original)
    public $call2 = '56';
    public $call2_unit = 'cal';
    public $fat2 = '150';
    public $fat2_unit = 'g';
    public $fiber2 = '150';
    public $fiber2_unit = 'g';

    // Sec 4 (Daily Target)
    public $weight = '56';
    public $weight_unit = 'kg';
    public $height = '56';
    public $height_unit = 'cm';
    public $age = '23';
    public $gender = 'female';
    public $activity = '1';

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

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->selection = '1';
        $this->fe = '50'; $this->fe_unit = 'cal';
        $this->sf = '100'; $this->sf_unit = 'g';
        $this->sgr = '100'; $this->sgr_unit = 'g';
        $this->ptn = '150'; $this->ptn_unit = 'g';
        $this->ptn2 = '150'; $this->ptn2_unit = 'g';
        $this->carbo = '150'; $this->carbo_unit = 'g';
        $this->fat = '150'; $this->fat_unit = 'g';
        $this->fiber = '150'; $this->fiber_unit = 'g';
        $this->call2 = '56'; $this->call2_unit = 'cal';
        $this->fat2 = '150'; $this->fat2_unit = 'g';
        $this->fiber2 = '150'; $this->fiber2_unit = 'g';
        $this->weight = '56'; $this->weight_unit = 'kg';
        $this->height = '56'; $this->height_unit = 'cm';
        $this->age = '23';
        $this->gender = 'female';
        $this->activity = '1';
        
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error'
        ]);
    }

    public function calculate()
    {
        $request = (object)[
            'selection' => $this->selection,
            'fe' => $this->fe, 'fe_unit' => $this->fe_unit,
            'sf' => $this->sf, 'sf_unit' => $this->sf_unit,
            'sgr' => $this->sgr, 'sgr_unit' => $this->sgr_unit,
            'ptn' => $this->ptn, 'ptn_unit' => $this->ptn_unit,
            'ptn2' => $this->ptn2, 'ptn2_unit' => $this->ptn2_unit,
            'carbo' => $this->carbo, 'carbo_unit' => $this->carbo_unit,
            'fat' => $this->fat, 'fat_unit' => $this->fat_unit,
            'fiber' => $this->fiber, 'fiber_unit' => $this->fiber_unit,
            'call2' => $this->call2, 'call2_unit' => $this->call2_unit,
            'fat2' => $this->fat2, 'fat2_unit' => $this->fat2_unit,
            'fiber2' => $this->fiber2, 'fiber2_unit' => $this->fiber2_unit,
            'weight' => $this->weight, 'weight_unit' => $this->weight_unit,
            'height' => $this->height, 'height_unit' => $this->height_unit,
            'age' => $this->age,
            'gender' => $this->gender,
            'activity' => $this->activity,
        ];

        $model = new Health();
        $result = $model->weight_watchers($request);

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
        return view('livewire.calculators.weight-watchers-points-calculator');
    }
}
