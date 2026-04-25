<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class EmpiricalFormulaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $e1 = 'C';
    public $e2 = 'H';
    public $e3 = 'O';
    public $e4 = 'P';
    public $e5 = 'Fr';
    public $e6 = 'Ba';

    public $m1 = '40.00';
    public $m2 = '6.67';
    public $m3 = '53.3';
    public $m4 = '40.00';
    public $m5 = '6.67';
    public $m6 = '137.33';

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

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'e1', 'e2', 'e3', 'e4', 'e5', 'e6', 'm1', 'm2', 'm3', 'm4', 'm5', 'm6']);
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
            'e1' => $this->e1, 'e2' => $this->e2, 'e3' => $this->e3, 'e4' => $this->e4, 'e5' => $this->e5, 'e6' => $this->e6,
            'm1' => $this->m1, 'm2' => $this->m2, 'm3' => $this->m3, 'm4' => $this->m4, 'm5' => $this->m5, 'm6' => $this->m6,
        ];

        $model = new Chemistry();
        $result = $model->empirical($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
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

        return view('livewire.calculators.empirical-formula-calculator');
    }
}
