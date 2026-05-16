<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class PythagoreanTheoremCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $for = 'c';
    public $one = 12;
    public $two = 23;
    public $unit = 'ft';
    public $nbr = 5;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->for = $inputs['for'] ?? 'c';
            $this->one = $inputs['one'] ?? 12;
            $this->two = $inputs['two'] ?? 23;
            $this->unit = $inputs['unit'] ?? 'ft';
            $this->nbr = $inputs['nbr'] ?? 5;
        }
    }

    public function resetForm()
    {
        $this->for = 'c';
        $this->one = 12;
        $this->two = 23;
        $this->unit = 'ft';
        $this->nbr = 5;
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
            'for' => $this->for,
            'one' => $this->one,
            'two' => $this->two,
            'unit' => $this->unit,
            'nbr' => $this->nbr,
        ];

        $model = new Math();
        $result = $model->pythagorean($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;
            $this->detail = $result;
            $this->dispatch('math-updated');

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.pythagorean-theorem-calculator');
    }
}
