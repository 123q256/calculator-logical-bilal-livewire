<?php

namespace App\Livewire\Calculators;
use App\Models\Math;  
use Livewire\Component;

class EquationOfACircle extends Component
{
     public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $from = '1';
    public $a = '5';
    public $b = '3';
    public $c = '1';
    public $x1 = '5';
    public $y1 = '4';
    public $r = '3';
    public $h1 = '3';
    public $k1 = '4';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->from = $inputs['from'] ?? '1';
            $this->a = $inputs['a'] ?? '5';
            $this->b = $inputs['b'] ?? '3';
            $this->c = $inputs['c'] ?? '1';
            $this->x1 = $inputs['x1'] ?? '5';
            $this->y1 = $inputs['y1'] ?? '4';
            $this->r = $inputs['r'] ?? '3';
            $this->h1 = $inputs['h1'] ?? '3';
            $this->k1 = $inputs['k1'] ?? '4';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->from = '1';
        $this->a = '5';
        $this->b = '3';
        $this->c = '1';
        $this->x1 = '5';
        $this->y1 = '4';
        $this->r = '3';
        $this->h1 = '3';
        $this->k1 = '4';

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
            'from' => $this->from,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'x1' => $this->x1,
            'y1' => $this->y1,
            'r' => $this->r,
            'h1' => $this->h1,
            'k1' => $this->k1,
        ];
        
        array_walk_recursive($requestData, function (&$item) {
            if (is_float($item)) $item = (string) $item;
        });

        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->equation($request);

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
        return view('livewire.calculators.equation-of-a-circle');
    }
}
