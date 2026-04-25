<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class CharlesLawCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $find = 't2';
    public $v1 = '5';
    public $v1_unit = 'm³';
    public $t1 = '5';
    public $t1_unit = '°C';
    public $v2 = '5';
    public $v2_unit = 'm³';
    public $t2 = '8';
    public $t2_unit = '°C';
    public $p = '9';
    public $p_unit = 'Pa';
    public $n = '10';
    public $R = '8.3144626';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($field, $unit)
    {
        $this->$field = $unit;
        $this->openDropdown = null;
    }

    public function updatedFind($value)
    {
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'find', 'v1', 'v1_unit', 't1', 't1_unit', 'v2', 'v2_unit', 't2', 't2_unit', 'p', 'p_unit', 'n', 'R']);
        $this->resetErrorBag();

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
            'find'    => $this->find,
            'v1'      => $this->v1,
            'v1_unit' => $this->v1_unit,
            't1'      => $this->t1,
            't1_unit' => $this->t1_unit,
            'v2'      => $this->v2,
            'v2_unit' => $this->v2_unit,
            't2'      => $this->t2,
            't2_unit' => $this->t2_unit,
            'p'       => $this->p,
            'p_unit'  => $this->p_unit,
            'n'       => $this->n,
            'R'       => $this->R,
        ];

        $model = new Chemistry();
        $result = $model->charles($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.charles-law-calculator');
    }

  
}
