<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class DirectionalDerivativeCalculator extends Component
{
   public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $dimen = 'two';
    public $EnterEq = 'e^(x)+y^2';
    public $u1 = '1';
    public $u2 = '3';
    public $u3 = '2';
    public $x = '0';
    public $y = '3';
    public $z = '2';

  public function setDimen($val) {
      $this->dimen = $val;
      if ($val === 'three') {
          $this->EnterEq = 'e^y+cos(xz)';
      } else {
          $this->EnterEq = 'e^(x)+y^2';
      }
      $this->detail = null;
      $this->error = null;
  }

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

        }
    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;

        $this->dimen = 'two';
        $this->EnterEq = 'e^(x)+y^2';
        $this->u1 = '1';
        $this->u2 = '3';
        $this->u3 = '2';
        $this->x = '0';
        $this->y = '3';
        $this->z = '2';

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
            'type' => $this->dimen,
            'EnterEq' => $this->EnterEq,
            'u1' => $this->u1,
            'u2' => $this->u2,
            'u3' => $this->u3,
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
        ];

        $model = new Math();
        $result = $model->directional($request);

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
                $this->dispatch('math-updated');
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
        return view('livewire.calculators.directional-derivative-calculator');
    }
}
