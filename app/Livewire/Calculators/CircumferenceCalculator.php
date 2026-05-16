<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class CircumferenceCalculator extends Component
{
    public $radius = '';
    public $diameter = '';
    public $circumference = '';
    public $area = '';
    
    public $unit_r = 'cm';
    public $unit_d = 'cm';
    public $unit_c = 'cm';
    public $unit_a = 'cm';

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
            $this->radius = $inputs['radius'] ?? '';
            $this->diameter = $inputs['diameter'] ?? '';
            $this->circumference = $inputs['circumference'] ?? '';
            $this->area = $inputs['area'] ?? '';
            $this->unit_r = $inputs['unit_r'] ?? 'cm';
            $this->unit_d = $inputs['unit_d'] ?? 'cm';
            $this->unit_c = $inputs['unit_c'] ?? 'cm';
            $this->unit_a = $inputs['unit_a'] ?? 'cm';
        }
    }

    public function resetForm()
    {
        $this->radius = '';
        $this->diameter = '';
        $this->circumference = '';
        $this->area = '';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        
        // Logic to ensure only one value is entered at a time
        if (in_array($propertyName, ['radius', 'diameter', 'circumference', 'area'])) {
            if ($this->{$propertyName} !== '') {
                if ($propertyName !== 'radius') $this->radius = '';
                if ($propertyName !== 'diameter') $this->diameter = '';
                if ($propertyName !== 'circumference') $this->circumference = '';
                if ($propertyName !== 'area') $this->area = '';
            }
        }
    }

    public function setUnit($unit, $value)
    {
        $this->{$unit} = $value;
        $this->detail = null;
    }

    public function calculate()
    {
        $request = (object)[
            'radius' => $this->radius,
            'diameter' => $this->diameter,
            'circumference' => $this->circumference,
            'area' => $this->area,
            'unit_r' => $this->unit_r,
            'unit_d' => $this->unit_d,
            'unit_c' => $this->unit_c,
            'unit_a' => $this->unit_a,
        ];

        $model = new Math();
        $result = $model->circumference($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $result['radius_used'] = $this->radius;
            $result['diameter_used'] = $this->diameter;
            $result['circumference_used'] = $this->circumference;
            $result['area_used'] = $this->area;

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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.circumference-calculator');
    }
}
