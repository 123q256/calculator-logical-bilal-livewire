<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class MonthlyIncomeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currency = '$';

    public $pay = '1';
    public $first = 50;
    public $second = 40;
    public $txt1 = '';
    public $txt2 = '';
    public $showSecond = true;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $this->updateLabels();

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->pay = $inputs->pay ?? '1';
            $this->first = $inputs->first ?? 50;
            $this->second = $inputs->second ?? 40;
            $this->updateLabels();
        }
    }

    public function updatedPay()
    {
        $this->updateLabels();
        $this->detail = null;
        $this->error = null;
    }

    public function updateLabels()
    {
        if ($this->pay == '1') {
            $this->txt1 = $this->lang[9] ?? 'Hourly Wage';
            $this->txt2 = $this->lang[10] ?? 'Hours per week';
            $this->second = 40;
            $this->showSecond = true;
        } elseif ($this->pay == '2') {
            $this->txt1 = $this->lang[19] ?? 'Daily Wage';
            $this->txt2 = $this->lang[20] ?? 'Days per week';
            $this->second = 5;
            $this->showSecond = true;
        } elseif ($this->pay == '3') {
            $this->txt1 = $this->lang[21] ?? 'Weekly Salary';
            $this->showSecond = false;
        } elseif ($this->pay == '4') {
            $this->txt1 = $this->lang[22] ?? 'Bi-weekly Salary';
            $this->showSecond = false;
        } elseif ($this->pay == '5') {
            $this->txt1 = $this->lang[23] ?? 'Semi-monthly Salary';
            $this->showSecond = false;
        } elseif ($this->pay == '6') {
            $this->txt1 = $this->lang[24] ?? 'Quarterly Salary';
            $this->showSecond = false;
        } else {
            $this->txt1 = $this->lang[25] ?? 'Annual Salary';
            $this->showSecond = false;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->pay = '1';
        $this->first = 50;
        $this->second = 40;
        $this->updateLabels();

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

    public function updated($propertyName)
    {
        if ($propertyName !== 'pay') {
            $this->detail = null;
            $this->error = null;
            session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
        }
    }

    public function calculate()
    {
        $request = (object)[
            'pay' => $this->pay,
            'first' => (float)$this->first,
            'second' => (float)$this->second,
        ];

        $model = new Finance();
        $result = $model->monthly($request);

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

        return view('livewire.calculators.monthly-income-calculator');
    }
}
