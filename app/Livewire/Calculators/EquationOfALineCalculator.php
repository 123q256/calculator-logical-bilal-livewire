<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class EquationOfALineCalculator extends Component
{
    public $type = '2';
    public $x1 = '2';
    public $y1 = '21';
    public $x2 = '11';
    public $y2 = '5';
    public $x3 = '2';
    public $y3 = '7';
    public $error = null;
    public $detail = null;
    public $componentType = 'calculator'; // renamed to componentType to avoid collision with $type input
    public $lang = [];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->componentType = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->type = $inputs['type'] ?? $this->type;
            $this->x1 = $inputs['x1'] ?? $this->x1;
            $this->y1 = $inputs['y1'] ?? $this->y1;
            $this->x2 = $inputs['x2'] ?? $this->x2;
            $this->y2 = $inputs['y2'] ?? $this->y2;
            $this->x3 = $inputs['x3'] ?? $this->x3;
            $this->y3 = $inputs['y3'] ?? $this->y3;
        }
    }

  public function resetForm()
    {
        $this->type = '2';
        $this->x1 = '2';
        $this->y1 = '21';
        $this->x2 = '11';
        $this->y2 = '5';
        $this->x3 = '2';
        $this->y3 = '7';
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
        session()->forget([
            'calculator_result',
            'validation_error'
        ]);
    }

    public function calculate()
    {
        $request = (object)[
            'type' => $this->type,
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x2' => $this->x2,
            'y2' => $this->y2,
            'x3' => $this->x3,
            'y3' => $this->y3,
        ];

        $model = new Math();
        $result = $model->line($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
                        if (typeof drawGraph === 'function') {
                            drawGraph($wire.type, $wire.x1, $wire.y1, $wire.x2, $wire.y2);
                        }
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 150);
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
        return view('livewire.calculators.equation-of-a-line-calculator');
    }
}
