<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class OrderOfOperationsCalculator extends Component
{
   public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $expression = '(10+5^2)((5*-2)+9-3^3)/2';
    
    public $calculationSteps = [];
    public $finalAnswer = null;
    public $errorMessage = null;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        $this->calculationSteps = session('calculation_steps', []);
        $this->finalAnswer = session('final_answer');
        $this->errorMessage = session('solver_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->expression = $inputs['expression'] ?? $this->expression;
        }
    }

  public function resetForm()
    {
        $this->expression = '(10+5^2)((5*-2)+9-3^3)/2';

        $this->error = null;
        $this->detail = null;
        $this->calculationSteps = [];
        $this->finalAnswer = null;
        $this->errorMessage = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result',
            'calculation_steps',
            'final_answer',
            'solver_error'
        ]);

          if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

  public function updated()
    {
        $this->detail = null;
        $this->error = null;
        $this->calculationSteps = [];
        $this->finalAnswer = null;
        $this->errorMessage = null;
    }

    public function calculate()
    {
        $this->calculationSteps = [];
        $this->finalAnswer = null;
        $this->errorMessage = null;

        $solver = new OrderOfOperationsSolver();
        $success = $solver->solve($this->expression);

        $request = ['expression' => $this->expression];
        
        if ($success) {
            $result = ['RESULT' => 1, 'expression' => $this->expression];
            
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('calculation_steps', $solver->steps);
            session()->flash('final_answer', $solver->finalAnswer);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->calculationSteps = $solver->steps;
                $this->finalAnswer = $solver->finalAnswer;
                
                $this->js('
                    setTimeout(() => {
                        if (typeof MJrerender === "function") MJrerender();
                        const el = document.getElementById("result-section");
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: "smooth" });
                        }
                    }, 100);
                ');
            }
            return;
        }

        $this->errorMessage = $solver->errorMessage;
        $this->calculationSteps = $solver->steps;
        $this->error = $this->errorMessage ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        session()->flash('solver_error', $this->errorMessage);
        session()->flash('calculation_steps', $this->calculationSteps);
        
        $this->detail = ['expression' => $this->expression];
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
        return view('livewire.calculators.order-of-operations-calculator');
    }
}
