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

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        return redirect()->to(url()->previous() ?? '/');
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
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            return redirect()->to(url()->previous() ?? '/'); // fallback if referer not available
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.date-duration-calculator');
    }
}
