<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class FractionToPercentCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $n1 = '3';
    public $n2 = '2';
    public $d1 = '5';
    public $round = '8';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['n1'])) $this->n1 = $inputs['n1'];
            if (isset($inputs['n2'])) $this->n2 = $inputs['n2'];
            if (isset($inputs['d1'])) $this->d1 = $inputs['d1'];
            if (isset($inputs['round'])) $this->round = $inputs['round'];
        }
    }

    public function resetForm()
    {
        $this->n1 = '3';
        $this->n2 = '2';
        $this->d1 = '5';
        $this->round = '8';
        $this->error = null;
        $this->detail = null;

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
        if (!is_numeric($this->d1) || $this->d1 == 0) {
            $this->error = "Denominator cannot be zero.";
            $this->detail = null;
            return;
        }

        $request = (object)[
            'n1' => $this->n1,
            'n2' => $this->n2,
            'd1' => $this->d1,
            'round' => $this->round,
        ];

        $model = new Math();
        $result = $model->frac_to_dec($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof window.MJrerender === 'function') window.MJrerender();
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
    
        return view('livewire.calculators.fraction-to-percent-calculator');
    }
}
