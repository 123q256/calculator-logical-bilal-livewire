<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class EbitdaCalculator extends Component
{
    public $unit_type = 'simple';
    
    // Simple Mode Inputs
    public $x;
    public $y;
    public $a;
    public $d;
    
    // Extended Mode Inputs
    public $rev;
    public $net;
    public $Interest;
    public $Taxes;
    public $ae;
    public $de;

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
            $this->unit_type = $inputs->unit_type ?? 'simple';
            $this->x = $inputs->x ?? 50;
            $this->y = $inputs->y ?? 50;
            $this->a = $inputs->a ?? 50;
            $this->d = $inputs->d ?? 50;
            $this->rev = $inputs->rev ?? 50;
            $this->net = $inputs->net ?? 50;
            $this->Interest = $inputs->Interest ?? 50;
            $this->Taxes = $inputs->Taxes ?? 50;
            $this->ae = $inputs->ae ?? 50;
            $this->de = $inputs->de ?? 50;
        } else {
            $this->x = 50;
            $this->y = 50;
            $this->a = 50;
            $this->d = 50;
            $this->rev = 50;
            $this->net = 50;
            $this->Interest = 50;
            $this->Taxes = 50;
            $this->ae = 50;
            $this->de = 50;
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
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['detail', 'error']);
        $this->unit_type = 'simple';
        
        $this->x = 50;
        $this->y = 50;
        $this->a = 50;
        $this->d = 50;
        $this->rev = 50;
        $this->net = 50;
        $this->Interest = 50;
        $this->Taxes = 50;
        $this->ae = 50;
        $this->de = 50;

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
            'x' => $this->x,
            'y' => $this->y,
            'a' => $this->a,
            'd' => $this->d,
            'rev' => $this->rev,
            'net' => $this->net,
            'Interest' => $this->Interest,
            'Taxes' => $this->Taxes,
            'ae' => $this->ae,
            'de' => $this->de,
        ];

        $model = new Finance();
        $result = $model->ebitda($request);

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

        return view('livewire.calculators.ebitda-calculator');
    }
}
