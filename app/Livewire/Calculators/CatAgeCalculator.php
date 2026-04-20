<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class CatAgeCalculator extends Component
{

    public $e_date;
    public $error;
    public $type = 'calculator';
    public $lang = [];
    public $detail = null;
    public $method = '1';
    public $year = '4';
    public $month = '4';

    public $calName;
    public $calLink;
    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            // New values you're adding
            $this->method = $inputs->method ?? $this->method;
            $this->year = $inputs->year ?? $this->year;
            $this->month = $inputs->month ?? $this->month;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag(); // Clears validation errors

        $this->method = 1;
        $this->year = 4;
        $this->month = 4;
        $this->detail = null;
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'validation_error', 'scroll_to_result', 'calculator_back_inputs']);
            return redirect()->to(url()->previous() ?? '/');
        }
    }
    public function changeMethod()
    {
        $this->detail = null;
        //dd($this->method); // Will show '1' or '2'
    }


    public function calculate()
    {

        $request = (object)[
            'method' => $this->method,
            'year' => $this->year,
            'month' => $this->month,
        ];
        $model = new \App\Models\Pets();
        $result = $model->cat_age($request); // use the correct method here

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }




    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
        const el = document.getElementById('result-section');
        if (el) {
            const offset = 30;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
    JS);
        }
        return view('livewire.calculators.cat-age-calculator');
    }
}
