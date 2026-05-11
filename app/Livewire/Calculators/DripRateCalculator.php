<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class DripRateCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $calc_type = 'first'; // 'first' for simple, 'second' for advanced
    public $v = '500';
    public $v_unit = 'ml';
    public $t = '8';
    public $t_unit = 'hrs';
    public $dp = '20';
    public $dp_unit = 'gtts/ml';

    // Advanced inputs
    public $d = '0.02';
    public $d_unit = 'mg/kg/min';
    public $bw = '85';
    public $bw_unit = 'kg';
    public $bv = '500';
    public $bv_unit = 'ml';
    public $drug = '100';
    public $drug_unit = 'mg';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
            if (isset($inputs['type'])) {
                $this->calc_type = $inputs['type'];
            }
        }
    }

    public function updated($propertyName)
    {
        // Clear results when any input changes
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->calc_type = 'first';
        $this->v = '500';
        $this->v_unit = 'ml';
        $this->t = '8';
        $this->t_unit = 'hrs';
        $this->dp = '20';
        $this->dp_unit = 'gtts/ml';
        $this->d = '0.02';
        $this->d_unit = 'mg/kg/min';
        $this->bw = '85';
        $this->bw_unit = 'kg';
        $this->bv = '500';
        $this->bv_unit = 'ml';
        $this->drug = '100';
        $this->drug_unit = 'mg';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $request = (object)[
            'type'      => $this->calc_type,
            'v'         => (float)$this->v,
            'v_unit'    => $this->v_unit,
            't'         => (float)$this->t,
            't_unit'    => $this->t_unit,
            'dp'        => (float)$this->dp,
            'dp_unit'   => $this->dp_unit,
            'd'         => (float)$this->d,
            'd_unit'    => $this->d_unit,
            'bw'        => (float)$this->bw,
            'bw_unit'   => $this->bw_unit,
            'bv'        => (float)$this->bv,
            'bv_unit'   => $this->bv_unit,
            'drug'      => (float)$this->drug,
            'drug_unit' => $this->drug_unit,
        ];

        $model = new Health();
        $result = $model->drip($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
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
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.drip-rate-calculator');
    }
}
