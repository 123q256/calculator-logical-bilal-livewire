<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class GrowthRateCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currency = '$';

    public $operation = 1;
    public $present_val = 2400;
    public $past_val = 1200;
    public $time_val = 2400;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->operation = $inputs->operation ?? 1;
            $this->present_val = $inputs->present_val ?? 2400;
            $this->past_val = $inputs->past_val ?? 1200;
            $this->time_val = $inputs->time_val ?? 2400;
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'operation') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->operation = 1;
        $this->present_val = 2400;
        $this->past_val = 1200;
        $this->time_val = 2400;

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
        $request = (object)[
            'operation' => $this->operation,
            'present_val' => (float)$this->present_val,
            'past_val' => (float)$this->past_val,
            'time_val' => (float)$this->time_val,
        ];

        $model = new Finance();
        $result = $model->growth($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
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
        return view('livewire.calculators.growth-rate-calculator');
    }
}
