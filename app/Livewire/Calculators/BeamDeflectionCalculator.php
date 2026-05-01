<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class BeamDeflectionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $operations = '1';
    public $shape_1 = '1';
    public $shape_2 = '1';
    
    public $first = 12;
    public $unit1 = 'm';
    
    public $six = 12;
    public $unit6 = 'N/m';
    
    public $seven = 12;
    public $unit7 = 'N.m';
    
    public $second = 12;
    public $unit2 = 'N';
    
    public $third = 12;
    public $unit3 = 'kPa';
    
    public $four = 12;
    public $unit4 = 'm⁴';
    
    public $five = 12;
    public $unit5 = 'm';
    
    public $shape1_extra = '1';

    // Result units
    public $res_unit1 = 'MN·m²';
    public $res_unit2 = 'mm';

    public $openDropdown = null;

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

    public function updated($propertyName)
    {
        if (!str_starts_with($propertyName, 'res_unit') && $propertyName !== 'openDropdown') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($name, $value)
    {
        $this->$name = $value;
        $this->openDropdown = null;
        
        if (!str_starts_with($name, 'res_unit')) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->res_unit1 = 'MN·m²';
        $this->res_unit2 = 'mm';

        // Reset all inputs to defaults
        $this->operations = '1';
        $this->shape_1 = '1';
        $this->shape_2 = '1';
        $this->first = 12;
        $this->unit1 = 'm';
        $this->six = 12;
        $this->unit6 = 'N/m';
        $this->seven = 12;
        $this->unit7 = 'N.m';
        $this->second = 12;
        $this->unit2 = 'N';
        $this->third = 12;
        $this->unit3 = 'kPa';
        $this->four = 12;
        $this->unit4 = 'm⁴';
        $this->five = 12;
        $this->unit5 = 'm';
        $this->shape1_extra = '1';

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

    public function convertResult($value, $type)
    {
        if (!$value) return 0;
        
        if ($type == 'stiffness') {
            $factors = [
                'MN·m²' => 1,
                'kN·m²' => 1000,
                'N·m²'  => 1000000,
            ];
            return $value * ($factors[$this->res_unit1] ?? 1);
        } else if ($type == 'deflection') {
            $factors = [
                'mm' => 1,
                'cm' => 0.1,
                'm'  => 0.001,
                'in' => 0.0393701,
                'ft' => 0.00328084,
            ];
            return $value * ($factors[$this->res_unit2] ?? 1);
        }
        
        return $value;
    }

    public function calculate()
    {
        $requestData = [
            'operations'   => $this->operations,
            'shape_1'      => $this->shape_1,
            'shape_2'      => $this->shape_2,
            'first'        => $this->first,
            'unit1'        => $this->unit1,
            'six'          => $this->six,
            'unit6'        => $this->unit6,
            'seven'        => $this->seven,
            'unit7'        => $this->unit7,
            'second'       => $this->second,
            'unit2'        => $this->unit2,
            'third'        => $this->third,
            'unit3'        => $this->unit3,
            'four'         => $this->four,
            'unit4'        => $this->unit4,
            'five'         => $this->five,
            'unit5'        => $this->unit5,
            'shape1_extra' => $this->shape1_extra,
        ];

        $request = (object)$requestData;

        $model = new Physics();
        $result = $model->beam($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $requestData);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

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

    public function getBeamImage()
    {
        if ($this->operations == '1') {
            return url("images/d1_img{$this->shape_1}.png");
        } else {
            return url("images/d2_img{$this->shape_2}.png");
        }
    }

    public function render()
    {
        return view('livewire.calculators.beam-deflection-calculator');
    }
}
