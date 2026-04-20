<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Timedate;

class DaysLeftInTheYear extends Component
{
    public $inputs = [];
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $currentYear;
    public $daysLeft = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currentYear = now()->year;

        if (session()->has('calculator_back_inputs')) {
            $this->inputs = (array)session('calculator_back_inputs');
        } else {
            $today = Carbon::today();
            $this->inputs = [
                'month' => $today->month,
                'day' => $today->day,
                'year' => $today->year,
            ];
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;

        $today = Carbon::today();
        $this->inputs = [
            'month' => $today->month,
            'day' => $today->day,
            'year' => $today->year,
        ];

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)$this->inputs;

        $model = new Timedate();
        $result = $model->days_left($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $this->inputs);
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
                session()->flash('calculator_back_inputs', $this->inputs);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.days-left-in-the-year');
    }
}
