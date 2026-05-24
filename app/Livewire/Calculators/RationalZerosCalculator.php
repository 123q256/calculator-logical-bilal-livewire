<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class RationalZerosCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $no_of = '2';
    public $v1 = '1';
    public $v2 = '5';
    public $v3 = '6';
    public $v4 = '4';
    public $v5 = '5';
    public $v6 = '6';
    public $v7 = '7';
    public $v8 = '8';
    public $v9 = '9';
    public $v10 = '10';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->no_of = $inputs['no_of'] ?? $this->no_of;
            $this->v1 = $inputs['v1'] ?? $this->v1;
            $this->v2 = $inputs['v2'] ?? $this->v2;
            $this->v3 = $inputs['v3'] ?? $this->v3;
            $this->v4 = $inputs['v4'] ?? $this->v4;
            $this->v5 = $inputs['v5'] ?? $this->v5;
            $this->v6 = $inputs['v6'] ?? $this->v6;
            $this->v7 = $inputs['v7'] ?? $this->v7;
            $this->v8 = $inputs['v8'] ?? $this->v8;
            $this->v9 = $inputs['v9'] ?? $this->v9;
            $this->v10 = $inputs['v10'] ?? $this->v10;
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->no_of = '2';
        $this->v1 = '1';
        $this->v2 = '5';
        $this->v3 = '6';
        $this->v4 = '4';
        $this->v5 = '5';
        $this->v6 = '6';
        $this->v7 = '7';
        $this->v8 = '8';
        $this->v9 = '9';
        $this->v10 = '10';

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
            'no_of' => $this->no_of,
            'v1' => $this->v1,
            'v2' => $this->v2,
            'v3' => $this->v3,
            'v4' => $this->v4,
            'v5' => $this->v5,
            'v6' => $this->v6,
            'v7' => $this->v7,
            'v8' => $this->v8,
            'v9' => $this->v9,
            'v10' => $this->v10,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->rational_zero($request);

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
                        if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
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
                setTimeout(() => {
                    if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.rational-zeros-calculator');
    }
}
