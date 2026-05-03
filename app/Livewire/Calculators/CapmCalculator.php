<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class CapmCalculator extends Component
{
    public $cal = 'R';
    public $rf = 5;
    public $rm = 10;
    public $bi = 1.2;
    public $r = 11;
    
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal = $inputs->cal ?? $this->cal;
            $this->rf = $inputs->rf ?? $this->rf;
            $this->rm = $inputs->rm ?? $this->rm;
            $this->bi = $inputs->bi ?? $this->bi;
            $this->r = $inputs->r ?? $this->r;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    /**
     * Clear results whenever any property is updated
     */
    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->cal = 'R';
        $this->rf = 5;
        $this->rm = 10;
        $this->bi = 1.2;
        $this->r = 11;
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'cal' => $this->cal,
            'rf' => $this->rf,
            'rm' => $this->rm,
            'bi' => $this->bi,
            'r' => $this->r,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->capm($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

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

        return view('livewire.calculators.capm-calculator');
    }
}
