<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class GramsToMolesCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $chemical_selection = '1';
    public $chemical_name = '18.015';
    public $mm = 18.015;
    public $mm_unit = 'g/mol';
    public $unit = '1';
    public $m = 5;
    public $m_unit = 'ng';
    public $nm = 1;
    public $nm_unit = 'mol';

    public $chemical_options = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $this->updateChemicalOptions();

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if(isset($inputs->chemical_selection)){
                $this->chemical_selection = $inputs->chemical_selection;
                $this->updateChemicalOptions();
                $this->chemical_name = $inputs->chemical_name ?? $this->chemical_name;
                $this->mm = $inputs->mm;
                $this->mm_unit = $inputs->mm_unit;
                $this->unit = $inputs->unit;
                $this->m = $inputs->m;
                $this->m_unit = $inputs->m_unit;
                $this->nm = $inputs->nm;
                $this->nm_unit = $inputs->nm_unit;
            }
        }
    }

    public function updatedChemicalSelection()
    {
        $this->updateChemicalOptions();
        if ($this->chemical_selection != '7') {
            if (!empty($this->chemical_options)) {
                $this->chemical_name = array_key_first($this->chemical_options);
                $this->mm = $this->chemical_name;
            }
        } else {
            $this->mm = 10;
        }
    }

    public function updatedChemicalName()
    {
        $this->mm = $this->chemical_name;
    }

    public function updateChemicalOptions()
    {
        if ($this->chemical_selection == '1') {
            $this->chemical_options = ['18.015'=>'Water(H₂O)','28.014'=>'Nitrogen(N₂)','31.999'=>'Oxygen(O₂)','2.016'=>'Hydrogen(H₂)','4.003'=>'Helium(He)','44.01'=>'Carbon Dioxide(CO₂)','17.031'=>'Ammonia(NH₃)','34.081'=>'Hydrogen sulfide(H₂S)','119.378'=>'Choloform(CHCL₃)'];
        } elseif ($this->chemical_selection == '2') {
            $this->chemical_options = ['58.443'=>'Sodium Chloride(NaCl)','74.551'=>'Potassium Chloride(KCL)','95.211'=>'Magnesium Chloride(MgCl₂)','110.984'=>'Calcium Chloride(CaCI₂)','53.491'=>'Ammonium Chloride(NH₄Cl)','84.995'=>'Sodium Nitrate(NaNO₃)','101.103'=>'Potassium Nitrate(KNO₃)','80.043'=>'Ammonium Nitrate(NH₄NO₃)','182.703'=>'Nikel Nitrate(Ni(NO₃)₂)','169.873'=>'Silver Nitrate(AgNO₃)','100.087'=>'Calcium Carbonate(CaCO₃)','120.368'=>'Magnesium Sulfate(MgSO₄)','136.141'=>'Calcium Sulphate(CaSO₄)','158.034'=>'Potassium Permanganate(KmnO₄)'];
        } elseif ($this->chemical_selection == '3') {
            $this->chemical_options = ['36.461'=>'Hydrochloric Acid(HCL)','98.078'=>'Sulphuric Acid(H₂SO₄)','82.079'=>'Sulfurous Acid(H₂SO₃)','34.081'=>'Hydrosulfuric Acid(H₂S)','63.013'=>'Nitric Acid(HNO₃)','47.013'=>'Nitrous Acid(HNO₂)','97.995'=>'Phosphoric Acid(H₃PO₄)','81.996'=>'Phosphorus Acid(H₃PO₃)','80.912'=>'Hydrobromic Acid(HBr)','20.006'=>'Hydrofluoric(HF)','46.025'=>'Formic Acid(HCOOH)','60.052'=>'Acetic Acid(CH₃COOH)'];
        } elseif ($this->chemical_selection == '4') {
            $this->chemical_options = ['39.997'=>'Sodium Hydroxide(NaOH)','98.078'=>'Sodium Hydroxide(KOH)','58.32'=>'Magnesium Hydroxide(Mg(OH)₂)','74.093'=>'Calcium Hydroxide(Ca(OH)₂)','78.004'=>'Aliminium Hydroxide(Al(OH)₃)','23.948'=>'Lithium Hydroxide(LiOH)'];
        } elseif ($this->chemical_selection == '5') {
            $this->chemical_options = ['16.042'=>'Methane(CH₄)','36.069'=>'Ethane(C₂H₆)','44.096'=>'Propane(C₃H₈)','58.122'=>'Butane(C₄H₁₀)','32.042'=>'CH₃OH','46.068'=>'Methanol(C₂H₅OH)','78.112'=>'Benzene(C₆H₆)','180.156'=>'Glucose(C₆H₁₂O₆)','176.124'=>'Vitamin C(C₆H₈O₆)'];
        } elseif ($this->chemical_selection == '6') {
            $this->chemical_options = ['55.845'=>'Iron(Fe)','26.892'=>'Aluminium(Al)','63.456'=>'Copper(Cu)','47.867'=>'Titanium(Ti)','107.868'=>'Silver(Ag)','196.967'=>'Gold(Au)','58.693'=>'Nickel(Ni)','51.996'=>'Chromium(Cr)','58.933'=>'Cobalt(Co)','54.938'=>'Manganese(Mn)','200.59'=>'Mercury(Hg)','207.2'=>'Lead(Pb)','238.029'=>'Uranium(U)'];
        } else {
            $this->chemical_options = [];
        }
    }

    public function resetForm()
    {
        $this->reset(['chemical_selection', 'chemical_name', 'mm', 'mm_unit', 'unit', 'm', 'm_unit', 'nm', 'nm_unit', 'error', 'detail']);
        $this->updateChemicalOptions();
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
            'chemical_selection' => $this->chemical_selection,
            'unit' => $this->unit,
            'mm_unit' => $this->mm_unit,
            'mm' => $this->mm,
            'm_unit' => $this->m_unit,
            'm' => $this->m,
            'nm' => $this->nm,
            'nm_unit' => $this->nm_unit,
        ];

        $model = new Chemistry();
        $result = $model->grams($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            foreach($result as $key => $val) {
                if (is_float($val) && is_infinite($val)) {
                    $result[$key] = 'Infinity';
                } elseif (is_float($val) && is_nan($val)) {
                    $result[$key] = 'Undefined (NaN)';
                }
            }
            $this->detail = $result;
            $this->error = null;
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
            $this->error = $result['error'] ?? 'Something went wrong.';
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.grams-to-moles-calculator');
    }
}
