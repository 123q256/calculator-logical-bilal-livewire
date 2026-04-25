<?php
namespace App\Livewire\Calculators;

use Livewire\Component;

class PpmCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $calculator_name = 'calculator1';
    public $operations = '1';
    public $first = 4;
    public $drop1 = '1';
    public $drop2 = '1';
    public $drop3 = '';
    public $second = 2; // Molar Mass
    public $drop4 = '1';
    public $third = 2;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            $this->calculator_name = $inputs['calculator_name'] ?? $this->calculator_name;
            $this->operations = $inputs['operations'] ?? $this->operations;
            $this->first = $inputs['first'] ?? $this->first;
            $this->drop1 = $inputs['drop1'] ?? $this->drop1;
            $this->drop2 = $inputs['drop2'] ?? $this->drop2;
            $this->drop3 = $inputs['drop3'] ?? $this->drop3;
            $this->second = $inputs['second'] ?? $this->second;
            $this->drop4 = $inputs['drop4'] ?? $this->drop4;
            $this->third = $inputs['third'] ?? $this->third;
        }
    }

    public function updatedDrop3($value)
    {
        if (!empty($value)) {
            $this->second = $value;
        }
    }

    public function updatedCalculatorName()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;
        $this->reset(['operations', 'first', 'drop1', 'drop2', 'drop3', 'second', 'drop4', 'third']);

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $inputs = [
            'calculator_name' => $this->calculator_name,
            'operations' => $this->operations,
            'first' => $this->first,
            'drop1' => $this->drop1,
            'drop2' => $this->drop2,
            'drop3' => $this->drop3,
            'second' => $this->second,
            'drop4' => $this->drop4,
            'third' => $this->third,
        ];
        $request = (object)$inputs;

        $model = new \App\Models\Chemistry();
        $result = $model->ppm($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->detail['type'] = $result['type']; // Chemistry model sets this
            if ($this->calculator_name == 'calculator2') {
                $this->detail['drop4'] = $this->drop4;
            }
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $this->detail);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $inputs);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 50);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $inputs);
                return redirect()->to(url()->previous() ?? '/');
            }
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
                }, 50);
            JS);
        }
        return view('livewire.calculators.ppm-calculator');
    }
}

