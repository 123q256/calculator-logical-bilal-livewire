<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class UrineOutputCalculator extends Component
{
    public $weight = '80';
    public $weight_unit = 'kg';
    public $time = '24';
    public $time_min = '10';
    public $time_sec = '10';
    public $time_unit = 'sec';
    public $urine = '3000';
    public $urine_unit = 'ml';
    public $fluid = '300';
    public $fluid_unit = 'ml';
    public $output_unit = 'kg';
    public $balance_unit = 'ml';
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
            $this->weight = $inputs['weight'] ?? '80';
            $this->weight_unit = $inputs['weight_unit'] ?? 'kg';
            $this->time = $inputs['time'] ?? '24';
            $this->time_min = $inputs['time_min'] ?? '10';
            $this->time_sec = $inputs['time_sec'] ?? '10';
            $this->time_unit = $inputs['time_unit'] ?? 'sec';
            $this->urine = $inputs['urine'] ?? '3000';
            $this->urine_unit = $inputs['urine_unit'] ?? 'ml';
            $this->fluid = $inputs['fluid'] ?? '300';
            $this->fluid_unit = $inputs['fluid_unit'] ?? 'ml';
            $this->output_unit = $inputs['output_unit'] ?? 'kg';
            $this->balance_unit = $inputs['balance_unit'] ?? 'ml';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->weight = '80';
        $this->weight_unit = 'kg';
        $this->time = '24';
        $this->time_min = '10';
        $this->time_sec = '10';
        $this->time_unit = 'sec';
        $this->urine = '3000';
        $this->urine_unit = 'ml';
        $this->fluid = '300';
        $this->fluid_unit = 'ml';
        $this->output_unit = 'kg';
        $this->balance_unit = 'ml';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $request = (object)[
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit,
            'time' => $this->time,
            'time_min' => $this->time_min,
            'time_sec' => $this->time_sec,
            'time_unit' => $this->time_unit,
            'urine' => $this->urine,
            'urine_unit' => $this->urine_unit,
            'fluid' => $this->fluid,
            'fluid_unit' => $this->fluid_unit,
            'output_unit' => $this->output_unit,
            'balance_unit' => $this->balance_unit,
        ];

        $model = new Health();
        $result = $model->urine($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
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
        return view('livewire.calculators.urine-output-calculator');
    }
}
