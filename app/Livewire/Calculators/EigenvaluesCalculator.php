<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class EigenvaluesCalculator extends Component
{
  public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $matrix = 3;
    
    public $matrix_0_0 = 1, $matrix_0_1 = 1, $matrix_0_2 = 9, $matrix_0_3 = 0, $matrix_0_4 = 0;
    public $matrix_1_0 = 2, $matrix_1_1 = 5, $matrix_1_2 = 1, $matrix_1_3 = 0, $matrix_1_4 = 0;
    public $matrix_2_0 = 1, $matrix_2_1 = 2, $matrix_2_2 = 7, $matrix_2_3 = 0, $matrix_2_4 = 0;
    public $matrix_3_0 = 0, $matrix_3_1 = 0, $matrix_3_2 = 0, $matrix_3_3 = 0, $matrix_3_4 = 0;
    public $matrix_4_0 = 0, $matrix_4_1 = 0, $matrix_4_2 = 0, $matrix_4_3 = 0, $matrix_4_4 = 0;



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
        $this->matrix = 3;
        $this->matrix_0_0 = 1; $this->matrix_0_1 = 1; $this->matrix_0_2 = 9; $this->matrix_0_3 = 0; $this->matrix_0_4 = 0;
        $this->matrix_1_0 = 2; $this->matrix_1_1 = 5; $this->matrix_1_2 = 1; $this->matrix_1_3 = 0; $this->matrix_1_4 = 0;
        $this->matrix_2_0 = 1; $this->matrix_2_1 = 2; $this->matrix_2_2 = 7; $this->matrix_2_3 = 0; $this->matrix_2_4 = 0;
        $this->matrix_3_0 = 0; $this->matrix_3_1 = 0; $this->matrix_3_2 = 0; $this->matrix_3_3 = 0; $this->matrix_3_4 = 0;
        $this->matrix_4_0 = 0; $this->matrix_4_1 = 0; $this->matrix_4_2 = 0; $this->matrix_4_3 = 0; $this->matrix_4_4 = 0;

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
        $request = (object)[
            'submit' => true,
            'matrix' => $this->matrix,
        ];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $prop = "matrix_{$i}_{$j}";
                $request->$prop = $this->$prop;
            }
        }

        $model = new Math();
        $result = $model->eigenvalues($request);
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
        return view('livewire.calculators.eigenvalues-calculator');
    }
}
