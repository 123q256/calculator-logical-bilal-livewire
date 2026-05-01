<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class AccelerationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $velo_value = '1'; // 1: Velocity/Time, 2: Displacement/Time, 3: Force/Mass
    public $iv = '';
    public $ivU = 'm/s';
    public $fv = '';
    public $fvU = 'm/s';
    public $ct = '';
    public $ctU = 'sec';
    public $cdis = '';
    public $cdisU = 'm';
    public $mass = '';
    public $masU = 'kg';
    public $force = '';
    public $forceU = 'N';

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

    public function setTab($tab)
    {
        $this->velo_value = $tab;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'openDropdown') {
            $this->detail = null;
            $this->error = null;
        }
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

        $this->velo_value = '1';
        $this->iv = '';
        $this->ivU = 'm/s';
        $this->fv = '';
        $this->fvU = 'm/s';
        $this->ct = '';
        $this->ctU = 'sec';
        $this->cdis = '';
        $this->cdisU = 'm';
        $this->mass = '';
        $this->masU = 'kg';
        $this->force = '';
        $this->forceU = 'N';

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
        // Required field validation
        if ($this->velo_value == '1') {
            if ($this->iv === '' || $this->fv === '' || $this->ct === '') {
                $this->error = $this->lang['error'] ?? 'Please! Check Your Input.';
                $this->detail = null;
                return;
            }
        } elseif ($this->velo_value == '2') {
            if ($this->iv === '' || $this->cdis === '' || $this->ct === '') {
                $this->error = $this->lang['error'] ?? 'Please! Check Your Input.';
                $this->detail = null;
                return;
            }
        } elseif ($this->velo_value == '3') {
            if ($this->force === '' || $this->mass === '') {
                $this->error = $this->lang['error'] ?? 'Please! Check Your Input.';
                $this->detail = null;
                return;
            }
        }

        // Validation to prevent DivisionByZeroError
        if ($this->velo_value == '1' || $this->velo_value == '2') {
            if ($this->ct == 0 && is_numeric($this->ct)) {
                $this->error = "Time cannot be zero.";
                $this->detail = null;
                return;
            }
        } elseif ($this->velo_value == '3') {
            if ($this->mass == 0 && is_numeric($this->mass)) {
                $this->error = "Mass cannot be zero.";
                $this->detail = null;
                return;
            }
        }

        $requestData = [
            'velo_value' => $this->velo_value,
            'iv'         => is_numeric($this->iv) ? (float)$this->iv : null,
            'ivU'        => $this->ivU,
            'fv'         => is_numeric($this->fv) ? (float)$this->fv : null,
            'fvU'        => $this->fvU,
            'ct'         => is_numeric($this->ct) ? (float)$this->ct : null,
            'ctU'        => $this->ctU,
            'cdis'       => is_numeric($this->cdis) ? (float)$this->cdis : null,
            'cdisU'      => $this->cdisU,
            'mass'       => is_numeric($this->mass) ? (float)$this->mass : null,
            'masU'       => $this->masU,
            'force'      => is_numeric($this->force) ? (float)$this->force : null,
            'forceU'     => $this->forceU,
            'acc'        => null,
            'accU'       => 'm/s²',
        ];

        $request = (object)$requestData;

        $model = new Physics();
        $result = $model->acceleration($request);

        if (!empty($result['ans']) || (isset($result['ans']) && $result['ans'] == 0)) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $requestData);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Please fill all required fields correctly.';
            $this->detail = null;
        }
    }

    public function render()
    {
        if (session('scroll_to_result') || $this->detail) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.acceleration-calculator');
    }
}
