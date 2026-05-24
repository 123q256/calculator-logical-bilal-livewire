<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class NullSpaceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $row = 3;
    public $colum = 3;
    public $matrix = [];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        // Initialize default matrix
        for ($i = 0; $i < 10; $i++) {
            $this->matrix[$i] = [];
            for ($j = 0; $j < 10; $j++) {
                $this->matrix[$i][$j] = '';
            }
        }
        $this->matrix[0][0] = 1; $this->matrix[0][1] = 1; $this->matrix[0][2] = 9;
        $this->matrix[1][0] = 2; $this->matrix[1][1] = 5; $this->matrix[1][2] = 1;
        $this->matrix[2][0] = 1; $this->matrix[2][1] = 2; $this->matrix[2][2] = 7;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['row'])) $this->row = $inputs['row'];
            if (isset($inputs['colum'])) $this->colum = $inputs['colum'];
            for ($i = 0; $i < 10; $i++) {
                for ($j = 0; $j < 10; $j++) {
                    if (isset($inputs["matrix_{$i}_{$j}"])) {
                        $this->matrix[$i][$j] = $inputs["matrix_{$i}_{$j}"];
                    }
                }
            }
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->row = 3;
        $this->colum = 3;

        for ($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $this->matrix[$i][$j] = '';
            }
        }
        $this->matrix[0][0] = 1; $this->matrix[0][1] = 1; $this->matrix[0][2] = 9;
        $this->matrix[1][0] = 2; $this->matrix[1][1] = 5; $this->matrix[1][2] = 1;
        $this->matrix[2][0] = 1; $this->matrix[2][1] = 2; $this->matrix[2][2] = 7;

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
        $this->dispatch('math-updated');
    }

    public function calculate()
    {
        $request = (object)[
            'row' => $this->row,
            'colum' => $this->colum,
        ];
        for ($i = 0; $i < $this->row; $i++) {
            for ($j = 0; $j < $this->colum; $j++) {
                $prop = "matrix_{$i}_{$j}";
                $request->$prop = $this->matrix[$i][$j] ?? '';
            }
        }

        $model = new Math();
        $result = $model->null($request);

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
        return view('livewire.calculators.null-space-calculator');
    }
}
