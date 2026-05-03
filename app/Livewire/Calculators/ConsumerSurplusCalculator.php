<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class ConsumerSurplusCalculator extends Component
{
    public $operations1 = 1;
    public $operations2 = 1;
    public $first = 50;
    public $second = 50;
    public $third = 35;
    public $four = 20;
    public $five = 10;

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
            $this->operations1 = $inputs->operations1 ?? $this->operations1;
            $this->operations2 = $inputs->operations2 ?? $this->operations2;
            $this->first = $inputs->first ?? $this->first;
            $this->second = $inputs->second ?? $this->second;
            $this->third = $inputs->third ?? $this->third;
            $this->four = $inputs->four ?? $this->four;
            $this->five = $inputs->five ?? $this->five;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['operations1', 'operations2'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->operations1 = 1;
        $this->operations2 = 1;
        $this->first = 50;
        $this->second = 50;
        $this->third = 35;
        $this->four = 20;
        $this->five = 10;

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
            'operations1' => $this->operations1,
            'operations2' => $this->operations2,
            'first' => $this->first,
            'second' => $this->second,
            'third' => $this->third,
            'four' => $this->four,
            'five' => $this->five,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->consumer($request);

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
        return view('livewire.calculators.consumer-surplus-calculator');
    }
}
