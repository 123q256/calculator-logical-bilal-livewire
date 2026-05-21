<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class CharacteristicPolynomialCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $matrix22 = 2; // Default dimension 2x2
    public $matrix = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->matrix22 = $inputs['matrix22'] ?? 2;
            for ($i = 1; $i <= $this->matrix22; $i++) {
                for ($j = 1; $j <= $this->matrix22; $j++) {
                    $key = 'matrix3' . $i . '_' . $j;
                    if (isset($inputs[$key])) {
                        $this->matrix[$i][$j] = $inputs[$key];
                    }
                }
            }
        }
        $this->initializeMatrix();
    }

    public function updatedMatrix22()
    {
        if ($this->matrix22 < 1) $this->matrix22 = 1;
        if ($this->matrix22 > 10) $this->matrix22 = 10;
        $this->initializeMatrix();
    }

    public function initializeMatrix()
    {
        for ($i = 1; $i <= $this->matrix22; $i++) {
            for ($j = 1; $j <= $this->matrix22; $j++) {
                if (!isset($this->matrix[$i][$j])) {
                    if ($i == 1 && $j == 1) $this->matrix[$i][$j] = 3;
                    elseif ($i == 1 && $j == 2) $this->matrix[$i][$j] = 5;
                    elseif ($i == 2 && $j == 1) $this->matrix[$i][$j] = 7;
                    elseif ($i == 2 && $j == 2) $this->matrix[$i][$j] = 9;
                    else $this->matrix[$i][$j] = '';
                }
            }
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->matrix22 = 2;
        $this->matrix = [];
        $this->initializeMatrix();

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
        $data = [
            'matrix22' => $this->matrix22,
        ];
        for ($i = 1; $i <= $this->matrix22; $i++) {
            for ($j = 1; $j <= $this->matrix22; $j++) {
                $data['matrix3' . $i . '_' . $j] = $this->matrix[$i][$j] ?? '';
            }
        }
        
        $request = new \Illuminate\Http\Request($data);

        $model = new Math();
        $result = $model->characteristic($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $data);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
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
                setTimeout(() => {
                    if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.characteristic-polynomial-calculator');
    }
}
