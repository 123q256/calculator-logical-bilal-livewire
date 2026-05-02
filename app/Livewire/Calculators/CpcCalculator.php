<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class CpcCalculator extends Component
{
    public $method = 'cost';
    public $x = 50;
    public $y = 50;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    protected $rules = [
        'method' => 'required',
        'x' => 'required|numeric',
        'y' => 'required|numeric',
    ];

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->method = $inputs->method ?? 'cost';
            $this->x = $inputs->x ?? 50;
            $this->y = $inputs->y ?? 50;
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'method') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['x', 'y', 'detail', 'error']);
        $this->method = 'cost';
        $this->x = 50;
        $this->y = 50;
        
        session()->forget([
            'calculator_result',
            'calculator_back_inputs',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $this->validate();

        $request = (object)[
            'method' => $this->method,
            'x' => $this->x,
            'y' => $this->y,
            'hidden_currency' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->cpc($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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

        return view('livewire.calculators.cpc-calculator');
    }
}
