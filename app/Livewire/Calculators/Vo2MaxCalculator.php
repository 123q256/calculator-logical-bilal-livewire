<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class Vo2MaxCalculator extends Component
{
    public $type = 'calculator';
    public $lang = [];
    public $detail = null;
    public $error = null;

    // Inputs
    public $methods = '2'; // Default: Rockport
    public $operations1 = '1'; // Sex (Male: 1, Female: 0)
    public $first = '22'; // Age
    public $second = '67'; // Weight
    public $units2 = 'kg'; // Weight unit
    public $third = '45'; // Time/Seconds
    public $units3 = 'sec'; // Time unit
    public $operations2 = '2'; // Specific Sex for Method 5
    public $four = '70'; // Beats/Heart Rate

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
        $this->methods = '2';
        $this->operations1 = '1';
        $this->first = '22';
        $this->second = '67';
        $this->units2 = 'kg';
        $this->third = '45';
        $this->units3 = 'sec';
        $this->operations2 = '2';
        $this->four = '70';
        
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
            'methods' => $this->methods,
            'operations1' => $this->operations1,
            'first' => $this->first,
            'second' => $this->second,
            'units2' => $this->units2,
            'third' => $this->third,
            'units3' => $this->units3,
            'operations2' => $this->operations2,
            'four' => $this->four,
        ];

        $model = new Health();
        $result = $model->vo2($request);

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
        return view('livewire.calculators.vo2-max-calculator');
    }
}
