<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class AreaOfASectorCalculator extends Component
{
    // Public Input Properties
    public $angle = '120';
    public $angle_unit = 'deg';
    
    public $rad = '120';
    public $rad_unit = 'cm';
    
    public $diameter = '';
    public $diameter_unit = 'cm';
    
    public $area = '';
    public $area_unit = 'cm²';
    
    public $arc = '';
    public $arc_unit = 'cm';
    
    public $c = '';
    public $c_unit = 'cm';

    // Component State
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
            $this->angle = $inputs['angle'] ?? '120';
            $this->angle_unit = $inputs['angle_unit'] ?? 'deg';
            $this->rad = $inputs['rad'] ?? '120';
            $this->rad_unit = $inputs['rad_unit'] ?? 'cm';
            $this->diameter = $inputs['diameter'] ?? '';
            $this->diameter_unit = $inputs['diameter_unit'] ?? 'cm';
            $this->area = $inputs['area'] ?? '';
            $this->area_unit = $inputs['area_unit'] ?? 'cm²';
            $this->arc = $inputs['arc'] ?? '';
            $this->arc_unit = $inputs['arc_unit'] ?? 'cm';
            $this->c = $inputs['c'] ?? '';
            $this->c_unit = $inputs['c_unit'] ?? 'cm';
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->angle = '120';
        $this->angle_unit = 'deg';
        $this->rad = '120';
        $this->rad_unit = 'cm';
        $this->diameter = '';
        $this->diameter_unit = 'cm';
        $this->area = '';
        $this->area_unit = 'cm²';
        $this->arc = '';
        $this->arc_unit = 'cm';
        $this->c = '';
        $this->c_unit = 'cm';

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
    }

    public function calculate()
    {
        $request = (object)[
            'angle' => $this->angle,
            'angle_unit' => $this->angle_unit,
            'rad' => $this->rad,
            'rad_unit' => $this->rad_unit,
            'diameter' => $this->diameter,
            'diameter_unit' => $this->diameter_unit,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'arc' => $this->arc,
            'arc_unit' => $this->arc_unit,
            'c' => $this->c,
            'c_unit' => $this->c_unit,
        ];

        $model = new Math();
        $result = $model->sector($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
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

        $this->error = $result['error'] ?? 'Please! Check Your Input.';
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
        return view('livewire.calculators.area-of-a-sector-calculator');
    }
}
