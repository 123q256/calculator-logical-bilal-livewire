<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SlopeInterceptFormCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $formType = '2';
    public $x1 = '2';
    public $y1 = '21';
    public $x2 = '11';
    public $y2 = '5';
    public $renderCount = 0;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['type'])) $this->formType = $inputs['type'];
            if (isset($inputs['x1'])) $this->x1 = $inputs['x1'];
            if (isset($inputs['y1'])) $this->y1 = $inputs['y1'];
            if (isset($inputs['x2'])) $this->x2 = $inputs['x2'];
            if (isset($inputs['y2'])) $this->y2 = $inputs['y2'];
        }
    }

    public function resetForm()
    {
        $this->formType = '2';
        $this->x1 = '2';
        $this->y1 = '21';
        $this->x2 = '11';
        $this->y2 = '5';
        $this->error = null;
        $this->detail = null;
        $this->renderCount = 0;

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
        $request = (object)[
            'type' => $this->formType,
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x2' => $this->x2,
            'y2' => $this->y2,
        ];

        $model = new Math();
        $result = $model->slope_intercept($request);

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
        return view('livewire.calculators.slope-intercept-form-calculator');
    }
}
