<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class OvulationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $date;
    public $days = '28';
    public $Luteal = '14';

    // Calendar navigation
    public $calendarMonth;
    public $calendarYear;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->date = date('Y-m-d');
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $this->calendarMonth = date('m');
        $this->calendarYear = date('Y');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->date = $inputs->date ?? date('Y-m-d');
            $this->days = $inputs->days ?? '28';
            $this->Luteal = $inputs->Luteal ?? '14';
        }

        if ($this->detail && isset($this->detail['lasttime'])) {
            $this->calendarMonth = date('m', $this->detail['lasttime']);
            $this->calendarYear = date('Y', $this->detail['lasttime']);
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['date', 'days', 'Luteal'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function prevMonth()
    {
        $date = \Carbon\Carbon::create($this->calendarYear, $this->calendarMonth, 1)->subMonth();
        $this->calendarMonth = $date->format('m');
        $this->calendarYear = $date->format('Y');
    }

    public function nextMonth()
    {
        $date = \Carbon\Carbon::create($this->calendarYear, $this->calendarMonth, 1)->addMonth();
        $this->calendarMonth = $date->format('m');
        $this->calendarYear = $date->format('Y');
    }

    public function getCalendarDaysProperty()
    {
        $startOfMonth = \Carbon\Carbon::create($this->calendarYear, $this->calendarMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        // Start from Monday of the first week
        $startOfGrid = $startOfMonth->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
        // End at Sunday of the last week
        $endOfGrid = $endOfMonth->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

        $days = [];
        $current = $startOfGrid->copy();

        $events = [];
        if ($this->detail) {
            for ($i = 3; $i <= 32; $i++) {
                if (isset($this->detail['event' . $i])) {
                    $events[$this->detail['event' . $i]] = true;
                }
            }
        }

        while ($current <= $endOfGrid) {
            $dateStr = $current->format('Y-m-d');
            $days[] = [
                'date' => $dateStr,
                'day' => $current->day,
                'isCurrentMonth' => $current->month == (int)$this->calendarMonth,
                'isToday' => $current->isToday(),
                'isEvent' => isset($events[$dateStr]),
                'info' => isset($events[$dateStr]) ? 'Fertile Period' : null
            ];
            $current->addDay();
        }

        return $days;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->date = date('Y-m-d');
        $this->days = '28';
        $this->Luteal = '14';
        $this->calendarMonth = date('m');
        $this->calendarYear = date('Y');

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'date' => $this->date,
            'days' => $this->days,
            'Luteal' => $this->Luteal,
        ];

        $model = new Health();
        $result = $model->ovulation($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->calendarMonth = date('m', $result['lasttime']);
            $this->calendarYear = date('Y', $result['lasttime']);
            
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.ovulation-calculator');
    }
}
