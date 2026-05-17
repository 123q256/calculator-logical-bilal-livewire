<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class ParallelAndPerpendicularCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $form = '1';
    public $a = '2';
    public $b = '-6';
    public $c = '-13';
    public $p1 = '-13';
    public $p2 = '3';
    public $method = '1';
    public $renderCount = 1;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->form = $inputs['form'] ?? '1';
            $this->a = $inputs['a'] ?? '2';
            $this->b = $inputs['b'] ?? '-6';
            $this->c = $inputs['c'] ?? '-13';
            $this->p1 = $inputs['p1'] ?? '-13';
            $this->p2 = $inputs['p2'] ?? '3';
            $this->method = $inputs['method'] ?? '1';
        }
    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;
        $this->form = '1';
        $this->a = '2';
        $this->b = '-6';
        $this->c = '-13';
        $this->p1 = '-13';
        $this->p2 = '3';
        $this->method = '1';

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
        $this->renderCount++;
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'form' => $this->form,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'p1' => $this->p1,
            'p2' => $this->p2,
            'method' => $this->method,
        ]);

        $model = new Math();
        $result = $model->parallel($request);

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
        return view('livewire.calculators.parallel-and-perpendicular-calculator');
    }
}
