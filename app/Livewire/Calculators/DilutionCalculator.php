<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class DilutionCalculator extends Component
{
    public $type = 'calculator';
    public $lang = [];
    public $error = null;
    public $detail = null;

    // Calculation Mode
    public $cal = 'v2'; // Default to "v2"

    // Inputs
    public $c1 = 2;
    public $c1_unit = 'M';
    public $v1 = 3;
    public $v1_unit = 'mL';
    public $c2 = 4;
    public $c2_unit = 'M';
    public $v2 = 4;
    public $v2_unit = 'mL';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            $this->detail = session('calculator_result');
            $this->error = session('validation_error');
            if (session()->has('calculator_back_inputs')) {
                $inputs = (array)session('calculator_back_inputs');
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
            'c1' => $this->c1,
            'c1_unit' => $this->c1_unit,
            'v1' => $this->v1,
            'v1_unit' => $this->v1_unit,
            'c2' => $this->c2,
            'c2_unit' => $this->c2_unit,
            'v2' => $this->v2,
            'v2_unit' => $this->v2_unit,
        ];

        $model = new Chemistry();
        $result = $model->dilution($request);

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
            'cal', 'c1', 'c1_unit', 'v1', 'v1_unit', 'c2', 'c2_unit', 'v2', 'v2_unit',
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.dilution-calculator');
    }
}
