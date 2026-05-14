<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class AdjustedBodyWeightCalculator extends Component
{
    public $gender = 'male';
    public $weight = '15';
    public $weight_unit = 'kg';
    
    public $height_ft = '6';
    public $height_in = '12';
    public $height_cm = '168';
    public $unit_ft_in = 'cm';

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
            $this->weight = $inputs['weight'] ?? '15';
            $this->weight_unit = $inputs['weight_unit'] ?? 'kg';
            
            $this->height_ft = $inputs['height_ft'] ?? '6';
            $this->height_in = $inputs['height_in'] ?? '12';
            $this->height_cm = $inputs['height_cm'] ?? '168';
            $this->unit_ft_in = $inputs['unit_ft_in'] ?? 'cm';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['gender', 'weight', 'weight_unit', 'height_ft', 'height_in', 'height_cm', 'unit_ft_in', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'gender' => $this->gender,
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit,
            'height_ft' => $this->height_ft,
            'height_in' => $this->height_in,
            'height_cm' => $this->height_cm,
            'unit_ft_in' => $this->unit_ft_in,
        ];

        $model = new Health();
        $result = $model->adjusted($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
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
        return view('livewire.calculators.adjusted-body-weight-calculator');
    }
}
