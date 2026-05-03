<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class AgiCalculator extends Component
{
    // Income inputs (1-13)
    public $input1 = 21;
    public $input2 = 19;
    public $input3 = 17;
    public $input4 = 35;
    public $input5 = 45;
    public $input6 = 27;
    public $input7 = 23;
    public $input8 = 13;
    public $input9 = 19;
    public $input10 = 49;
    public $input11 = 12;
    public $input12 = 38;
    public $input13 = 25;

    // Deduction inputs (14-24)
    public $input14 = 22;
    public $input15 = 14;
    public $input16 = 19;
    public $input17 = 23;
    public $input18 = 45;
    public $input19 = 43;
    public $input20 = 67;
    public $input21 = 57;
    public $input22 = 32;
    public $input23 = 32;
    public $input24 = 32;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            for ($i = 1; $i <= 24; $i++) {
                $prop = "input$i";
                $this->$prop = $inputs->$prop ?? $this->$prop;
            }
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

  

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        // Default values
        $defaults = [
            'input1' => 21, 'input2' => 19, 'input3' => 17, 'input4' => 35, 'input5' => 45,
            'input6' => 27, 'input7' => 23, 'input8' => 13, 'input9' => 19, 'input10' => 49,
            'input11' => 12, 'input12' => 38, 'input13' => 25, 'input14' => 22, 'input15' => 14,
            'input16' => 19, 'input17' => 23, 'input18' => 45, 'input19' => 43, 'input20' => 67,
            'input21' => 57, 'input22' => 32, 'input23' => 32, 'input24' => 32,
        ];

        foreach ($defaults as $prop => $val) {
            $this->$prop = $val;
        }

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
        $requestData = [];
        for ($i = 1; $i <= 24; $i++) {
            $prop = "input$i";
            $requestData[$prop] = $this->$prop;
        }

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->agi($request);

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
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
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
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.agi-calculator');
    }
}
