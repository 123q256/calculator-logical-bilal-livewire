<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class SyntheticDivisionCalculator extends Component
{
    public $dividend = '7x^3 + 4x + 8';
    public $divisor = 'x + 2';
    public $device = 'desktop';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $agent = request()->header('User-Agent', '');
        $this->device = (preg_match('/Mobile|Android|iPhone|iPad/i', $agent)) ? 'mobile' : 'desktop';

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->dividend = $inputs['dividend'] ?? $this->dividend;
            $this->divisor = $inputs['divisor'] ?? $this->divisor;
        }
    }

    public function resetForm()
    {
        $this->dividend = '7x^3 + 4x + 8';
        $this->divisor = 'x + 2';
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
        if (empty($this->dividend) || empty($this->divisor)) {
            $this->error = 'Please enter a valid dividend and divisor.';
            $this->detail = null;
            return;
        }

        $inputs = [
            'dividend' => $this->dividend,
            'divisor' => $this->divisor,
        ];
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->synthetic($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $inputs);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
                        if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.synthetic-division-calculator');
    }
}
