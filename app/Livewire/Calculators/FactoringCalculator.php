<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class FactoringCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $eq = 'x^2-6x+8';
    public $num1 = 12;
    public $num2 = 8;
    public $calc_type = 'factoring';



  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->eq = $inputs['eq'] ?? 'x^2-6x+8';
            $this->num1 = $inputs['num1'] ?? 12;
            $this->num2 = $inputs['num2'] ?? 8;
            $this->calc_type = $inputs['type'] ?? 'factoring';
        }

    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;
        $this->eq = 'x^2-6x+8';
        $this->num1 = 12;
        $this->num2 = 8;
        $this->calc_type = 'factoring';

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
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'eq' => $this->eq,
            'num1' => $this->num1,
            'num2' => $this->num2,
            'type' => $this->calc_type,
        ]);


        $model = new Math();
        $result = $model->factoring($request);

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
        return view('livewire.calculators.factoring-calculator');
    }
}
