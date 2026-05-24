<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class TangentLineCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $cal = 'y';
    public $func = '3*x^2';
    public $func1 = '5*t^3';
    public $point = '2';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal = $inputs['cal'] ?? 'y';
            $this->func = $inputs['func'] ?? '3*x^2';
            $this->func1 = $inputs['func1'] ?? '5*t^3';
            $this->point = $inputs['point'] ?? '2';
        }
    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;
        $this->cal = 'y';
        $this->func = '3*x^2';
        $this->func1 = '5*t^3';
        $this->point = '2';

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
            'cal' => $this->cal,
            'func' => $this->func,
            'func1' => $this->func1,
            'point' => $this->point,
        ];

        $model = new Math();
        $result = $model->tangent_line($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
        return view('livewire.calculators.tangent-line-calculator');
    }
}
