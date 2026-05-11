<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class CorrectedCalciumCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $calcium = 9.5;
    public $albumin = 4.0;
    public $normal = 4.0;
    public $unit_c = 'mg/dl';
    public $unit_a = 'g/dL';
    public $unit_n = 'g/dL';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calcium = $inputs->calcium ?? $this->calcium;
            $this->albumin = $inputs->albumin ?? $this->albumin;
            $this->normal = $inputs->normal ?? $this->normal;
            $this->unit_c = $inputs->unit_c ?? $this->unit_c;
            $this->unit_a = $inputs->unit_a ?? $this->unit_a;
            $this->unit_n = $inputs->unit_n ?? $this->unit_n;
        }
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->calcium = 9.5;
        $this->albumin = 4.0;
        $this->normal = 4.0;
        $this->unit_c = 'mg/dl';
        $this->unit_a = 'g/dL';
        $this->unit_n = 'g/dL';

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
            'calcium' => $this->calcium,
            'albumin' => $this->albumin,
            'normal' => $this->normal,
            'unit_c' => $this->unit_c,
            'unit_a' => $this->unit_a,
            'unit_n' => $this->unit_n,
        ];

        $model = new Health();
        $result = $model->corrected($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
        }
        return view('livewire.calculators.corrected-calcium-calculator');
    }
}
