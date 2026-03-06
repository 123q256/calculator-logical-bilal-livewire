<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Illuminate\Validation\ValidationException;

class AgeCalculator extends Component
{
    // Properties
    public $result = null;
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $calName;
    public $calLink;

    // Date of Birth fields — static defaults
    public $year = 1999;
    public $month = 1;
    public $day = 1;

    // End Date fields — dynamic, mount() mein set honge
    public $year_sec;
    public $month_sec;
    public $day_sec;

    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        $backInputs = session('calculator_back_inputs');

        if ($backInputs) {
            // Result ke baad — user ki selected values restore
            $this->year      = $backInputs->year;
            $this->month     = $backInputs->month;
            $this->day       = $backInputs->day;
            $this->year_sec  = $backInputs->year_sec;
            $this->month_sec = $backInputs->month_sec;
            $this->day_sec   = $backInputs->day_sec;
        } else {
            // Fresh page — end date current date pe set karo
            $this->year_sec  = (int) date('Y');
            $this->month_sec = (int) date('n');
            $this->day_sec   = (int) date('j');
            // DOB property declaration se already set hai: 1999, 1, 1
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();

        // Session clear karo
        session()->forget('calculator_result');
        session()->forget('calculator_back_inputs');
        session()->forget('validation_error');
        // DOB reset — defaults
        $this->year  = 1999;
        $this->month = 1;
        $this->day   = 1;
        // End date reset — current date
        $this->year_sec  = (int) date('Y');
        $this->month_sec = (int) date('n');
        $this->day_sec   = (int) date('j');
        // Result/error clear
        $this->error  = null;
        $this->detail = null;
        return redirect()->to(url()->previous() ?? '/');
    }

    public function calculate()
    {
        try {
            $this->validate([
                'year'       => 'required|integer|min:1940|max:' . date('Y'),
                'month'      => 'required|integer|min:1|max:12',
                'day'        => 'required|integer|min:1|max:31',
                'year_sec'   => 'required|integer|min:1940|max:' . date('Y'),
                'month_sec'  => 'required|integer|min:1|max:12',
                'day_sec'    => 'required|integer|min:1|max:31',
            ]);
        } catch (ValidationException $e) {
            $this->error = 'Please! Check your input.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $request = (object)[
            'year'      => $this->year,
            'month'     => $this->month,
            'day'       => $this->day,
            'year_sec'  => $this->year_sec,
            'month_sec' => $this->month_sec,
            'day_sec'   => $this->day_sec,
        ];

        $model = new \App\Models\EverydayLife();
        $result = $model->age($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            // flash ki jagah put() use karo taake next request ke baad bhi rahe
            session()->put('calculator_back_inputs', (object)$request);
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
                    el.scrollIntoView({ behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.age-calculator');
    }
}
