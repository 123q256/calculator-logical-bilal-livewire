<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Timedate;

class DaysUntilCalculator extends Component
{
    public $inputs = [];
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $device;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $this->inputs = (array)session('calculator_back_inputs');
        } else {
            $this->inputs = [
                'startEvent' => 'empty',
                'next' => now()->addMonth()->toDateString(),
                'current' => now()->toDateString(),
                'inc_all' => true,
                'inc_day' => false,
                'weekDay' => ['Mon', 'Tue'],
            ];
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function changeinc_all() {}

    public function changestartEvent()
    {
        $value = $this->inputs['startEvent'] ?? 'empty';
        $currentDate = now();
        $currentYear = $currentDate->year;

        switch ($value) {
            case 'Thanksgiving (Canada)':
                $eventDate = now()->setYear($currentYear)->setMonth(10)->setDay(14);
                break;
            case 'Halloween':
                $eventDate = now()->setYear($currentYear)->setMonth(10)->setDay(31);
                break;
            case 'Thanksgiving (US)':
                $eventDate = now()->setYear($currentYear)->setMonth(11)->setDay(28);
                break;
            case 'Christmas':
                $eventDate = now()->setYear($currentYear)->setMonth(12)->setDay(25);
                break;
            case "New Year's Eve":
                $eventDate = now()->setYear($currentYear + 1)->setMonth(1)->setDay(1);
                break;
            case 'Easter (Easter Sunday)':
                $eventDate = now()->setYear($currentYear + 1)->setMonth(4)->setDay(20);
                break;
            default:
                $eventDate = now()->setYear($currentYear + 1)->setMonth(1)->setDay(1);
                break;
        }

        if ($eventDate->lessThan($currentDate)) {
            $eventDate = $eventDate->addYear();
        }

        $this->inputs['next'] = $eventDate->toDateString();
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;

        $this->inputs = [
            'startEvent' => 'empty',
            'next' => now()->addMonth()->toDateString(),
            'current' => now()->toDateString(),
            'inc_all' => true,
            'inc_day' => false,
            'weekDay' => ['Mon', 'Tue'],
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
        $result = $model->days_until($request);

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
        return view('livewire.calculators.days-until-calculator');
    }
}
