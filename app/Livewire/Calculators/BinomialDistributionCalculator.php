<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class BinomialDistributionCalculator extends Component
{
    public $n = '20';
    public $p = '0.13';
    public $x = '4';
    public $con = '1';

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
            $this->n = $inputs->n ?? '20';
            $this->p = $inputs->p ?? '0.13';
            $this->x = $inputs->x ?? '4';
            $this->con = $inputs->con ?? '1';
        }
    }

    public function resetForm()
    {
        $this->n = '20';
        $this->p = '0.13';
        $this->x = '4';
        $this->con = '1';
        
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
            'n' => $this->n,
            'p' => $this->p,
            'x' => $this->x,
            'con' => $this->con,
        ];

        $model = new Statistics();
        $result = $model->binomial($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
            
            $this->detail = $result;
            $this->dispatch('chart-updated', detail: $this->detail, x: $this->x, n: $this->n, p: $this->p);
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
        return view('livewire.calculators.binomial-distribution-calculator');
    }
}
