<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class ChildPughCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $cal_name = '';

    // Form inputs
    public $b = '1';
    public $a = '1';
    public $i = '1';
    public $as = '1';
    public $e = '1';

    public function mount($type = 'calculator', $lang = [], $cal_name = '')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->cal_name = $cal_name;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->b = $inputs->b ?? $this->b;
            $this->a = $inputs->a ?? $this->a;
            $this->i = $inputs->i ?? $this->i;
            $this->as = $inputs->as ?? $this->as;
            $this->e = $inputs->e ?? $this->e;
        }
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->b = '1';
        $this->a = '1';
        $this->i = '1';
        $this->as = '1';
        $this->e = '1';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'b' => $this->b,
            'a' => $this->a,
            'i' => $this->i,
            'as' => $this->as,
            'e' => $this->e,
        ]);

        $model = new Health();
        $result = $model->child($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
        }
        return view('livewire.calculators.child-pugh-calculator');
    }
}
