<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Timedate;

class TimeDurationCalculator extends Component
{
    public $inputs = [];
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->inputs = (array)$inputs;
        } else {
            $this->inputs = [
                'calculator_time' => 'date_cal',
                'start_date' => now()->format('Y-m-d'),
                'd_start_h' => 8,
                'd_start_m' => 30,
                'd_start_s' => 0,
                'd_start_ampm' => 'am',
                'end_date' => now()->format('Y-m-d'),
                'd_end_h' => 5,
                'd_end_m' => 30,
                'd_end_s' => 0,
                'd_end_ampm' => 'pm',
                't_start_h' => 8,
                't_start_m' => 30,
                't_start_s' => 0,
                't_start_ampm' => 'am',
                't_end_h' => 5,
                't_end_m' => 30,
                't_end_s' => 0,
                't_end_ampm' => 'pm',
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

        $this->inputs = [
            'calculator_time' => 'date_cal',
            'start_date' => now()->format('Y-m-d'),
            'd_start_h' => 8,
            'd_start_m' => 30,
            'd_start_s' => 0,
            'd_start_ampm' => 'am',
            'end_date' => now()->format('Y-m-d'),
            'd_end_h' => 5,
            'd_end_m' => 30,
            'd_end_s' => 0,
            'd_end_ampm' => 'pm',
            't_start_h' => 8,
            't_start_m' => 30,
            't_start_s' => 0,
            't_start_ampm' => 'am',
            't_end_h' => 5,
            't_end_m' => 30,
            't_end_s' => 0,
            't_end_ampm' => 'pm',
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
        $result = $model->time_duration($request);

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

    public function changeOperation($value)
    {
        $this->inputs['calculator_time'] = $value;
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
        
        return view('livewire.calculators.time-duration-calculator');
    }
}