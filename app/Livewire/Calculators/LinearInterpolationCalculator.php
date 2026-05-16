<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class LinearInterpolationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $renderCount = 0;

    // Inputs
    public $x1 = 200;
    public $y1 = 15;
    public $x2 = 300;
    public $y2 = 20;
    public $x3 = 250;
    public $y3 = '';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->x1 = $inputs['x1'] ?? 200;
            $this->y1 = $inputs['y1'] ?? 15;
            $this->x2 = $inputs['x2'] ?? 300;
            $this->y2 = $inputs['y2'] ?? 20;
            $this->x3 = $inputs['x3'] ?? 250;
            $this->y3 = $inputs['y3'] ?? '';
        }
    }

    public function resetForm()
    {
        $this->x1 = 200;
        $this->y1 = 15;
        $this->x2 = 300;
        $this->y2 = 20;
        $this->x3 = 250;
        $this->y3 = '';
        
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
        $this->error = null;
        $this->detail = null;
    }

    public function calculate()
    {
        $request = (object)[
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x2' => $this->x2,
            'y2' => $this->y2,
            'x3' => $this->x3,
            'y3' => $this->y3,
        ];

        $model = new Math();
        $result = $model->linear_interpolation($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;
            $this->renderCount++;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');

                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.linear-interpolation-calculator');
    }
}
