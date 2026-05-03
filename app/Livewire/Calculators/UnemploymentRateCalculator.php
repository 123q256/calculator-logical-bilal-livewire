<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class UnemploymentRateCalculator extends Component
{
    public $find = 1;
    public $employed_people = 40;
    public $unemployed_people = 40;
    public $labor_force = 1.44;
    public $unemployment_rate = 50;
    public $adult_population = null;

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
            $this->find = $inputs->find ?? $this->find;
            $this->employed_people = $inputs->employed_people ?? $this->employed_people;
            $this->unemployed_people = $inputs->unemployed_people ?? $this->unemployed_people;
            $this->labor_force = $inputs->labor_force ?? $this->labor_force;
            $this->unemployment_rate = $inputs->unemployment_rate ?? $this->unemployment_rate;
            $this->adult_population = $inputs->adult_population ?? $this->adult_population;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'find') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->find = 1;
        $this->employed_people = 40;
        $this->unemployed_people = 40;
        $this->labor_force = 1.44;
        $this->unemployment_rate = 50;
        $this->adult_population = null;

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
            'calculate' => $this->find,
            'employed_people' => $this->employed_people,
            'unemployed_people' => $this->unemployed_people,
            'labor_force' => $this->labor_force,
            'unemployment_rate' => $this->unemployment_rate,
            'adult_population' => $this->adult_population,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->unemployment($request);

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
        return view('livewire.calculators.unemployment-rate-calculator');
    }
}
