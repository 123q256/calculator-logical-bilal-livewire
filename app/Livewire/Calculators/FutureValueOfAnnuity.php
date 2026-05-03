<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class FutureValueOfAnnuity extends Component
{
    public $payment = 12;
    public $interest = 2;
    public $term = 12;
    public $term_unit = 'mons';
    public $compounding = 1;
    public $payment_fre = 1;
    public $annuity_type = 1;
    public $g = 0;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->payment = $inputs->payment ?? $this->payment;
            $this->interest = $inputs->interest ?? $this->interest;
            $this->term = $inputs->term ?? $this->term;
            $this->term_unit = $inputs->term_unit ?? $this->term_unit;
            $this->compounding = $inputs->compounding ?? $this->compounding;
            $this->payment_fre = $inputs->payment_fre ?? $this->payment_fre;
            $this->annuity_type = $inputs->annuity_type ?? $this->annuity_type;
            $this->g = $inputs->g ?? $this->g;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        $dropdowns = [
            'term_unit', 'compounding', 'payment_fre', 'annuity_type'
        ];

        if (in_array($propertyName, $dropdowns)) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->payment = 12;
        $this->interest = 2;
        $this->term = 12;
        $this->term_unit = 'mons';
        $this->compounding = 1;
        $this->payment_fre = 1;
        $this->annuity_type = 1;
        $this->g = 0;

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
            'payment' => $this->payment,
            'interest' => $this->interest,
            'term' => $this->term,
            'term_unit' => $this->term_unit,
            'compounding' => $this->compounding,
            'payment_fre' => $this->payment_fre,
            'annuity_type' => ($this->annuity_type == 2) ? 'yrs' : 'mons', // Map 1 to mons, 2 to yrs
            'g' => $this->g,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->future($request);

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
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.future-value-of-annuity');
    }
}
