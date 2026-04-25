<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class MoleCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Properties
    public $cal = 'moles';
    public $mass = 5;
    public $mass_unit = 'pg';
    public $mw = 4;
    public $moles = 5;
    public $moles_unit = 'M';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if(isset($inputs->cal)){
                $this->cal = $inputs->cal;
                $this->mass = $inputs->mass;
                $this->mass_unit = $inputs->mass_unit;
                $this->mw = $inputs->mw;
                $this->moles = $inputs->moles;
                $this->moles_unit = $inputs->moles_unit;
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['cal', 'mass', 'mass_unit', 'mw', 'moles', 'moles_unit', 'error', 'detail']);
        $this->resetErrorBag();
        $this->resetValidation();

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

    public function updatedCal()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'cal' => $this->cal,
            'mass' => $this->mass,
            'mass_unit' => $this->mass_unit,
            'mw' => $this->mw,
            'moles' => $this->moles,
            'moles_unit' => $this->moles_unit,
        ];

        $model = new Chemistry();
        $result = $model->mole($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);

                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $request);
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
                }, 100);
            JS);
        }
   
        return view('livewire.calculators.mole-calculator');
    }
}
