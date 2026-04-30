<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class AverageVelocityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $method = '1';
    public $x = 8;
    public $y = 8;
    public $iv = 'm/s';
    public $fv = 'm/s';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ((array)$inputs as $key => $value) {
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
        $this->reset(['error', 'detail', 'method', 'x', 'y', 'iv', 'fv']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'method' => $this->method,
            'x'      => (float)$this->x,
            'y'      => (float)$this->y,
            'iv'     => $this->iv,
            'fv'     => $this->fv,
        ];

        $model = new Physics();
        $result = $model->ave_vel($request);

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
   
        return view('livewire.calculators.average-velocity-calculator');
    }
}
