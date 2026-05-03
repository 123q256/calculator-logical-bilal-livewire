<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class CommissionCalculator extends Component
{
    public $find = '1';
    public $select1 = 'commission';
    public $sale_price = 10;
    public $commission_rate = 20;
    public $commission_amount = 30;

    public $currency = '$';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [], $currency = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currency = $currency;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->find = $inputs->find ?? '1';
            $this->select1 = $inputs->select1 ?? 'commission';
            $this->sale_price = $inputs->sale_price ?? 10;
            $this->commission_rate = $inputs->commission_rate ?? 20;
            $this->commission_amount = $inputs->commission_amount ?? 30;
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['find', 'select1'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['find', 'select1', 'sale_price', 'commission_rate', 'commission_amount', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'find' => $this->find,
            'select1' => $this->select1,
            'sale_price' => (float)$this->sale_price,
            'commission_rate' => (float)$this->commission_rate,
            'commission_amount' => (float)$this->commission_amount,
        ];

        $model = new Finance();
        $result = $model->commission($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
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

        return view('livewire.calculators.commission-calculator');
    }
}
