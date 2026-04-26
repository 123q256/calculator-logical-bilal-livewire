<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class MoleRatioCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $find = 1;
    public $reactants = [];
    public $products = [];

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
        } else {
            // Initialize with 2 reactants and 2 products
            $this->reactants = [
                $this->emptyParticipant('Reactant', 4),
                $this->emptyParticipant('Reactant', 8)
            ];
            $this->products = [
                $this->emptyParticipant('Product', 2),
                $this->emptyParticipant('Product', 5)
            ];
        }
    }

    private function emptyParticipant($type, $coeff = '')
    {
        return [
            'coefficient' => $coeff,
            'moles' => '',
            'atoms' => [
                ['count' => 1, 'mass' => 1],
                ['count' => 2, 'mass' => 1.00784],
                ['count' => 3, 'mass' => 1.00784],
            ],
            'molecular_weight' => 0,
            'mass' => 0
        ];
    }

    public function addReactant()
    {
        if (count($this->reactants) < 10) {
            $this->reactants[] = $this->emptyParticipant('Reactant');
        } else {
            $this->error = 'Only Ten Fields are Allowed';
        }
    }

    public function removeReactant($index)
    {
        unset($this->reactants[$index]);
        $this->reactants = array_values($this->reactants);
    }

    public function addProduct()
    {
        if (count($this->products) < 10) {
            $this->products[] = $this->emptyParticipant('Product');
        } else {
            $this->error = 'Only Ten Fields are Allowed';
        }
    }

    public function removeProduct($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        if ($this->find == 2) {
            $this->calculateMoleRelationships();
        } elseif ($this->find == 3) {
            $this->calculateMassRelationships();
        }
    }

    private function calculateMoleRelationships()
    {
        // Logic from jQuery for mode 2
        // If we have moles for the first reactant, calculate for others
        if (isset($this->reactants[0]['moles']) && is_numeric($this->reactants[0]['moles']) && is_numeric($this->reactants[0]['coefficient'])) {
            $moles_one = $this->reactants[0]['moles'];
            $coeff_one = $this->reactants[0]['coefficient'];

            foreach ($this->reactants as $index => $reactant) {
                if ($index == 0) continue;
                if (is_numeric($reactant['coefficient']) && $coeff_one > 0) {
                    $this->reactants[$index]['moles'] = ($reactant['coefficient'] * $moles_one) / $coeff_one;
                }
            }
            foreach ($this->products as $index => $product) {
                if (is_numeric($product['coefficient']) && $coeff_one > 0) {
                    $this->products[$index]['moles'] = ($product['coefficient'] * $moles_one) / $coeff_one;
                }
            }
        }
    }

    private function calculateMassRelationships()
    {
        // Reactants
        foreach ($this->reactants as $i => $reactant) {
            $mw = 0;
            foreach ($reactant['atoms'] as $atom) {
                $mw += (float)$atom['count'] * (float)$atom['mass'];
            }
            $this->reactants[$i]['molecular_weight'] = $mw;
            if (is_numeric($reactant['moles'])) {
                $this->reactants[$i]['mass'] = $mw * (float)$reactant['moles'];
            }
        }

        // Products
        foreach ($this->products as $i => $product) {
            $mw = 0;
            foreach ($product['atoms'] as $atom) {
                $mw += (float)$atom['count'] * (float)$atom['mass'];
            }
            $this->products[$i]['molecular_weight'] = $mw;
            if (is_numeric($product['moles'])) {
                $this->products[$i]['mass'] = $mw * (float)$product['moles'];
            }
        }

        // Also handle the cross-calculation if first reactant moles are present
        $this->calculateMoleRelationships();
    }

    public function resetForm()
    {
        $this->reset(['reactants', 'products', 'find', 'detail', 'error']);
        $this->mount($this->type, $this->lang);
        
        session()->forget(['calculator_result', 'validation_error', 'calculator_back_inputs', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $this->error = null;

        // Prepare request for model
        $request = (object)[
            'find' => $this->find,
            'first_coefficient' => array_column($this->reactants, 'coefficient'),
            'first_product' => array_column($this->products, 'coefficient'),
            'moles' => array_column($this->reactants, 'moles'),
        ];

        $model = new Chemistry();
        $result = $model->molar_ratio($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->put('calculator_back_inputs', [
                    'reactants' => $this->reactants,
                    'products' => $this->products,
                    'find' => $this->find,
                ]);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->dispatch('scroll-to-result');
            }
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->flash('validation_error', $this->error);
            session()->put('calculator_back_inputs', [
                'reactants' => $this->reactants,
                'products' => $this->products,
                'find' => $this->find,
            ]);
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function ordinal($number)
    {
        $words = [
            1 => 'First', 2 => 'Second', 3 => 'Third', 4 => 'Fourth', 5 => 'Fifth',
            6 => 'Sixth', 7 => 'Seventh', 8 => 'Eighth', 9 => 'Ninth', 10 => 'Tenth'
        ];
        return $words[$number] ?? $number . 'th';
    }

    public function render()
    {
        if (session('scroll_to_result')) {
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
        return view('livewire.calculators.mole-ratio-calculator');
    }
}

