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

            $this->from   = $inputs->from   ?? $this->from;
            $this->x      = $inputs->x      ?? $this->x;
            $this->unit   = $inputs->unit   ?? $this->unit;
            $this->y      = $inputs->y      ?? $this->y;
            $this->unit_r = $inputs->unit_r ?? $this->unit_r;
            $this->unit_a = $inputs->unit_a ?? $this->unit_a;
        }
    }

    public function changeFrom()
    {
        $this->detail = null;
        $this->error  = null;

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'validation_error']);
        }
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

        $this->error  = null;
        $this->detail = null;

        $this->from   = 1;
        $this->x      = 7;
        $this->unit   = 'm';
        $this->y      = 9;
        $this->unit_r = 'm';
        $this->unit_a = 'deg';

        $this->showUnitDropdown  = false;
        $this->showUnitRDropdown = false;
        $this->showUnitADropdown = false;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result',
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'from'   => $this->from,
            'x'      => $this->x,
            'unit'   => $this->unit,
            'y'      => $this->y,
            'unit_r' => $this->unit_r,
            'unit_a' => $this->unit_a,
        ];

        $model  = new Construction();
        $result = $model->roof($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error  = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        } else {
            $this->error  = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            }
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
        return view('livewire.calculators.roof-pitch-calculator');
    }
}
