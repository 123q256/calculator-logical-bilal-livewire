<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class CostOfEquityCalculator extends Component
{
    public $find = 1;
    public $dividend_per_share = 50;
    public $current_market_value = 50;
    public $growth_rate_dividend = 5;
    public $risk_rate_return = 7;
    public $market_rate_return = 10;
    public $beta = 1.2;

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

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->find = $inputs->pay ?? $this->find;
            $this->dividend_per_share = $inputs->dividend_per_share ?? $this->dividend_per_share;
            $this->current_market_value = $inputs->current_market_value ?? $this->current_market_value;
            $this->growth_rate_dividend = $inputs->growth_rate_dividend ?? $this->growth_rate_dividend;
            $this->risk_rate_return = $inputs->risk_rate_return ?? $this->risk_rate_return;
            $this->market_rate_return = $inputs->market_rate_return ?? $this->market_rate_return;
            $this->beta = $inputs->beta ?? $this->beta;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'find') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->find = 1;
        $this->dividend_per_share = 50;
        $this->current_market_value = 50;
        $this->growth_rate_dividend = 5;
        $this->risk_rate_return = 7;
        $this->market_rate_return = 10;
        $this->beta = 1.2;

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
        $requestData = [
            'pay' => $this->find,
            'dividend_per_share' => $this->dividend_per_share,
            'current_market_value' => $this->current_market_value,
            'growth_rate_dividend' => $this->growth_rate_dividend,
            'risk_rate_return' => $this->risk_rate_return,
            'market_rate_return' => $this->market_rate_return,
            'beta' => $this->beta,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->cost($request);

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
            session()->flash('validation_error', $this->error);
            $this->detail = null;
        }
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
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.cost-of-equity-calculator');
    }
}
