<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class InstantaneousRateOfChangeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $EnterEq = '(6x^2 - 4)';
    public $x = '4';
    public $showKeyboard = false;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            $this->EnterEq = $inputs['EnterEq'] ?? $this->EnterEq;
            $this->x = $inputs['x'] ?? $this->x;
            if (isset($inputs['hidden_val']) && $inputs['hidden_val'] == '1') {
                $this->showKeyboard = true;
            }
        }
    }

    public function toggleKeyboard()
    {
        $this->showKeyboard = !$this->showKeyboard;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->EnterEq = '(6x^2 - 4)';
        $this->x = '4';
        $this->showKeyboard = false;
        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'EnterEq' => $this->EnterEq,
            'x' => $this->x,
            'hidden_val' => $this->showKeyboard ? '1' : '0',
        ];

        $request = (object)$requestData;
        $model = new Physics();
        $result = $model->i_r_o_c($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->error = null;
            $this->js(<<<'JS'
                setTimeout(() => {
                    if (window.MathJax) {
                        MathJax.typesetPromise();
                    }
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
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    if (window.MathJax) {
                        MathJax.typesetPromise();
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.instantaneous-rate-of-change-calculator');
    }
}
