<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class BasisPointCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $unit_type = 'submit';

    // Calculator Mode 1
    public $dec = 25;
    public $percent = '';
    public $perm = '';
    public $bsp = '';

    // Calculator Mode 2
    public $bps1 = '';
    public $bps_unit = 'decimal';
    public $of = 10000;
    public $equals = 10;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->unit_type = $inputs->unit_type ?? 'submit';
            
            if ($this->unit_type == 'submit') {
                $this->dec = $inputs->dec ?? 25;
                $this->percent = $inputs->percent ?? '';
                $this->perm = $inputs->perm ?? '';
                $this->bsp = $inputs->bsp ?? '';
            } else {
                $this->bps1 = $inputs->bps1 ?? '';
                $this->bps_unit = $inputs->bps_unit ?? 'decimal';
                $this->of = $inputs->of ?? 10000;
                $this->equals = $inputs->equals ?? 10;
            }
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        
        $this->unit_type = 'submit';
        $this->dec = 25;
        $this->percent = '';
        $this->perm = '';
        $this->bsp = '';
        
        $this->bps1 = '';
        $this->bps_unit = 'decimal';
        $this->of = 10000;
        $this->equals = 10;

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

    public function setUnitType($type)
    {
        $this->unit_type = $type;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        // Clear other fields in mode 1 when one is updated to avoid model conflicts
        if (in_array($propertyName, ['dec', 'percent', 'perm', 'bsp'])) {
            if ($propertyName !== 'dec') $this->dec = '';
            if ($propertyName !== 'percent') $this->percent = '';
            if ($propertyName !== 'perm') $this->perm = '';
            if ($propertyName !== 'bsp') $this->bsp = '';
        }

        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'unit_type' => $this->unit_type,
            'dec' => $this->dec,
            'percent' => $this->percent,
            'perm' => $this->perm,
            'bsp' => $this->bsp,
            'bps1' => $this->bps1,
            'bps_unit' => $this->bps_unit,
            'of' => $this->of,
            'equals' => $this->equals,
            'currency' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->basis($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.basis-point-calculator');
    }
}
