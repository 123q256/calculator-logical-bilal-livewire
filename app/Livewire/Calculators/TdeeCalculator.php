<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class TdeeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $gender = 'male';
    public $age = 25;
    public $weight = 75;
    public $unit = 'kg';
    public $height_ft = 5;
    public $height_in = 9;
    public $height_cm = 175.26;
    public $hightUnit = 'cm';
    public $activity = 'Lightly Active';
    public $percent = '';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        // Set default units based on localization if needed, but here we follow common pattern
        // The blade has some logic for metricCountries, we can handle it here or in blade.
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->gender = $inputs->gender ?? 'male';
            $this->age = $inputs->age ?? 25;
            $this->weight = $inputs->weight ?? 75;
            $this->unit = $inputs->unit ?? 'kg';
            $this->height_ft = $inputs->height_ft ?? 5;
            $this->height_in = $inputs->height_in ?? 9;
            $this->height_cm = $inputs->height_cm ?? 175.26;
            $this->hightUnit = $inputs->hightUnit ?? 'cm';
            $this->activity = $inputs->activity ?? 'Lightly Active';
            $this->percent = $inputs->percent ?? '';
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['gender', 'age', 'weight', 'unit', 'height_ft', 'height_in', 'height_cm', 'hightUnit', 'activity', 'percent'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->gender = 'male';
        $this->age = 25;
        $this->weight = 75;
        $this->unit = 'kg';
        $this->height_ft = 5;
        $this->height_in = 9;
        $this->height_cm = 175.26;
        $this->hightUnit = 'cm';
        $this->activity = 'Lightly Active';
        $this->percent = '';
        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'gender'    => $this->gender,
            'age'       => $this->age,
            'weight'    => $this->weight,
            'unit'      => $this->unit,
            'height_ft' => $this->height_ft,
            'height_in' => $this->height_in,
            'height_cm' => $this->height_cm,
            'hightUnit' => $this->hightUnit,
            'activity'  => $this->activity,
            'percent'   => $this->percent,
            'unit_ft_in'=> $this->hightUnit, // Health model uses this key too
        ];

        $model = new Health();
        $result = $model->tdee($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Merge inputs into result so Alpine.js has access to them for its calculations
            $result = array_merge($result, [
                'gender'    => $this->gender,
                'age'       => (int)$this->age,
                'weight'    => (float)$this->weight,
                'height_cm' => (float)$this->height_cm,
                'activity'  => $this->activity,
                'percent'   => $this->percent ? (float)$this->percent : 0,
            ]);

            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $this->detail);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('render-graph', { detail: %s }));
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 400);
            JS, json_encode($this->detail)));
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('render-graph', { detail: %s }));
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 400);
            JS, json_encode($this->detail)));
        }
        return view('livewire.calculators.tdee-calculator');
    }
}
