<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class ArcsinCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $arcsin = '0.5';
    public $round = '5';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->arcsin = $inputs['arcsin'] ?? '0.5';
            $this->round = $inputs['round'] ?? '5';
        }
    }

    public function resetForm()
    {
        $this->arcsin = '0.5';
        $this->round = '5';
        $this->error = null;
        $this->detail = null;

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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        if ($this->arcsin === '' || $this->arcsin === null) {
            $this->error = 'Please! Check Your Input.';
            return;
        }

        if ($this->arcsin < -1 || $this->arcsin > 1) {
            $this->error = 'Input must be between -1 and 1.';
            return;
        }

        $request = new class($this->arcsin, $this->round) {
            public $arcsin;
            public $round;
            public function __construct($arcsin, $round) { 
                $this->arcsin = $arcsin; 
                $this->round = $round; 
            }
            public function all() { 
                return [
                    'arcsin' => $this->arcsin,
                    'round' => $this->round
                ]; 
            }
        };

        $model = new Math();
        $result = $model->arcsin($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                 session()->flash('scroll_to_result', true);
                 return redirect()->to(url()->previous() ?? '/');
            } else {
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
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
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
        return view('livewire.calculators.arcsin-calculator');
    }
}
