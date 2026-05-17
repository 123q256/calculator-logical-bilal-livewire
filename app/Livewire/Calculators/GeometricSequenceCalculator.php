<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class GeometricSequenceCalculator extends Component
{
    public $find = 'gs';
    public $cw   = 'nth';
    public $a1   = '2';
    public $r    = '2';
    public $n    = '10';
    public $an   = '4';
    public $sn   = '4';
    public $n1   = '3';
    public $a_n  = '16';

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
            $inputs      = session('calculator_back_inputs');
            $this->find  = $inputs['find']  ?? $this->find;
            $this->cw    = $inputs['cw']    ?? $this->cw;
            $this->a1    = $inputs['a1']    ?? $this->a1;
            $this->r     = $inputs['r']     ?? $this->r;
            $this->n     = $inputs['n']     ?? $this->n;
            $this->an    = $inputs['an']    ?? $this->an;
            $this->sn    = $inputs['sn']    ?? $this->sn;
            $this->n1    = $inputs['n1']    ?? $this->n1;
            $this->a_n   = $inputs['a_n']   ?? $this->a_n;
        }
    }

    public function resetForm()
    {
        $this->find = 'gs';
        $this->cw   = 'nth';
        $this->a1   = '2';
        $this->r    = '2';
        $this->n    = '10';
        $this->an   = '4';
        $this->sn   = '4';
        $this->n1   = '3';
        $this->a_n  = '16';

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
        $inputs = [
            'find' => $this->find,
            'cw'   => $this->cw,
            'a1'   => $this->a1,
            'r'    => $this->r,
            'n'    => $this->n,
            'an'   => $this->an,
            'sn'   => $this->sn,
            'n1'   => $this->n1,
            'a_n'  => $this->a_n,
        ];

        $request = request()->merge($inputs);

        $model  = new Math();
        $result = $model->geometric($request);

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
        return view('livewire.calculators.geometric-sequence-calculator');
    }
}
