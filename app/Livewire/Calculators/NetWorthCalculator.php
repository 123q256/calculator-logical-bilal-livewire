<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class NetWorthCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $as_real = 20;
    public $as_check = 20;
    public $as_saving = 20;
    public $as_retire = 20;
    public $as_car = 20;
    public $as_other = 20;

    public $li_real = 10;
    public $li_card = 10;
    public $li_loan = 20;
    public $li_stload = 20;
    public $li_car = 20;
    public $li_other = 20;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->as_real = $inputs->as_real ?? 20;
            $this->as_check = $inputs->as_check ?? 20;
            $this->as_saving = $inputs->as_saving ?? 20;
            $this->as_retire = $inputs->as_retire ?? 20;
            $this->as_car = $inputs->as_car ?? 20;
            $this->as_other = $inputs->as_other ?? 20;

            $this->li_real = $inputs->li_real ?? 10;
            $this->li_card = $inputs->li_card ?? 10;
            $this->li_loan = $inputs->li_loan ?? 20;
            $this->li_stload = $inputs->li_stload ?? 20;
            $this->li_car = $inputs->li_car ?? 20;
            $this->li_other = $inputs->li_other ?? 20;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->as_real = 20;
        $this->as_check = 20;
        $this->as_saving = 20;
        $this->as_retire = 20;
        $this->as_car = 20;
        $this->as_other = 20;

        $this->li_real = 10;
        $this->li_card = 10;
        $this->li_loan = 20;
        $this->li_stload = 20;
        $this->li_car = 20;
        $this->li_other = 20;

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
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'as_real' => $this->as_real,
            'as_check' => $this->as_check,
            'as_saving' => $this->as_saving,
            'as_retire' => $this->as_retire,
            'as_car' => $this->as_car,
            'as_other' => $this->as_other,
            'li_real' => $this->li_real,
            'li_card' => $this->li_card,
            'li_loan' => $this->li_loan,
            'li_stload' => $this->li_stload,
            'li_car' => $this->li_car,
            'li_other' => $this->li_other,
            'submit' => true,
        ];

        $model = new Finance();
        $result = $model->net($request);

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

        return view('livewire.calculators.net-worth-calculator');
    }
}
