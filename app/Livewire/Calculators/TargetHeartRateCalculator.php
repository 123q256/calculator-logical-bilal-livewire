<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class TargetHeartRateCalculator extends Component
{
    public $method = '1';
    public $formula = '1';
    public $age = '';
    public $rhr = '';
    public $hrr = '';
    public $mhr_input = '';
    public $rhrm = '';
    public $percent = '';
    public $ideal = '0.65';
    
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
            $this->method = $inputs['method'] ?? '1';
            $this->formula = $inputs['formula'] ?? '1';
            $this->age = $inputs['age'] ?? '';
            $this->rhr = $inputs['rhr'] ?? '';
            $this->hrr = $inputs['hrr'] ?? '';
            $this->mhr_input = $inputs['mhr'] ?? '';
            $this->rhrm = $inputs['rhrm'] ?? '';
            $this->percent = $inputs['percent'] ?? '';
            $this->ideal = $inputs['ideal'] ?? '0.65';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['method', 'formula', 'age', 'rhr', 'hrr', 'mhr_input', 'rhrm', 'percent', 'ideal', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $requestData = [
            'method' => $this->method,
            'formula' => $this->formula,
            'age' => $this->age,
            'rhr' => ($this->method == '3') ? $this->rhrm : $this->rhr, // Mapping rhrm to rhr for model compatibility if needed
            'hrr' => $this->hrr,
            'mhr' => $this->mhr_input,
            'rhrm' => $this->rhrm,
            'percent' => $this->percent,
            'ideal' => $this->ideal,
        ];

        $request = (object)$requestData;

        $model = new \App\Models\Health();
        $result = $model->target($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
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
        return view('livewire.calculators.target-heart-rate-calculator');
    }
}
