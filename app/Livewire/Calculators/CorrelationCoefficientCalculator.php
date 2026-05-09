<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class CorrelationCoefficientCalculator extends Component
{
    public $method = '1';
    public $x = '43, 21, 25, 42, 57, 59';
    public $y = '99, 65, 79, 75, 87, 81';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated()
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
            $this->method = $inputs->method ?? '1';
            $this->x = $inputs->x ?? '43, 21, 25, 42, 57, 59';
            $this->y = $inputs->y ?? '99, 65, 79, 75, 87, 81';
        }
    }

    public function resetForm()
    {
        $this->method = '1';
        $this->x = '43, 21, 25, 42, 57, 59';
        $this->y = '99, 65, 79, 75, 87, 81';
        
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
            'method' => $this->method,
            'x' => $this->x,
            'y' => $this->y,
        ];

        $model = new Statistics();
        $result = $model->correlation($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
            
            $scatterData = [];
            for ($i = 0; $i < $result['countx']; $i++) {
                $scatterData[] = [(float)$result['numbers'][$i], (float)$result['numbersy'][$i]];
            }
            $result['scatterData'] = json_encode($scatterData);
            
            $this->detail = $result;
            $this->dispatch('chart-updated', detail: $this->detail);
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.correlation-coefficient-calculator');
    }
}
