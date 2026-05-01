<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class ResultantForceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Reactive arrays for dynamic inputs
    public $forces = ['', ''];
    public $angles = ['', ''];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (is_object($inputs)) {
                $this->forces = (array)$inputs->force;
                $this->angles = (array)$inputs->angle;
            }
        }
    }

    public function addForce()
    {
        if (count($this->forces) < 10) {
            $this->forces[] = '';
            $this->angles[] = '';
        } else {
            $this->error = 'Maximum 10 forces allowed.';
        }
    }

    public function removeForce($index)
    {
        if (count($this->forces) > 2) {
            unset($this->forces[$index]);
            unset($this->angles[$index]);
            $this->forces = array_values($this->forces);
            $this->angles = array_values($this->angles);
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->forces = ['', ''];
        $this->angles = ['', ''];

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
        // Filter out empty values
        $validForces = [];
        $validAngles = [];
        
        foreach ($this->forces as $index => $force) {
            if (is_numeric($force) && is_numeric($this->angles[$index])) {
                $validForces[] = $force;
                $validAngles[] = $this->angles[$index];
            }
        }

        if (count($validForces) < 2) {
            $this->error = 'Please enter at least 2 forces and angles.';
            return;
        }

        $request = (object)[
            'force' => $validForces,
            'angle' => $validAngles,
        ];

        $model = new Physics();
        $result = $model->resultant($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);

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
        }
    }

    public function render()
    {
        return view('livewire.calculators.resultant-force-calculator');
    }
}
