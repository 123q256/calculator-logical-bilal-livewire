<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class CalorieDeficitCalculator extends Component
{
    // Form Inputs
    public $unit = 'lbs';
    public $gender = 'Male';
    public $age = 23;
    public $weight = 205;
    public $target = 185;
    public $activity = '1.55';
    
    // Height Inputs
    public $height_ft = 5;
    public $height_in = 9;
    public $height_ft_in = '5-9';
    public $height_cm = 175;

    // Results & State
    public $detail = null;
    public $error = null;
    public $type = 'calculator';
    public $lang = [];

    protected $rules = [
        'age' => 'required|numeric|min:1|max:120',
        'weight' => 'required|numeric|min:1',
        'target' => 'required|numeric|min:1',
        'activity' => 'required',
    ];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->fill($inputs);
            $this->height_ft_in = $this->height_ft . '-' . $this->height_in;
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'height_ft_in') {
            $parts = explode('-', $this->height_ft_in);
            if (count($parts) === 2) {
                $this->height_ft = (int)$parts[0];
                $this->height_in = (int)$parts[1];
            }
        }
        // Reset results on any input change to ensure real-time consistency
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $this->validate();

        if ($this->target >= $this->weight) {
            $this->error = 'Your target weight must be lower than your current weight.';
            return;
        }

        // Prepare request object for Health model
        $request = (object)[
            'unit_type' => $this->unit,
            'gender' => $this->gender,
            'age' => $this->age,
            'weight' => $this->weight,
            'target' => $this->target,
            'activity' => (float)$this->activity,
            'ft_in' => ($this->unit === 'lbs') ? ($this->height_ft * 12 + $this->height_in) : null,
            'height_cm' => ($this->unit === 'kg') ? $this->height_cm : null,
        ];

        $model = new Health();
        $result = $model->cal_deficit($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            // Persist for PDF/Share if needed
            session()->put('calculator_result', $result);
            session()->put('calculator_back_inputs', [
                'unit' => $this->unit,
                'gender' => $this->gender,
                'age' => $this->age,
                'weight' => $this->weight,
                'target' => $this->target,
                'activity' => $this->activity,
                'height_ft' => $this->height_ft,
                'height_in' => $this->height_in,
                'height_cm' => $this->height_cm,
            ]);

            $this->dispatch('render-graph');

            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Calculation failed. Please check your inputs.';
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->fill([
            'unit' => 'lbs',
            'gender' => 'Male',
            'age' => 23,
            'weight' => 205,
            'target' => 185,
            'activity' => '1.55',
            'height_ft' => 5,
            'height_in' => 9,
            'height_cm' => 175,
            'detail' => null,
            'error' => null,
        ]);

        session()->forget(['calculator_result', 'calculator_back_inputs']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
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
        return view('livewire.calculators.calorie-deficit-calculator');
    }
}
