<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class ChebyshevsTheoremCalculator extends Component
{
    public $operations = '3';
    public $first = '3';
    public $second = '3';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->operations = $inputs->operations ?? '3';
            $this->first = $inputs->first ?? '3';
            $this->second = $inputs->second ?? '3';
        }
    }

    public function resetForm()
    {
        $this->operations = '3';
        $this->first = '3';
        $this->second = '3';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'operations' => $this->operations,
            'first' => $this->first,
            'second' => $this->second,
        ];

        $model = new Statistics();
        $result = $model->chebyshevs($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.chebyshevs-theorem-calculator');
    }
}
