<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class RrefCalculator extends Component
{
    public $rows = 2;
    public $columns = 2;
    public $matrix = [];

    public $error = null;
    protected $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function initializeMatrix()
    {
        $newMatrix = [];
        for ($i = 1; $i <= $this->rows; $i++) {
            for ($j = 1; $j <= $this->columns; $j++) {
                $key = "{$i}_{$j}";
                if (isset($this->matrix[$key])) {
                    $newMatrix[$key] = $this->matrix[$key];
                } else {
                    if ($i == 1 && $j == 1) $newMatrix[$key] = 3;
                    elseif ($i == 1 && $j == 2) $newMatrix[$key] = 5;
                    elseif ($i == 2 && $j == 1) $newMatrix[$key] = 7;
                    elseif ($i == 2 && $j == 2) $newMatrix[$key] = 9;
                    else $newMatrix[$key] = '';
                }
            }
        }
        $this->matrix = $newMatrix;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->rows = $inputs['matrix2'] ?? 2;
            $this->columns = $inputs['matrix22'] ?? 2;

            for ($i = 1; $i <= $this->rows; $i++) {
                for ($j = 1; $j <= $this->columns; $j++) {
                    $this->matrix["{$i}_{$j}"] = $inputs['matrix3' . $i . '_' . $j] ?? '';
                }
            }
        } else {
            $this->initializeMatrix();
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updatedRows()
    {
        $this->rows = max(1, min(10, intval($this->rows)));
        $this->initializeMatrix();
        $this->detail = null;
        $this->error = null;
    }

    public function updatedColumns()
    {
        $this->columns = max(1, min(10, intval($this->columns)));
        $this->initializeMatrix();
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->rows = 2;
        $this->columns = 2;
        $this->matrix = [];
        $this->initializeMatrix();

        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

          if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
          }
    }

    public function calculate()
    {
        $inputs = [
            'matrix2' => $this->rows,
            'matrix22' => $this->columns,
        ];

        for ($i = 1; $i <= $this->rows; $i++) {
            for ($j = 1; $j <= $this->columns; $j++) {
                $inputs['matrix3' . $i . '_' . $j] = $this->matrix["{$i}_{$j}"] ?? '';
            }
        }

        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->rref($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $inputs);
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

        $this->error = $result['error'] ?? 'Please check your inputs.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }


   public function render()
    {
        if (session('scroll_to_result')) {
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
        
        // Load detail from session on initial render if it's there
        if (empty($this->detail) && session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        return view('livewire.calculators.rref-calculator', [
            'detail' => $this->detail
        ]);
    }
}
