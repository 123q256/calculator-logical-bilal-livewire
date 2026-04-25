<?php

namespace App\Livewire\Calculators;


use App\Models\Chemistry;
use Livewire\Component;

class TheoreticalYieldCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $lx = '8';
    public $unit_x = 'g';
    public $ly = '50';
    public $sx = '0.75';
    public $dx = '0.16';
    public $dy = '48';

    public $result_unit = 'g';
    public $openDropdown = null;

    public $massUnits = [
        'µg' => 1000000,
        'mg' => 1000,
        'g' => 1,
        'dag' => 0.1,
        'kg' => 0.001,
        't' => 0.000001,
        'gr' => 15.4323584,
        'dr' => 0.564383391,
        'oz' => 0.0352739619,
        'lb' => 0.00220462262,
        'st' => 0.000157473044
    ];

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

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($field, $unit)
    {
        $this->$field = $unit;
        $this->openDropdown = null;
    }

    public function setResultUnit($unit)
    {
        $this->result_unit = $unit;
        $this->openDropdown = null;
    }

    public function getConvertedValue($value)
    {
        if (!$value) return '00';
        
        // Base is grams (g)
        $baseValue = $value; 
        $multiplier = $this->massUnits[$this->result_unit] ?? 1;
        
        return round($baseValue * $multiplier, 4);
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'lx', 'unit_x', 'ly', 'sx', 'dx', 'dy']);
        $this->resetErrorBag();

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

    public function calculate()
    {
        $request = (object)[
            'lx'      => $this->lx,
            'unit_x'  => $this->unit_x,
            'ly'      => $this->ly,
            'sx'      => $this->sx,
            'dx'      => $this->dx,
            'dy'      => $this->dy,
        ];

        $model = new Chemistry();
        $result = $model->theoretical($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
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
        return view('livewire.calculators.theoretical-yield-calculator');
    }
}
