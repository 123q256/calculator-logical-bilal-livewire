<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class DrugHalfLifeCalculator extends Component
{
    public $time = '12';
    public $time_min = '9';
    public $time_sec = '12';
    public $time_unit = 'hrs';
    public $dosage = '1000';
    public $dosage_unit = 'mg';

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
            $this->time = $inputs['time'] ?? '12';
            $this->time_min = $inputs['time_min'] ?? '9';
            $this->time_sec = $inputs['time_sec'] ?? '12';
            $this->time_unit = $inputs['time_unit'] ?? 'hrs';
            $this->dosage = $inputs['dosage'] ?? '1000';
            $this->dosage_unit = $inputs['dosage_unit'] ?? 'mg';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['time', 'time_min', 'time_sec', 'time_unit', 'dosage', 'dosage_unit', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'time' => $this->time,
            'time_min' => $this->time_min,
            'time_sec' => $this->time_sec,
            'time_unit' => $this->time_unit,
            'dosage' => $this->dosage,
            'dosage_unit' => $this->dosage_unit,
        ];

        $model = new Health();
        $result = $model->drug($request);

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
        return view('livewire.calculators.drug-half-life-calculator');
    }
}
