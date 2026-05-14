<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class NavyBodyFatCalculator extends Component
{
    public $gender = 'male';
    public $age = '23';
    public $weight = '15';
    public $weight_unit = 'lbs';
    
    public $height_ft = '6';
    public $height_in = '0';
    public $height_cm = '168';
    public $unit_ft_in = 'cm';
    
    public $neck_ft = '0';
    public $neck_in = '0';
    public $neck_cm = '30';
    public $unit_ft_in1 = 'cm';
    
    public $waist_ft = '0';
    public $waist_in = '0';
    public $waist_cm = '81';
    public $unit_ft_in2 = 'cm';
    
    public $hip_ft = '1';
    public $hip_in = '2';
    public $hip_cm = '97';
    public $unit_ft_in3 = 'cm';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->gender = $inputs['gender'] ?? 'male';
            $this->age = $inputs['age'] ?? '23';
            $this->weight = $inputs['weight'] ?? '15';
            $this->weight_unit = $inputs['weight_unit'] ?? 'lbs';
            
            $this->height_ft = $inputs['height_ft'] ?? '6';
            $this->height_in = $inputs['height_in'] ?? '0';
            $this->height_cm = $inputs['height_cm'] ?? '168';
            $this->unit_ft_in = $inputs['unit_ft_in'] ?? 'cm';
            
            $this->neck_ft = $inputs['neck_ft'] ?? '0';
            $this->neck_in = $inputs['neck_in'] ?? '0';
            $this->neck_cm = $inputs['neck_cm'] ?? '30';
            $this->unit_ft_in1 = $inputs['unit_ft_in1'] ?? 'cm';
            
            $this->waist_ft = $inputs['waist_ft'] ?? '0';
            $this->waist_in = $inputs['waist_in'] ?? '0';
            $this->waist_cm = $inputs['waist_cm'] ?? '81';
            $this->unit_ft_in2 = $inputs['unit_ft_in2'] ?? 'cm';
            
            $this->hip_ft = $inputs['hip_ft'] ?? '1';
            $this->hip_in = $inputs['hip_in'] ?? '2';
            $this->hip_cm = $inputs['hip_cm'] ?? '97';
            $this->unit_ft_in3 = $inputs['unit_ft_in3'] ?? 'cm';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['gender', 'age', 'weight', 'weight_unit', 'height_ft', 'height_in', 'height_cm', 'unit_ft_in', 'neck_ft', 'neck_in', 'neck_cm', 'unit_ft_in1', 'waist_ft', 'waist_in', 'waist_cm', 'unit_ft_in2', 'hip_ft', 'hip_in', 'hip_cm', 'unit_ft_in3', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'gender' => $this->gender,
            'age' => $this->age,
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit,
            'height_ft' => $this->height_ft,
            'height_in' => $this->height_in,
            'height_cm' => $this->height_cm,
            'unit_ft_in' => $this->unit_ft_in,
            'neck_ft' => $this->neck_ft,
            'neck_in' => $this->neck_in,
            'neck_cm' => $this->neck_cm,
            'unit_ft_in1' => $this->unit_ft_in1,
            'waist_ft' => $this->waist_ft,
            'waist_in' => $this->waist_in,
            'waist_cm' => $this->waist_cm,
            'unit_ft_in2' => $this->unit_ft_in2,
            'hip_ft' => $this->hip_ft,
            'hip_in' => $this->hip_in,
            'hip_cm' => $this->hip_cm,
            'unit_ft_in3' => $this->unit_ft_in3,
        ];

        $model = new Health();
        $result = $model->navy($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (isset($result['bodyFat']) && is_nan((float)$result['bodyFat'])) {
                $result['bodyFat'] = 'NAN %';
            }
            
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
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
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.navy-body-fat-calculator');
    }
}
