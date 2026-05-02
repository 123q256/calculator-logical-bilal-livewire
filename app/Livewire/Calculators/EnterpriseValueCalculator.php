<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class EnterpriseValueCalculator extends Component
{
    public $cs;
    public $ps;
    public $mvd;
    public $mi;
    public $ce;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    protected $rules = [
        'cs' => 'required|numeric',
        'ps' => 'required|numeric',
        'mvd' => 'required|numeric',
        'mi' => 'required|numeric',
        'ce' => 'required|numeric',
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
            $this->cs = $inputs->cs ?? 10;
            $this->ps = $inputs->ps ?? 15;
            $this->mvd = $inputs->mvd ?? 25;
            $this->mi = $inputs->mi ?? 30;
            $this->ce = $inputs->ce ?? 35;
        } else {
            $this->cs = 10;
            $this->ps = 15;
            $this->mvd = 25;
            $this->mi = 30;
            $this->ce = 35;
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['cs', 'ps', 'mvd', 'mi', 'ce'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['cs', 'ps', 'mvd', 'mi', 'ce', 'detail', 'error']);
        
        $this->cs = 10;
        $this->ps = 15;
        $this->mvd = 25;
        $this->mi = 30;
        $this->ce = 35;

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
        $request = (object)[
            'cs' => $this->cs,
            'ps' => $this->ps,
            'mvd' => $this->mvd,
            'mi' => $this->mi,
            'ce' => $this->ce,
        ];

        $model = new Finance();
        $result = $model->enterprise($request);

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

        return view('livewire.calculators.enterprise-value-calculator');
    }
}
