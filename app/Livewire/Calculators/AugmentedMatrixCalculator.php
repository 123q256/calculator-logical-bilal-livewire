<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class AugmentedMatrixCalculator extends Component
{
   public $error = null;
    public $type = 'calculator';
    public $lang = [];

    public $matrix2 = 2;
    public $matrix22 = 3;
    public $matrixA = [];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->error = session('validation_error');

        for ($i = 0; $i < 10; $i++) {
            $this->matrixA[$i] = [];
            for ($j = 0; $j < 10; $j++) {
                $this->matrixA[$i][$j] = '2';
            }
        }
        $this->matrixA[0][0] = '3'; $this->matrixA[0][1] = '5';
        $this->matrixA[1][0] = '7'; $this->matrixA[1][1] = '9';

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['matrix2'])) $this->matrix2 = $inputs['matrix2'];
            if (isset($inputs['matrix22'])) $this->matrix22 = $inputs['matrix22'];
            for ($i = 0; $i < 10; $i++) {
                for ($j = 0; $j < 10; $j++) {
                    $propI = $i + 1;
                    $propJ = $j + 1;
                    if (isset($inputs["matrix3{$propI}_{$propJ}"])) {
                        $this->matrixA[$i][$j] = $inputs["matrix3{$propI}_{$propJ}"];
                    }
                }
            }
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->matrix2 = 2;
        $this->matrix22 = 3;

        for ($i = 0; $i < 10; $i++) {
            $this->matrixA[$i] = [];
            for ($j = 0; $j < 10; $j++) {
                $this->matrixA[$i][$j] = '2';
            }
        }
        $this->matrixA[0][0] = '3'; $this->matrixA[0][1] = '5';
        $this->matrixA[1][0] = '7'; $this->matrixA[1][1] = '9';

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
        session()->forget('calculator_result');
        $this->error = null;
        $this->dispatch('math-updated');
    }

    public function calculate()
    {
        $request = (object)[
            'matrix2' => $this->matrix2,
            'matrix22' => $this->matrix22,
        ];
        for ($i = 0; $i < $this->matrix2; $i++) {
            for ($j = 0; $j < $this->matrix22; $j++) {
                $propI = $i + 1;
                $propJ = $j + 1;
                $prop = "matrix3{$propI}_{$propJ}";
                $request->$prop = $this->matrixA[$i][$j] ?? '2';
            }
        }

        $model = new Math();
        $result = $model->augmented($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
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
        session()->forget('calculator_result');
    }


   public function render()
    {
        $detail = session('calculator_result');
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
    
        return view('livewire.calculators.augmented-matrix-calculator', ['detail' => $detail]);
    }
}
