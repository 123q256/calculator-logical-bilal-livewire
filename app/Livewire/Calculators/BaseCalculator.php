<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class BaseCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $tool = 'calculator';
    public $bnr_third = '101';
    public $select_base = '2';
    public $to_number = '2';
    public $bnr_frs = '101';
    public $bnr_slc = 'add';
    public $bnr_sec = '101';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->tool = $inputs['tool'] ?? 'calculator';
            $this->bnr_third = $inputs['bnr_third'] ?? '101';
            $this->select_base = $inputs['select_base'] ?? '2';
            $this->to_number = $inputs['to_number'] ?? '2';
            $this->bnr_frs = $inputs['bnr_frs'] ?? '101';
            $this->bnr_slc = $inputs['bnr_slc'] ?? 'add';
            $this->bnr_sec = $inputs['bnr_sec'] ?? '101';
        }
    }

    public function updatedTool($value)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updatedSelectBase($value)
    {
        $this->detail = null;
        $this->error = null;

        $value = (string)$value;
        if (in_array($value, ["2", "3", "4", "5", "6", "7"])) {
            $this->bnr_frs = "101";
            $this->bnr_sec = "101";
            $this->bnr_third = "101";
        } elseif (in_array($value, ["8", "9"])) {
            $this->bnr_frs = "123";
            $this->bnr_sec = "123";
            $this->bnr_third = "123";
        } elseif ($value === "10") {
            $this->bnr_frs = "23";
            $this->bnr_sec = "23";
            $this->bnr_third = "23";
        } else {
            $this->bnr_frs = "54f";
            $this->bnr_sec = "54f";
            $this->bnr_third = "54f";
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->tool = 'calculator';
        $this->bnr_third = '101';
        $this->select_base = '2';
        $this->to_number = '2';
        $this->bnr_frs = '101';
        $this->bnr_slc = 'add';
        $this->bnr_sec = '101';
        
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

    public function calculate()
    {
        $request = new \Illuminate\Http\Request([
            'bnr_frs' => $this->bnr_frs,
            'bnr_sec' => $this->bnr_sec,
            'select_base' => $this->select_base,
            'tool' => $this->tool,
            'bnr_slc' => $this->bnr_slc,
            'to_number' => $this->to_number,
            'bnr_third' => $this->bnr_third,
        ]);

        $model = new Math();
        $result = $model->base($request);

        if (is_array($result)) {
            foreach ($result as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $result[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $result[$key] = 'INF';
                    }
                }
            }
        }

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'bnr_frs' => $this->bnr_frs,
                'bnr_sec' => $this->bnr_sec,
                'select_base' => $this->select_base,
                'tool' => $this->tool,
                'bnr_slc' => $this->bnr_slc,
                'to_number' => $this->to_number,
                'bnr_third' => $this->bnr_third,
            ]);

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                 return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
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
        return view('livewire.calculators.base-calculator');
    }
}
