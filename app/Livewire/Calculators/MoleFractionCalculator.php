<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class MoleFractionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $x = '3.5482';
    public $unit_x = 'Mole';
    public $divide_x = '';
    public $y = '';
    public $unit_y = 'Mole';
    public $divide_y = '';
    public $z = '';
    public $unit_z = 'Mole';
    public $divide_z = '';
    public $a = '';
    public $unit_a = 'Mole';
    public $divide_a = '';

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

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($field, $unit)
    {
        $this->$field = $unit;
        $this->openDropdown = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'x', 'unit_x', 'divide_x', 'y', 'unit_y', 'divide_y', 'z', 'unit_z', 'divide_z', 'a', 'unit_a', 'divide_a']);
        $this->resetErrorBag();

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'x' => $this->x,
            'unit_x' => $this->unit_x,
            'divide_x' => $this->divide_x,
            'y' => $this->y,
            'unit_y' => $this->unit_y,
            'divide_y' => $this->divide_y,
            'z' => $this->z,
            'unit_z' => $this->unit_z,
            'divide_z' => $this->divide_z,
            'a' => $this->a,
            'unit_a' => $this->unit_a,
            'divide_a' => $this->divide_a,
        ];

        $model = new \App\Models\Chemistry();
        $result = $model->mole_frac($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
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
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
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
        return view('livewire.calculators.mole-fraction-calculator');
    }
}
