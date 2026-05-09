<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class PercentileRankCalculator extends Component
{
    public $x = '12, 23, 45, 33, 65, 54, 54';
    public $find = '13';
    public $method = '1';

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
            $this->x = $inputs->x ?? '12, 23, 45, 33, 65, 54, 54';
            $this->find = $inputs->find ?? '13';
            $this->method = $inputs->method ?? '1';
        }
    }

    public function resetForm()
    {
        $this->x = '12, 23, 45, 33, 65, 54, 54';
        $this->find = '13';
        $this->method = '1';
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
            'x' => $this->x,
            'find' => $this->find,
            'method' => $this->method,
        ];

        $model = new Statistics();
        $result = $model->per_rank($request);

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
        return view('livewire.calculators.percentile-rank-calculator');
    }
}
