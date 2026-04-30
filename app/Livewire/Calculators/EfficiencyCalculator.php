<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class EfficiencyCalculator extends Component
{
    public $solve = '1';
    public $en_in = 12;
    public $en_in_unit = 'J';
    public $en_ou = 12;
    public $en_ou_unit = 'J';
    public $en_ef = 7;

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
            $this->solve = $inputs->solve ?? '1';
            $this->en_in = $inputs->en_in ?? 12;
            $this->en_in_unit = $inputs->en_in_unit ?? 'J';
            $this->en_ou = $inputs->en_ou ?? 12;
            $this->en_ou_unit = $inputs->en_ou_unit ?? 'J';
            $this->en_ef = $inputs->en_ef ?? 7;
        }
    }

    public function updated($propertyName)
    {
        if (strpos($propertyName, 'dropdowns') === false) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($id)
    {
        $this->dropdowns[$id] = !($this->dropdowns[$id] ?? false);
    }

    public function setUnit($property, $unit, $dropdownId = null)
    {
        $this->{$property} = $unit;
        if ($dropdownId) {
            $this->dropdowns[$dropdownId] = false;
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->solve = '1';
        $this->en_in = 12;
        $this->en_in_unit = 'J';
        $this->en_ou = 12;
        $this->en_ou_unit = 'J';
        $this->en_ef = 7;

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
            'solve'      => $this->solve,
            'en_in'      => (float)$this->en_in,
            'en_in_unit' => $this->en_in_unit,
            'en_ou'      => (float)$this->en_ou,
            'en_ou_unit' => $this->en_ou_unit,
            'en_ef'      => (float)$this->en_ef,
        ];

        $model = new Physics();
        $result = $model->efficiency($request);

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
   
        return view('livewire.calculators.efficiency-calculator');
    }
}
