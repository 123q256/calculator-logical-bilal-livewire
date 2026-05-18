<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class AngleOfElevationCalculator extends Component
{
    // Public Input Properties
    public $to_cal = '1';
    public $vertical = '12';
    public $vertical_unit = 'm';
    public $hori = '12';
    public $hori_unit = 'm';
    public $angle = '45';
    public $angle_unit = 'deg';

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
            $this->to_cal = $inputs['to_cal'] ?? '1';
            $this->vertical = $inputs['vertical'] ?? '12';
            $this->vertical_unit = $inputs['vertical_unit'] ?? 'm';
            $this->hori = $inputs['hori'] ?? '12';
            $this->hori_unit = $inputs['hori_unit'] ?? 'm';
            $this->angle = $inputs['angle'] ?? '45';
            $this->angle_unit = $inputs['angle_unit'] ?? 'deg';
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->to_cal = '1';
        $this->vertical = '12';
        $this->vertical_unit = 'm';
        $this->hori = '12';
        $this->hori_unit = 'm';
        $this->angle = '45';
        $this->angle_unit = 'deg';

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
            'to_cal' => $this->to_cal,
            'vertical' => $this->vertical,
            'vertical_unit' => $this->vertical_unit,
            'hori' => $this->hori,
            'hori_unit' => $this->hori_unit,
            'angle' => $this->angle,
            'angle_unit' => $this->angle_unit,
        ];

        $model = new Math();
        $result = $model->angle_of($request);

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
        return view('livewire.calculators.angle-of-elevation-calculator');
    }
}
