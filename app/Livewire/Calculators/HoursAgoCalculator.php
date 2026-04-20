<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Timedate;

class HoursAgoCalculator extends Component
{
    public $inputs = [];
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';

    protected $listeners = ['refreshTime' => 'updateTime'];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $this->inputs = (array)session('calculator_back_inputs');
        } else {
            $this->inputs = [
                'hours' => '',
                'minutes' => '',
                'seconds' => '',
                'hrs' => '',
                'min' => '',
                'outputFormat' => 'twhr',
                'timeType' => 'stat',
                'isLive' => true,
            ];
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $this->updateTime();
    }

    public function toggleLive()
    {
        $this->inputs['isLive'] = !($this->inputs['isLive'] ?? true);
        $this->inputs['timeType'] = ($this->inputs['isLive'] ?? true) ? 'stat' : 'dyna';
    }

    public function updateTime()
    {
        if (($this->inputs['timeType'] ?? 'stat') === 'stat' && ($this->inputs['isLive'] ?? true)) {
            $now = Carbon::now();
            $this->inputs['hours'] = str_pad($now->hour, 2, '0', STR_PAD_LEFT);
            $this->inputs['minutes'] = str_pad($now->minute, 2, '0', STR_PAD_LEFT);
            $this->inputs['seconds'] = str_pad($now->second, 2, '0', STR_PAD_LEFT);
        }
    }

    public function updatedInputsTimeType($value)
    {
        $this->inputs['isLive'] = ($value === 'stat');
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;

        $this->inputs = [
            'hours' => '',
            'minutes' => '',
            'seconds' => '',
            'hrs' => '',
            'min' => '',
            'outputFormat' => 'twhr',
            'timeType' => 'stat',
            'isLive' => true,
        ];

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        $this->updateTime();

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = $this->inputs;
        // Map inputs to what Timedate model expects
        $request = (object)[
            'hours' => $requestData['hours'] ?? null,
            'minuts' => $requestData['minutes'] ?? null,
            'sec' => $requestData['seconds'] ?? null,
            'hrs' => $requestData['hrs'] ?? null,
            'min' => $requestData['min'] ?? null,
            'outputFormat' => $requestData['outputFormat'] ?? 'twhr',
            'timeType' => $requestData['timeType'] ?? 'stat',
            'isLive' => $requestData['isLive'] ?? true,
        ];

        $model = new Timedate();
        $result = $model->time_ago($request);

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
        return view('livewire.calculators.hours-ago-calculator');
    }
}
