<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class CriticalValueCalculator extends Component
{
    public $calculator_name = 't_val';
    public $first = '0.3';
    public $second = '7';
    public $third = '45';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    protected $listeners = ['math-updated' => '$refresh'];

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
        $this->dispatch('math-updated');
    }

    public function setCalculator($name)
    {
        $this->calculator_name = $name;
        $this->error = null;
        $this->detail = null;
        $this->dispatch('math-updated');
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calculator_name = $inputs->calculator_name ?? 't_val';
            $this->first = $inputs->first ?? '0.3';
            $this->second = $inputs->second ?? '7';
            $this->third = $inputs->third ?? '45';
        }
    }

    public function resetForm()
    {
        $this->calculator_name = 't_val';
        $this->first = '0.3';
        $this->second = '7';
        $this->third = '45';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        $this->dispatch('math-updated');

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'calculator_name' => $this->calculator_name,
            'first'           => $this->first,
            'second'          => $this->second,
            'third'           => $this->third,
        ];

        $model = new Statistics();
        $result = $model->critical($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->dispatch('math-updated');
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        if ($this->detail) {
            $this->js('setTimeout(() => { window.calculateJStat('.json_encode($this->detail).'); }, 100);');
        }

        return view('livewire.calculators.critical-value-calculator');
    }
}
