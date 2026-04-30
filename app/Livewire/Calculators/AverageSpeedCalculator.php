<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class AverageSpeedCalculator extends Component
{
    public $t_hours = 8;
    public $t_min = 30;
    public $t_sec = 0;
    public $distance = 10;
    public $distance_unit = 'km';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $unit_open = false;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->t_hours = $inputs->t_hours ?? 8;
            $this->t_min = $inputs->t_min ?? 30;
            $this->t_sec = $inputs->t_sec ?? 0;
            $this->distance = $inputs->distance ?? 10;
            $this->distance_unit = $inputs->distance_unit ?? 'km';
        }
    }

    public function setUnit($unit)
    {
        $this->distance_unit = $unit;
        $this->unit_open = false;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'unit_open') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->t_hours = 8;
        $this->t_min = 30;
        $this->t_sec = 0;
        $this->distance = 10;
        $this->distance_unit = 'km';

        $this->error = null;
        $this->detail = null;

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

    public function calculate()
    {
        $request = (object)[
            't_hours'       => $this->t_hours,
            't_min'         => $this->t_min,
            't_sec'         => $this->t_sec,
            'distance'      => $this->distance,
            'distance_unit' => $this->distance_unit,
        ];

        $model = new Physics();
        $result = $model->average($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

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
            session()->flash('validation_error', $this->error);
        }
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
    
        return view('livewire.calculators.average-speed-calculator');
    }
}
