<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class LengthOfCurveCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $cal = 'y';
    public $func = '6x^3+7x^2-7x+10';
    public $func1 = '10t^3+3t^2-7t-7';
    public $func2 = '6t^3+7t^2-7t+10';
    public $upper = '2';
    public $lower = '0';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal = $inputs['cal'] ?? $this->cal;
            $this->func = $inputs['func'] ?? $this->func;
            $this->func1 = $inputs['func1'] ?? $this->func1;
            $this->func2 = $inputs['func2'] ?? $this->func2;
            $this->upper = $inputs['upper'] ?? $this->upper;
            $this->lower = $inputs['lower'] ?? $this->lower;
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->cal = 'y';
        $this->func = '6x^3+7x^2-7x+10';
        $this->func1 = '10t^3+3t^2-7t-7';
        $this->func2 = '6t^3+7t^2-7t+10';
        $this->upper = '2';
        $this->lower = '0';

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

    public function updatedCal($value)
    {
        if ($value === 'y') {
            $this->func = '6x^3+7x^2-7x+10';
        } elseif ($value === 'x') {
            $this->func = '10y^3+3y^2-7y-7';
        } elseif ($value === 'xy') {
            $this->func = '6t^3+7t^2-7t+10';
            $this->func1 = '10t^3+3t^2-7t-7';
        } elseif ($value === 'r') {
            $this->func = '6t^3+7t^2-7t+10';
        } elseif ($value === 'xyz') {
            $this->func = '17t^3+15t^2-13t+10';
            $this->func1 = '19t^3+2t^2-9t+11';
            $this->func2 = '6t^3+7t^2-7t+10';
        }
    }

    public function calculate()
    {
        $requestData = [
            'cal' => $this->cal,
            'func' => $this->func,
            'func1' => $this->func1,
            'func2' => $this->func2,
            'upper' => $this->upper,
            'lower' => $this->lower,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->length($request);

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
                        if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
                        if (typeof MJrerender === 'function') MJrerender();
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
                    if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.length-of-curve-calculator');
    }
}
