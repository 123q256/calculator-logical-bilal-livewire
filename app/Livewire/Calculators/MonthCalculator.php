<?php

namespace App\Livewire\Calculators;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Timedate;
use Illuminate\Validation\ValidationException;

class MonthCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $start_date;
    public $end_date;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

            $this->start_date = $inputs->start_date ?? Carbon::now()->format('Y-m-d');
            $this->end_date = $inputs->end_date ?? Carbon::now()->addYear()->addMonth()->format('Y-m-d');
        } else {
            $this->start_date = Carbon::now()->format('Y-m-d');
            $this->end_date = Carbon::now()->addYear()->addMonth()->format('Y-m-d');
        }
    }


    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->start_date = Carbon::now()->format('Y-m-d');
        $this->end_date = Carbon::now()->addYear()->addMonth()->format('Y-m-d');

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
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
        ];

        try {
            $this->validate([
                'start_date' => 'required',
                'end_date'   => 'required',
            ]);
        } catch (ValidationException $e) {
            $this->error = 'Please! Check your input.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            }
            return;
        }

        $model = new Timedate();
        $result = $model->month($request);
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
        return view('livewire.calculators.month-calculator');
    }
}
