<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class CoefficientOfVariationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $x = '12, 23, 45, 33, 65, 54, 54';
    public $type_ = '1';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'x', 'type_']);
        $this->type_ = '1';
        $this->x = '12, 23, 45, 33, 65, 54, 54';

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
        $request = (object)[
            'x'         => $this->x,
            'type_'     => $this->type_,
        ];

        $model = new Statistics();
        $result = $model->coefficient($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
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
                $nextTick(() => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                });
            JS);
        }
        return view('livewire.calculators.coefficient-of-variation-calculator');
    }
}
