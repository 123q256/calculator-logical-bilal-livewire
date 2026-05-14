<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class FractionCalculator extends Component
{
    // Basic state
    public $calculate_type = 'fraction_type';
    public $fraction_types = 'simple_frac';
    public $stype = 'simple_frac'; // Radio binding
    
    // One fraction mode
    public $ne1 = '';
    public $neo2 = '5';
    public $du1 = '6';

    // 2, 3, 4 fractions mode
    public $N1 = '3';
    public $D1 = '13';
    public $N2 = '5';
    public $D2 = '15';
    public $N3 = '7';
    public $D3 = '17';
    public $N4 = '9';
    public $D4 = '19';
    public $action = '+';
    public $action1 = '+';
    public $action2 = '+';

    // Mixed fractions mode
    public $s1 = '-3';
    public $nu1 = '2';
    public $de1 = '5';
    public $s2 = '5';
    public $nu2 = '2';
    public $de2 = '7';
    public $actions = '+';

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
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        // Handle radio button sync
        if ($propertyName == 'stype') {
            $this->fraction_types = $this->stype;
        }

        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->detail = null;
        $this->error = null;
        
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
        // Basic Validation
        try {
            if ($this->calculate_type === 'fraction_type') {
                if ($this->fraction_types === 'one_frac') {
                    if ($this->du1 == 0) throw new \Exception("Denominator cannot be zero.");
                } else {
                    if ($this->D1 == 0 || $this->D2 == 0) throw new \Exception("Denominator cannot be zero.");
                    if ($this->fraction_types === 'three_frac' && $this->D3 == 0) throw new \Exception("Denominator cannot be zero.");
                    if ($this->fraction_types === 'four_frac' && ($this->D3 == 0 || $this->D4 == 0)) throw new \Exception("Denominator cannot be zero.");
                }
            } else {
                if ($this->de1 == 0 || $this->de2 == 0) throw new \Exception("Denominator cannot be zero.");
            }
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return;
        }

        $requestData = [
            'calculate_type' => $this->calculate_type,
            'fraction_types' => $this->fraction_types,
            'ne1' => $this->ne1,
            'neo2' => $this->neo2,
            'du1' => $this->du1,
            'N1' => $this->N1,
            'D1' => $this->D1,
            'N2' => $this->N2,
            'D2' => $this->D2,
            'N3' => $this->N3,
            'D3' => $this->D3,
            'N4' => $this->N4,
            'D4' => $this->D4,
            'action' => $this->action,
            'action1' => $this->action1,
            'action2' => $this->action2,
            's1' => $this->s1,
            'nu1' => $this->nu1,
            'de1' => $this->de1,
            's2' => $this->s2,
            'nu2' => $this->nu2,
            'de2' => $this->de2,
            'actions' => $this->actions,
        ];

        $request = new \Illuminate\Http\Request($requestData);
        $model = new \App\Models\Math();
        $result = $model->fraction($request);
        // dd($result);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');
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
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
        return view('livewire.calculators.fraction-calculator');
    }
}
