<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class BinomialCoefficientCalculator extends Component
{
    public $n = '13';
    public $k = '7';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->n = $inputs->n ?? '13';
            $this->k = $inputs->k ?? '7';
        }
    }

    public function resetForm()
    {
        $this->n = '13';
        $this->k = '7';
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

    public function factorial($n)
    {
        if ($n <= 1) {
            return 1;
        } else {
            try {
                if (function_exists('gmp_fact')) {
                    $fact = gmp_fact($n);
                    return gmp_strval($fact);
                }
                
                // Fallback for systems without GMP
                $res = 1;
                for ($i = 2; $i <= $n; $i++) {
                    $res = bcmul($res, $i);
                }
                return $res;
            } catch (\Exception $r) {
                return false;
            }
        }
    }

    public function calculate()
    {
        $request = (object)[
            'n' => $this->n,
            'k' => $this->k,
        ];

        $model = new Statistics();
        $result = $model->bin_cof($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.binomial-coefficient-calculator');
    }
}
