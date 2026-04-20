<?php

namespace App\Livewire\Calculators;

use Illuminate\Support\Carbon;
use Livewire\Component;

class DateDurationCalculator extends Component
{

    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $e_date;
    public $checkbox = false;
    public $s_date;
    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            // New values you're adding
            $this->s_date = $inputs->s_date ?? $this->s_date;
            $this->e_date = $inputs->e_date ?? $this->e_date;
            $this->checkbox = $inputs->checkbox ?? $this->checkbox;
        }
    }

    public function setNowDate()
    {
        $this->s_date = Carbon::now()->toDateString();
    }
    public function settwoNowDate()
    {
        $this->e_date = Carbon::now()->toDateString();
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->s_date = null;
        $this->e_date = null;
        $this->checkbox = false;

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget([
                'calculator_back_inputs',
                'calculator_result',
                'validation_error',
                'scroll_to_result'
            ]);
            return redirect()->to(url()->previous() ?? '/');
        }
    }


    public function calculate()
    {

        $request = (object)[
            's_date' => $this->s_date,
            'e_date' => $this->e_date,
            'checkbox' => $this->checkbox,
        ];
        $model = new \App\Models\Timedate();
        $result = $model->date_duration($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('calculator_back_inputs', $request);
                session()->flash('scroll_to_result', true);
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
                session()->flash('calculator_back_inputs', $request);
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
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.date-duration-calculator');
    }
}
