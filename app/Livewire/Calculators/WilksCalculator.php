<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class WilksCalculator extends Component
{
    public $sex = 'male';
    public $bw = '80';
    public $unit = 'kg';
    public $method = 'au';
    public $bp = '20';
    public $bp_reps = '15';
    public $bs = '15';
    public $bs_reps = '10';
    public $dl = '15';
    public $dl_reps = '5';
    public $wl = '100';
    
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
            $this->sex = $inputs['sex'] ?? 'male';
            $this->bw = $inputs['bw'] ?? '80';
            $this->unit = $inputs['unit'] ?? 'kg';
            $this->method = $inputs['method'] ?? 'au';
            $this->bp = $inputs['bp'] ?? '20';
            $this->bp_reps = $inputs['bp_reps'] ?? '15';
            $this->bs = $inputs['bs'] ?? '15';
            $this->bs_reps = $inputs['bs_reps'] ?? '10';
            $this->dl = $inputs['dl'] ?? '15';
            $this->dl_reps = $inputs['dl_reps'] ?? '5';
            $this->wl = $inputs['wl'] ?? '100';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['sex', 'bw', 'unit', 'method', 'bp', 'bp_reps', 'bs', 'bs_reps', 'dl', 'dl_reps', 'wl', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'sex' => $this->sex,
            'bw' => $this->bw,
            'unit' => $this->unit,
            'method' => $this->method,
            'bp' => $this->bp,
            'bp_reps' => $this->bp_reps,
            'bs' => $this->bs,
            'bs_reps' => $this->bs_reps,
            'dl' => $this->dl,
            'dl_reps' => $this->dl_reps,
            'wl' => $this->wl,
        ];

        $request = (object)$requestData;

        $model = new \App\Models\Health();
        $result = $model->wilks($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
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
        return view('livewire.calculators.wilks-calculator');
    }
}
