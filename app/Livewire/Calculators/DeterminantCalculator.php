<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class DeterminantCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $dtrmn_slct_method = 3;
    public $dtrmn_opts_method = 'exp_col';
    public $dtrmn_opts = 1;

    public $dtrmn_0_0 = 1; public $dtrmn_0_1 = 1; public $dtrmn_0_2 = 9; public $dtrmn_0_3 = 0; public $dtrmn_0_4 = 0;
    public $dtrmn_1_0 = 2; public $dtrmn_1_1 = 5; public $dtrmn_1_2 = 1; public $dtrmn_1_3 = 0; public $dtrmn_1_4 = 0;
    public $dtrmn_2_0 = 1; public $dtrmn_2_1 = 2; public $dtrmn_2_2 = 7; public $dtrmn_2_3 = 0; public $dtrmn_2_4 = 0;
    public $dtrmn_3_0 = 0; public $dtrmn_3_1 = 0; public $dtrmn_3_2 = 0; public $dtrmn_3_3 = 1; public $dtrmn_3_4 = 0;
    public $dtrmn_4_0 = 0; public $dtrmn_4_1 = 0; public $dtrmn_4_2 = 0; public $dtrmn_4_3 = 0; public $dtrmn_4_4 = 1;

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

        $this->dtrmn_slct_method = 3;
        $this->dtrmn_opts_method = 'exp_col';
        $this->dtrmn_opts = 1;

        $this->dtrmn_0_0 = 1; $this->dtrmn_0_1 = 1; $this->dtrmn_0_2 = 9; $this->dtrmn_0_3 = 0; $this->dtrmn_0_4 = 0;
        $this->dtrmn_1_0 = 2; $this->dtrmn_1_1 = 5; $this->dtrmn_1_2 = 1; $this->dtrmn_1_3 = 0; $this->dtrmn_1_4 = 0;
        $this->dtrmn_2_0 = 1; $this->dtrmn_2_1 = 2; $this->dtrmn_2_2 = 7; $this->dtrmn_2_3 = 0; $this->dtrmn_2_4 = 0;
        $this->dtrmn_3_0 = 0; $this->dtrmn_3_1 = 0; $this->dtrmn_3_2 = 0; $this->dtrmn_3_3 = 1; $this->dtrmn_3_4 = 0;
        $this->dtrmn_4_0 = 0; $this->dtrmn_4_1 = 0; $this->dtrmn_4_2 = 0; $this->dtrmn_4_3 = 0; $this->dtrmn_4_4 = 1;

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
    public function clearMatrix() {
        for ($i=0; $i<5; $i++) {
            for ($j=0; $j<5; $j++) {
                $prop = "dtrmn_{$i}_{$j}";
                $this->$prop = '';
            }
        }
        $this->detail = null;
    }

    public function generateMatrix() {
        $arr = range(0, 24);
        shuffle($arr);
        $index = 0;
        for ($i=0; $i<5; $i++) {
            for ($j=0; $j<5; $j++) {
                $prop = "dtrmn_{$i}_{$j}";
                $this->$prop = substr((string)$arr[$index], 0, 1);
                $index++;
            }
        }
        $this->detail = null;
    }
  public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        if ($this->dtrmn_slct_method != 3 && in_array($this->dtrmn_opts_method, ['triangle', 'sarrus'])) {
            $this->error = "This method can only be used with 3x3 matrices.";
            return;
        }

        $requestData = [
            'dtrmn_slct_method' => (string) $this->dtrmn_slct_method,
            'dtrmn_opts_method' => $this->dtrmn_opts_method,
            'dtrmn_opts' => (string) $this->dtrmn_opts,
        ];
        
        $matrixValues = $requestData;
        for ($i=0; $i<5; $i++) {
            for ($j=0; $j<5; $j++) {
                $prop = "dtrmn_{$i}_{$j}";
                $requestData[$prop] = $this->$prop;
                $matrixValues[$prop] = $this->$prop;
            }
        }

        $request = new \Illuminate\Http\Request();
        $request->merge($requestData);

        // Populate $_POST for legacy backend Math logic
        foreach ($matrixValues as $key => $val) {
            $_POST[$key] = $val;
        }

        $model = new Math();
        $result = $model->determinant($request);
        if (is_array($result)) {
            $result['matrix'] = $matrixValues;
        }

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
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        } else if (typeof MJrerender === 'function') {
                            MJrerender();
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
        return view('livewire.calculators.determinant-calculator');
    }
}
