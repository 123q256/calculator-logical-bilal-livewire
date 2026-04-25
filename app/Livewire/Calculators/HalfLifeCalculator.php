<?php

namespace App\Livewire\Calculators;


use App\Models\Chemistry;
use Livewire\Component;

class HalfLifeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Properties
    public $calculator_name = 'calculator1';
    public $find = 't1_2';
    public $nt = 10;
    public $n0 = 100;
    public $t = 50;
    public $t1_2 = 15;
    
    public $find_by = 't_1_2';
    public $t_1_2 = 15;
    public $T = 50;
    public $lamda = 10;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if(isset($inputs->calculator_name)){
                $this->calculator_name = $inputs->calculator_name;
                $this->find = $inputs->find;
                $this->nt = $inputs->nt;
                $this->n0 = $inputs->n0;
                $this->t = $inputs->t;
                $this->t1_2 = $inputs->t1_2;
                $this->find_by = $inputs->find_by;
                $this->t_1_2 = $inputs->t_1_2;
                $this->T = $inputs->T;
                $this->lamda = $inputs->lamda;
            }
        }
    }

    public function resetForm()
    {
        $this->reset([
            'calculator_name', 'find', 'nt', 'n0', 't', 't1_2',
            'find_by', 't_1_2', 'T', 'lamda', 'error', 'detail'
        ]);
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

    public function updatedCalculatorName()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function updatedFind()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'scroll_to_result']);
    }

    public function updatedFindBy()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'calculator_name' => $this->calculator_name,
            'find' => $this->find,
            'nt' => $this->nt,
            'n0' => $this->n0,
            't' => $this->t,
            't1_2' => $this->t1_2,
            'find_by' => $this->find_by,
            't_1_2' => $this->t_1_2,
            'T' => $this->T,
            'lamda' => $this->lamda,
        ];


        $model = new Chemistry();
        $result = $model->half($request);
        // dd($result);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);

                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->dispatch('math-updated');
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
            $this->dispatch('math-updated');
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
   
        return view('livewire.calculators.half-life-calculator');
    }
}
