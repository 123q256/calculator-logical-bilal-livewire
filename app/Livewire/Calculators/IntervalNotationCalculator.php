<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class IntervalNotationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $i = '(2,8]';
    public $x = 'select';

    // Processed Data
    public $filteredSet = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->i = $inputs['i'] ?? '(2,8]';
            $this->x = $inputs['x'] ?? 'select';
        }

        if ($this->detail) {
            $this->processSet();
        }
    }

    public function resetForm()
    {
        $this->i = '(2,8]';
        $this->x = 'select';
        $this->error = null;
        $this->detail = null;
        $this->filteredSet = [];

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'i' => $this->i,
            'x' => $this->x,
        ];

        $model = new Math();
        $result = $model->interval($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;
            $this->detail = $result;
            $this->processSet();

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->dispatch('math-updated');
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
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    private function processSet()
    {
        if (!isset($this->detail['set'])) return;

        $set = $this->detail['set'];
        $filtered = [];

        if ($this->x === 'even') {
            $filtered = array_filter($set, fn($v) => $v % 2 === 0);
        } elseif ($this->x === 'odd') {
            $filtered = array_filter($set, fn($v) => $v % 2 !== 0);
        } elseif ($this->x === 'prime') {
            foreach ($set as $v) {
                if ($this->isPrime($v)) $filtered[] = $v;
            }
        } else {
            $filtered = $set;
        }

        $this->filteredSet = array_values($filtered);
    }

    private function isPrime($number)
    {
        $number = (int)$number;
        if ($number <= 1) return false;
        if ($number === 2) return true;
        if ($number % 2 === 0) return false;
        
        $ceil = sqrt($number);
        for ($i = 3; $i <= $ceil; $i += 2) {
            if ($number % $i === 0) return false;
        }
        return true;
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
        return view('livewire.calculators.interval-notation-calculator');
    }
}
