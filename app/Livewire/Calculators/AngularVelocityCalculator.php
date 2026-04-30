<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class AngularVelocityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Main Method (0, 1, 2)
    public $method = "0";

    // Sub-methods (Radios)
    public $g = 'ang_vel';   // for method 0
    public $gg = 'ang_vel1'; // for method 1

    // Inputs
    public $ac = 8;        // Angular Change
    public $ac1 = 'deg';   // Angular Change Unit
    public $t = 10;        // Time
    public $t1 = 'sec';    // Time Unit
    public $av = 10;       // Angular Velocity
    public $av1 = 'rad/s'; // Angular Velocity Unit
    public $vel = 10;      // Linear Velocity
    public $vel1 = 'm/s';  // Linear Velocity Unit
    public $rad = 10;      // Radius
    public $rad1 = 'mm';   // Radius Unit
    public $rpm = 10;      // RPM
    public $rds_m = 1.5;   // Radius M
    public $rds_m1 = 'm';  // Radius M Unit

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

    public function setMethod($val)
    {
        $this->method = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function setG($val)
    {
        $this->g = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function setGG($val)
    {
        $this->gg = $val;
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
        $this->reset(['error', 'detail', 'method', 'g', 'gg', 'ac', 'ac1', 't', 't1', 'av', 'av1', 'vel', 'vel1', 'rad', 'rad1', 'rpm', 'rds_m', 'rds_m1']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        // Map G/GG to the 'check' field as expected by the model
        $check = '';
        if ($this->method == '0') {
            if ($this->g == 'ang_vel') $check = 'g1_value';
            elseif ($this->g == 'ang_chnge') $check = 'g2_value';
            elseif ($this->g == 'time') $check = 'g3_value';
        } elseif ($this->method == '1') {
            if ($this->gg == 'ang_vel1') $check = 'g11_value';
            elseif ($this->gg == 'velocity') $check = 'g12_value'; // model uses g12 for velocity
            elseif ($this->gg == 'radius') $check = 'g13_value';   // model uses g13 for radius
        }

        $request = [
            'method' => $this->method,
            'g'      => $this->g,
            'gg'     => $this->gg,
            'check'  => $check,
            'ac'     => $this->ac,
            'ac1'    => $this->ac1,
            't'      => $this->t,
            't1'     => $this->t1,
            'av'     => $this->av,
            'av1'    => $this->av1,
            'vel'    => $this->vel,
            'vel1'   => $this->vel1,
            'rad'    => $this->rad,
            'rad1'   => $this->rad1,
            'rpm'    => $this->rpm,
            'rds_m'  => $this->rds_m,
            'rds_m1' => $this->rds_m1,
        ];

        $model = new Physics();
        $result = $model->angular($request);

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
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
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
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.angular-velocity-calculator');
    }
}
