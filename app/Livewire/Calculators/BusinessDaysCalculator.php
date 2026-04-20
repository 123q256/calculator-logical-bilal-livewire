<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Timedate;
use Illuminate\Validation\ValidationException;

class BusinessDaysCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $mode = 'simple';
    public $s_date;
    public $e_date;
    public $end_inc = false;
    public $sat_inc = false;
    public $holiday_c = 'no'; // default value

    public $nyd = true;
    public $mlkd = true;
    public $psd = true;
    public $memd = false;
    public $ind = true;
    public $labd = false;
    public $cold = true;

    public $vetd = true;
    public $thankd = true;
    public $blkf = false;
    public $cheve = true;
    public $chirs = false;
    public $nye = true;

    public $ex_in = 1;     // default
    public $satting = 2;   // default
    public $showSelectDays = false;

    public $sun = false;
    public $mon = false;
    public $tue = false;
    public $wed = false;
    public $thu = false;
    public $fri = false;
    public $sat = false;
    public $holidays = [];
    public $totalHolidays = 0;
    public $totalHolidays_two = 0;
    public $add_date;
    public $method = '+';
    public $cal_bus = false;

    public $weekend_c = '';

    public $holidays_two = [];
    public $total_j = 0;
    public $years;
    public $months;
    public $weeks;
    public $days;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->restoreInputs($inputs);
        } else {
            $this->s_date = date('Y-m-d');
            $this->e_date = date('Y-m-d');
            $this->add_date = date('Y-m-d');
            
            if (empty($this->holidays)) {
                $this->addHoliday();
            }
            if (empty($this->holidays_two)) {
                $this->holidays_two = [['name' => '', 'month' => '', 'day' => '']];
            }
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    private function restoreInputs($inputs)
    {
        $this->mode = $inputs->sim_adv ?? $this->mode;
        $this->s_date = $inputs->s_date ?? $this->s_date;
        $this->e_date = $inputs->e_date ?? $this->e_date;
        $this->end_inc = $inputs->end_inc ?? $this->end_inc;
        $this->sat_inc = $inputs->sat_inc ?? $this->sat_inc;
        $this->holiday_c = $inputs->holiday_c ?? $this->holiday_c;

        $fields = ['nyd', 'mlkd', 'psd', 'memd', 'ind', 'labd', 'cold', 'vetd', 'thankd', 'blkf', 'cheve', 'chirs', 'nye', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'satting', 'ex_in', 'showSelectDays', 'add_date', 'method', 'cal_bus', 'weekend_c', 'years', 'months', 'weeks', 'days'];
        foreach ($fields as $field) {
            if (isset($inputs->$field)) {
                $this->$field = $inputs->$field;
            }
        }

        if (!empty($inputs->holidays)) {
            $this->holidays = $inputs->holidays;
            $this->totalHolidays = count($this->holidays);
        }
        if (!empty($inputs->holidays_two)) {
            $this->holidays_two = $inputs->holidays_two;
            $this->totalHolidays_two = count($this->holidays_two);
        }
    }

    public function addHoliday_two()
    {
        $this->holidays_two[] = ['name' => '', 'month' => '', 'day' => ''];
        $this->totalHolidays_two = count($this->holidays_two);
    }

    public function removeHoliday_two($index)
    {
        unset($this->holidays_two[$index]);
        $this->holidays_two = array_values($this->holidays_two); 
        $this->totalHolidays_two = count($this->holidays_two);
    }

    public function changeweekendC($value)
    {
        $this->weekend_c = $value;
    }

    public function addHoliday()
    {
        $this->holidays[] = ['name' => '', 'month' => '', 'day' => ''];
        $this->totalHolidays = count($this->holidays);
    }

    public function removeHoliday($index)
    {
        unset($this->holidays[$index]);
        $this->holidays = array_values($this->holidays); 
        $this->totalHolidays = count($this->holidays);
    }

    public function changeOperation($mode)
    {
        $this->mode = $mode;
    }

    public function changeHolidayC($value)
    {
        $this->holiday_c = $value;
    }

    public function changesatting()
    {
        $this->showSelectDays = ($this->satting == 6);
    }

    public function calculate()
    {
        try {
            if ($this->mode !== 'simple') {
                $this->validate(['add_date' => 'required']);
            } else {
                $this->validate(['s_date' => 'required']);
            }
        } catch (ValidationException $e) {
            $this->error = 'Please! Check your input.';
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
            return;
        }

        $request = (object)[
            'sim_adv' => $this->mode,
            's_date' => $this->s_date,
            'e_date' => $this->e_date,
            'end_inc' => $this->end_inc,
            'sat_inc' => $this->sat_inc,
            'holiday_c' => $this->holiday_c,
            'nyd' => $this->nyd,
            'mlkd' => $this->mlkd,
            'psd' => $this->psd,
            'memd' => $this->memd,
            'ind' => $this->ind,
            'labd' => $this->labd,
            'cold' => $this->cold,
            'vetd' => $this->vetd,
            'thankd' => $this->thankd,
            'blkf' => $this->blkf,
            'cheve' => $this->cheve,
            'chirs' => $this->chirs,
            'nye' => $this->nye,
            'sun' => $this->sun,
            'mon' => $this->mon,
            'tue' => $this->tue,
            'wed' => $this->wed,
            'thu' => $this->thu,
            'fri' => $this->fri,
            'sat' => $this->sat,
            'satting' => $this->satting,
            'ex_in' => $this->ex_in,
            'showSelectDays' => $this->showSelectDays,
            'holidays' => $this->holidays,
            'totalHolidays' => $this->totalHolidays,
            'total_i' => $this->totalHolidays,
            'add_date' => $this->add_date,
            'method' => $this->method,
            'cal_bus' => $this->cal_bus,
            'weekend_c' => $this->weekend_c,
            'total_j' => $this->totalHolidays_two,
            'years' => $this->years,
            'months' => $this->months,
            'weeks' => $this->weeks,
            'days' => $this->days,
            'holidays_two' => $this->holidays_two,
            'totalHolidays_two' => $this->totalHolidays_two,
        ];

        foreach ($this->holidays as $index => $holiday) {
            $request->{"n{$index}"} = $holiday['name'] ?? '';
            $request->{"m{$index}"} = $holiday['month'] ?? '';
            $request->{"d{$index}"} = $holiday['day'] ?? '';
        }

        $model = new Timedate();
        $result = $model->business($request);

        if ($result && isset($result['RESULT']) && $result['RESULT'] == 1) {
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

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->mode = 'simple';
        $this->s_date = date('Y-m-d');
        $this->e_date = date('Y-m-d');
        $this->end_inc = false;
        $this->sat_inc = false;
        $this->holiday_c = 'no';
        $this->nyd = true; $this->mlkd = true; $this->psd = true; $this->memd = false; 
        $this->ind = true; $this->labd = false; $this->cold = true; $this->vetd = true; 
        $this->thankd = true; $this->blkf = false; $this->cheve = true; $this->chirs = false; $this->nye = true;
        $this->ex_in = 1; $this->satting = 2; $this->showSelectDays = false;
        $this->sun = false; $this->mon = false; $this->tue = false; $this->wed = false; 
        $this->thu = false; $this->fri = false; $this->sat = false;
        $this->holidays = [['name' => '', 'month' => '', 'day' => '']];
        $this->totalHolidays = 1;
        $this->add_date = date('Y-m-d');
        $this->method = '+';
        $this->cal_bus = false;
        $this->weekend_c = '';
        $this->holidays_two = [['name' => '', 'month' => '', 'day' => '']];
        $this->totalHolidays_two = 1;
        $this->years = null; $this->months = null; $this->weeks = null; $this->days = null;

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
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
        return view('livewire.calculators.business-days-calculator');
    }
}
