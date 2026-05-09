<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class AccuracyCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $method_unit = 'Standard method';
    public $true_postive = 100;
    public $false_negative = 20;
    public $false_positive = 10;
    public $true_negative = 40;
    public $prevalence = 10;
    public $sensitivity = 20;
    public $specificity = 10;
    public $observed_value = 40;
    public $accepted_value = 50;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->method_unit = $inputs->method_unit ?? 'Standard method';
            $this->true_postive = $inputs->true_postive ?? 100;
            $this->false_negative = $inputs->false_negative ?? 20;
            $this->false_positive = $inputs->false_positive ?? 10;
            $this->true_negative = $inputs->true_negative ?? 40;
            $this->prevalence = $inputs->prevalence ?? 10;
            $this->sensitivity = $inputs->sensitivity ?? 20;
            $this->specificity = $inputs->specificity ?? 10;
            $this->observed_value = $inputs->observed_value ?? 40;
            $this->accepted_value = $inputs->accepted_value ?? 50;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->method_unit = 'Standard method';
        $this->true_postive = 100;
        $this->false_negative = 20;
        $this->false_positive = 10;
        $this->true_negative = 40;
        $this->prevalence = 10;
        $this->sensitivity = 20;
        $this->specificity = 10;
        $this->observed_value = 40;
        $this->accepted_value = 50;

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'method_unit'    => $this->method_unit,
            'true_postive'   => $this->true_postive,
            'false_negative' => $this->false_negative,
            'false_positive' => $this->false_positive,
            'true_negative'  => $this->true_negative,
            'prevalence'     => $this->prevalence,
            'sensitivity'    => $this->sensitivity,
            'specificity'    => $this->specificity,
            'observed_value' => $this->observed_value,
            'accepted_value' => $this->accepted_value,
        ];

        $model = new Statistics();
        $result = $model->accuracy($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->dispatch('math-updated');
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
        return view('livewire.calculators.accuracy-calculator');
    }
}
