<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class KineticEnergyCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $submit = 'linear';
    public $to_cal = 'kin';
    public $to_calr = 'r_kin';
    
    // Linear values
    public $mass = 53;
    public $velocity = 52600;
    public $kin = 52600;
    public $unit_m = 'kg';
    public $unit_v = 'miles/s';
    public $unit_k = 'j';

    // Rotational values
    public $moment = 1067;
    public $a_velocity = 31.4;
    public $r_kin = 52600;
    public $unit_i = 'kg*m²';
    public $unit_k_r = 'j';
    public $unit_v_r = 'rad/s';

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

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
    }

    public function setTab($tab)
    {
        $this->submit = $tab;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'submit', 'to_cal', 'to_calr', 'mass', 'velocity', 'kin', 'unit_m', 'unit_v', 'unit_k', 'moment', 'a_velocity', 'r_kin', 'unit_i', 'unit_k_r', 'unit_v_r']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = [
            'submit'     => $this->submit,
            'to_cal'     => $this->to_cal,
            'to_calr'    => $this->to_calr,
            'mass'       => $this->mass,
            'velocity'   => $this->velocity,
            'kin'        => $this->kin,
            'unit_m'     => $this->unit_m,
            'unit_v'     => $this->unit_v,
            'unit_k'     => $this->unit_k,
            'moment'     => $this->moment,
            'a_velocity' => $this->a_velocity,
            'r_kin'      => $this->r_kin,
            'unit_i'     => $this->unit_i,
            'unit_k_r'   => $this->unit_k_r,
            'unit_v_r'   => $this->unit_v_r,
        ];

        $model = new Physics();
        $result = $model->kinetic($request);

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
        return view('livewire.calculators.kinetic-energy-calculator');
    }
}
