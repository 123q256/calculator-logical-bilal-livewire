<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class StepsToMilesCalculator extends Component
{
    public $methods = '2';
    public $sex = '1';
    public $first = '12';
    public $unit = 'cm';
    public $steps = '25';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->methods = $inputs->methods ?? $this->methods;
            $this->sex = $inputs->sex ?? $this->sex;
            $this->first = $inputs->first ?? $this->first;
            $this->unit = $inputs->unit ?? $this->unit;
            $this->steps = $inputs->steps ?? $this->steps;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->methods = '2';
        $this->sex = '1';
        $this->first = '12';
        $this->unit = 'cm';
        $this->steps = '25';
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

    public function calculate()
    {
        $request = (object)[
            'methods' => $this->methods,
            'sex'     => $this->sex,
            'first'   => $this->first,
            'unit'    => $this->unit,
            'steps'   => $this->steps,
        ];

        $model = new Health();
        $result = $model->steps_mi($request);

       if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
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
        return view('livewire.calculators.steps-to-miles-calculator');
    }
}
