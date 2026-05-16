<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class DiscriminantCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $to_calculate = '2d';
    public $value = '13';
    public $value1 = '-10';
    public $value2 = '7';
    public $value3 = '-6';
    public $value4 = '4';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['to_calculate'])) $this->to_calculate = $inputs['to_calculate'];
            if (isset($inputs['value'])) $this->value = $inputs['value'];
            if (isset($inputs['value1'])) $this->value1 = $inputs['value1'];
            if (isset($inputs['value2'])) $this->value2 = $inputs['value2'];
            if (isset($inputs['value3'])) $this->value3 = $inputs['value3'];
            if (isset($inputs['value4'])) $this->value4 = $inputs['value4'];
        }
    }

    public function resetForm()
    {
        $this->to_calculate = '2d';
        $this->value = '13';
        $this->value1 = '-10';
        $this->value2 = '7';
        $this->value3 = '-6';
        $this->value4 = '4';
        $this->error = null;
        $this->detail = null;

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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'to_calculate' => $this->to_calculate,
            'value' => $this->value,
            'value1' => $this->value1,
            'value2' => $this->value2,
            'value3' => $this->value3,
            'value4' => $this->value4,
        ];

        $model = new Math();
        $result = $model->discriminant($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
        return view('livewire.calculators.discriminant-calculator');
    }
}
