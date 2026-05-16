<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class ECalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal = $inputs['cal'] ?? 'ex';
            $this->a = $inputs['a'] ?? '5';
            $this->x = $inputs['x'] ?? '2';
        }
    }

    public function resetForm()
    {
        $this->cal = 'ex';
        $this->a = '5';
        $this->x = '2';
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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        if ($this->x === '' || $this->x === null) {
            $this->error = 'Please! Check Your Input.';
            return;
        }

        if ($this->cal === 'ax' && ($this->a === '' || $this->a === null)) {
            $this->error = 'Please! Check Your Input.';
            return;
        }

        $request = (object)[
            'cal' => $this->cal,
            'a' => $this->a,
            'x' => $this->x,
        ];

        $model = new Math();
        $result = $model->e($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                 session()->flash('scroll_to_result', true);
                 return redirect()->to(url()->previous() ?? '/');
            } else {
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
            return;
        }

        $this->error = $result['error'] ?? 'Please! Check Your Input.';
        $this->detail = null;
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
        return view('livewire.calculators.e-calculator');
    }
}
