<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class MomentumCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Tabs & Modes
    public $tab = 'velocity';
    public $to_cal = 'mom';
    public $to_calr = 'mom_t';

    // Linear Inputs
    public $mass = 12;
    public $velocity = 12;
    public $mom = 13;
    public $unit_m = 'kg';
    public $unit_v = 'miles/s';
    public $unit_k = 'kg-ms';

    // Rotational Inputs
    public $mom_t = 13;
    public $force = 20;
    public $time = 20;
    public $unit_mt = 'kg-ms';
    public $unit_i = 'N'; // mapped to unit_f in model
    public $unit_t = 's';

    public $openDropdown = null;

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
        if ($propertyName !== 'openDropdown') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function setTab($val)
    {
        $this->tab = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function selectToCal($val)
    {
        $this->to_cal = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function selectToCalr($val)
    {
        $this->to_calr = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'tab', 'to_cal', 'to_calr', 'mass', 'velocity', 'mom', 'unit_m', 'unit_v', 'unit_k', 'mom_t', 'force', 'time', 'unit_mt', 'unit_i', 'unit_t']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = [
            'type'    => $this->tab,
            'to_cal'  => $this->to_cal,
            'to_calr' => $this->to_calr,
            'mass'    => $this->mass,
            'velocity'=> $this->velocity,
            'mom'     => $this->mom,
            'unit_m'  => $this->unit_m,
            'unit_v'  => $this->unit_v,
            'unit_k'  => $this->unit_k,
            'mom_t'   => $this->mom_t,
            'force'   => $this->force,
            'time'    => $this->time,
            'unit_mt' => $this->unit_mt,
            'unit_f'  => $this->unit_i, // Model expects unit_f
            'unit_t'  => $this->unit_t,
        ];

        $model = new Physics();
        $result = $model->momentum($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            
            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
        }
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
        return view('livewire.calculators.momentum-calculator');
    }
}
