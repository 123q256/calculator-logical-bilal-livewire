<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class BotoxCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $solve = '1';
    public $input_f = 7;
    public $input_s = 4;
    public $currancy = "$";

    public function mount($type = 'calculator', $lang = [], $currancy = "$")
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->solve = $inputs->solve ?? '1';
            $this->input_f = $inputs->input_f ?? 7;
            $this->input_s = $inputs->input_s ?? 4;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->solve = '1';
        $this->input_f = 7;
        $this->input_s = 4;

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

    public function calculate()
    {
        $requestData = [
            'solve'   => $this->solve,
            'input_f' => $this->input_f,
            'input_s' => $this->input_s,
        ];

        $model = new EverydayLife();
        $result = $model->botox((object)$requestData);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (object)$requestData);
                $this->error = null;

                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
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
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.botox-cost-calculator');
    }
}
