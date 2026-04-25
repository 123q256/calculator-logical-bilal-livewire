<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class MolesToGramsCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $chemical_selection = '9';
    public $chemical_name = '227';
    public $mm = 227;
    public $mm_unit = 'g/mol';
    public $unit = '2';
    public $m = 1;
    public $m_unit = 'ng';
    public $nm = 1;
    public $nm_unit = 'mol';

    public $chemical_options = [];

    // Full compound list (type 8)
    private static $compounds = [
        '44.0526'=>'Acetaldehyde [C₂H₄O]','59.0672'=>'Acetamide [C₂H₅NO]','60.052'=>'Acetic acid [CH₃COOH]',
        '58.0791'=>'Acetone [C₃H₆O]','41.0519'=>'Acetonitrile [C₂H₃N]','133.341'=>'Aluminium chloride [AlCl₃]',
        '212.996'=>'Aluminium nitrate [Al(NO₃)₃]','342.151'=>'Aluminium sulfate [Al₂(SO₄)₃]',
        '17.0305'=>'Ammonia[NH₃]','77.0825'=>'Ammonium acetate [CH₃COONH₄]',
        '96.0858'=>'Ammonium carbonate [(NH₄)₂CO₃]','53.4915'=>'Ammonium chloride [NH₄Cl]',
        '252.065'=>'Ammonium dichromate [(NH₄)₂Cr₂O₇]','35.0458'=>'Ammonium hydroxide [NH₄OH]',
        '80.0434'=>'Ammonium nitrate [NH₄NO₃]','124.096'=>'Ammonium oxalate [(NH₄)₂C₂O₄]',
        '132.14'=>'Ammonium sulfate [(NH₄)₂SO₄]','208.233'=>'Barium chloride [BaCl₂]',
        '171.342'=>'Barium hydroxide [Ba(OH)₂]','261.337'=>'Barium nitrate [Ba(NO₃)₂]',
        '78.1118'=>'Benzene [C₆H₆]','58.1222'=>'Butane [C₄H₁₀]','110.984'=>'Calcium chloride [CaCl₂]',
        '74.0927'=>'Calcium hydroxide [Ca(OH)₂]','164.088'=>'Calcium nitrate [Ca(NO₃)₂]',
        '136.141'=>'Calcium sulfate [CaSO₄]','44.0095'=>'Carbon dioxide [CO₂]',
        '76.1407'=>'Carbon disulfide [CS₂]','94.497'=>'Chloroacetic acid [C₂H₃ClO₂]',
        '339.786'=>'Chloroauric acid [HAuCl₄]','119.378'=>'Chloroform [CHCl₃]',
        '409.812'=>'Chloroplatinic acid [H₂PtCl₆]','192.124'=>'Citric acid [C₆H₈O₇]',
        '128.942'=>'Dichloroacetic acid [C₂H₂Cl₂O₂]','74.1216'=>'Diethyl ether [(C₂H₅)₂O]',
        '116.119'=>'Dimethylglyoxime [(CH₃CNOH)₂]','336.206'=>'EDTA, disodium salt [Na₂C₁₀H₁₄N₂O₈]',
        '30.069'=>'Ethane [C₂H₆]','46.0684'=>'Ethanol [C₂H₅OH]','62.0678'=>'Ethylene glycol [(CH₂OH)₂]',
        '30.026'=>'Formaldehyde [CH₂O]','46.0254'=>'Formic acid [CH₂O₂]','180.156_f'=>'Fructose [C₆H₁₂O₆]',
        '180.156'=>'Glucose [C₆H₁₂O₆]','92.0938'=>'Glycerol [C₃H₈O₃]',
        '144.092'=>'Hexafluorosilicic acid [H₂SiF₆]','32.0452'=>'Hydrazine [N₂H₄]',
        '80.9119'=>'Hydrobromic acid [HBr]','36.4609'=>'Hydrochloric acid [HCl]',
        '27.0253'=>'Hydrocyanic acid [HCN]','20.0063'=>'Hydrofluoric acid [HF]',
        '2.0159'=>'Hydrogen [H₂]','34.0147'=>'Hydrogen peroxide [H₂O₂]',
        '34.0809'=>'Hydrogen sulfide [H₂S]','127.912'=>'Hydroiodic acid [HI]',
        '175.911'=>'Iodic acid [HIO₃]','74.1216_i'=>'Isobutanol [C₄H₁₀O]',
        '90.0779'=>'Lactic acid [C₃H₆O₃]','342.296_l'=>'Lactose [C₁₂H₂₂O₁₁]',
        '42.394'=>'Lithium chloride [LiCl]','95.211'=>'Magnesium chloride [MgCl₂]',
        '148.315'=>'Magnesium nitrate [Mg(NO₃)₂]','120.368'=>'Magnesium sulfate [MgSO₄]',
        '116.072'=>'Maleic acid [C₄H₄O₄]','104.061'=>'Malonic acid [C₃H₄O₄]',
        '342.296'=>'Maltose [C₁₂H₂₂O₁₁]','182.172'=>'Mannitol [C₆H₁₄O₆]',
        '16.0425'=>'Methane [CH₄]','32.0419'=>'Methanol [CH₃OH]',
        '74.0785'=>'Methyl acetate [C₃H₆O₂]','129.599'=>'Nickel chloride [NiCl₂]',
        '182.703'=>'Nickel nitrate [Ni(NO₃)₂]','154.756'=>'Nickel sulfate [NiSO₄]',
        '162.232'=>'Nicotine [C₁₀H₁₄N₂]','63.0128'=>'Nitric acid [HNO₃]',
        '28.0134'=>'Nitrogen [N₂]','31.9988'=>'Oxygen [O₂]','90.0349'=>'Oxalic acid [H₂C₂O₄]',
        '97.9952'=>'Phosphoric acid [H₃PO₄]','100.115'=>'Potassium bicarbonate [KHCO₃]',
        '167'=>'Potassium bromate [KBrO₃]','119.002'=>'Potassium bromide [KBr]',
        '138.205'=>'Potassium carbonate [K₂CO₃]','74.551'=>'Potassium chloride [KCl]',
        '194.19'=>'Potassium chromate [K₂CrO₄]','65.1154'=>'Potassium cyanide [KCN]',
        '294.184'=>'Potassium dichromate [K₂Cr₂O₇]','174.175'=>'Potassium hydrogen phosphate [K₂HPO₄]',
        '56.1053'=>'Potassium hydroxide [KOH]','214.001'=>'Potassium iodate [KIO₃]',
        '166.002'=>'Potassium iodide [KI]','101.103'=>'Potassium nitrate [KNO₃]',
        '85.1035'=>'Potassium nitrite [KNO₂]','158.034'=>'Potassium permanganate [KMnO₄]',
        '174.259'=>'Potassium sulfate [K₂SO₄]','158.259'=>'Potassium sulfite [K₂SO₃]',
        '226.267'=>'Potassium tartrate [K₂C₄H₄O₆]','97.1804'=>'Potassium thiocyanate [KCNS]',
        '44.0956'=>'Propane [C₃H₈]','79.0999'=>'Pyridine [C₅H₅N]','110.111'=>'Resorcinol [C₆H₆O₂]',
        '342.296_s'=>'Saccharose [C₁₂H₂₂O₁₁]','169.873'=>'Silver nitrate [AgNO₃]',
        '311.799'=>'Silver sulfate [Ag₂SO₄]','82.0338'=>'Sodium acetate [NaC₂H₃O₂]',
        '207.889'=>'Sodium arsenate [Na₃AsO₄]','102.894'=>'Sodium bromide [NaBr]',
        '105.988'=>'Sodium carbonate [Na₂CO₃]','106.441'=>'Sodium chlorate [NaClO₃]',
        '58.4428'=>'Sodium chloride [NaCl]','161.973'=>'Sodium chromate [Na₂CrO₄]',
        '258.069'=>'Sodium citrate [Na₃C₆H₅O₇]','261.968'=>'Sodium dichromate [Na₂Cr₂O₇]',
        '119.977'=>'Sodium dihydrogen phosphate [NaH₂PO₄]','68.0072'=>'Sodium formate [HCOONa]',
        '84.0066'=>'Sodium hydrogen carbonate [NaHCO₃]','141.959'=>'Sodium hydrogen phosphate [Na₂HPO₄]',
        '172.069'=>'Sodium hydrogen tartrate [NaHC₄H₄O₆]','39.9971'=>'Sodium hydroxide [NaOH]',
        '84.9947'=>'Sodium nitrate [NaNO₃]','68.9953'=>'Sodium nitrite [NaNO₂]',
        '163.941'=>'Sodium phosphate [Na₃PO₄]','210.159'=>'Sodium potassium tartrate [NaKC₄H₄O₆]',
        '142.042'=>'Sodium sulfate [Na₂SO₄]','78.0445'=>'Sodium sulfide [Na₂S]',
        '126.043'=>'Sodium sulfite [Na₂SO₃]','194.051'=>'Sodium tartrate [Na₂C₄H₄O₆]',
        '158.108'=>'Sodium thiosulfate [Na₂S₂O₃]','158.526'=>'Strontium chloride [SrCl₂]',
        '211.63'=>'Strontium nitrate [Sr(NO₃)₂]','98.0785'=>'Sulfuric acid [H₂SO₄]',
        '82.0791'=>'Sulfurous acid [H₂SO₃]','150.087'=>'Tartaric acid [H₂C₄H₄O₆]',
        '76.1209'=>'Thiourea [CH₄N₂S]','163.387'=>'Trichloroacetic acid [CCl₃COOH]',
        '89.0932'=>'Urethane [C₃H₇NO₂]','176.124'=>'Vitamin C [C₆H₈O₆]',
        '18.0153'=>'Water [H₂O]','225.217'=>'Zinc bromide [ZnBr₂]',
        '136.315'=>'Zinc chloride [ZnCl₂]','189.419'=>'Zinc nitrate [Zn(NO₃)₂]',
        '161.472'=>'Zinc sulfate [ZnSO₄]',
    ];

    // Full element list (type 9)
    private static $elements = [
        '227'=>'Actinium [Ac]','107.868'=>'Silver [Ag]','26.9815'=>'Aluminium [Al]',
        '243'=>'Americium [Am]','39.948'=>'Argon [Ar]','74.9216'=>'Arsenic [As]',
        '210'=>'Astatine [At]','196.967'=>'Gold [Au]','10.811'=>'Boron [B]',
        '137.327'=>'Barium [Ba]','9.0122'=>'Beryllium [Be]','262'=>'Bohrium [Bh]',
        '208.98'=>'Bismuth [Bi]','247'=>'Berkelium [Bk]','79.904'=>'Bromine [Br]',
        '12.0107'=>'Carbon [C]','40.078'=>'Calcium [Ca]','112.411'=>'Cadmium [Cd]',
        '140.116'=>'Cerium [Ce]','251'=>'Californium [Cf]','35.453'=>'Chlorine [Cl]',
        '247_cm'=>'Curium [Cm]','63.546'=>'Copper [Cu]','132.905'=>'Cesium [Cs]',
        '51.9961'=>'Chromium [Cr]','58.9332'=>'Cobalt [Co]','285'=>'Copernicium [Cn]',
        '262_db'=>'Dubnium [Db]','281'=>'Darmstadtium [Ds]','162.5'=>'Dysprosium [Dy]',
        '167.259'=>'Erbium [Er]','254'=>'Einsteinium [Es]','151.964'=>'Europium [Eu]',
        '18.9984'=>'Fluorine [F]','55.845'=>'Iron [Fe]','289'=>'Flevorium [Fl]',
        '257'=>'Fermium [Fm]','223'=>'Francium [Fr]','69.723'=>'Galium [Ga]',
        '157.25'=>'Gadollnium [Gd]','72.64'=>'Germanium [Ge]','1.0079'=>'Hydrogen [H]',
        '4.003'=>'Helium [He]','178.49'=>'Hafnium [Hf]','200.59'=>'Mercury [Hg]',
        '164.93'=>'Holmium [Ho]','265'=>'Hassium [Hs]','126.904'=>'Iodine [I]',
        '114.813'=>'Indium [In]','192.217'=>'Iridium [Ir]','39.098'=>'Potassium [K]',
        '83.798'=>'Krypton [Kr]','138.906'=>'Lanthanum [La]','6.941'=>'Lithium [Li]',
        '262_lr'=>'Lawrencium [Lr]','293'=>'Livermonium [Lv]','174.967'=>'Lutetium [Lu]',
        '260'=>'Mendelevium [Md]','24.305'=>'Magnesium [Mg]','54.938'=>'Manganese [Mn]',
        '95.94'=>'Molybdenum [Mo]','266'=>'Meitnerium [Mt]','14.0067'=>'Nitrogen [N]',
        '22.9898'=>'Sodium [Na]','92.9064'=>'Niobium [Nb]','144.24'=>'Neodymium [Nd]',
        '20.1797'=>'Neon [Ne]','58.6934'=>'Nickel [Ni]','259'=>'Nobelium [No]',
        '237'=>'Neptunium [Np]','31.999'=>'Oxygen [O₂]','190.23'=>'Osmium [Os]',
        '30.9738'=>'Phosporus [P]','231.036'=>'Protactinium [Pa]','207.2'=>'Lead [Pb]',
        '106.42'=>'Palladium [Pd]','140.908'=>'Praseodymium [Pr]','195.078'=>'Platinum [Pt]',
        '244'=>'Plutonium [Pu]','226'=>'Radium [Ra]','85.4678'=>'Rubidium [Rb]',
        '186.207'=>'Rhenium [Re]','261'=>'Rutherfordium [Rf]','272'=>'Roentgenium [Rg]',
        '102.906'=>'Rhodium [Rh]','222'=>'Radon [Rn]','101.07'=>'Ruthenium [Ru]',
        '32.065'=>'Sulfur [S]','121.76'=>'Antimony [Sb]','44.9559'=>'Scandium [Sc]',
        '78.96'=>'Selenium [Se]','266_sg'=>'Seaborgium [Sg]','28.0855'=>'Silicon [Si]',
        '150.36'=>'Samarium [Sm]','118.71'=>'Tin [Sn]','87.62'=>'Strontium [Sr]',
        '158.925'=>'Terbium [Tb]','127.6_tc'=>'Technetium [Tc]','127.6'=>'Tellurium [Te]',
        '232.038'=>'Thorium [Th]','47.867'=>'Titanium [Ti]','204.383'=>'Thallium [Tl]',
        '168.934'=>'Thulium [Tm]','180.947'=>'Tantalum [Ta]','294_uuo'=>'Ununoctium [Uuo]',
        '294_uup'=>'Ununpentium [Uup]','294_uus'=>'Ununseptium [Uus]','284'=>'Ununtrium [Uut]',
        '50.9415'=>'Vanadium [V]','183.84'=>'Tungsten [W]','131.293'=>'Xenon [Xe]',
        '88.9059'=>'Yttrium [Y]','173.04'=>'Ytterbium [Yb]','65.409'=>'Zinc [Zn]',
        '91.224'=>'Zirconium [Zr]',
    ];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $this->updateChemicalOptions();

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs->chemical_selection)) {
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

    public function updateChemicalOptions()
    {
        if ($this->chemical_selection == '8') {
            $this->chemical_options = self::$compounds;
        } else {
            $this->chemical_options = self::$elements;
        }
    }

    public function updatedChemicalSelection()
    {
        $this->updateChemicalOptions();
        if (!empty($this->chemical_options)) {
            $this->chemical_name = array_key_first($this->chemical_options);
            $this->mm = $this->getRawValue($this->chemical_name);
        }
    }

    public function updatedChemicalName()
    {
        $this->mm = $this->getRawValue($this->chemical_name);
    }

    private function getRawValue($key)
    {
        // Strip any suffix like _f, _l, _s, _i used to de-duplicate keys
        return preg_replace('/_[a-z]+$/', '', $key);
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
        // The Chemistry model has a bug where 'kg/mol' is never mapped (dag/mol is mapped twice).
        // We normalize mm_unit to numeric here to ensure correct conversion.
        $mm_unit_map = ['g/mol' => '1', 'dag/mol' => '2', 'kg/mol' => '3'];
        $mm_unit_numeric = $mm_unit_map[$this->mm_unit] ?? '1';

        $request = (object)[
            'chemical_selection' => $this->chemical_selection,
            'unit' => $this->unit,
            'mm_unit' => $mm_unit_numeric,
            'mm' => $this->getRawValue((string) $this->mm),
            'm_unit' => $this->m_unit,
            'm' => $this->m,
            'nm' => $this->nm,
            'nm_unit' => $this->nm_unit,
        ];

        $model = new Chemistry();
        $result = $model->moles($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            foreach ($result as $key => $val) {
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
        return view('livewire.calculators.moles-to-grams-calculator');
    }
}
