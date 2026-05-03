<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class RoasCalculator extends Component
{
    public $first = 90;
    public $operations1 = 1;
    public $second = 90;
    public $third = 90;

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
            $this->first = $inputs->first ?? $this->first;
            $this->operations1 = $inputs->operations1 ?? $this->operations1;
            $this->second = $inputs->second ?? $this->second;
            $this->third = $inputs->third ?? $this->third;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'operations1') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->first = 90;
        $this->operations1 = 1;
        $this->second = 90;
        $this->third = 90;

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
            'first' => $this->first,
            'operations1' => $this->operations1,
            'second' => $this->second,
            'third' => $this->third,
            'hidden_currency' => $this->currancy,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->roas($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            // Dispatch event for chart
            $this->dispatch('calculator-calculated', [
                'mode' => $this->operations1,
                'first' => $this->first,
                'second' => $this->second,
                'answer1' => $result['answer1']
            ]);

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
        return view('livewire.calculators.roas-calculator');
    }
}
