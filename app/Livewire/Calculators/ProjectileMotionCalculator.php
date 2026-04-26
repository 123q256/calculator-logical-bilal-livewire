<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class ProjectileMotionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $method = 'tof';
    public $v = '30';
    public $v_unit = 'm/s';
    public $a = '45';
    public $a_unit = 'deg';
    public $h = '0';
    public $h_unit = 'm';
    public $g = '9.80665';
    public $g_unit = 'm/s²';
    public $t = '2';
    public $t_unit = 'sec';

    // Result Units (Reactive)
    public $res_unit = null;
    public $vx_unit = 'm/s';
    public $vy_unit = 'm/s';
    public $g_unit_res = 'm/s²';
    public $hv_unit = 'm/s';
    public $vv_unit = 'm/s';
    public $x_unit = 'm';
    public $y_unit = 'm';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
            $this->initResultUnits();
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function initResultUnits()
    {
        if (!$this->detail) return;
        
        $check = $this->detail['check'] ?? '';
        if ($check === 'tof') $this->res_unit = 'sec';
        elseif ($check === 'fp') $this->res_unit = 'm/s';
        else $this->res_unit = 'm';
        
        $this->vx_unit = 'm/s';
        $this->vy_unit = 'm/s';
        $this->g_unit_res = 'm/s²';
        $this->hv_unit = 'm/s';
        $this->vv_unit = 'm/s';
        $this->x_unit = 'm';
        $this->y_unit = 'm';
    }

    public function convertValue($value, $toUnit, $baseUnit = 'm/s')
    {
        if (!is_numeric($value)) return $value;
        
        $factors = [
            'm/s' => 1, 'km/h' => 3.6, 'ft/s' => 3.28084, 'mph' => 2.23694,
            'm' => 1, 'km' => 0.001, 'cm' => 100, 'mm' => 1000, 'ft' => 3.28084, 'in' => 39.3701, 'yd' => 1.09361, 'mi' => 0.000621371,
            'sec' => 1, 'min' => 1/60, 'hrs' => 1/3600,
            'm/s²' => 1, 'g' => 0.101971621298
        ];

        // If it's a simple 1:1 or unknown unit, return as is
        if (!isset($factors[$toUnit]) || !isset($factors[$baseUnit])) return $value;

        // Convert from base to target
        $converted = $value * ($factors[$toUnit] / $factors[$baseUnit]);
        return round($converted, 4);
    }

    public function toggleDropdown($id)
    {
        $this->openDropdown = ($this->openDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        $this->openDropdown = null;
    }

    public function updated($propertyName)
    {
        if (strpos($propertyName, '_unit') === false && $propertyName !== 'res_unit' && $propertyName !== 'g_unit_res') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->method = 'tof';
        $this->v = '30';
        $this->v_unit = 'm/s';
        $this->a = '45';
        $this->a_unit = 'deg';
        $this->h = '0';
        $this->h_unit = 'm';
        $this->g = '9.80665';
        $this->g_unit = 'm/s²';
        $this->t = '2';
        $this->t_unit = 'sec';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'method' => $this->method,
            'v' => $this->v,
            'v_unit' => $this->v_unit,
            'a' => $this->a,
            'a_unit' => $this->a_unit,
            'h' => $this->h,
            'h_unit' => $this->h_unit,
            'g' => $this->g,
            'g_unit' => $this->g_unit,
            't' => $this->t,
            't_unit' => $this->t_unit,
        ];
        
        if ($requestData['v_unit'] === 'km/h') $requestData['v_unit'] = 'kmh';
        if ($requestData['v_unit'] === 'ft/s') $requestData['v_unit'] = 'fts';
        if ($requestData['g_unit'] === 'm/s²') $requestData['g_unit'] = 'ms2';

        $model = new Physics();
        $result = $model->projectile((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->initResultUnits();
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.projectile-motion-calculator');
    }
}
