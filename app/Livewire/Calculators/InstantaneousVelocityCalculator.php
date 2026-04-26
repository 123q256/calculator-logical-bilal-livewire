<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class InstantaneousVelocityCalculator extends Component
{
    public $i_d = 1;
    public $i_d_unit = 'cm';
    public $f_d = 3;
    public $f_d_unit = 'cm';
    public $i_tt = 10;
    public $i_tt_unit = 'sec';
    public $f_tt = 7;
    public $f_tt_unit = 'sec';
    public $circle_unit_result = 'm/s';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $showDropdown = null;

    protected $conversionFactors = [
        'm/s' => 1,
        'ft/s' => 3.281,
        'km/s' => 0.001,
        'km/h' => 3.6,
        'mi/s' => 0.0006214,
        'mph' => 2.237,
    ];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            $this->i_d = $inputs['i_d'] ?? 1;
            $this->i_d_unit = $inputs['i_d_unit'] ?? 'cm';
            $this->f_d = $inputs['f_d'] ?? 3;
            $this->f_d_unit = $inputs['f_d_unit'] ?? 'cm';
            $this->i_tt = $inputs['i_tt'] ?? 10;
            $this->i_tt_unit = $inputs['i_tt_unit'] ?? 'sec';
            $this->f_tt = $inputs['f_tt'] ?? 7;
            $this->f_tt_unit = $inputs['f_tt_unit'] ?? 'sec';
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'circle_unit_result' && $propertyName !== 'showDropdown') {
            $this->detail = null;
        }

        if ($propertyName === 'circle_unit_result') {
            $this->dispatch('math-rendered');
        }
    }

    public function toggleOverlay($name)
    {
        $this->showDropdown = ($this->showDropdown === $name) ? null : $name;
        $this->dispatch('math-rendered');
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->showDropdown = null;
        
        if ($field !== 'circle_unit_result') {
            $this->detail = null;
        } else {
            $this->dispatch('math-rendered');
        }
    }

    public function resetForm()
    {
        $this->i_d = 1;
        $this->i_d_unit = 'cm';
        $this->f_d = 3;
        $this->f_d_unit = 'cm';
        $this->i_tt = 10;
        $this->i_tt_unit = 'sec';
        $this->f_tt = 7;
        $this->f_tt_unit = 'sec';
        $this->circle_unit_result = 'm/s';
        $this->detail = null;
        $this->error = null;

        session()->forget(['calculator_result', 'calculator_back_inputs']);
    }

    public function calculate()
    {
        $requestData = [
            'i_d' => $this->i_d,
            'i_d_unit' => $this->i_d_unit,
            'f_d' => $this->f_d,
            'f_d_unit' => $this->f_d_unit,
            'i_tt' => $this->i_tt,
            'i_tt_unit' => $this->i_tt_unit,
            'f_tt' => $this->f_tt,
            'f_tt_unit' => $this->f_tt_unit,
        ];

        $model = new Physics();
        $result = $model->instantaneous($requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            $this->dispatch('math-rendered');

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->current());
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function getConvertedValueProperty()
    {
        if (!$this->detail || !isset($this->detail['iv'])) {
            return 0;
        }

        $baseValue = $this->detail['iv'];
        $factor = $this->conversionFactors[$this->circle_unit_result] ?? 1;
        return round($baseValue * $factor, 5);
    }

    public function render()
    {
         if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.instantaneous-velocity-calculator');
    }
}
