<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Timedate;

class ElapsedTimeCalculator extends Component
{

    public $inputs = [];
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';

    // Toggle states for fields (UI only)
    public $showElapsedStart = false;
    public $showElapsedStartOne = false;
    public $showElapsedStartSec = false;
    public $showElapsedStartThree = false;
    public $showElapsedEnd = false;
    public $showElapsedEndOne = false;
    public $showElapsedEndSec = false;
    public $showElapsedEndThree = false;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $this->inputs = (array)session('calculator_back_inputs');
        } else {
            $this->inputs = [
                'main_units' => 'elapsed',
                'clock_format' => '12',
                'clock_start_unit' => 'AM',
                'clock_end_unit' => 'AM',
                'clock_secs' => 8,
                'clock_mints' => 9,
                'clock_hur' => 10,
                'clock_second' => 6,
                'clock_minute' => 5,
                'clock_hour' => 9,
                'elapsed_end_unit' => 'hrs/mins/sec',
                'elapsed_end' => 11,
                'elapsed_end_one' => 11,
                'elapsed_end_sec' => 40,
                'elapsed_end_three' => 55,
                'elapsed_start_unit' => 'hrs/mins/sec',
                'elapsed_start' => 9,
                'elapsed_start_one' => 9,
                'elapsed_start_sec' => 30,
                'elapsed_start_three' => 50,
            ];
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $this->updateUIFields();
    }

    public function setMainUnits($unit)
    {
        $this->inputs['main_units'] = $unit;
    }

    public function setClockFormat($format)
    {
        $this->inputs['clock_format'] = $format;
        if ($format == '24') {
            $this->inputs['clock_start_unit'] = '';
        } elseif ($format == '12' && ($this->inputs['clock_start_unit'] ?? '') == '') {
            $this->inputs['clock_start_unit'] = 'AM';
        }
    }

    public function updatedInputs()
    {
        $this->updateUIFields();
    }

    public function changeelapsed_start_unit()
    {
        $this->updateUIFields();
    }

    public function changeelapsed_end_unit()
    {
        $this->updateUIFields();
    }

    private function updateUIFields()
    {
        // Start fields
        $this->showElapsedStart = false;
        $this->showElapsedStartOne = false;
        $this->showElapsedStartSec = false;
        $this->showElapsedStartThree = false;

        switch ($this->inputs['elapsed_start_unit'] ?? '') {
            case 'hrs/mins/sec':
                $this->showElapsedStartOne = true;
                $this->showElapsedStartSec = true;
                $this->showElapsedStartThree = true;
                break;
            case 'hrs/mins':
                $this->showElapsedStartOne = true;
                $this->showElapsedStartSec = true;
                break;
            case 'mins/sec':
                $this->showElapsedStartSec = true;
                $this->showElapsedStartThree = true;
                break;
            case 'hrs':
            case 'mins':
            case 'sec':
                $this->showElapsedStart = true;
                break;
        }

        // End fields
        $this->showElapsedEnd = false;
        $this->showElapsedEndOne = false;
        $this->showElapsedEndSec = false;
        $this->showElapsedEndThree = false;

        switch ($this->inputs['elapsed_end_unit'] ?? '') {
            case 'hrs/mins/sec':
                $this->showElapsedEndOne = true;
                $this->showElapsedEndSec = true;
                $this->showElapsedEndThree = true;
                break;
            case 'hrs/mins':
                $this->showElapsedEndOne = true;
                $this->showElapsedEndSec = true;
                break;
            case 'mins/sec':
                $this->showElapsedEndSec = true;
                $this->showElapsedEndThree = true;
                break;
            case 'hrs':
            case 'mins':
            case 'sec':
                $this->showElapsedEnd = true;
                break;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;

        $this->inputs = [
            'main_units' => 'elapsed',
            'clock_format' => '12',
            'clock_start_unit' => 'AM',
            'clock_end_unit' => 'AM',
            'clock_secs' => 8,
            'clock_mints' => 9,
            'clock_hur' => 10,
            'clock_second' => 6,
            'clock_minute' => 5,
            'clock_hour' => 9,
            'elapsed_end_unit' => 'hrs/mins/sec',
            'elapsed_end' => 11,
            'elapsed_end_one' => 11,
            'elapsed_end_sec' => 40,
            'elapsed_end_three' => 55,
            'elapsed_start_unit' => 'hrs/mins/sec',
            'elapsed_start' => 9,
            'elapsed_start_one' => 9,
            'elapsed_start_sec' => 30,
            'elapsed_start_three' => 50,
        ];

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        $this->updateUIFields();

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)$this->inputs;

        $model = new Timedate();
        $result = $model->elapsed($request);

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
        return view('livewire.calculators.elapsed-time-calculator');
    }
}
