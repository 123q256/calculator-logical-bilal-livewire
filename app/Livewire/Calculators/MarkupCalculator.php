<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class MarkupCalculator extends Component
{
    public $to_cal = '1';
    public $a = 10;
    public $b = 20;
    public $c = 30;
    public $d = 40;

    public $currency = '$';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [], $currency = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currency = $currency;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->to_cal = $inputs->to_cal ?? '1';
            $this->a = $inputs->a ?? 10;
            $this->b = $inputs->b ?? 20;
            $this->c = $inputs->c ?? 30;
            $this->d = $inputs->d ?? 40;
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['to_cal'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['to_cal', 'a', 'b', 'c', 'd', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'to_cal' => $this->to_cal,
            'a'      => (float)$this->a,
            'b'      => (float)$this->b,
            'c'      => (float)$this->c,
            'd'      => (float)$this->d,
        ];

        $model = new Finance();
        $result = $model->markup($request);

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
        return view('livewire.calculators.markup-calculator');
    }
}
