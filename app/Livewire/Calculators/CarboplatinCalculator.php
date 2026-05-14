<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class CarboplatinCalculator extends Component
{
    public $type = 'calculator';
    public $lang = [];
    public $detail = null;
    public $error = null;

    // Inputs
    public $c_type = 'first'; // Simple (first) vs Advance (second)
    public $operations = '1'; // 1: Male, 2: Female
    public $first = '22'; // Age
    public $second = '67'; // Weight
    public $s_units = 'kg'; // Weight Unit
    public $third = '5'; // Creatinine
    public $t_units = 'mg/dL'; // Creatinine Unit
    public $four = '5'; // Target AUC
    public $five = '67'; // Height
    public $f_units = 'in'; // Height Unit

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

    public function setTab($tab)
    {
        $this->c_type = $tab;
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
        $this->c_type = 'first';
        $this->operations = '1';
        $this->first = '22';
        $this->second = '67';
        $this->s_units = 'kg';
        $this->third = '5';
        $this->t_units = 'mg/dL';
        $this->four = '5';
        $this->five = '67';
        $this->f_units = 'in';
        
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error'
        ]);
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'type' => $this->c_type,
            'operations' => $this->operations,
            'first' => $this->first,
            'second' => $this->second,
            's_units' => $this->s_units,
            'third' => $this->third,
            't_units' => $this->t_units,
            'four' => $this->four,
            'five' => $this->five,
            'f_units' => $this->f_units,
        ];

        $model = new Health();
        $result = $model->carboplatin($request);

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
        return view('livewire.calculators.carboplatin-calculator');
    }
}
