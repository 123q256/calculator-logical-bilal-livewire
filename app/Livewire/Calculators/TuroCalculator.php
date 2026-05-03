<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class TuroCalculator extends Component
{
    public $calculation_type = 'first'; // 'first' is Profit, 'second' is Calculator (Income/Lease/Expenses)
    public $operations = 1;

    // Calculator inputs
    public $first = 12;
    public $second = 12;
    public $third = 12;
    public $four = 12;

    // Converter (Profit) inputs
    public $f_first = 1500;
    public $f_second = 1500;
    public $f_third = 1500;

    public $error = null;
    public $detail = null;
    public $type = 'calculator'; // Widget vs Calculator mode
    public $lang = [];
    public $currancy = '$';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calculation_type = $inputs->type ?? $this->calculation_type;
            $this->operations = $inputs->operations ?? $this->operations;
            $this->first = $inputs->first ?? $this->first;
            $this->second = $inputs->second ?? $this->second;
            $this->third = $inputs->third ?? $this->third;
            $this->four = $inputs->four ?? $this->four;
            $this->f_first = $inputs->f_first ?? $this->f_first;
            $this->f_second = $inputs->f_second ?? $this->f_second;
            $this->f_third = $inputs->f_third ?? $this->f_third;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['calculation_type', 'operations'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->calculation_type = 'first';
        $this->operations = 1;
        $this->first = 12;
        $this->second = 12;
        $this->third = 12;
        $this->four = 12;
        $this->f_first = 1500;
        $this->f_second = 1500;
        $this->f_third = 1500;

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
            'type' => $this->calculation_type,
            'operations' => $this->operations,
            'first' => $this->first,
            'second' => $this->second,
            'third' => $this->third,
            'four' => $this->four,
            'f_first' => $this->f_first,
            'f_second' => $this->f_second,
            'f_third' => $this->f_third,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->turo($request);

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
        return view('livewire.calculators.turo-calculator');
    }
}
