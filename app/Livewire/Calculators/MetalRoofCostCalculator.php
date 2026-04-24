<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class MetalRoofCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $roof_type = 'yes'; // yes for flat, no for pitched
    public $r_length = '100';
    public $rl_units = 'ft';
    public $r_width = '100';
    public $rw_units = 'ft';
    public $roof_pitch = '1:12';
    public $p_length = '16';
    public $pl_units = 'ft';
    public $p_width = '16';
    public $pw_units = 'ft';
    public $cost = '3';

    public $showDropdown = null;

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

    public function toggleOverlay($dropdown)
    {
        $this->showDropdown = ($this->showDropdown === $dropdown) ? null : $dropdown;
    }

    public function setUnit($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'roof_type', 'r_length', 'rl_units', 'r_width', 'rw_units', 'roof_pitch', 'p_length', 'pl_units', 'p_width', 'pw_units', 'cost']);
        $this->resetErrorBag();
        session()->forget(['calculator_result', 'validation_error', 'calculator_back_inputs', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $this->error = null;
        $request = (object)[
            'roof_type' => $this->roof_type,
            'r_length' => $this->r_length,
            'rl_units' => $this->rl_units,
            'r_width' => $this->r_width,
            'rw_units' => $this->rw_units,
            'roof_pitch' => $this->roof_pitch,
            'p_length' => $this->p_length,
            'pl_units' => $this->pl_units,
            'p_width' => $this->p_width,
            'pw_units' => $this->pw_units,
            'cost' => $this->cost,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->metal($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (array)$request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
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
        return view('livewire.calculators.metal-roof-cost-calculator');
    }
}
