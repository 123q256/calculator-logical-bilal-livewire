<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class MolalityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $tab = 'first'; // 'first' or 'second'
    public $find = '1'; // 1: Molality, 2: Amount of Solute, 3: Mass of Solvent
    public $amount_solute = 8;
    public $amount_solute_unit = 'mol';
    public $mass_solvent = 7;
    public $mass_solvent_unit = 'kg';
    public $molality = 7;
    public $molality_unit = 'mol / kg';
    public $density = 997;
    public $density_unit = '1';
    public $molecular_mass_solute = 25;
    public $molecular_mass_solute_unit = '1';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
            if (isset($inputs['type'])) {
                $this->tab = $inputs['type'];
            }
        }
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        $this->detail = null;
        $this->error = null;
    }

    public function updatedFind()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;
        $this->reset(['find', 'amount_solute', 'amount_solute_unit', 'mass_solvent', 'mass_solvent_unit', 'molality', 'molality_unit', 'density', 'density_unit', 'molecular_mass_solute', 'molecular_mass_solute_unit']);

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $inputs = [
            'type' => $this->tab,
            'find' => $this->find,
            'amount_solute' => $this->amount_solute,
            'amount_solute_unit' => $this->amount_solute_unit,
            'mass_solvent' => $this->mass_solvent,
            'mass_solvent_unit' => $this->mass_solvent_unit,
            'molality' => $this->molality,
            'molality_unit' => $this->molality_unit,
            'density' => $this->density,
            'density_unit' => $this->density_unit,
            'molecular_mass_solute' => $this->molecular_mass_solute,
            'molecular_mass_solute_unit' => $this->molecular_mass_solute_unit,
        ];

        $request = (object)$inputs;
        $model = new Chemistry();
        $result = $model->molality($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $inputs);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 50);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $inputs);
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 50);
            JS);
        }
        return view('livewire.calculators.molality-calculator');
    }

}
