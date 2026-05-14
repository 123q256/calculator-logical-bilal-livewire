<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class SvrCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $map = 90;        // Mean Arterial Pressure (normal ~70-105)
    public $map_unit = 'mmHg';
    public $cvp = 7;         // Central Venous Pressure (normal ~2-8)
    public $cvp_unit = 'mmHg';
    public $co = 5;          // Cardiac Output (normal ~4-8)
    public $co_unit = 'L/min';

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
        if (in_array($propertyName, ['map', 'cvp', 'co', 'map_unit', 'cvp_unit', 'co_unit'])) {
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->map = 90;
        $this->cvp = 7;
        $this->co = 5;
        $this->map_unit = 'mmHg';
        $this->cvp_unit = 'mmHg';
        $this->co_unit = 'L/min';

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
        if (!is_numeric($this->map) || !is_numeric($this->cvp) || !is_numeric($this->co)) {
            $this->error = 'Please enter valid numeric values.';
            return;
        }

        $request = (object)[
            'map'      => $this->map,
            'map_unit' => $this->map_unit,
            'cvp'      => $this->cvp,
            'cvp_unit' => $this->cvp_unit,
            'co'       => $this->co,
            'co_unit'  => $this->co_unit,
        ];

        $model = new Health();
        $result = $model->svr($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
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
        return view('livewire.calculators.svr-calculator');
    }
}
