<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class EquivalentFractionsCalculator extends Component
{
    public $want_to = 1;
    public $is_frac = 1;
    public $s1 = 3;
    public $n1 = 2;
    public $d1 = 5;
    public $no = 5;
    public $s2 = '';
    public $n2 = 2;
    public $d2 = 4;
    public $s3 = '';
    public $n3 = 5;
    public $d3 = 11;

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
            $this->want_to = $inputs['want_to'] ?? $this->want_to;
            $this->is_frac = $inputs['is_frac'] ?? $this->is_frac;
            $this->s1 = $inputs['s1'] ?? $this->s1;
            $this->n1 = $inputs['n1'] ?? $this->n1;
            $this->d1 = $inputs['d1'] ?? $this->d1;
            $this->no = $inputs['no'] ?? $this->no;
            $this->s2 = $inputs['s2'] ?? $this->s2;
            $this->n2 = $inputs['n2'] ?? $this->n2;
            $this->d2 = $inputs['d2'] ?? $this->d2;
            $this->s3 = $inputs['s3'] ?? $this->s3;
            $this->n3 = $inputs['n3'] ?? $this->n3;
            $this->d3 = $inputs['d3'] ?? $this->d3;
        }
    }

  public function resetForm()
    {
        $this->want_to = 1;
        $this->is_frac = 1;
        $this->s1 = 3;
        $this->n1 = 2;
        $this->d1 = 5;
        $this->no = 5;
        $this->s2 = '';
        $this->n2 = 2;
        $this->d2 = 4;
        $this->s3 = '';
        $this->n3 = 5;
        $this->d3 = 11;
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
        $requestData = [
            'want_to' => $this->want_to,
            'is_frac' => $this->is_frac,
            's1' => $this->s1,
            'n1' => $this->n1,
            'd1' => $this->d1,
            'no' => $this->no,
            's2' => $this->s2,
            'n2' => $this->n2,
            'd2' => $this->d2,
            's3' => $this->s3,
            'n3' => $this->n3,
            'd3' => $this->d3,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->equivalent($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
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
        return view('livewire.calculators.equivalent-fractions-calculator');
    }
}
