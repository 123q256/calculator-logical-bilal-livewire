<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class MillionBillionLakhCrore extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $from = '10000';
    public $calFrom = 'Million';
    public $calto = 'Lakh';
    public $from_new = null;
    public $calFrom_new = null;
    public $calto_new = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['from'])) $this->from = $inputs['from'];
            if (isset($inputs['calFrom'])) $this->calFrom = $inputs['calFrom'];
            if (isset($inputs['calto'])) $this->calto = $inputs['calto'];
        }
    }

    public function resetForm()
    {
        $this->from = '10000';
        $this->calFrom = 'Million';
        $this->calto = 'Lakh';
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

    public function swapUnits()
    {
        $temp = $this->calFrom;
        $this->calFrom = $this->calto;
        $this->calto = $temp;
        $this->detail = null;
    }

    public function calculate($from_new = null, $calFrom_new = null, $calto_new = null)
    {
        $request = (object)[
            'from' => $this->from,
            'calFrom' => $this->calFrom,
            'calto' => $this->calto,
            'from_new' => $from_new,
            'calFrom_new' => $calFrom_new,
            'calto_new' => $calto_new,
        ];

        $model = new Math();
        $result = $model->million($request);

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
        return view('livewire.calculators.million-billion-lakh-crore');
    }
}
