<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class TaxCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form properties
    public $tax_year = '2020';
    public $income = '10';
    public $f_state = 's';
    public $age = '20';
    public $k_con = '12';
    public $ira = '10';
    public $tax_with = '15';
    public $ded = 's';
    public $item = '';

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
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->tax_year = '2020';
        $this->income = '10';
        $this->f_state = 's';
        $this->age = '20';
        $this->k_con = '12';
        $this->ira = '10';
        $this->tax_with = '15';
        $this->ded = 's';
        $this->item = '';

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
            'tax_year' => $this->tax_year,
            'income'   => $this->income,
            'f_state'  => $this->f_state,
            'age'      => $this->age,
            'k_con'    => $this->k_con,
            'ira'      => $this->ira,
            'tax_with' => $this->tax_with,
            'ded'      => $this->ded,
            'item'     => $this->item,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->tax($request);

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
            $this->error = $result['error'] ?? 'Please fill all required fields correctly.';
            $this->detail = null;
        }
    }

    public function render()
    {
        if (session('scroll_to_result') || $this->detail) {
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
        return view('livewire.calculators.tax-calculator');
    }
}
