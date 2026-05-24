<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class MatrixMultiplicationCalculator extends Component
{
   public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $rows1 = 2;
    public $columns1 = 2;
    public $matrix2 = 2;
    public $matrix22 = 2;
    
    public $matrixA = [];
    public $matrixB = [];

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

        for ($i = 0; $i < 10; $i++) {
            $this->matrixA[$i] = [];
            $this->matrixB[$i] = [];
            for ($j = 0; $j < 10; $j++) {
                $this->matrixA[$i][$j] = '2';
                $this->matrixB[$i][$j] = '2';
            }
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['rows1'])) $this->rows1 = $inputs['rows1'];
            if (isset($inputs['columns1'])) $this->columns1 = $inputs['columns1'];
            if (isset($inputs['matrix2'])) $this->matrix2 = $inputs['matrix2'];
            if (isset($inputs['matrix22'])) $this->matrix22 = $inputs['matrix22'];
            
            for ($i = 0; $i < 10; $i++) {
                for ($j = 0; $j < 10; $j++) {
                    $propI = $i + 1;
                    $propJ = $j + 1;
                    if (isset($inputs["matrix{$propI}_{$propJ}"])) {
                        $this->matrixA[$i][$j] = $inputs["matrix{$propI}_{$propJ}"];
                    }
                    if (isset($inputs["matrix3{$propI}_{$propJ}"])) {
                        $this->matrixB[$i][$j] = $inputs["matrix3{$propI}_{$propJ}"];
                    }
                }
            }
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->rows1 = 2;
        $this->columns1 = 2;
        $this->matrix2 = 2;
        $this->matrix22 = 2;

        for ($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $this->matrixA[$i][$j] = '2';
                $this->matrixB[$i][$j] = '2';
            }
        }

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

  public function updated()
    {
        $this->detail = null;
        $this->error = null;
        $this->dispatch('math-updated');
    }

    public function calculate()
    {
        $request = (object)[
            'rows1' => $this->rows1,
            'columns1' => $this->columns1,
            'matrix2' => $this->matrix2,
            'matrix22' => $this->matrix22,
        ];
        
        for ($i = 0; $i < $this->rows1; $i++) {
            for ($j = 0; $j < $this->columns1; $j++) {
                $propI = $i + 1;
                $propJ = $j + 1;
                $prop = "matrix{$propI}_{$propJ}";
                $request->$prop = $this->matrixA[$i][$j] ?? '2';
            }
        }
        for ($i = 0; $i < $this->matrix2; $i++) {
            for ($j = 0; $j < $this->matrix22; $j++) {
                $propI = $i + 1;
                $propJ = $j + 1;
                $prop = "matrix3{$propI}_{$propJ}";
                $request->$prop = $this->matrixB[$i][$j] ?? '2';
            }
        }

        $model = new Math();
        $result = $model->matrix($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $this->sanitizeForLivewire($result);
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
                $this->dispatch('math-updated');
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
        return view('livewire.calculators.matrix-multiplication-calculator');
    }
}
