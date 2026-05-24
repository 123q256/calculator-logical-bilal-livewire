<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Illuminate\Http\Request;
use Livewire\Component;

class MatrixTransposeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $rows = 2;
    public $cols = 2;
    public $matrix = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        if (session()->has('calculator_result')) {
            $this->detail = $this->sanitizeForLivewire(session('calculator_result'));
        } else {
            $this->detail = null;
        }
        $this->error = session('validation_error');

        // Initialize default matrix
        $this->matrix[1][1] = 3;
        $this->matrix[1][2] = 5;
        $this->matrix[2][1] = 7;
        $this->matrix[2][2] = 9;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->rows = $inputs['matrix2'] ?? 2;
            $this->cols = $inputs['matrix22'] ?? 2;
            for ($i = 1; $i <= $this->rows; $i++) {
                for ($j = 1; $j <= $this->cols; $j++) {
                    if (isset($inputs['matrix3' . $i . '_' . $j])) {
                        $this->matrix[$i][$j] = $inputs['matrix3' . $i . '_' . $j];
                    }
                }
            }
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->rows = 2;
        $this->cols = 2;
        $this->matrix = [];
        $this->matrix[1][1] = 3;
        $this->matrix[1][2] = 5;
        $this->matrix[2][1] = 7;
        $this->matrix[2][2] = 9;

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

    /**
     * Prevents Livewire CorruptComponentPayloadException caused by:
     * 1. Un-serializable objects (stdClass)
     * 2. Javascript Float Precision Loss (converting floats to strings)
     */
    private function sanitizeForLivewire($data)
    {
        if (is_null($data)) return null;
        
        $sanitized = json_decode(json_encode($data), true);
        if (is_array($sanitized)) {
            array_walk_recursive($sanitized, function (&$item) {
                if (is_float($item)) {
                    $item = (string) $item;
                }
            });
        }
        return $sanitized;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        
        if ($propertyName === 'rows' || $propertyName === 'cols') {
            // Ensure matrix array has necessary keys to avoid undefined warnings in blade
            for ($i = 1; $i <= $this->rows; $i++) {
                for ($j = 1; $j <= $this->cols; $j++) {
                    if (!isset($this->matrix[$i][$j])) {
                        $this->matrix[$i][$j] = ''; // or 0
                    }
                }
            }
        }
    }



    public function calculate()
    {
        $requestData = [
            'matrix2' => $this->rows,
            'matrix22' => $this->cols,
        ];
        
        for ($i = 1; $i <= $this->rows; $i++) {
            for ($j = 1; $j <= $this->cols; $j++) {
                $requestData['matrix3' . $i . '_' . $j] = $this->matrix[$i][$j] ?? 0;
            }
        }

        $request = new Request($requestData);

        $model = new Math();
        $result = $model->transpose($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $this->sanitizeForLivewire($result);
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
        return view('livewire.calculators.matrix-transpose-calculator');
    }
}
