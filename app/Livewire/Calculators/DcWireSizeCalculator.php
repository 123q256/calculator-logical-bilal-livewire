<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class DcWireSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $wire = 'wire_size'; // Tab type
    public $calc_type = 'single_phase'; // 'type' in legacy
    public $s_voltage = 120;
    public $sv_units = 'V';
    public $voltage_drop = 3;
    public $c_units = 'copper';
    public $current = 25;
    public $current_unit = 'A';
    public $wire_length = 25;
    public $wl_units = 'm';
    public $w_temp = 25;
    public $wt_units = '°C';
    public $wire_gauge = '3';
    public $wire_diameter = 5.771;
    public $wd_units = 'in';

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

    public function setUnitType($type)
    {
        $this->wire = $type;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($name, $value)
    {
        $this->$name = $value;
        $this->openDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

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
        $requestData = [
            'wire'          => $this->wire,
            'type'          => $this->calc_type,
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
                        
                        if (typeof renderMathInElement !== 'undefined') {
                            renderMathInElement(el);
                        }
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
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
        return view('livewire.calculators.dc-wire-size-calculator');
    }
}
