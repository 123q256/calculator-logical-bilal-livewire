<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class TimeOfFlightCalculator extends Component
{
    public $a = 45;
    public $a_unit = 'deg';
    public $h = 5;
    public $h_unit = 'cm';
    public $v = 5;
    public $v_unit = 'ms';
    public $g = 9.80665;
    public $g_unit = 'msms2';

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
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        
        $this->a = 45;
        $this->h = 5;
        $this->v = 5;
        $this->g = 9.80665;

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
        $this->validate([
            'a' => 'required|numeric',
            'h' => 'required|numeric',
            'v' => 'required|numeric',
            'g' => 'required|numeric',
        ]);

        $request = (object)[
            'a'      => $this->a,
            'a_unit' => $this->a_unit,
            'h'      => $this->h,
            'h_unit' => $this->h_unit,
            'v'      => $this->v,
            'v_unit' => $this->v_unit,
            'g'      => $this->g,
            'g_unit' => $this->g_unit,
        ];

        $model = new Physics();
        $result = $model->time($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            
            $this->dispatch('initKaTeX');

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
        }
    }

    public function render()
    {
        return view('livewire.calculators.time-of-flight-calculator');
    }
}
