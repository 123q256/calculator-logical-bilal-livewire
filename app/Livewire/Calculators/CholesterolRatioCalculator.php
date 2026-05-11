<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class CholesterolRatioCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $tc = '175';
    public $tc_unit = 'mg/dL';
    public $hc = '45';
    public $hc_unit = 'mg/dL';
    public $lc = '';
    public $lc_unit = 'mg/dL';
    public $tr = '120';
    public $tr_unit = 'mg/dL';
    public $gender = 'male';

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
        $this->tc = '175';
        $this->tc_unit = 'mg/dL';
        $this->hc = '45';
        $this->hc_unit = 'mg/dL';
        $this->lc = '';
        $this->lc_unit = 'mg/dL';
        $this->tr = '120';
        $this->tr_unit = 'mg/dL';
        $this->gender = 'male';

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
        // The model expects exactly three values to be numeric
        $request = (object)[
            'tc'      => $this->tc !== '' ? (float)$this->tc : '',
            'tc_unit' => $this->tc_unit,
            'hc'      => $this->hc !== '' ? (float)$this->hc : '',
            'hc_unit' => $this->hc_unit,
            'lc'      => $this->lc !== '' ? (float)$this->lc : '',
            'lc_unit' => $this->lc_unit,
            'tr'      => $this->tr !== '' ? (float)$this->tr : '',
            'tr_unit' => $this->tr_unit,
            'gender'  => $this->gender,
        ];

        $model = new Health();
        $result = $model->cholesterol($request);

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

        $this->error = $result['error'] ?? 'Please! Enter exactly three values.';
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
        return view('livewire.calculators.cholesterol-ratio-calculator');
    }
}
