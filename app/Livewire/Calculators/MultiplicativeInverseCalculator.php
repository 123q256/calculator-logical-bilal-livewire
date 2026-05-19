<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class MultiplicativeInverseCalculator extends Component
{
    public $is_frac = '2';
    public $s1 = '3';
    public $n1 = '2';
    public $d1 = '5';
    public $dec = '13';
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
            $this->is_frac = $inputs['is_frac'] ?? $this->is_frac;
            $this->s1 = $inputs['s1'] ?? $this->s1;
            $this->n1 = $inputs['n1'] ?? $this->n1;
            $this->d1 = $inputs['d1'] ?? $this->d1;
            $this->dec = $inputs['dec'] ?? $this->dec;
        }
    }

  public function resetForm()
    {
        $this->is_frac = '2';
        $this->s1 = '3';
        $this->n1 = '2';
        $this->d1 = '5';
        $this->dec = '13';
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
        session()->forget([
            'calculator_result',
            'validation_error'
        ]);
    }

    public function calculate()
    {
        $request = (object)[
            'is_frac' => $this->is_frac,
            's1' => $this->s1,
            'n1' => $this->n1,
            'd1' => $this->d1,
            'dec' => $this->dec,
        ];

        $model = new Math();
        $result = $model->multiplicative($request);

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
                        if (typeof MJrerender === 'function') MJrerender();
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
    
        return view('livewire.calculators.multiplicative-inverse-calculator');
    }
}
