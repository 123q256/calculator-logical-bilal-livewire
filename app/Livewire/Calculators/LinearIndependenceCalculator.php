<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class LinearIndependenceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public array $data = [
        'row' => 3,
        'colum' => 3,
        'matrix_0_0' => 1, 'matrix_0_1' => 1, 'matrix_0_2' => 0, 'matrix_0_3' => 0,
        'matrix_1_0' => 2, 'matrix_1_1' => 5, 'matrix_1_2' => -3, 'matrix_1_3' => 0,
        'matrix_2_0' => 1, 'matrix_2_1' => 2, 'matrix_2_2' => 7, 'matrix_2_3' => 0,
        'matrix_3_0' => 0, 'matrix_3_1' => 0, 'matrix_3_2' => 0, 'matrix_3_3' => 0,
    ];


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
        $lang = $this->lang;
        $type = $this->type;
        $this->reset();
        $this->lang = $lang;
        $this->type = $type;
        $this->error = null;
        $this->detail = null;

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
        $requestData = $this->data;
        $request = new \Illuminate\Http\Request();
        $request->replace($requestData);

        $model = new Math();
        $result = $model->independence($request);

        if (is_array($result)) {
            foreach ($result as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $result[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $result[$key] = 'INF';
                    }
                }
            }
        }

                if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $rows = (int)$requestData['row'];
            $columns = (int)$requestData['colum'];
            
            $input = [];
            for ($i = 0; $i < 4; $i++) {
                $input[$i] = [];
                for ($j = 0; $j < 4; $j++) {
                    $input[$i][$j] = isset($requestData["matrix_{$i}_{$j}"]) ? floatval($requestData["matrix_{$i}_{$j}"]) : 0;
                }
            }
            
            $matrix = [];
            $rank = $rows;
            $noZero = 0;
            
            for ($i = 0; $i < $rows; $i++) {
                $matrix[$i] = [];
                for ($j = 0; $j < $columns; $j++) {
                    $matrix[$i][$j] = round($input[$i][$j], 4);
                }
            }
            
            for ($k = 0; $k < min($rows, $columns); $k++) {
                for ($i = $k - $noZero + 1; $i < $rows; $i++) {
                    if (abs($matrix[$k - $noZero][$k]) < 1e-9) {
                        $safe = $matrix[$k - $noZero];
                        $matrix[$k - $noZero] = $matrix[$i];
                        $matrix[$i] = $safe;
                    }
                }
                if (abs($matrix[$k - $noZero][$k]) < 1e-9) {
                    $noZero += 1;
                } else {
                    $pivot = $matrix[$k - $noZero][$k];
                    for ($i = $columns - 1; $i >= 0; $i--) {
                        $matrix[$k - $noZero][$i] = round($matrix[$k - $noZero][$i] / $pivot, 5);
                    }
                    for ($i = $k - $noZero + 1; $i < $rows; $i++) {
                        $factor = $matrix[$i][$k];
                        for ($j = $columns - 1; $j >= $k; $j--) {
                            $matrix[$i][$j] = round($matrix[$i][$j] - $factor * $matrix[$k - $noZero][$j], 5);
                        }
                    }
                }
            }
            
            for ($i = 0; $i < $rows; $i++) {
                $isZeroRow = true;
                for ($j = 0; $j < $columns; $j++) {
                    if (abs($matrix[$i][$j]) > 1e-9) {
                        $isZeroRow = false;
                        break;
                    }
                }
                if ($isZeroRow) {
                    $rank -= 1;
                }
            }
            
            $result['status'] = ($rank != $rows) ? 'Linearly Dependent.' : 'Linearly Independent.';

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
        return view('livewire.calculators.linear-independence-calculator');
    }
}
