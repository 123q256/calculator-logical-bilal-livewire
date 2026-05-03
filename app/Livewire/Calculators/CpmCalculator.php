<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class CpmCalculator extends Component
{
    public $method = 'cpm';
    public $x = 10;
    public $y = 20;
    
    public $checkbox = false;
    
    public $methodf = 'cpm';
    public $xf = 10;
    public $yf = 20;
    
    public $methods = 'cpm';
    public $xs = 50;
    public $ys = 50;

    public $currency = '$';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [], $currency = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currency = $currency;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->method = $inputs->method ?? 'cpm';
            $this->x = $inputs->x ?? 10;
            $this->y = $inputs->y ?? 20;
            $this->checkbox = $inputs->checkbox ?? false;
            $this->methodf = $inputs->methodf ?? 'cpm';
            $this->xf = $inputs->xf ?? 10;
            $this->yf = $inputs->yf ?? 20;
            $this->methods = $inputs->methods ?? 'cpm';
            $this->xs = $inputs->xs ?? 50;
            $this->ys = $inputs->ys ?? 50;
        }
    }

    public function resetForm()
    {
        $this->reset(['method', 'x', 'y', 'checkbox', 'methodf', 'xf', 'yf', 'methods', 'xs', 'ys', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['method', 'checkbox', 'methodf', 'methods'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $request = (object)[
            'my_current' => $this->currency,
            'method'     => $this->method,
            'x'          => (float)$this->x,
            'y'          => (float)$this->y,
            'checkbox'   => $this->checkbox ? 'on' : null,
            'methodf'    => $this->methodf,
            'xf'         => (float)$this->xf,
            'yf'         => (float)$this->yf,
            'methods'    => $this->methods,
            'xs'         => (float)$this->xs,
            'ys'         => (float)$this->ys,
        ];

        $model = new Finance();
        $result = $model->cpm($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.cpm-calculator');
    }
}
