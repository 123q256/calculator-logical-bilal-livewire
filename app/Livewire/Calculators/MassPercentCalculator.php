<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class MassPercentCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $find = '1';
    public $mass_solute = 12;
    public $mass_solute_unit = 'µg';
    public $mass_solvent = 20;
    public $mass_solvent_unit = 'µg';
    public $mass_percentage = 20;
    public $mass_chemical = 20;
    public $mass_chemical_unit = 'kg';
    public $total_mass_compound = 20;
    public $total_mass_compound_unit = 'kg';
    
    public $first_value = 30;
    public $first_value_unit = 'H (Hydrogen)';
    public $second_value = null;
    public $second_value_unit = 'H (Hydrogen)';
    public $third_value = null;
    public $third_value_unit = 'H (Hydrogen)';
    public $four_value = null;
    public $four_value_unit = 'H (Hydrogen)';
    public $five_value = null;
    public $five_value_unit = 'H (Hydrogen)';
    public $six_value = null;
    public $six_value_unit = 'H (Hydrogen)';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->find = $inputs->find ?? '1';
            $this->mass_solute = $inputs->mass_solute ?? 12;
            $this->mass_solute_unit = $inputs->mass_solute_unit ?? 'µg';
            $this->mass_solvent = $inputs->mass_solvent ?? 20;
            $this->mass_solvent_unit = $inputs->mass_solvent_unit ?? 'µg';
            $this->mass_percentage = $inputs->mass_percentage ?? 20;
            $this->mass_chemical = $inputs->mass_chemical ?? 20;
            $this->mass_chemical_unit = $inputs->mass_chemical_unit ?? 'kg';
            $this->total_mass_compound = $inputs->total_mass_compound ?? 20;
            $this->total_mass_compound_unit = $inputs->total_mass_compound_unit ?? 'kg';
            $this->first_value = $inputs->first_value ?? 30;
            $this->first_value_unit = $inputs->first_value_unit ?? 'H (Hydrogen)';
            $this->second_value = $inputs->second_value ?? null;
            $this->second_value_unit = $inputs->second_value_unit ?? 'H (Hydrogen)';
            $this->third_value = $inputs->third_value ?? null;
            $this->third_value_unit = $inputs->third_value_unit ?? 'H (Hydrogen)';
            $this->four_value = $inputs->four_value ?? null;
            $this->four_value_unit = $inputs->four_value_unit ?? 'H (Hydrogen)';
            $this->five_value = $inputs->five_value ?? null;
            $this->five_value_unit = $inputs->five_value_unit ?? 'H (Hydrogen)';
            $this->six_value = $inputs->six_value ?? null;
            $this->six_value_unit = $inputs->six_value_unit ?? 'H (Hydrogen)';
        }
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
        $this->find = '1';
        $this->mass_solute = 12;
        $this->mass_solvent = 20;
        $this->mass_percentage = 20;
        $this->mass_chemical = 20;
        $this->total_mass_compound = 20;
        $this->first_value = 30;
        $this->second_value = null;
        $this->third_value = null;
        $this->four_value = null;
        $this->five_value = null;
        $this->six_value = null;

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
            'find'                     => $this->find,
            'mass_solute'              => $this->mass_solute,
            'mass_solute_unit'         => $this->mass_solute_unit,
            'mass_solvent'             => $this->mass_solvent,
            'mass_solvent_unit'        => $this->mass_solvent_unit,
            'mass_percentage'          => $this->mass_percentage,
            'mass_chemical'            => $this->mass_chemical,
            'mass_chemical_unit'       => $this->mass_chemical_unit,
            'total_mass_compound'      => $this->total_mass_compound,
            'total_mass_compound_unit' => $this->total_mass_compound_unit,
            'first_value'              => $this->first_value,
            'first_value_unit'         => $this->first_value_unit,
            'second_value'             => $this->second_value,
            'second_value_unit'        => $this->second_value_unit,
            'third_value'              => $this->third_value,
            'third_value_unit'         => $this->third_value_unit,
            'four_value'               => $this->four_value,
            'four_value_unit'          => $this->four_value_unit,
            'five_value'               => $this->five_value,
            'five_value_unit'          => $this->five_value_unit,
            'six_value'                => $this->six_value,
            'six_value_unit'           => $this->six_value_unit,
        ];

        $model = new Chemistry();
        $result = $model->mass($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.mass-percent-calculator');
    }
}
