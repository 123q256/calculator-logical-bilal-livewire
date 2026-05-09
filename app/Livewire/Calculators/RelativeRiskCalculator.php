<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class RelativeRiskCalculator extends Component
{
    public $e_disease = '5';
    public $e_no_disease = '3';
    public $c_disease = '7';
    public $c_no_disease = '10';
    public $confidenceLevel = '95';
    public $z_score = '1.9600';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updatedConfidenceLevel()
    {
        $this->calculateZScore();
        $this->error = null;
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'confidenceLevel' && $propertyName !== 'z_score') {
            $this->error = null;
            $this->detail = null;
        }
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->e_disease = $inputs->e_disease ?? '5';
            $this->e_no_disease = $inputs->e_no_disease ?? '3';
            $this->c_disease = $inputs->c_disease ?? '7';
            $this->c_no_disease = $inputs->c_no_disease ?? '10';
            $this->confidenceLevel = $inputs->confidenceLevel ?? '95';
            $this->z_score = $inputs->z_score ?? '1.9600';
        } else {
            $this->calculateZScore();
        }
    }

    protected function calculateZScore()
    {
        $confidence = floatval($this->confidenceLevel) / 100;
        if ($confidence <= 0 || $confidence >= 1) {
            $this->z_score = '0.0000';
            return;
        }

        $alpha = (1 - $confidence) / 2;
        $p = 1 - $alpha;

        // Common Z-scores for speed
        $common = [
            '0.90' => '1.6449',
            '0.95' => '1.9600',
            '0.99' => '2.5758',
            '0.999' => '3.2905'
        ];

        $key = strval($confidence);
        if (isset($common[$key])) {
            $this->z_score = $common[$key];
            return;
        }

        // Simple inverse normal approximation (Acklam's algorithm or similar)
        $this->z_score = number_format($this->inverseNormal($p), 4, '.', '');
    }

    protected function inverseNormal($p)
    {
        // Lower tail quantile for standard normal distribution
        // Approximation from https://www.johndcook.com/blog/python_phi_inverse/
        if ($p < 0.5) {
            return -$this->inverseNormal(1 - $p);
        }

        $p = 1 - $p;
        $t = sqrt(-2 * log($p));
        return $t - (2.515517 + 0.802853 * $t + 0.010328 * $t * $t) / (1 + 1.432788 * $t + 0.189269 * $t * $t + 0.001308 * $t * $t * $t);
    }

    public function resetForm()
    {
        $this->e_disease = '5';
        $this->e_no_disease = '3';
        $this->c_disease = '7';
        $this->c_no_disease = '10';
        $this->confidenceLevel = '95';
        $this->calculateZScore();
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
        $this->calculateZScore();

        $request = (object)[
            'e_disease' => $this->e_disease,
            'e_no_disease' => $this->e_no_disease,
            'c_disease' => $this->c_disease,
            'c_no_disease' => $this->c_no_disease,
            'confidenceLevel' => $this->confidenceLevel,
            'z_score' => $this->z_score,
        ];

        $model = new Statistics();
        $result = $model->relative_risk($request);

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
        return view('livewire.calculators.relative-risk-calculator');
    }
}
