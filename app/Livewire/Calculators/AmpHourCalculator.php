<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class AmpHourCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type_calc = 'calculator';
    public $lang = [];

    // Form properties
    public $type = 'first'; // 'first' (Battery Capacity), 'second' (Battery Life)
    public $find = 1;
    public $vol = 12;
    public $bc = 32;
    public $bc_unit = 'Ah';
    public $wt_hour = 26.4;
    public $wt_hour_unit = 'kJ';
    public $c_rate = 2;
    public $load_size = 2;
    public $load_duration = 2;
    public $temp_chk = false;
    public $age_chk = false;
    public $batteries = 'gel';

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

    public function updatedType()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updatedFind()
    {
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
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'type', 'find', 'vol', 'bc', 'bc_unit', 'wt_hour', 'wt_hour_unit', 'c_rate', 'load_size', 'load_duration', 'temp_chk', 'age_chk', 'batteries']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'type'          => $this->type,
            'find'          => $this->find,
            'vol'           => $this->vol,
            'bc'            => $this->bc,
            'bc_unit'       => $this->bc_unit,
            'wt_hour'       => $this->wt_hour,
            'wt_hour_unit'  => $this->wt_hour_unit,
            'c_rate'        => $this->c_rate,
            'load_size'     => $this->load_size,
            'load_duration' => $this->load_duration,
            'temp_chk'      => $this->temp_chk ? 'checked' : null,
            'age_chk'       => $this->age_chk ? 'checked' : null,
            'batteries'     => $this->batteries,
        ];

        // The Physics model's amp() method uses $request->input(), which stdClass does not have.
        // We use an anonymous class to mock the request object.
        $request = new class($requestData) {
            private $data;
            public function __construct($data) { $this->data = $data; }
            public function input($key, $default = null) { return $this->data[$key] ?? $default; }
            public function __get($key) { return $this->data[$key] ?? null; }
            public function all() { return $this->data; }
        };

        $model = new Physics();
        $result = $model->amp($request);

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
        return view('livewire.calculators.amp-hour-calculator');
    }
}
