<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class SseCalculator extends Component
{
    public $x = '6, 7, 7, 8, 12, 14, 15, 16, 16, 19';
    public $y = '14, 15, 15, 17, 18, 18, 16, 14, 11, 8';

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
            $this->x = $inputs->x ?? '6, 7, 7, 8, 12, 14, 15, 16, 16, 19';
            $this->y = $inputs->y ?? '14, 15, 15, 17, 18, 18, 16, 14, 11, 8';
        }
    }

    public function resetForm()
    {
        $this->x = '6, 7, 7, 8, 12, 14, 15, 16, 16, 19';
        $this->y = '14, 15, 15, 17, 18, 18, 16, 14, 11, 8';
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
            'y' => $this->y,
        ];

        $model = new Statistics();
        $result = $model->sse($request);

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
        return view('livewire.calculators.sse-calculator');
    }
}
