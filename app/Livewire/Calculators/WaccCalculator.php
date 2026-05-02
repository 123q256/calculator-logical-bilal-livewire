<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class WaccCalculator extends Component
{
    public $unit_type = 'capm';
    
    // WACC Mode Inputs (capm)
    public $a = 50000; // Debt
    public $b = 9;     // Cost of Debt
    public $c = 30000; // Equity
    public $d = 13;    // Cost of Equity
    public $e = 13;    // Tax Rate
    
    // Cost of Equity Mode Inputs (mapped to 'debt' in model)
    public $risk = 13;
    public $beta = 13;
    public $eq = 13;
    
    // Cost of Debt Mode Inputs (mapped to 'cd' in model)
    public $rate = 13;
    public $tax = 13;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->unit_type = $inputs->unit_type ?? 'capm';
            $this->a = $inputs->a ?? 50000;
            $this->b = $inputs->b ?? 9;
            $this->c = $inputs->c ?? 30000;
            $this->d = $inputs->d ?? 13;
            $this->e = $inputs->e ?? 13;
            $this->risk = $inputs->risk ?? 13;
            $this->beta = $inputs->beta ?? 13;
            $this->eq = $inputs->eq ?? 13;
            $this->rate = $inputs->rate ?? 13;
            $this->tax = $inputs->tax ?? 13;
        }
    }

    public function setMode($mode)
    {
        $this->unit_type = $mode;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'unit_type') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['a', 'b', 'c', 'd', 'e', 'risk', 'beta', 'eq', 'rate', 'tax', 'detail', 'error']);
        $this->unit_type = 'capm';
        
        $this->a = 50000;
        $this->b = 9;
        $this->c = 30000;
        $this->d = 13;
        $this->e = 13;
        $this->risk = 13;
        $this->beta = 13;
        $this->eq = 13;
        $this->rate = 13;
        $this->tax = 13;

        session()->forget([
            'calculator_result',
            'calculator_back_inputs',
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
            'unit_type' => $this->unit_type,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'd' => $this->d,
            'e' => $this->e,
            'risk' => $this->risk,
            'beta' => $this->beta,
            'eq' => $this->eq,
            'rate' => ($this->unit_type == 'debt' ? $this->beta : $this->rate),
            'tax' => ($this->unit_type == 'debt' ? $this->eq : $this->tax),
        ];

        $model = new Finance();
        $result = $model->wacc($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.wacc-calculator');
    }
}
