<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class NernstEquationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Properties
    public $cal = 'ecell';
    public $ecell = 2;
    public $ecell_unit = 'mV';
    public $eo = 2;
    public $eo_unit = 'mV';
    public $t = 4;
    public $t_unit = '°C';
    public $n = 5;
    public $q = 6;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if(isset($inputs->cal)){
                $this->cal = $inputs->cal;
                $this->ecell = $inputs->ecell;
                $this->ecell_unit = $inputs->ecell_unit;
                $this->eo = $inputs->eo;
                $this->eo_unit = $inputs->eo_unit;
                $this->t = $inputs->t;
                $this->t_unit = $inputs->t_unit;
                $this->n = $inputs->n;
                $this->q = $inputs->q;
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['cal', 'ecell', 'ecell_unit', 'eo', 'eo_unit', 't', 't_unit', 'n', 'q', 'error', 'detail']);
        $this->resetErrorBag();
        $this->resetValidation();

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

    public function updatedCal()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'cal' => $this->cal,
            'ecell' => $this->ecell,
            'ecell_unit' => $this->ecell_unit,
            'eo' => $this->eo,
            'eo_unit' => $this->eo_unit,
            't' => $this->t,
            't_unit' => $this->t_unit,
            'n' => $this->n,
            'q' => $this->q,
        ];

        $model = new Chemistry();
        $result = $model->nernst($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            foreach($result as $key => $val) {
                if (is_float($val) && is_infinite($val)) {
                    $result[$key] = 'Infinity';
                } elseif (is_float($val) && is_nan($val)) {
                    $result[$key] = 'Undefined (NaN)';
                }
            }
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);

                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
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
        return view('livewire.calculators.nernst-equation-calculator');
    }
}
