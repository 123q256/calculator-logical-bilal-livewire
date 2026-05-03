<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class GrossIncomeCalculator extends Component
{
    public $income_type = 'Salary';
    public $pay_frequency = 'Monthly';
    public $filer_status = 'single';
    public $pay_method = 'Per-Year';
    public $amount = 10000;

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
            $this->income_type = $inputs->type ?? 'Salary';
            $this->pay_frequency = $inputs->pay_frequency ?? 'Monthly';
            $this->filer_status = $inputs->filer_status ?? 'single';
            $this->pay_method = $inputs->pay_method ?? 'Per-Year';
            $this->amount = $inputs->amount ?? 10000;
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['income_type', 'pay_frequency', 'filer_status', 'pay_method'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['income_type', 'pay_frequency', 'filer_status', 'pay_method', 'amount', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'type' => $this->income_type,
            'pay_frequency' => $this->pay_frequency,
            'filer_status' => $this->filer_status,
            'pay_method' => $this->pay_method,
            'amount' => (float)$this->amount,
        ];

        $model = new Finance();
        $result = $model->gross($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Prepare Highcharts data (as array for Livewire dispatch)
            $result['chartData'] = [
                ['name' => 'Take Home', 'y' => (float)$result['net_income_per'], 'color' => '#2845F5'],
                ['name' => 'Tax', 'y' => (float)$result['net_tax_per'], 'color' => '#FF5A5F']
            ];

            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->dispatch('chart-updated', data: $result['chartData']);

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
                    if (typeof renderGrossChart === 'function') {
                        renderGrossChart();
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.gross-income-calculator');
    }
}
