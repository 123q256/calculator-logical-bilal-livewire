<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class BoylesLawCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $find = '1';
    public $p1 = 2;
    public $p1_unit = 'Pa';
    public $v1 = 3;
    public $v1_unit = 'm³';
    public $p2 = 3;
    public $p2_unit = 'Pa';
    public $v2 = 5;
    public $v2_unit = 'm³';
    public $temp = 8;
    public $temp_unit = '°C';
    public $amount = 8;
    public $R = 8.3144626;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->find = $inputs->find ?? '1';
            $this->p1 = $inputs->p1 ?? 2;
            $this->p1_unit = $inputs->p1_unit ?? 'Pa';
            $this->v1 = $inputs->v1 ?? 3;
            $this->v1_unit = $inputs->v1_unit ?? 'm³';
            $this->p2 = $inputs->p2 ?? 3;
            $this->p2_unit = $inputs->p2_unit ?? 'Pa';
            $this->v2 = $inputs->v2 ?? 5;
            $this->v2_unit = $inputs->v2_unit ?? 'm³';
            $this->temp = $inputs->temp ?? 8;
            $this->temp_unit = $inputs->temp_unit ?? '°C';
            $this->amount = $inputs->amount ?? 8;
            $this->R = $inputs->R ?? 8.3144626;
        }
    }

    public function updatedFind()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->find = '1';
        $this->p1 = 2;
        $this->v1 = 3;
        $this->p2 = 3;
        $this->v2 = 5;
        $this->temp = 8;
        $this->amount = 8;
        $this->R = 8.3144626;

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

    public function calculate()
    {
        $request = (object)[
            'find'      => $this->find,
            'p1'        => $this->p1,
            'p1_unit'   => $this->p1_unit,
            'v1'        => $this->v1,
            'v1_unit'   => $this->v1_unit,
            'p2'        => $this->p2,
            'p2_unit'   => $this->p2_unit,
            'v2'        => $this->v2,
            'v2_unit'   => $this->v2_unit,
            'temp'      => $this->temp,
            'temp_unit' => $this->temp_unit,
            'amount'    => $this->amount,
            'R'         => $this->R,
        ];

        $model = new Chemistry();
        $result = $model->boyles($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
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
        return view('livewire.calculators.boyles-law-calculator');
    }
}
