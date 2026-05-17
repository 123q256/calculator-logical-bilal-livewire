<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SubsetCalculator extends Component
{
    public $cal_by = 'elements';
    public $set_val = '1,2,3,4,5';
    public $cardinal = '5';

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
            $this->cal_by = $inputs['cal_by'] ?? $this->cal_by;
            $this->set_val = $inputs['set'] ?? $this->set_val;
            $this->cardinal = $inputs['cardinal'] ?? $this->cardinal;
        }
    }

    public function setCalBy($calBy)
    {
        $this->cal_by = $calBy;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->cal_by = 'elements';
        $this->set_val = '1,2,3,4,5';
        $this->cardinal = '5';

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
        // Validation check before model call
        if ($this->cal_by === 'elements') {
            if (empty($this->set_val)) {
                $this->error = 'Please enter set elements.';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        } else {
            if (empty($this->cardinal)) {
                $this->error = 'Please enter cardinality.';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        }

        $inputs = [
            'cal_by' => $this->cal_by,
            'set' => $this->set_val,
            'cardinal' => $this->cardinal,
        ];

        // Construct request compatibility layer using Laravel request merge
        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->subset($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Apply float formatting guard to prevent corrupt component payload errors
            foreach ($result as $key => $value) {
                if (is_float($value)) {
                    $result[$key] = round($value, 10);
                }
            }

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

        $this->error = $result['error'] ?? 'Please check your inputs.';
        session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.subset-calculator');
    }
}
