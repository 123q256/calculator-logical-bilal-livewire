<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class InequalityCalculator extends Component
{
    public $select = '2';
    public $equ1 = 'x^2-2x+1 > 34';
    public $con = '1';
    public $equ2 = 'x^2-2x+1 > 34';
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

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->select = $inputs['select'] ?? $this->select;
            $this->equ1 = $inputs['equ1'] ?? $this->equ1;
            $this->con = $inputs['con'] ?? $this->con;
            $this->equ2 = $inputs['equ2'] ?? $this->equ2;
        }
    }

  public function resetForm()
    {
        $this->select = '2';
        $this->equ1 = 'x^2-2x+1 > 34';
        $this->con = '1';
        $this->equ2 = 'x^2-2x+1 > 34';
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
        session()->forget([
            'calculator_result',
            'validation_error'
        ]);
    }

    public function calculate()
    {
        $request = (object)[
            'select' => $this->select,
            'equ1' => $this->equ1,
            'con' => $this->con,
            'equ2' => $this->equ2,
        ];

        $model = new Math();
        $result = $model->inequality($request);

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
                        if (typeof MJrerender === 'function') MJrerender();
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
        return view('livewire.calculators.inequality-calculator');
    }
}
