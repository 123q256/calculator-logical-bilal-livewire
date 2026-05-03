<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class PayRaiseCalculator extends Component
{
    public $pay = 50;
    public $period = 1;
    public $hour = 40;
    public $type_selection = 1; // 'type' is reserved in some contexts, using type_selection
    public $new_raise = 40;

    public $error = null;
    public $detail = null;
    public $type = 'calculator'; // for widget/calculator mode
    public $lang = [];
    public $currancy = '$';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->pay = $inputs->pay ?? $this->pay;
            $this->period = $inputs->period ?? $this->period;
            $this->hour = $inputs->hour ?? $this->hour;
            $this->type_selection = $inputs->type ?? $this->type_selection;
            $this->new_raise = $inputs->new ?? $this->new_raise;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->pay = 50;
        $this->period = 1;
        $this->hour = 40;
        $this->type_selection = 1;
        $this->new_raise = 40;

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
            'pay' => $this->pay,
            'period' => $this->period,
            'hour' => $this->hour,
            'type' => $this->type_selection,
            'new' => $this->new_raise,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->pay($request);

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

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['period', 'type_selection'])) {
            $this->detail = null;
            $this->error = null;
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
        return view('livewire.calculators.pay-raise-calculator');
    }
}
