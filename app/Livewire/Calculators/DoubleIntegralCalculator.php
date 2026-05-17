<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class DoubleIntegralCalculator extends Component
{
    public $EnterEq = 'x^2 + 3xy^2 + xy';
    public $with = 'xy';
    public $form = 'indef';
    public $lbx = '';
    public $ubx = '';
    public $lby = '';
    public $uby = '';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $device = 'desktop';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        // Detect device type
        $agent = request()->header('User-Agent', '');
        $this->device = (preg_match('/Mobile|Android|iPhone|iPad/i', $agent)) ? 'mobile' : 'desktop';

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->EnterEq = $inputs['EnterEq'] ?? $this->EnterEq;
            $this->with    = $inputs['with']    ?? $this->with;
            $this->form    = $inputs['form']    ?? $this->form;
            $this->lbx     = $inputs['lbx']     ?? $this->lbx;
            $this->ubx     = $inputs['ubx']     ?? $this->ubx;
            $this->lby     = $inputs['lby']     ?? $this->lby;
            $this->uby     = $inputs['uby']     ?? $this->uby;
        }
    }

    public function resetForm()
    {
        $this->EnterEq = 'x^2 + 3xy^2 + xy';
        $this->with    = 'xy';
        $this->form    = 'indef';
        $this->lbx     = '';
        $this->ubx     = '';
        $this->lby     = '';
        $this->uby     = '';

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
        if (empty($this->EnterEq)) {
            $this->error = 'Please enter a valid equation.';
            $this->detail = null;
            return;
        }

        $inputs = [
            'EnterEq' => $this->EnterEq,
            'with'    => $this->with,
            'form'    => $this->form,
            'lbx'     => $this->lbx,
            'ubx'     => $this->ubx,
            'lby'     => $this->lby,
            'uby'     => $this->uby,
        ];

        $request = request()->merge($inputs);

        $model  = new Math();
        $result = $model->double_int($request);

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
        return view('livewire.calculators.double-integral-calculator');
    }
}
