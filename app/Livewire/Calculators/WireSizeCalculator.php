<?php
 
namespace App\Livewire\Calculators;
 
use App\Models\Physics;
use Livewire\Component;
 
class WireSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type_calc = 'calculator';
    public $lang = [];
 
    // State
    public $unit_type = 'wire_size'; // Mode
    public $type = 'single_phase';
    public $s_voltage = 5.771;
    public $sv_units = 'mV';
    public $voltage_drop = 3;
    public $c_units = 'copper';
    public $current = 1200;
    public $current_unit = 'A';
    public $wire_length = 1200;
    public $wl_units = 'cm';
    public $w_temp = 1200;
    public $wt_units = '°C';
    public $wire_gauge = '4';
    public $wire_diameter = 5.771;
    public $wd_units = 'in';
 
    public $openDropdown = null;
 
    public function mount($type = 'calculator', $lang = [])
    {
        $this->type_calc = $type;
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
 
    public function setUnitType($value)
    {
        $this->unit_type = $value;
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
 
    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }
 
    public function resetForm()
    {
        $this->reset(['error', 'detail', 'type', 's_voltage', 'sv_units', 'voltage_drop', 'c_units', 'current', 'current_unit', 'wire_length', 'wl_units', 'w_temp', 'wt_units', 'wire_gauge', 'wire_diameter', 'wd_units']);
        
        $this->unit_type = 'wire_size';
        $this->type = 'single_phase';
        $this->s_voltage = 5.771;
        $this->sv_units = 'mV';
        $this->voltage_drop = 3;
        $this->c_units = 'copper';
        $this->current = 1200;
        $this->current_unit = 'A';
        $this->wire_length = 1200;
        $this->wl_units = 'cm';
        $this->w_temp = 1200;
        $this->wt_units = '°C';
        $this->wire_gauge = '4';
        $this->wire_diameter = 5.771;
        $this->wd_units = 'in';
 
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }
 
    public function calculate()
    {
        $requestData = [
            'wire'          => $this->unit_type, // Physics model uses $request->wire as submit type
            'unit_type'     => $this->unit_type,
            'type'          => $this->type,
            's_voltage'     => $this->s_voltage,
            'sv_units'      => $this->sv_units,
            'voltage_drop'  => $this->voltage_drop,
            'c_units'       => $this->c_units,
            'current'       => $this->current,
            'current_unit'  => $this->current_unit,
            'wire_length'   => $this->wire_length,
            'wl_units'      => $this->wl_units,
            'w_temp'        => $this->w_temp,
            'wt_units'      => $this->wt_units,
            'wire_gauge'    => $this->wire_gauge,
            'wire_diameter' => $this->wire_diameter,
            'wd_units'      => $this->wd_units,
        ];
 
        $request = (object)$requestData;
 
        $model = new Physics();
        $result = $model->dc_wire($request);
 
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
 
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
 
            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
 
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                        
                        // Trigger math rendering
                        if (typeof renderMathInElement !== 'undefined') {
                            renderMathInElement(el);
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.wire-size-calculator');
    }
}
