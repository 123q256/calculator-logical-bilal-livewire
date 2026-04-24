<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class RampCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form fields
    public $calc = 'one'; // 'one' = simple, 'two' = advance
    public $appli = 'a';
    public $r_type = 'st';
    public $no = '4';
    public $unit = 'cm';
    public $no1 = '5';
    public $unit0 = 'm';
    public $no2 = '5';
    public $unit1 = 'm';
    public $width = '5';
    public $unit2 = 'm';

    public $showDropdown = null;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calc = $inputs->calc ?? 'one';
            $this->appli = $inputs->appli ?? 'a';
            $this->r_type = $inputs->r_type ?? 'st';
            $this->no = $inputs->no ?? '4';
            $this->unit = $inputs->unit ?? 'cm';
            $this->no1 = $inputs->no1 ?? '5';
            $this->unit0 = $inputs->unit0 ?? 'm';
            $this->no2 = $inputs->no2 ?? '5';
            $this->unit1 = $inputs->unit1 ?? 'm';
            $this->width = $inputs->width ?? '5';
            $this->unit2 = $inputs->unit2 ?? 'm';
        }
    }

    public function setCalc($mode)
    {
        $this->calc = $mode;
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function toggleDropdown($name)
    {
        if ($this->showDropdown === $name) {
            $this->showDropdown = null;
        } else {
            $this->showDropdown = $name;
        }
    }

    public function setUnit($dropdown, $unit)
    {
        $this->$dropdown = $unit;
        $this->showDropdown = null;
    }

  public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'calc', 'appli', 'r_type', 'no', 'unit', 'no1', 'unit0', 'no2', 'unit1', 'width', 'unit2', 'showDropdown'
        ]);

        $this->resetErrorBag();
        $this->resetValidation();

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
            'calc'   => $this->calc,
            'appli'  => $this->appli,
            'r_type' => $this->r_type,
            'no'     => $this->no,
            'unit'   => $this->unit,
            'no1'    => $this->no1,
            'unit0'  => $this->unit0,
            'no2'    => $this->no2,
            'unit1'  => $this->unit1,
            'width'  => $this->width,
            'unit2'  => $this->unit2,
        ];

        $model = new Construction();
        $result = $model->ramp($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                $this->error = null;
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
                $this->js('if (window.MathJax && window.MathJax.typesetPromise) { MathJax.typesetPromise(); }');
                $this->dispatch('math-updated');
                return;
            }
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->flash('validation_error', $this->error);
            return redirect()->to(url()->previous() ?? '/');
        } else {
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
        return view('livewire.calculators.ramp-calculator');
    }
}
