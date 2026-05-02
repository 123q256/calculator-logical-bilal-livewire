<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class ProfitMarginCalculator extends Component
{
    public $method = 'Gross';
    public $x;
    public $y;
    
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    protected $rules = [
        'x' => 'required|numeric',
        'y' => 'required|numeric',
    ];

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        // Restore from session if available
        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->method = $inputs->method ?? 'Gross';
            $this->x = $inputs->x ?? null;
            $this->y = $inputs->y ?? null;
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['method', 'x', 'y'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['method', 'x', 'y', 'detail', 'error']);
        $this->method = 'Gross';
        
        session()->forget([
            'calculator_result',
            'calculator_back_inputs',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'method' => $this->method,
            'x' => $this->x,
            'y' => $this->y,
            'hidden_currency' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->profit($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->put('calculator_result', $result);
            session()->put('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
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

        return view('livewire.calculators.profit-margin-calculator');
    }
}
