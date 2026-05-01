<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class EnthalpyCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $device = 'desktop';

    // Inputs
    public $calEnthalpy = 'enthalpyFormula';
    public $calFrom = 'byStandard';
    public $calFrom1 = '2';
    
    // Formula Inputs
    public $q1 = 45;
    public $q1_unit = 'J';
    public $q2 = 45;
    public $q2_unit = 'J';
    public $v1 = 45;
    public $v1_unit = 'mm3';
    public $v2 = 45;
    public $v2_unit = 'mm3';
    public $changeQ = 45;
    public $changeQ_unit = 'J';
    public $changeV = 45;
    public $changeV_unit = 'mm3';
    public $p = 45;
    public $p_unit = 'Pa';

    // Reaction Scheme Inputs
    public $a_n = 2;
    public $rA = '0';
    public $rA_val = '';
    public $rA_values = 'Ag(s)';
    
    public $b_n = 2;
    public $rB = '0';
    public $rB_val = '';
    public $rB_values = 'Ag(s)';
    
    public $c_n = 2;
    public $rC = '0';
    public $rC_val = '';
    public $rC_values = 'Ag(s)';
    
    public $d_n = 2;
    public $pD = '0';
    public $pD_val = '';
    public $pD_values = 'Ag(s)';
    
    public $e_n = 1;
    public $pE = '0';
    public $pE_val = '';
    public $pE_values = 'Ag(s)';
    
    public $f_n = 1;
    public $pF = '0';
    public $pF_val = '';
    public $pF_values = 'Ag(s)';

    public $openDropdown = null;

    public $DATA_A = [
        "None" => "0", "Custom" => "0", "Ag(s)" => "0", "Ag⁺(aq)" => "105.58", "Ag₂O(s)" => "-31.05", "Ag₂S(s)" => "-31.8", "AgBr(aq)" => "-15.98", "AgBr(s)" => "-100.37", "AgCl(aq)" => "-61.58", "AgCl(s)" => "-127.7", "AgI(aq)" => "50.38", "AgI(s)" => "-61.84", "AgNO₃(s)" => "-124.39", "Al(s)" => "0", "Al₂O₃(s)" => "-1669.8", "Al³⁺(aq)" => "-524.7", "AlCl₃(s)" => "-704.2", "As(s) " => "0", "As₂S₃(s) " => "-169", "AsO₄³⁻(aq)" => "-888.14", "B(s)" => "0", "B₂O₃(s)" => "-1272.8", "Ba(s)" => "0", "Ba²⁺(aq)" => "-537.64", "BaCl₂(s)" => "-860.1", "BaCO₃(aq)" => "-1214.78", "BaCO₃(s)" => "-1218.8", "BaO(s)" => "-558.1", "BaSO₄(s)" => "-1465.2", "BF₃(g)" => "-1137", "Br⁻(aq)" => "-121.55", "Br(g)" => "111.88", "Br₂(g)" => "30.907", "Br₂(l)" => "0", "C(g)" => "716.68", "C(s) - Diamond" => "1.88", "C(s) - Graphite" => "0", "CH₃CHO(g)" => "-166.19", "CH₃CHO(l) - Acetaldehyde" => "-192.3", "CH₃COCH₃(l) - Acetone" => "-248.1", "CH₃COOH(aq)" => "-485.76", "CH₃COOH(l) - Acetic acid" => "-484.5", "CH₃NH₂(g) - Methylamine" => "-22.97", "CH₃OH(g)" => "-200.66", "CH₃OH(l) - Methanol" => "-238.6", "CH₄(g) - Methane" => "-74.81", "CHCl₃(l)" => "-131.8", "(COOH)₂(s) - Oxalic acid" => "-827.2", "C₂H₂(g) - Acetylene" => "226.73", "C₂H₄(g) - Ethylene" => "52.28", "C₂H₅OH(g)" => "-235.1", "C₂H₅OH(l) - Ethanol" => "-277.69", "C₂H₆(g) - Ethane" => "-84.68", "C₃H₆(g) - Cyclopropane " => "53.3", "C₃H₆(g) - Propylene" => "20.42", "C₃H₈(g) - Propane" => "-103.8", "C₄H₁₀(g) - Butane" => "-126.15", "C₅H₁₂(g) - Pentane" => "-146.44", "C₆H₁₂(l) - Cyclohexane" => "-156.4", "C₆H₁₂O₆(s) - Fructose" => "-1266", "C₆H₁₂O₆(s) - Glucose" => "-1273", "C₆H₁₄(l) - Haxane" => "-198.7", "C₆H₅COOH(s) - Benzoic acid" => "-385.1", "C₆H₅NH₂(l) - Aniline" => "31.6", "C₆H₅OH(s) - Phenol" => "-164.6", "C₆H₆(l) - Benzene" => "49.03", "C₇H₈(l) - Toluene" => "12", "C₈H₁₈(l) - Octane" => "-250.1", "C₁₂H₂₂O₁₁(s) - Sucrose" => "-2220", "CO(g)" => "-110.5", "CO(NH₂)₂(s) - Urea" => "-333.51", "CO₂(g)" => "-393.5", "CO₃²⁻(aq)" => "-677.14", "CCl₄(g)" => "-102.9", "CCl₄(l)" => "-139.5", "Ca(g)" => "178.2", "Ca(OH)₂(aq)" => "-1002.82", "Ca(OH)₂(s)" => "-986.6", "Ca(s)" => "0", "Ca²⁺(aq)" => "-542.83", "CaBr₂(s)" => "-682.8", "CaC₂(s)" => "-59.8", "CaCl₂(aq)" => "-877.1", "CaCl₂(s)" => "-795", "CaCO₃(aq)" => "-1219.97", "CaCO₃(s)" => "-1207.1", "CaF₂(aq)" => "-1208.09", "CaF₂(s)" => "-1219.6", "CaO(s)" => "-635.5", "CaSO₄(aq)" => "-1452.1", "CaSO₄(s)" => "-1432.7", "Ce(s)" => "0", "Ce³⁺(aq)" => "-696.2", "Ce⁴⁺(aq)" => "-537.2", "Cl(g)" => "121.68", "Cl⁻(aq)" => "-167.16", "Cl₂(g)" => "0", "CoO(s)" => "-239.3", "Cr₂O₃(s)" => "-1128.4", "CS₂(l)" => "89.7", "Cu(s)" => "0", "Cu⁺(aq)" => "71.67", "Cu²⁺(aq)" => "64.77", "Cu₂O(s)" => "-168.6", "CuO(s)" => "-157.3", "CuS(s)" => "-48.5", "CuSO₄(s)" => "-771.36", "D₂(g)" => "0", "D₂O(l)" => "-294.6", "D₂O(g)" => "-249.2", "F⁻(aq)" => "-332.63", "F₂(g)" => "0", "Fe(s)" => "0", "Fe²⁺(aq)" => "-89.1", "Fe³⁺(aq)" => "-48.5", "FeO(s)" => "-272.04", "Fe₂O₃(s) - Hematite" => "-824.2", "Fe₃O₄(s) - Magnetite" => "-1118.4", "FeS(s) - α" => "-100", "FeS₂(s) " => "-178.2", "H(g)" => "217.97", "H⁺(aq)" => "0", "H₂(g)" => "0", "H₂O(g) - Water vapor" => "-241.8", "H₂O(l) - Water" => "-285.83", "H₂O₂(aq)" => "-191.17", "H₂O₂(l)" => "-187.8", "H₂S(aq)" => "-39.7", "H₂S(g)" => "-20.63", "H₂SO₄(aq)" => "-909.27", "H₂SO₄(l)" => "-813.99", "H₃PO₃(aq)" => "-964", "H₃PO₄(aq)" => "-277.4", "H₃PO₄(l)" => "-1266.9", "HBr(g)" => "-36.23", "HCHO(g) - Formaldehyde" => "-108.57", "HCl(aq)" => "-167.16", "HCl(g)" => "-92.31", "HCN(g)" => "135.1", "HCN(l)" => "108.87", "HCOOH(l) - Formic acid" => "-424.72", "HF(aq)" => "-332.36", "HF(g)" => "-271.1", "Hg(g)" => "61.32", "Hg(l)" => "0", "Hg₂Cl₂(s)" => "-265.22", "HgO(s)" => "-90.83", "HgS(s)" => "-58.2", "HI(g)" => "26.48", "HN₃(g)" => "294.1", "HNO₃(aq)" => "-207.36", "HNO₃(l)" => "-174.1", "I⁻(aq)" => "-55.19", "I₂(g)" => "62.44", "I₂(s)" => "0", "K(g)" => "89.24", "K(s)" => "0", "K⁺(aq)" => "-252.38", "K₂S(aq)" => "-471.5", "K₂S(s)" => "-380.7", "KBr(s)" => "-393.8", "KCl(s)" => "-436.75", "KClO₃(s)" => "-397.73", "KClO₄(s)" => "-432.75", "KF(s)" => "-567.27", "KI(s)" => "-327.9", "KOH(aq)" => "-482.37", "KOH(s)" => "-424.76", "Mg(g)" => "147.7", "Mg(OH)₂(s)" => "-924.7", "Mg(s)" => "0", "Mg²⁺(aq)" => "-466.85", "MgBr₂(s)" => "-524.3", "MgCl₂(s)" => "-641.8", "MgCO₃(s)" => "-1095.8", "MgO(s)" => "-601.7", "MgSO₄(s)" => "-1278.2", "MnO(s)" => "-384.9", "MnO₂(s)" => "-519.7", "N₂(g)" => "0", "N₂H₄(g)" => "95.4", "N₂H₄(l)" => "50.63", "N₂O(g)" => "82.05", "N₂O₄(g)" => "9.16", "N₂O₄(l)" => "-19.5", "Na(g)" => "107.32", "Na(s)" => "0", "Na⁺(aq)" => "-240.12", "Na₂CO₃(s)" => "-1130.9", "NaBr(s)" => "-361.06", "NaCl(s)" => "-411.15", "NaF(s)" => -569, "NaHCO₃(s)" => "-947.7", "NaI(s)" => "-287.78", "NaOH(aq)" => "-470.11", "NaOH(s)" => "-425.61", "NH₂CH₂COOH(s) - Glycine" => "-532.9", "NH₂OH(s)" => "-114.2", "NH₃(aq)" => "-80.29", "NH₃(g) - Ammonia" => "-46.11", "NH₄⁺(aq)" => "-132.51", "NH₄Cl(s)" => "-314.43", "NH₄ClO₄(s)" => "-295.31", "NH₄NO₃(s)" => "-365.56", "NiO(s)" => "-244.3", "NO(g)" => "90.25", "NO₂(g)" => "33.18", "NO₃⁻(aq)" => "-205", "O₂(g)" => "0", "O₃(g)" => "142.7", "OH⁻(aq)" => "-229.99", "P(s)" => "0", "P₄(g)" => "58.91", "P₄O₁₀(s)" => "-2984", "Pb(s)" => "0", "Pb²⁺(aq)" => "-1.7", "Pb₃O₄(s)" => "-734.7", "PbBr₂(aq)" => "-244.8", "PbBr₂(s)" => "-278.7", "PbCl₂(s)" => "-359.2", "PbO(s)" => "-217.9", "PbO₂(s)" => "-277.4", "PbSO₄(s)" => "-919.94", "PCl₃(g)" => "-287", "PCl₃(l)" => "-319.7", "PCl₅(g)" => "-374.9", "PCl₅(s)" => "-443.5", "PH₃(g)" => "5.4", "S(s) - Monoclinic" => "0.33", "S(s) - Rhombic" => "0", "S²⁻(aq)" => "33.1", "SbCl₃(g)" => "-313.8", "SbCl₅(g) " => "-394.34", "SbH₃(g) " => "145.11", "SF₆(g)" => "-1209", "Si(s)" => "0", "SiO₂(s)" => "-859.4", "SiO₂(s) - α" => "-910.94", "Sn(s) - Gray" => "-2.09", "Sn(s) - White" => "0", "SnCl₂(s)" => "-349.8", "SnCl₄(l)" => "-545.2", "SnO(s)" => "-285.8", "SnO₂(s)" => "-580.7", "SO₂(g)" => "-296.83", "SO₃(g)" => "-395.72", "SO₄²⁻(aq)" => "-909.27", "Zn(s)" => "0", "Zn²⁺(aq)" => "-153.89", "ZnO(s)" => "-348.28", "ZnS(s)" => "-202.9"
    ];

    public function mount($type = 'calculator', $lang = [], $device = 'desktop')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->device = $device;
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

    public function updatedCalEnthalpy()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updatedCalFrom()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updatedCalFrom1()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        
        // Auto-update corresponding numeric value if it's a substance selection
        $mapping = [
            'rA_values' => 'rA',
            'rB_values' => 'rB',
            'rC_values' => 'rC',
            'pD_values' => 'pD',
            'pE_values' => 'pE',
            'pF_values' => 'pF',
        ];

        if (isset($mapping[$property])) {
            $valProp = $mapping[$property];
            if (isset($this->DATA_A[$value])) {
                $this->$valProp = $this->DATA_A[$value];
            }
        }

        $this->openDropdown = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'calEnthalpy', 'calFrom', 'calFrom1', 'q1', 'q1_unit', 'q2', 'q2_unit', 'v1', 'v1_unit', 'v2', 'v2_unit', 'changeQ', 'changeQ_unit', 'changeV', 'changeV_unit', 'p', 'p_unit', 'a_n', 'rA', 'rA_val', 'rA_values', 'b_n', 'rB', 'rB_val', 'rB_values', 'c_n', 'rC', 'rC_val', 'rC_values', 'd_n', 'pD', 'pD_val', 'pD_values', 'e_n', 'pE', 'pE_val', 'pE_values', 'f_n', 'pF', 'pF_val', 'pF_values']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'calEnthalpy' => $this->calEnthalpy,
            'calFrom'     => $this->calFrom,
            'calFrom1'    => $this->calFrom1,
            'q1'          => $this->q1,
            'q1_unit'     => $this->q1_unit,
            'q2'          => $this->q2,
            'q2_unit'     => $this->q2_unit,
            'v1'          => $this->v1,
            'v1_unit'     => $this->v1_unit,
            'v2'          => $this->v2,
            'v2_unit'     => $this->v2_unit,
            'changeQ'     => $this->changeQ,
            'changeQ_unit' => $this->changeQ_unit,
            'changeV'     => $this->changeV,
            'changeV_unit' => $this->changeV_unit,
            'p'           => $this->p,
            'p_unit'      => $this->p_unit,
            'a_n'         => $this->a_n,
            'rA'          => $this->rA,
            'rA_val'      => $this->rA_val,
            'rA_values'   => $this->rA_values,
            'b_n'         => $this->b_n,
            'rB'          => $this->rB,
            'rB_val'      => $this->rB_val,
            'rB_values'   => $this->rB_values,
            'c_n'         => $this->c_n,
            'rC'          => $this->rC,
            'rC_val'      => $this->rC_val,
            'rC_values'   => $this->rC_values,
            'd_n'         => $this->d_n,
            'pD'          => $this->pD,
            'pD_val'      => $this->pD_val,
            'pD_values'   => $this->pD_values,
            'e_n'         => $this->e_n,
            'pE'          => $this->pE,
            'pE_val'      => $this->pE_val,
            'pE_values'   => $this->pE_values,
            'f_n'         => $this->f_n,
            'pF'          => $this->pF,
            'pF_val'      => $this->pF_val,
            'pF_values'   => $this->pF_values,
        ];

        $model = new Physics();
        $result = $model->enthalpy($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

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
            session()->flash('validation_error', $this->error);
            $this->detail = null;
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

        return view('livewire.calculators.enthalpy-calculator');
    }
}
