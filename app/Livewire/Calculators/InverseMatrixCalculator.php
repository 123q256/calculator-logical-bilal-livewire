<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class InverseMatrixCalculator extends Component
{
  public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $dtrmn_slct_method = 3;
    public $dtrmn_opts_method = 'exp_col';
    public $matrix = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        $this->initMatrix();

        // Default initial values to match original UI
        $this->matrix[0][0] = 1;
        $this->matrix[0][1] = 1;
        $this->matrix[0][2] = 9;
        $this->matrix[1][0] = 2;
        $this->matrix[1][1] = 5;
        $this->matrix[1][2] = 1;
        $this->matrix[2][0] = 1;
        $this->matrix[2][1] = 2;
        $this->matrix[2][2] = 7;

        if (session()->has('calculator_result')) {
            $this->detail = $this->sanitizeForLivewire(session('calculator_result'));
        }
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['dtrmn_slct_method'])) $this->dtrmn_slct_method = $inputs['dtrmn_slct_method'];
            if (isset($inputs['dtrmn_opts_method'])) $this->dtrmn_opts_method = $inputs['dtrmn_opts_method'];
            $this->initMatrix();
            for ($i = 0; $i < $this->dtrmn_slct_method; $i++) {
                for ($j = 0; $j < $this->dtrmn_slct_method; $j++) {
                    $key = 'dtrmn_' . $i . '_' . $j;
                    if (isset($inputs[$key])) {
                        $this->matrix[$i][$j] = $inputs[$key];
                    }
                }
            }
        }
    }

    private function initMatrix()
    {
        $matrix = [];
        for ($i = 0; $i < $this->dtrmn_slct_method; $i++) {
            $matrix[$i] = [];
            for ($j = 0; $j < $this->dtrmn_slct_method; $j++) {
                $matrix[$i][$j] = $this->matrix[$i][$j] ?? '';
            }
        }
        $this->matrix = $matrix;
    }

    private function sanitizeForLivewire($data)
    {
        if (is_null($data)) return null;
        $sanitized = json_decode(json_encode($data), true);
        if (is_array($sanitized)) {
            array_walk_recursive($sanitized, function (&$item) {
                if (is_float($item)) $item = (string) $item;
            });
        }
        return $sanitized;
    }

    public function updatedDtrmnSlctMethod()
    {
        $this->dtrmn_slct_method = max(2, min(5, (int)$this->dtrmn_slct_method));
        $this->detail = null;
        $this->error  = null;
        $this->initMatrix();
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->dtrmn_slct_method = 3;
        $this->dtrmn_opts_method = 'exp_col';
        $this->matrix = [];
        $this->initMatrix();
        $this->matrix[0][0] = 1;
        $this->matrix[0][1] = 1;
        $this->matrix[0][2] = 9;
        $this->matrix[1][0] = 2;
        $this->matrix[1][1] = 5;
        $this->matrix[1][2] = 1;
        $this->matrix[2][0] = 1;
        $this->matrix[2][1] = 2;
        $this->matrix[2][2] = 7;

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
            'dtrmn_slct_method' => $this->dtrmn_slct_method,
            'dtrmn_opts_method' => $this->dtrmn_opts_method,
        ];

        for ($i = 0; $i < $this->dtrmn_slct_method; $i++) {
            for ($j = 0; $j < $this->dtrmn_slct_method; $j++) {
                $requestData['dtrmn_' . $i . '_' . $j] = $this->matrix[$i][$j] ?? 0;
            }
        }

        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->inv_mat($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $this->sanitizeForLivewire($result);
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
                        else if (typeof MJrerender === 'function') MJrerender();
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
        return view('livewire.calculators.inverse-matrix-calculator');
    }
}
