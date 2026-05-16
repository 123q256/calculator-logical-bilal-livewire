<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class PointSlopeFormCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $point_unit = '1';
    public $x1 = '2';
    public $y1 = '4';
    public $m = '1.5';
    public $sec_x1 = '2';
    public $sec_y1 = '4';
    public $sec_x2 = '6';
    public $sec_y2 = '8';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['point_unit'])) $this->point_unit = $inputs['point_unit'];
            if (isset($inputs['x1'])) $this->x1 = $inputs['x1'];
            if (isset($inputs['y1'])) $this->y1 = $inputs['y1'];
            if (isset($inputs['m'])) $this->m = $inputs['m'];
            if (isset($inputs['sec_x1'])) $this->sec_x1 = $inputs['sec_x1'];
            if (isset($inputs['sec_y1'])) $this->sec_y1 = $inputs['sec_y1'];
            if (isset($inputs['sec_x2'])) $this->sec_x2 = $inputs['sec_x2'];
            if (isset($inputs['sec_y2'])) $this->sec_y2 = $inputs['sec_y2'];
        }
    }

    public function resetForm()
    {
        $this->point_unit = '1';
        $this->x1 = '2';
        $this->y1 = '4';
        $this->m = '1.5';
        $this->sec_x1 = '2';
        $this->sec_y1 = '4';
        $this->sec_x2 = '6';
        $this->sec_y2 = '8';
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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'point_unit' => $this->point_unit,
            'x1' => $this->x1,
            'y1' => $this->y1,
            'm' => $this->m,
            'sec_x1' => $this->sec_x1,
            'sec_y1' => $this->sec_y1,
            'sec_x2' => $this->sec_x2,
            'sec_y2' => $this->sec_y2,
        ];

        $model = new Math();
        $result = $model->point($request);

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
        return view('livewire.calculators.point-slope-form-calculator');
    }
}
