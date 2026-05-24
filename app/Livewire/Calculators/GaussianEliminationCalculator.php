<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Illuminate\Http\Request;
use Livewire\Component;

class GaussianEliminationCalculator extends Component
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
        $this->initMatrix();

        // Default values
        $this->matrix[0][0] = 3;
        $this->matrix[0][1] = 5;
        $this->matrix[1][0] = 7;
        $this->matrix[1][1] = 9;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->rows = (int)($inputs['matrix2'] ?? 2);
            $this->cols = (int)($inputs['matrix22'] ?? 2);
            $this->initMatrix();
            for ($i = 0; $i < $this->rows; $i++) {
                for ($j = 0; $j < $this->cols; $j++) {
                    $key = 'matrix3' . ($i + 1) . '_' . ($j + 1);
                    if (isset($inputs[$key])) {
                        $this->matrix[$i][$j] = $inputs[$key];
                    }
                }
            }
        }

        if (session()->has('calculator_result')) {
            $this->detail = $this->sanitizeForLivewire(session('calculator_result'));
        }
        if (session()->has('validation_error')) {
            $this->error = session('validation_error');
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
        
        // Deep convert all floats to strings to prevent JS precision mismatch
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

    /**
     * Initialize only the needed rows/cols (not full 10x10)
     */
    private function initMatrix()
    {
        $matrix = [];
        for ($i = 0; $i < $this->rows; $i++) {
            $matrix[$i] = [];
            for ($j = 0; $j < $this->cols; $j++) {
                $matrix[$i][$j] = $this->matrix[$i][$j] ?? '';
            }
        }
        $this->matrix = $matrix;
    }

    public function updatedRows()
    {
        $this->rows = max(1, min(10, (int)$this->rows));
        $this->detail = null;
        $this->error  = null;
        $this->initMatrix();
    }

    public function updatedCols()
    {
        $this->cols = max(1, min(10, (int)$this->cols));
        $this->detail = null;
        $this->error  = null;
        $this->initMatrix();
    }

    public function updated($propertyName)
    {
        // Only reset result for non-rows/cols changes
        if (!in_array($propertyName, ['rows', 'cols'])) {
            $this->detail = null;
            $this->error  = null;
        }
    }

    public function resetForm()
    {
        $this->error  = null;
        $this->detail = null;
        $this->rows   = 2;
        $this->cols   = 2;

        $this->matrix = [];
        $this->initMatrix();

        $this->matrix[0][0] = 3;
        $this->matrix[0][1] = 5;
        $this->matrix[1][0] = 7;
        $this->matrix[1][1] = 9;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result',
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'matrix2'  => $this->rows,
            'matrix22' => $this->cols,
        ];

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $requestData['matrix3' . ($i + 1) . '_' . ($j + 1)] =
                    $this->matrix[$i][$j] ?? 0;
            }
        }

        $request = new Request($requestData);
        $model   = new Math();
        $result  = $model->gaussian($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

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
            return;
        }

        $this->error  = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
        session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.gaussian-elimination-calculator');
    }
}