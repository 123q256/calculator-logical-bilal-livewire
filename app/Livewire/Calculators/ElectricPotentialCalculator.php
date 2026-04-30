<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class ElectricPotentialCalculator extends Component
{
    public $potential_type = 'single-point';
    public $charge = '0.0000004';
    public $charge_unit = 'PC';
    public $distance = 10;
    public $distance_unit = 'nm';
    public $U = 10;
    public $U_unit = 'J';
    public $points = 2;
    public $E = 1;

    public $Q = [];
    public $unit_Q = [];
    public $R = [];
    public $unit_R = [];

    public $dropdowns = [];

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->potential_type = $inputs->potential_type ?? 'single-point';
            $this->charge = $inputs->charge ?? '0.0000004';
            $this->charge_unit = $inputs->charge_unit ?? 'PC';
            $this->distance = $inputs->distance ?? 10;
            $this->distance_unit = $inputs->distance_unit ?? 'nm';
            $this->U = $inputs->U ?? 10;
            $this->U_unit = $inputs->U_unit ?? 'J';
            $this->points = $inputs->points ?? 2;
            $this->E = $inputs->E ?? 1;
            $this->Q = (array)($inputs->Q ?? []);
            $this->unit_Q = (array)($inputs->unit_Q ?? []);
            $this->R = (array)($inputs->R ?? []);
            $this->unit_R = (array)($inputs->unit_R ?? []);
        }

        $this->initMultiPoint();
    }

    public function initMultiPoint()
    {
        for ($i = 0; $i < 20; $i++) {
            if (!isset($this->Q[$i])) $this->Q[$i] = '';
            if (!isset($this->unit_Q[$i])) $this->unit_Q[$i] = 'mC';
            if (!isset($this->R[$i])) $this->R[$i] = '';
            if (!isset($this->unit_R[$i])) $this->unit_R[$i] = 'mC';
        }
    }

    public function toggleDropdown($id)
    {
        $this->dropdowns[$id] = !($this->dropdowns[$id] ?? false);
    }

    public function setUnit($property, $unit, $dropdownId = null)
    {
        if (strpos($property, '.') !== false) {
            $parts = explode('.', $property);
            $this->{$parts[0]}[$parts[1]] = $unit;
        } else {
            $this->{$property} = $unit;
        }
        
        if ($dropdownId) {
            $this->dropdowns[$dropdownId] = false;
        }
        $this->detail = null;
    }

    public function updatedPoints($value)
    {
        if ($value > 20) {
            $this->points = 20;
        }
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'potential_type') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->potential_type = 'single-point';
        $this->charge = '0.0000004';
        $this->charge_unit = 'PC';
        $this->distance = 10;
        $this->distance_unit = 'nm';
        $this->U = 10;
        $this->U_unit = 'J';
        $this->points = 2;
        $this->E = 1;
        $this->Q = [];
        $this->unit_Q = [];
        $this->R = [];
        $this->unit_R = [];
        $this->initMultiPoint();

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
        $request = (object)[
            'potential_type' => $this->potential_type,
            'charge'         => (float)($this->charge ?? 0),
            'charge_unit'    => $this->charge_unit,
            'distance'       => (float)($this->distance ?? 0),
            'distance_unit'  => $this->distance_unit,
            'U'              => (float)($this->U ?? 0),
            'U_unit'         => $this->U_unit,
            'points'         => (int)($this->points ?? 0),
            'E'              => (float)($this->E ?? 1),
            'Q'              => array_map(fn($v) => (float)($v ?: 0), $this->Q),
            'unit_Q'         => $this->unit_Q,
            'R'              => array_map(fn($v) => (float)($v ?: 0), $this->R),
            'unit_R'         => $this->unit_R,
        ];

        $model = new Physics();
        $result = $model->electricPotential($request);

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
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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
    

        return view('livewire.calculators.electric-potential-calculator');
    }
}
