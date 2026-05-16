<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class BinaryCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $bnr_frs = '110111';
    public $bnr_sec = '11011';
    public $bnr_slc = 'add';
    public $bnr_tpe1 = 'binary';
    public $bnr_tpe2 = 'binary';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['bnr_frs'])) $this->bnr_frs = $inputs['bnr_frs'];
            if (isset($inputs['bnr_sec'])) $this->bnr_sec = $inputs['bnr_sec'];
            if (isset($inputs['bnr_slc'])) $this->bnr_slc = $inputs['bnr_slc'];
            if (isset($inputs['bnr_tpe1'])) $this->bnr_tpe1 = $inputs['bnr_tpe1'];
            if (isset($inputs['bnr_tpe2'])) $this->bnr_tpe2 = $inputs['bnr_tpe2'];
        }
    }

    public function resetForm()
    {
        $this->bnr_frs = '110111';
        $this->bnr_sec = '11011';
        $this->bnr_slc = 'add';
        $this->bnr_tpe1 = 'binary';
        $this->bnr_tpe2 = 'binary';
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
        $request = (object)[
            'bnr_frs' => $this->bnr_frs,
            'bnr_sec' => $this->bnr_sec,
            'bnr_slc' => $this->bnr_slc,
            'bnr_tpe1' => $this->bnr_tpe1,
            'bnr_tpe2' => $this->bnr_tpe2,
        ];

        $model = new Math();
        $result = $model->binary($request);

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
        return view('livewire.calculators.binary-calculator');
    }
}
