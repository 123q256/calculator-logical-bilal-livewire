<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class TinettiCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs - Balance Section (A)
    public $a1 = '1';
    public $a2 = '1';
    public $a3 = '1';
    public $a4 = '1';
    public $a5 = '1';
    public $a6 = '1';
    public $a7 = '1';
    public $a8 = '1';
    public $a9 = '1';
    public $a10 = '1';

    // Form inputs - Gait Section (B)
    public $b1 = '1';
    public $b2 = '1';
    public $b3 = '1';
    public $b4 = '1';
    public $b5 = '1';
    public $b6 = '1';
    public $b7 = '1';
    public $b8 = '1';
    public $b9 = '1';
    public $b10 = '1';

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
        // Clear results when any input changes
        if (preg_match('/^[ab][0-9]+$/', $propertyName)) {
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        // Reset all inputs to default
        for ($i = 1; $i <= 10; $i++) {
            $this->{'a' . $i} = '1';
            $this->{'b' . $i} = '1';
        }

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $request = (object)[];
        for ($i = 1; $i <= 10; $i++) {
            $request->{'a' . $i} = $this->{'a' . $i};
            $request->{'b' . $i} = $this->{'b' . $i};
        }

        $model = new Health();
        $result = $model->tinetti($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
            } else {
                $this->detail = $result;
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.tinetti-calculator');
    }
}
