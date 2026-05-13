<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class WalkingCalorieCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $unit_type = 'sl'; // 'sl' (SI) or 'usa' (Imperial)
    public $age = 22;
    public $gender = 'male';
    public $height = 180;
    public $inches = 5;
    public $weight = 80;
    public $speed_unit = 'less than 2.0mph (3.2km/h)';
    public $mets = 2.0;
    public $duration = 120;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
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

    public function updatedUnitType($value)
    {
        if ($value === 'sl') {
            $this->height = 180;
            $this->weight = 80;
        } else {
            $this->height = 5;
            $this->weight = 175;
        }
        $this->detail = null;
        $this->error = null;
    }

    public function updatedSpeedUnit($value)
    {
        $metMap = [
            "less than 2.0mph (3.2km/h)" => 2.0,
            "2.0mph (3.2km/h)"           => 2.8,
            "2.5mph (4.0km/h)"           => 3.0,
            "3.0mph (4.8km/h)"           => 3.5,
            "3.5mph (5.6km/h)"           => 4.3,
            "4.0mph (6.4km/h)"           => 5.0,
            "4.5mph (7.2km/h)"           => 7.0,
            "5.0mph (8.0km/h)"           => 8.3,
        ];

        $this->mets = $metMap[$value] ?? 2.0;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        if (!in_array($propertyName, ['unit_type', 'speed_unit'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['unit_type', 'age', 'gender', 'height', 'inches', 'weight', 'speed_unit', 'mets', 'duration', 'detail', 'error']);
        
        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $this->error = null;

        $request = (object)[
            'unit_type'  => $this->unit_type,
            'age'        => (float)$this->age,
            'gender'     => $this->gender,
            'height'     => (float)$this->height,
            'inches'     => (float)$this->inches,
            'weight'     => (float)$this->weight,
            'speed_unit' => $this->speed_unit,
            'mets'       => (float)$this->mets,
            'duration'   => (float)$this->duration,
        ];

        $model = new Health();
        $result = $model->walking($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            
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
        return view('livewire.calculators.walking-calorie-calculator');
    }
}
