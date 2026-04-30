<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class DensityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Main Mode: simple or advance
    public $calc = 'simple';

    // Calculation Target: density, volume, mass
    public $to_cals = 'density';

    // Inputs
    public $dns = 10;
    public $sldns = 'kg/m³';
    public $vol = 32;
    public $slvol = 'm³';
    public $mas = 9;
    public $slmas = 'kg';
    
    // Advance Inputs
    public $lgn = 50;
    public $sllgn = 'cm';
    public $wdt = 40;
    public $slwdt = 'cm';
    public $hgt = 40;
    public $slhgt = 'cm';
    public $sladvol = 'm³';

    // Units and Dropdown Targets
    public $dens_unt = 'kg/m³';
    public $volu_unt = 'm³';
    public $mass_unt = 'kg';

    // Density Lookup Section
    public $showLookup = false;
    public $dens_lok_unt = 'kg/m³';
    public $slcat = 'metals';
    public $slmtl = 'aluminum';
    public $slmtl_no = 'concrete';
    public $slgas = 'air0';
    public $sllqd = 'cooking_oil';
    public $slastr = 'earth';
    public $dens_lok_ans_val = '2700';

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
        $this->updateLookupAnswer();
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'openDropdown' && !str_starts_with($propertyName, 'sl') && $propertyName !== 'dens_lok_unt') {
            $this->detail = null;
            $this->error = null;
        }

        if (in_array($propertyName, ['slcat', 'slmtl', 'slmtl_no', 'slgas', 'sllqd', 'slastr', 'dens_lok_unt'])) {
            $this->updateLookupAnswer();
        }
    }

    public function setCalc($val)
    {
        $this->calc = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function setToCals($val)
    {
        $this->to_cals = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function toggleLookup()
    {
        $this->showLookup = !$this->showLookup;
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function updateLookupAnswer()
    {
        $dens_val = 0;
        if ($this->slcat === "metals") {
            $mapping = [
                "aluminum" => 2700, "beryllium" => 1850, "brass" => 8600, "copper" => 8940,
                "gold" => 19320, "iron" => 7870, "lead" => 11340, "magnesium" => 1740,
                "mercury" => 13546, "nickel" => 8900, "platium" => 21450, "plutonium" => 19840,
                "potassium" => 860, "silver" => 10500, "sodium" => 970, "tin" => 7310,
                "titanium" => 240, "uranium" => 18800, "zinc" => 7000
            ];
            $dens_val = $mapping[$this->slmtl] ?? 2700;
        } elseif ($this->slcat === "non-metals") {
            $mapping = [
                "concrete" => 2400, "cork" => 240, "diamond" => 3500, "ice" => 916.7,
                "nylon" => 1150, "oak" => 710, "pine" => 373, "plastics" => 1175,
                "styrofoam" => 75, "wood" => 700
            ];
            $dens_val = $mapping[$this->slmtl_no] ?? 2400;
        } elseif ($this->slcat === "gases") {
            $mapping = [
                "air0" => 1.293, "air20" => 1.205, "carbon_dioxide0" => 1.977, "carbon_dioxide20" => 1.842,
                "carbon_monoxide0" => 1.25, "carbon_monoxide20" => 1.165, "hydrogen" => 0.0898,
                "helium" => 0.179, "methane0" => 0.717, "methane20" => 0.688, "nitrogen0" => 1.2506,
                "nitrogen20" => 1.165, "oxygen0" => 1.429, "oxygen20" => 1.331, "propane20" => 1.882,
                "water_vapor" => 0.804
            ];
            $dens_val = $mapping[$this->slgas] ?? 1.293;
        } elseif ($this->slcat === "liquids") {
            $mapping = [
                "cooking_oil" => 920, "liquid_hydrogen" => 70, "liquid_oxygen" => 1141,
                "water_fresh" => 1000, "water_salt" => 1030
            ];
            $dens_val = $mapping[$this->sllqd] ?? 920;
        } elseif ($this->slcat === "astronomy") {
            $mapping = [
                "earth" => 5515, "earth_core" => 13000, "sun_core_min" => 33000, "sun_core_max" => 160000,
                "super_black_hole" => 900000, "dwarf_star" => 2100000000, "atomic_nuclei" => 230000000000000000,
                "neutron_star" => 480000000000000000, "stellar_black_hole" => 1000000000000000000
            ];
            $dens_val = $mapping[$this->slastr] ?? 5515;
        }

        $unt = $this->dens_lok_unt;
        if ($unt === "kg/dm³" || $unt === "kg/L" || $unt === "g/mL" || $unt === "t/m³" || $unt === "g/cm³") {
            $dens_val = $dens_val / 1000;
        } elseif ($unt === "oz/cu_in") {
            $dens_val = $dens_val / 1730;
        } elseif ($unt === "lb/cu_in") {
            $dens_val = $dens_val / 27680;
        } elseif ($unt === "lb/cu_ft") {
            $dens_val = $dens_val / 16.018;
        } elseif ($unt === "lb/cu_yd") {
            $dens_val = $dens_val * 1.6855549959513;
        } elseif ($unt === "lb/us_gal") {
            $dens_val = $dens_val / 120;
        } elseif ($unt === "g/dl") {
            $dens_val = $dens_val / 10;
        } elseif ($unt === "mg/l") {
            $dens_val = $dens_val * 1000;
        }

        $this->dens_lok_ans_val = round($dens_val, 6) . " " . str_replace('_', ' ', $unt);
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'calc', 'to_cals', 'dns', 'sldns', 'vol', 'slvol', 'mas', 'slmas', 'lgn', 'sllgn', 'wdt', 'slwdt', 'hgt', 'slhgt', 'sladvol', 'dens_unt', 'volu_unt', 'mass_unt']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = [
            'calc'         => $this->calc,
            'to_cals'      => $this->to_cals,
            'dens_unt'     => $this->dens_unt,
            'vol'          => $this->vol,
            'slvol'        => $this->slvol,
            'mas'          => $this->mas,
            'slmas'        => $this->slmas,
            'dns'          => $this->dns,
            'sldns'        => $this->sldns,
            'volu_unt'     => $this->volu_unt,
            'mass_unt'     => $this->mass_unt,
            'lgn'          => $this->lgn,
            'sllgn'        => $this->sllgn,
            'wdt'          => $this->wdt,
            'slwdt'        => $this->slwdt,
            'hgt'          => $this->hgt,
            'slhgt'        => $this->slhgt,
            'sladvol'      => $this->sladvol,
        ];

        $model = new Physics();
        $result = $model->density((object)$request);

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
        return view('livewire.calculators.density-calculator');
    }
}
