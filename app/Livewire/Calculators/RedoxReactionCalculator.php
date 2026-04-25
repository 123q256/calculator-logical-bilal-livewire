<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class RedoxReactionCalculator extends Component
{
    public $eq = 'Cr2O7^2- + H^+ + e^- = Cr^3+ + H2O';
    public $error = null;
    public $detail = false;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
    }

    public $reactants = [];
    public $products = [];

    public function loadExample()
    {
        $examples = [
            "Cr2O7^2- + H^+ + e^- = Cr^3+ + H2O",
            "S^2- + I2 = I^- + S",
            "Mg + HCl = MgCl2 + H2",
            "C6H12O6 + O2 = CO2 + H2O",
            "H2 + O2 = H2O",
            "Al + Fe2O4 = Fe + Al2O3",
            "Fe + O2 = Fe2O3",
            "NH3 + O2 = NO + H2O"
        ];
        $this->eq = $examples[array_rand($examples)];
        $this->detail = false;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->eq = '';
        $this->error = null;
        $this->detail = false;
        $this->reactants = [];
        $this->products = [];
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'eq') {
            $this->detail = false;
            $this->error = null;
        }
    }

    public function calculate()
    {
        if (empty(trim($this->eq))) {
            $this->error = 'Please enter an equation.';
            $this->detail = false;
            return;
        }

        $result = \App\Services\RedoxBalancer::balance(trim($this->eq));
        
        if ($result['success']) {
            $this->reactants = $result['reactants'];
            $this->products = $result['products'];
            $this->error = null;
            $this->detail = true;

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 50);
            JS);
        } else {
            $this->error = "Equation Error: " . $result['error'];
            $this->detail = false;
        }
    }

    public function render()
    {
        return view('livewire.calculators.redox-reaction-calculator');
    }
}
