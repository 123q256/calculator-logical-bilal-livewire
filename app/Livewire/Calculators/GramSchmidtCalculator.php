<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class GramSchmidtCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $matrix2 = 2;
    public $matrix22 = 2;
    public $matrix3 = [];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->matrix2 = $inputs['matrix2'] ?? 2;
            $this->matrix22 = $inputs['matrix22'] ?? 2;
            for ($i = 1; $i <= 10; $i++) {
                for ($j = 1; $j <= 10; $j++) {
                    $key = "matrix3{$i}_{$j}";
                    $this->matrix3[$i][$j] = $inputs[$key] ?? '';
                }
            }
        } else {
            for ($i = 1; $i <= 10; $i++) {
                for ($j = 1; $j <= 10; $j++) {
                    if ($i == 1 && $j == 1) $this->matrix3[$i][$j] = 3;
                    elseif ($i == 1 && $j == 2) $this->matrix3[$i][$j] = 5;
                    elseif ($i == 2 && $j == 1) $this->matrix3[$i][$j] = 7;
                    elseif ($i == 2 && $j == 2) $this->matrix3[$i][$j] = 9;
                    else $this->matrix3[$i][$j] = '';
                }
            }
        }
    }

  public function resetForm()
    {

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
    }

    public function calculate()
    {
        $req_array = [
            'matrix2' => $this->matrix2,
            'matrix22' => $this->matrix22,
            'submit' => 'submit',
        ];

        for ($i = 1; $i <= $this->matrix2; $i++) {
            for ($j = 1; $j <= $this->matrix22; $j++) {
                $key = "matrix3{$i}_{$j}";
                $req_array[$key] = $this->matrix3[$i][$j] ?? '';
            }
        }
        
        $request = new \Illuminate\Http\Request($req_array);

        $model = new Math();
        $result = $model->gram($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $req_array);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
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
    
        return view('livewire.calculators.gram-schmidt-calculator');
    }
}
