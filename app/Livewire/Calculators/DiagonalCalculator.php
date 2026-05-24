<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class DiagonalCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $given = '1';
    public $ls = '1';
    public $ls_unit = 'cm';
    public $ss = '2';
    public $ss_unit = 'cm';
    public $area = '3';
    public $area_unit = 'cm²';
    public $perimeter = '1.5';
    public $perimeter_unit = 'cm';
    public $angle = '1';
    public $angle_unit = 'deg';
    public $circum = '1';
    public $circum_unit = 'cm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->given = $inputs['given'] ?? $this->given;
            $this->ls = $inputs['ls'] ?? $this->ls;
            $this->ls_unit = $inputs['ls_unit'] ?? $this->ls_unit;
            $this->ss = $inputs['ss'] ?? $this->ss;
            $this->ss_unit = $inputs['ss_unit'] ?? $this->ss_unit;
            $this->area = $inputs['area'] ?? $this->area;
            $this->area_unit = $inputs['area_unit'] ?? $this->area_unit;
            $this->perimeter = $inputs['perimeter'] ?? $this->perimeter;
            $this->perimeter_unit = $inputs['perimeter_unit'] ?? $this->perimeter_unit;
            $this->angle = $inputs['angle'] ?? $this->angle;
            $this->angle_unit = $inputs['angle_unit'] ?? $this->angle_unit;
            $this->circum = $inputs['circum'] ?? $this->circum;
            $this->circum_unit = $inputs['circum_unit'] ?? $this->circum_unit;
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->given = '1';
        $this->ls = '1';
        $this->ls_unit = 'cm';
        $this->ss = '2';
        $this->ss_unit = 'cm';
        $this->area = '3';
        $this->area_unit = 'cm²';
        $this->perimeter = '1.5';
        $this->perimeter_unit = 'cm';
        $this->angle = '1';
        $this->angle_unit = 'deg';
        $this->circum = '1';
        $this->circum_unit = 'cm';

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

  public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $requestData = [
            'given' => $this->given,
            'ls' => $this->ls,
            'ls_unit' => $this->ls_unit,
            'ss' => $this->ss,
            'ss_unit' => $this->ss_unit,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'perimeter' => $this->perimeter,
            'perimeter_unit' => $this->perimeter_unit,
            'angle' => $this->angle,
            'angle_unit' => $this->angle_unit,
            'circum' => $this->circum,
            'circum_unit' => $this->circum_unit,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->diagonal($request);

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
        return view('livewire.calculators.diagonal-calculator');
    }
}
