<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class GayLussacsLawCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $selection = '1';
    public $p1 = 3;
    public $p1_unit = 'Pa';
    public $t1 = 3;
    public $t1_unit = '°C';
    public $p2 = 3;
    public $p2_unit = 'Pa';
    public $t2 = 3;
    public $t2_unit = '°C';
    public $v1 = 3;
    public $v1_unit = 'm³';
    public $amount = 1;
    public $R = 8.3144626;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->selection = $inputs->selection ?? '1';
            $this->p1 = $inputs->p1 ?? 3;
            $this->p1_unit = $inputs->p1_unit ?? 'Pa';
            $this->t1 = $inputs->t1 ?? 3;
            $this->t1_unit = $inputs->t1_unit ?? '°C';
            $this->p2 = $inputs->p2 ?? 3;
            $this->p2_unit = $inputs->p2_unit ?? 'Pa';
            $this->t2 = $inputs->t2 ?? 3;
            $this->t2_unit = $inputs->t2_unit ?? '°C';
            $this->v1 = $inputs->v1 ?? 3;
            $this->v1_unit = $inputs->v1_unit ?? 'm³';
            $this->amount = $inputs->amount ?? 1;
            $this->R = $inputs->R ?? 8.3144626;
        }
    }

    public function updatedSelection()
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
        $this->selection = '1';
        $this->p1 = 3;
        $this->t1 = 3;
        $this->p2 = 3;
        $this->t2 = 3;
        $this->v1 = 3;
        $this->amount = 1;
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
            'selection' => $this->selection,
            'p1'        => $this->p1,
            'p1_unit'   => $this->p1_unit,
            't1'        => $this->t1,
            't1_unit'   => $this->t1_unit,
            'p2'        => $this->p2,
            'p2_unit'   => $this->p2_unit,
            't2'        => $this->t2,
            't2_unit'   => $this->t2_unit,
            'v1'        => $this->v1,
            'v1_unit'   => $this->v1_unit,
            'amount'    => $this->amount,
            'R'         => $this->R,
        ];

        $model = new Chemistry();
        $result = $model->gay($request);

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
        return view('livewire.calculators.gay-lussacs-law-calculator');
    }
}
