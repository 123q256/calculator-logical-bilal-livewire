<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class RoofPitchCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';

    // Input fields
    public $from = 1;

    public $x = 7; // default number
    public $unit = 'm'; // default unit
    public $showUnitDropdown = false;

    public $y = 9;
    public $unit_r = 'm';
    public $showUnitRDropdown = false;

    public $unit_a = 'deg';
    public $showUnitADropdown = false;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

            $this->from = $inputs->from ?? $this->from;
            $this->x = $inputs->x ?? $this->x;
            $this->unit = $inputs->unit ?? $this->unit;
            $this->y = $inputs->y ?? $this->y;
            $this->unit_r = $inputs->unit_r ?? $this->unit_r;
            $this->unit_a = $inputs->unit_a ?? $this->unit_a;
        }
    }

    public function changeFrom()
    {
        // Agar aapko koi aur logic chalana hai change par
    }

    // Dropdown toggles
    public function toggleUnitDropdown()
    {
        $this->showUnitDropdown = !$this->showUnitDropdown;
    }

    public function setUnit($value)
    {
        $this->unit = $value;
        $this->showUnitDropdown = false;
    }


    public function toggleUnitRDropdown()
    {
        $this->showUnitRDropdown = !$this->showUnitRDropdown;
    }

    public function setUnitR($value)
    {
        $this->unit_r = $value;
        $this->showUnitRDropdown = false;
    }

    public function toggleUnitADropdown()
    {
        $this->showUnitADropdown = !$this->showUnitADropdown;
    }

    public function setUnitA($value)
    {
        $this->unit_a = $value;
        $this->showUnitADropdown = false;
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

        return redirect()->to(url()->previous() ?? '/');
    }

    public function calculate()
    {
        $request = (object)[
            'from'       => $this->from,
            'x'          => $this->x,
            'unit'       => $this->unit,
            'y'          => $this->y,
            'unit_r'     => $this->unit_r,
            'unit_a'     => $this->unit_a,
        ];
        // dd($request);
        $model = new Construction();
        $result = $model->roof($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            return redirect()->to(url()->previous() ?? '/');
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
                    const offset = 30;
                    const top = el.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.roof-pitch-calculator');
    }
}
