<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class ZerosCalculator extends Component
{
    public $eq = 'x^4 - 16x^3 + 90x^2 - 224x + 245 = 6';

    public $error  = null;
    public $detail = null;
    public $type   = 'calculator';
    public $lang   = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error  = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->eq = $inputs['eq'] ?? $this->eq;
        }
    }

    public function resetForm()
    {
        $this->eq = 'x^4 - 16x^3 + 90x^2 - 224x + 245 = 6';

        $this->error  = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result',
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error  = null;
    }

    public function calculate()
    {
        if (empty($this->eq)) {
            $this->error  = 'Please enter a valid equation.';
            $this->detail = null;
            return;
        }

        $inputs  = ['eq' => $this->eq];
        $request = request()->merge($inputs);

        $model  = new Math();
        $result = $model->zeros($request);

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
                        if (typeof convertLegacyMathScripts === 'function') convertLegacyMathScripts();
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

        $this->error  = $result['error'] ?? 'Please check your inputs.';
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
        return view('livewire.calculators.zeros-calculator');
    }
}
