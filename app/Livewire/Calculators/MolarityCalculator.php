<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class MolarityCalculator extends Component
{
    public $type = 'calculator';
    public $lang = [];
    public $error = null;
    public $detail = null;

    // Calculation Mode
    public $cal = 'mol'; // Default to "mol" (Molarity)

    // Common properties
    public $mw = 4;

    // Mode-specific properties
    public $mass = 2;
    public $mass_unit = 'pg';

    public $vol = 5;
    public $vol_unit = 'nL';

    public $conc = 2;
    public $conc_unit = 'fM';

    // Dilution mode (rv)
    public $sc = 5; // Stock Concentration
    public $sc_unit = 'fM';
    public $dc = 5; // Desired Concentration
    public $dc_unit = 'fM';
    public $dv = 3; // Desired Volume
    public $dv_unit = 'nL';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
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
    }

    public function toggleOverlay($name)
    {
        $this->showDropdown = ($this->showDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'validation_error']);
        }
    }

    public function calculate()
    {
        $request = (object)[
            'cal' => $this->cal,
            'mass' => $this->mass,
            'mass_unit' => $this->mass_unit,
            'vol' => $this->vol,
            'vol_unit' => $this->vol_unit,
            'conc' => $this->conc,
            'conc_unit' => $this->conc_unit,
            'sc' => $this->sc,
            'sc_unit' => $this->sc_unit,
            'dc' => $this->dc,
            'dc_unit' => $this->dc_unit,
            'dv' => $this->dv,
            'dv_unit' => $this->dv_unit,
            'mw' => $this->mw,
        ];

        $model = new Chemistry();
        $result = $model->molarity($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('calculator_back_inputs', (array)$request);
                session()->flash('scroll_to_result', true);
                return redirect()->to(url()->previous() ?? '/');
            }
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->flash('validation_error', $this->error);
            session()->flash('calculator_back_inputs', (array)$request);
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'cal', 'mass', 'mass_unit', 'vol', 'vol_unit', 'conc', 'conc_unit', 
            'sc', 'sc_unit', 'dc', 'dc_unit', 'dv', 'dv_unit', 'mw', 
            'detail', 'error', 'showDropdown'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error']);
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function render()
    {
          if (session('scroll_to_result')) {
            $this->js(<<<'JS'
        const el = document.getElementById('result-section');
        if (el) {
            const offset = 30;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
       JS);
        }
        return view('livewire.calculators.molarity-calculator');
    }
}
