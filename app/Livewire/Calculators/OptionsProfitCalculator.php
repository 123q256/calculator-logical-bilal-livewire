<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class OptionsProfitCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currency = '$';

    public $ot = 'c';
    public $sp = 10;
    public $op = 10;
    public $stp = 10;
    public $nc = 10;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->ot = $inputs->ot ?? 'c';
            $this->sp = $inputs->sp ?? 10;
            $this->op = $inputs->op ?? 10;
            $this->stp = $inputs->stp ?? 10;
            $this->nc = $inputs->nc ?? 10;
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'ot') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        
        $this->ot = 'c';
        $this->sp = 10;
        $this->op = 10;
        $this->stp = 10;
        $this->nc = 10;

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
            'ot' => $this->ot,
            'sp' => (float)$this->sp,
            'op' => (float)$this->op,
            'stp' => (float)$this->stp,
            'nc' => (float)$this->nc,
        ];

        $model = new Finance();
        $result = $model->options($request);

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

        return view('livewire.calculators.options-profit-calculator');
    }
}
