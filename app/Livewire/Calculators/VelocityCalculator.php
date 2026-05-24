<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class VelocityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $circle_unit_result;
    public $base_ans;
    public $base_ans_t;

    public function updatedCircleUnitResult()
    {
        if (!$this->detail || !isset($this->base_ans)) return;

        $conversionFactors = [
            'Distance' => ['m'=>1,'cm'=>100,'in'=>39.3701,'ft'=>3.28084,'yd'=>1.09361,'km'=>0.001,'mi'=>0.000621371],
            'Velocity' => ['m/s'=>1,'km/h'=>3.6,'ft/s'=>3.28084,'mph'=>2.23694,'kn'=>1.94384,'ft/m'=>196.8504,'cm/s'=>100,'m/min'=>60],
            'Avrage Velocity' => ['m/s'=>1,'km/h'=>3.6,'ft/s'=>3.28084,'mph'=>2.23694,'kn'=>1.94384,'ft/m'=>196.8504,'cm/s'=>100,'m/min'=>60],
            'Final Velocity' => ['m/s'=>1,'km/h'=>3.6,'ft/s'=>3.28084,'mph'=>2.23694,'kn'=>1.94384,'ft/m'=>196.8504,'cm/s'=>100,'m/min'=>60],
            'Initial Velocity' => ['m/s'=>1,'km/h'=>3.6,'ft/s'=>3.28084,'mph'=>2.23694,'kn'=>1.94384,'ft/m'=>196.8504,'cm/s'=>100,'m/min'=>60],
            'Time' => ['s'=>1,'m'=>60,'h'=>3600,'d'=>86400,'w'=>604800,'mo'=>2.628e+6,'y'=>3.154e+7],
            'Acceleration' => ['m/s²'=>1,'cm/s²'=>100,'in/s²'=>39.3701,'ft/s²'=>3.28084,'yd/s²'=>1.09361,'km/s²'=>0.001,'mi/s²'=>0.000621371,'g'=>0.10197162129779]
        ];

        $unitType = $this->base_ans_t;
        $unit = $this->circle_unit_result;

        if ($unitType == 'Time' && isset($conversionFactors[$unitType][$unit])) {
            $conversionFactor = $conversionFactors[$unitType][$unit];
            $newValue = (float)$this->base_ans / $conversionFactor;
            $this->detail['ans'] = (string)round($newValue, 10);
            $this->detail['unit'] = $unit;
        } else if (isset($conversionFactors[$unitType][$unit])) {
            $conversionFactor = $conversionFactors[$unitType][$unit];
            $newValue = (float)$this->base_ans * $conversionFactor;
            $this->detail['ans'] = (string)round($newValue, 10);
            $this->detail['unit'] = $unit;
        }
    }

    // Properties for Distance Calculation (velo_value = 1)
    public $velo_value = '1';
    public $dem = 't';
    public $x = 1; // distance
    public $dis_unit = 'm';
    public $y; // time
    public $time_unit = 'sec';
    public $vel = 3; // velocity
    public $val_units = 'm/s';

    // Properties for Average Velocity (velo_value = 3)
    public $z = [6, 5]; // array of velocities
    public $val_unit = ['m/s', 'm/s'];
    public $aty = [2, 2]; // array of times
    public $ytime_unit = ['sec', 'sec'];

    // Properties for Acceleration (velo_value = 2)
    public $collection = '1';
    public $acc = 5;
    public $acc_unit = 'm/s²';
    public $y1 = 4; // time
    public $atime_unit = 'sec';
    public $z1 = 1; // final velocity
    public $fv_unit = 'm/s';
    public $x1; // initial velocity
    public $iv_unit = 'm/s';

    public $openDropdown = null;

    public function toggleDropdown($dropdown)
    {
        $this->openDropdown = $this->openDropdown === $dropdown ? null : $dropdown;
    }

    public function closeDropdown()
    {
        $this->openDropdown = null;
    }

    public function setUnit($property, $value, $index = null)
    {
        if ($index !== null) {
            $this->{$property}[$index] = $value;
        } else {
            $this->{$property} = $value;
            if ($property === 'circle_unit_result') {
                $this->updatedCircleUnitResult();
            }
        }
        $this->closeDropdown();
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        if (session()->has('calculator_result')) {
            $this->detail = $this->sanitizeForLivewire(session('calculator_result'));
        }
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (is_array($inputs)) {
                $this->velo_value = $inputs['velo_value'] ?? '1';
                $this->dem = $inputs['dem'] ?? 'av';
                $this->collection = $inputs['collection'] ?? '1';
                $this->x = $inputs['x'] ?? null;
                $this->dis_unit = $inputs['dis_unit'] ?? 'm';
                $this->y = $inputs['y'] ?? null;
                $this->time_unit = $inputs['time_unit'] ?? 'sec';
                $this->vel = $inputs['vel'] ?? null;
                $this->val_units = $inputs['val_units'] ?? 'm/s';
                
                $this->z = $inputs['z'] ?? [''];
                $this->val_unit = $inputs['val_unit'] ?? ['m/s'];
                $this->aty = $inputs['aty'] ?? [''];
                $this->ytime_unit = $inputs['ytime_unit'] ?? ['sec'];
                
                $this->acc = $inputs['acc'] ?? null;
                $this->acc_unit = $inputs['acc_unit'] ?? 'm/s²';
                $this->y1 = $inputs['y1'] ?? null;
                $this->atime_unit = $inputs['atime_unit'] ?? 'sec';
                $this->z1 = $inputs['z1'] ?? null;
                $this->fv_unit = $inputs['fv_unit'] ?? 'm/s';
                $this->x1 = $inputs['x1'] ?? null;
                $this->iv_unit = $inputs['iv_unit'] ?? 'm/s';
            }
        }
    }

    public function addRow()
    {
        $this->z[] = '';
        $this->val_unit[] = 'm/s';
        $this->aty[] = '';
        $this->ytime_unit[] = 'sec';
    }

    public function removeRow($index)
    {
        if (count($this->z) > 1) {
            unset($this->z[$index]);
            unset($this->val_unit[$index]);
            unset($this->aty[$index]);
            unset($this->ytime_unit[$index]);
            
            // Re-index arrays
            $this->z = array_values($this->z);
            $this->val_unit = array_values($this->val_unit);
            $this->aty = array_values($this->aty);
            $this->ytime_unit = array_values($this->ytime_unit);
        }
    }

    private function sanitizeForLivewire($data)
    {
        if (is_null($data)) return null;

        $sanitized = json_decode(json_encode($data), true);
        if (is_array($sanitized)) {
            array_walk_recursive($sanitized, function (&$item) {
                if (is_float($item)) {
                    if (is_nan($item)) {
                        $item = 'NaN';
                    } elseif (is_infinite($item)) {
                        $item = $item > 0 ? 'Infinity' : '-Infinity';
                    } else {
                        $item = (string) $item;
                    }
                }
            });
        }
        return $sanitized;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->openDropdown = null;
        $this->circle_unit_result = null;
        $this->base_ans = null;
        $this->base_ans_t = null;
        
        $this->velo_value = '1';
        $this->dem = 't';
        $this->collection = '1';
        $this->x = 1;
        $this->dis_unit = 'm';
        $this->y = null;
        $this->time_unit = 'sec';
        $this->vel = 3;
        $this->val_units = 'm/s';
        
        $this->z = [6, 5];
        $this->val_unit = ['m/s', 'm/s'];
        $this->aty = [2, 2];
        $this->ytime_unit = ['sec', 'sec'];
        
        $this->acc = 5;
        $this->acc_unit = 'm/s²';
        $this->y1 = 4;
        $this->atime_unit = 'sec';
        $this->z1 = 1;
        $this->fv_unit = 'm/s';
        $this->x1 = null;
        $this->iv_unit = 'm/s';
        $this->iv_unit = 'm/s';

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

    public function updated($propertyName)
    {
        if ($propertyName !== 'circle_unit_result') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        // Build the request array exactly as expected by Physics::velocity
        // The Physics::velocity method accesses properties using object notation ($request->z)
        // for Average Velocity, wait, let me check the Model code again.
        // In the Physics::velocity code it does: $vs = $request->z; $avt = $request->aty;
        // So we must use an anonymous class for those properties, or update it.
        // Actually, $request in Physics is expected to be an array for most things, but uses $request->z for some.
        // Let's create an anonymous class that supports array access and object access.
        $request = new class(
            $this->velo_value,
            $this->dem,
            $this->collection,
            $this->dis_unit,
            $this->time_unit,
            $this->val_unit,
            $this->val_units,
            $this->iv_unit,
            $this->acc_unit,
            $this->atime_unit,
            $this->fv_unit,
            $this->x,
            $this->y,
            $this->vel,
            $this->z,
            $this->aty,
            $this->ytime_unit,
            $this->acc,
            $this->y1,
            $this->z1,
            $this->x1
        ) implements \ArrayAccess {
            public $velo_value, $dem, $collection, $dis_unit, $time_unit, $val_unit, $val_units;
            public $iv_unit, $acc_unit, $atime_unit, $fv_unit, $x, $y, $vel, $z, $aty, $ytime_unit, $acc, $y1, $z1, $x1;
            
            public function __construct(
                $velo_value, $dem, $collection, $dis_unit, $time_unit, $val_unit, $val_units,
                $iv_unit, $acc_unit, $atime_unit, $fv_unit, $x, $y, $vel, $z, $aty, $ytime_unit, $acc, $y1, $z1, $x1
            ) {
                $this->velo_value = $velo_value; $this->dem = $dem; $this->collection = $collection;
                $this->dis_unit = $dis_unit; $this->time_unit = $time_unit; $this->val_unit = $val_unit;
                $this->val_units = $val_units; $this->iv_unit = $iv_unit; $this->acc_unit = $acc_unit;
                $this->atime_unit = $atime_unit; $this->fv_unit = $fv_unit; $this->x = $x;
                $this->y = $y; $this->vel = $vel; $this->z = $z; $this->aty = $aty;
                $this->ytime_unit = $ytime_unit; $this->acc = $acc; $this->y1 = $y1;
                $this->z1 = $z1; $this->x1 = $x1;
            }
            
            public function offsetExists($offset): bool { return property_exists($this, $offset); }
            public function offsetGet($offset): mixed { return $this->$offset; }
            public function offsetSet($offset, $value): void { $this->$offset = $value; }
            public function offsetUnset($offset): void { unset($this->$offset); }
            public function all() { return get_object_vars($this); }
        };

        $model = new \App\Models\Physics();
        $result = $model->velocity($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $sanitizedResult = $this->sanitizeForLivewire($result);
            session()->flash('calculator_result', $sanitizedResult);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request->all());
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $sanitizedResult;
                $this->base_ans = $sanitizedResult['ans'] ?? 0;
                $this->base_ans_t = $sanitizedResult['ans_t'] ?? '';
                $this->circle_unit_result = $sanitizedResult['unit'] ?? '';
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.velocity-calculator');
    }
}
