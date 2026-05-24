<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SubstitutionMethodCalculator extends Component
{
  public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $operations = '1';
    
    // System of 2 Equations (math_1)
    public $a1_f = '1', $b1_f = '3', $k1_f = '5';
    public $a2_f = '7', $b2_f = '9', $k2_f = '11';

    // System of 3 Equations (math_2)
    public $a1_s = '1', $b1_s = '2', $c1_s = '3', $k1_s = '4';
    public $a2_s = '5', $b2_s = '6', $c2_s = '7', $k2_s = '8';
    public $a3_s = '9', $b3_s = '10', $c3_s = '11', $k3_s = '12';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->operations = $inputs['operations'] ?? '1';
            
            $this->a1_f = $inputs['a1_f'] ?? '1';
            $this->b1_f = $inputs['b1_f'] ?? '3';
            $this->k1_f = $inputs['k1_f'] ?? '5';
            $this->a2_f = $inputs['a2_f'] ?? '7';
            $this->b2_f = $inputs['b2_f'] ?? '9';
            $this->k2_f = $inputs['k2_f'] ?? '11';

            $this->a1_s = $inputs['a1_s'] ?? '1';
            $this->b1_s = $inputs['b1_s'] ?? '2';
            $this->c1_s = $inputs['c1_s'] ?? '3';
            $this->k1_s = $inputs['k1_s'] ?? '4';
            $this->a2_s = $inputs['a2_s'] ?? '5';
            $this->b2_s = $inputs['b2_s'] ?? '6';
            $this->c2_s = $inputs['c2_s'] ?? '7';
            $this->k2_s = $inputs['k2_s'] ?? '8';
            $this->a3_s = $inputs['a3_s'] ?? '9';
            $this->b3_s = $inputs['b3_s'] ?? '10';
            $this->c3_s = $inputs['c3_s'] ?? '11';
            $this->k3_s = $inputs['k3_s'] ?? '12';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->operations = '1';
        $this->a1_f = '1'; $this->b1_f = '3'; $this->k1_f = '5';
        $this->a2_f = '7'; $this->b2_f = '9'; $this->k2_f = '11';
        
        $this->a1_s = '1'; $this->b1_s = '2'; $this->c1_s = '3'; $this->k1_s = '4';
        $this->a2_s = '5'; $this->b2_s = '6'; $this->c2_s = '7'; $this->k2_s = '8';
        $this->a3_s = '9'; $this->b3_s = '10'; $this->c3_s = '11'; $this->k3_s = '12';

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
        $requestData = [
            'operations' => $this->operations,
            'a1_f' => $this->a1_f,
            'b1_f' => $this->b1_f,
            'k1_f' => $this->k1_f,
            'a2_f' => $this->a2_f,
            'b2_f' => $this->b2_f,
            'k2_f' => $this->k2_f,
            
            'a1_s' => $this->a1_s,
            'b1_s' => $this->b1_s,
            'c1_s' => $this->c1_s,
            'k1_s' => $this->k1_s,
            
            'a2_s' => $this->a2_s,
            'b2_s' => $this->b2_s,
            'c2_s' => $this->c2_s,
            'k2_s' => $this->k2_s,
            
            'a3_s' => $this->a3_s,
            'b3_s' => $this->b3_s,
            'c3_s' => $this->c3_s,
            'k3_s' => $this->k3_s,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->substitution($request);

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
        return view('livewire.calculators.substitution-method-calculator');
    }
}
