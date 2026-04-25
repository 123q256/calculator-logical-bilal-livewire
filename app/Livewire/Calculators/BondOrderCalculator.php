<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class BondOrderCalculator extends Component
{
    // Default Values
    public $solve = "1"; // 1: Bond Order, 2: Bonding Electrons, 3: Antibonding Electrons
    public $f_input = 7;
    public $s_input = 8;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->solve = "1";
        $this->f_input = 7;
        $this->s_input = 8;
        $this->error = null;
        $this->detail = null;
    }

    public function calculate()
    {
        $request = (object)[
            'solve' => $this->solve,
            'f_input' => $this->f_input,
            's_input' => $this->s_input,
        ];

        $model = new Chemistry();
        $result = $model->bond($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            $this->dispatch('result-updated');
            
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
            $this->error = $result['error'] ?? 'Please check your input.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.bond-order-calculator');
    }
}
