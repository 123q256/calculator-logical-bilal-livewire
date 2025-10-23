<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Timedate;

class TimeCalculator extends Component
{
    public $operations = 'time_first';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $language = 'en';
    public $lang = [];
    public $cal_name = 'Time Difference';

    // Operation 1 - Time duration values
    public $t_days = 9, $t_hours = 5, $t_min = 9, $t_sec = 9;
    public $t_method = 'plus';

    // Estimated time values
    public $te_days = 9, $te_hours = 5, $te_min = 9, $te_sec = 9;

    // Operation 2 - Add/Subtract to date
    public $td_date;
    public $ts_hours = 5, $ts_min = 9, $ts_sec = 9, $am_pm = 'pm';
    public $td_method = 'plus';
    public $td_days = 1, $td_hours = 2, $td_min = 45, $td_sec = 0;

    // Operation 3 - Expression input
    public $input = '2d 3h 15m 30s + 5h 20s - 1200s + 12h';

       public function changeOperation($op)
    {
        $this->operations = $op;
    }
    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->td_date = now()->toDateString();
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        // Restore old inputs if any
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

            $this->t_days = $inputs->t_days ?? $this->t_days;
            $this->t_hours = $inputs->t_hours ?? $this->t_hours;
            $this->t_min = $inputs->t_min ?? $this->t_min;
            $this->t_sec = $inputs->t_sec ?? $this->t_sec;
            $this->t_method = $inputs->t_method ?? $this->t_method;

            $this->te_days = $inputs->te_days ?? $this->te_days;
            $this->te_hours = $inputs->te_hours ?? $this->te_hours;
            $this->te_min = $inputs->te_min ?? $this->te_min;
            $this->te_sec = $inputs->te_sec ?? $this->te_sec;

            $this->td_date = $inputs->td_date ?? $this->td_date;
            $this->ts_hours = $inputs->ts_hours ?? $this->ts_hours;
            $this->ts_min = $inputs->ts_min ?? $this->ts_min;
            $this->ts_sec = $inputs->ts_sec ?? $this->ts_sec;
            $this->am_pm = $inputs->am_pm ?? $this->am_pm;
            $this->td_method = $inputs->td_method ?? $this->td_method;
            $this->td_days = $inputs->td_days ?? $this->td_days;
            $this->td_hours = $inputs->td_hours ?? $this->td_hours;
            $this->td_min = $inputs->td_min ?? $this->td_min;
            $this->td_sec = $inputs->td_sec ?? $this->td_sec;

            $this->input = $inputs->input ?? $this->input;
            $this->operations = $inputs->sim_adv ?? $this->operations;
        }
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
            't_days' => $this->t_days,
            't_hours' => $this->t_hours,
            't_min' => $this->t_min,
            't_sec' => $this->t_sec,
            't_method' => $this->t_method,

            'te_days' => $this->te_days,
            'te_hours' => $this->te_hours,
            'te_min' => $this->te_min,
            'te_sec' => $this->te_sec,

            'td_date' => $this->td_date,
            'ts_hours' => $this->ts_hours,
            'ts_min' => $this->ts_min,
            'ts_sec' => $this->ts_sec,
            'am_pm' => $this->am_pm,
            'td_method' => $this->td_method,
            'td_days' => $this->td_days,
            'td_hours' => $this->td_hours,
            'td_min' => $this->td_min,
            'td_sec' => $this->td_sec,

            'input' => $this->input,
            'language' => $this->language,
            'sim_adv' => $this->operations,
        ];


        $model = new Timedate();
        $result = $model->time($request);
        // dd($result);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

           return redirect()->to(url()->previous() ?? '/');
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
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.time-calculator');
    }
}
