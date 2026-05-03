<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class TimeAndAHalf extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $normal_pay = 15;
    public $normal_time = 0;
    public $over_time = 50;
    public $multiplier = 1.5;
    public $pay_period = 52;
    public $currency = '$';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->normal_pay = $inputs->normal_pay ?? 15;
            $this->normal_time = $inputs->normal_time ?? 0;
            $this->over_time = $inputs->over_time ?? 50;
            $this->multiplier = $inputs->multiplier ?? 1.5;
            $this->pay_period = $inputs->pay_period ?? 52;
            $this->currency = $inputs->currency ?? '$';
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['multiplier', 'pay_period', 'currency'])) {
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

        $this->normal_pay = 15;
        $this->normal_time = 0;
        $this->over_time = 50;
        $this->multiplier = 1.5;
        $this->pay_period = 52;
        $this->currency = '$';

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
            'normal_pay' => (float)$this->normal_pay,
            'normal_time' => (float)$this->normal_time,
            'over_time' => (float)$this->over_time,
            'multiplier' => (float)$this->multiplier,
            'pay_period' => (float)$this->pay_period,
            'currency' => $this->currency,
        ];

        $model = new Finance();
        $result = $model->time_and_half($request);

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
        return view('livewire.calculators.time-and-a-half');
    }
}
