<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class DiscountCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form properties
    public $type_select = '1'; // Calculation type (1-10)
    public $tax = 'yes';
    public $sale = '6';

    // Common inputs
    public $amount = '';
    public $off = '';
    public $pay = '';
    public $saving = '';

    // Multi-item / tiered inputs
    public $p1 = '400';
    public $p2 = '500';
    public $p3 = '500';
    public $p4 = '500';
    public $off2 = '400';
    public $off3 = '400';

    // Type 10 inputs
    public $nbr = '3000';
    public $up = '4000';
    public $fix = '4000';

    // Localized inputs
    public $form_a = 'first1'; // AR
    public $first1 = '10';     // AR
    public $sec = '20';        // AR
    public $thir = '30';       // AR
    public $id_rp = '3212';    // ID
    public $id_p = '21';       // ID
    public $typet = '1';       // TR
    public $tx = '21';         // TR
    public $ty = '21';         // TR

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        // Results only hide on major structural changes (type or mode)
        if (in_array($propertyName, ['type_select', 'typet', 'form_a'])) {
            $this->detail = null;
            $this->error = null;
        }

        // Handle the "disable if 2 filled" logic for amount, off, pay, saving
        if (in_array($propertyName, ['amount', 'off', 'pay', 'saving'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function isInputDisabled($inputName)
    {
        if ($this->type_select != '1' && $this->type_select != '4') {
            return false;
        }

        $fields = ['amount', 'off', 'pay', 'saving'];
        $filledCount = 0;
        foreach ($fields as $field) {
            if ($this->$field !== '' && $this->$field !== null) {
                $filledCount++;
            }
        }

        if ($filledCount >= 2 && ($this->$inputName === '' || $this->$inputName === null)) {
            return true;
        }

        return false;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->type_select = '1';
        $this->tax = 'yes';
        $this->sale = '6';
        $this->amount = '';
        $this->off = '';
        $this->pay = '';
        $this->saving = '';
        $this->p1 = '400';
        $this->p2 = '500';
        $this->p3 = '500';
        $this->p4 = '500';
        $this->off2 = '400';
        $this->off3 = '400';
        $this->nbr = '3000';
        $this->up = '4000';
        $this->fix = '4000';

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
            'type'   => $this->type_select,
            'tax'    => $this->tax,
            'sale'   => $this->sale,
            'amount' => $this->amount,
            'off'    => $this->off,
            'pay'    => $this->pay,
            'saving' => $this->saving,
            'p1'     => $this->p1,
            'p2'     => $this->p2,
            'p3'     => $this->p3,
            'p4'     => $this->p4,
            'off2'   => $this->off2,
            'off3'   => $this->off3,
            'nbr'    => $this->nbr,
            'up'     => $this->up,
            'fix'    => $this->fix,
            'form_a' => $this->form_a,
            'first1' => $this->first1,
            'sec'    => $this->sec,
            'thir'   => $this->thir,
            'id_rp'  => $this->id_rp,
            'id_p'   => $this->id_p,
            'typet'  => $this->typet,
            'tx'     => $this->tx,
            'ty'     => $this->ty,
            'unit_type' => 'advance', // Used by the model's chart logic check
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->discount($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $requestData);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Please fill the fields correctly.';
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.discount-calculator');
    }
}
