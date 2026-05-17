<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class LinearApproximationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $calc_type = '1';
    public $EnterEq = '2x^2+3x-12';
    public $EnterEq1 = '2t';
    public $point = '3';

  public function mount($type = 'calculator', $lang = [])

    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calc_type = $inputs['type'] ?? '1';
            $this->EnterEq = $inputs['EnterEq'] ?? '2x^2+3x-12';
            $this->EnterEq1 = $inputs['EnterEq1'] ?? '2t';
            $this->point = $inputs['point'] ?? '3';
        }

    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;
        $this->calc_type = '1';
        $this->EnterEq = '2x^2+3x-12';
        $this->EnterEq1 = '2t';
        $this->point = '3';


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

        if ($propertyName === 'calc_type') {
            if ($this->calc_type === '1') {
                $this->EnterEq = '2x^2+3x-12';
            } elseif ($this->calc_type === '2') {
                $this->EnterEq = 't^2 + 3t';
            } else {
                $this->EnterEq = 't^2 + 3t';
            }
        }
    }


    public function calculate()
    {
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'type' => $this->calc_type,
            'EnterEq' => $this->EnterEq,
            'EnterEq1' => $this->EnterEq1,
            'point' => $this->point,
        ]);

        $model = new Math();
        $result = $model->linear($request);


        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request->all());
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
        return view('livewire.calculators.linear-approximation-calculator');
    }
}
