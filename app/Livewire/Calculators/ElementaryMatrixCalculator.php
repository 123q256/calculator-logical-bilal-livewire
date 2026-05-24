<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class ElementaryMatrixCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $matrix_type = 'row'; // renamed from 'type' to avoid conflict with $type ('calculator'/'widget')
    public $matrix_size = 3;
    public $pth_matrix = 2;
    public $a = 5;
    public $result_q = 3;
    public $b = 5;

    public $showSteps = false;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_result')) {
            $this->detail = $this->sanitizeForLivewire(session('calculator_result'));
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['type'])) $this->matrix_type = $inputs['type'];
            if (isset($inputs['matrix_size'])) $this->matrix_size = $inputs['matrix_size'];
            if (isset($inputs['pth_matrix'])) $this->pth_matrix = $inputs['pth_matrix'];
            if (isset($inputs['a'])) $this->a = $inputs['a'];
            if (isset($inputs['result_q'])) $this->result_q = $inputs['result_q'];
            if (isset($inputs['b'])) $this->b = $inputs['b'];
        }
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

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;

        $this->matrix_type = 'row';
        $this->matrix_size = 3;
        $this->pth_matrix = 2;
        $this->a = 5;
        $this->result_q = 3;
        $this->b = 5;

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
        $this->showSteps = false;
        
        $requestData = [
            'type' => $this->matrix_type,
            'matrix_size' => $this->matrix_size,
            'pth_matrix' => $this->pth_matrix,
            'a' => $this->a,
            'result_q' => $this->result_q,
            'b' => $this->b,
        ];

        $request = (object) $requestData;

        $model = new Math();
        $result = $model->elementary_matrix_function($request);

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


   public function updatedShowSteps()
    {
        $this->js(<<<'JS'
            setTimeout(() => {
                if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
            }, 50);
        JS);
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
        return view('livewire.calculators.elementary-matrix-calculator');
    }
}
