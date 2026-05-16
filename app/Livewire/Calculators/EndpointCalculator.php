<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class EndpointCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $x1 = '1';
    public $y1 = '3';
    public $x = '3';
    public $y = '4';
    public $renderCount = 0;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['x1'])) $this->x1 = $inputs['x1'];
            if (isset($inputs['y1'])) $this->y1 = $inputs['y1'];
            if (isset($inputs['x'])) $this->x = $inputs['x'];
            if (isset($inputs['y'])) $this->y = $inputs['y'];
        }
    }

    public function resetForm()
    {
        $this->x1 = '1';
        $this->y1 = '3';
        $this->x = '3';
        $this->y = '4';
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
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x' => $this->x,
            'y' => $this->y,
        ];

        $model = new Math();
        $result = $model->endpoint($request);

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
        return view('livewire.calculators.endpoint-calculator');
    }
}
