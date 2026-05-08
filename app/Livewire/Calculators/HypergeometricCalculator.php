<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class HypergeometricCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $method = '1';
    public $fun = '1';
    public $p = '52';
    public $sp = '26';
    public $s = '5';
    public $ss = '2';
    public $inc = '1';
    public $rep = '10';

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
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'method', 'fun', 'p', 'sp', 's', 'ss', 'inc', 'rep']);
        $this->method = '1';
        $this->fun = '1';
        $this->p = '52';
        $this->sp = '26';
        $this->s = '5';
        $this->ss = '2';
        $this->inc = '1';
        $this->rep = '10';

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
            'method'    => $this->method,
            'fun'       => $this->fun,
            'p'         => $this->p,
            'sp'        => $this->sp,
            's'         => $this->s,
            'ss'        => $this->ss,
            'inc'       => $this->inc,
            'rep'       => $this->rep,
        ];

        $model = new Statistics();
        $result = $model->hypergeometric($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('render-math'));
                    window.dispatchEvent(new CustomEvent('render-chart', { detail: @json($this->detail) }));
                }, 400);
            JS);
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
        if (session('scroll_to_result') && env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            $this->js(<<<'JS'
                $nextTick(() => {
                    window.dispatchEvent(new CustomEvent('render-math'));
                    window.dispatchEvent(new CustomEvent('render-chart', { detail: @json($this->detail) }));
                });
            JS);
        }
        return view('livewire.calculators.hypergeometric-calculator');
    }
}
