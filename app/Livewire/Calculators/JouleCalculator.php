<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class JouleCalculator extends Component
{
    public $mass = 5;
    public $mass_unit = '1';
    public $velocity = 4;
    public $velocity_unit = '1';
    public $joule_unit = 'Joule (J)';

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
            $this->mass = $inputs->mass ?? 5;
            $this->mass_unit = $inputs->mass_unit ?? '1';
            $this->velocity = $inputs->velocity ?? 4;
            $this->velocity_unit = $inputs->velocity_unit ?? '1';
            $this->joule_unit = $inputs->joule_unit ?? 'Joule (J)';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->mass = 5;
        $this->mass_unit = '1';
        $this->velocity = 4;
        $this->velocity_unit = '1';
        $this->joule_unit = 'Joule (J)';

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
        $request = (object)[
            'mass'          => (float)$this->mass,
            'mass_unit'     => (float)$this->mass_unit,
            'velocity'      => (float)$this->velocity,
            'velocity_unit' => (float)$this->velocity_unit,
            'joule_unit'    => $this->joule_unit,
        ];

        $model = new Physics();
        $result = $model->joule($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
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
            session()->flash('validation_error', $this->error);
        }
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
  
        return view('livewire.calculators.joule-calculator');
    }
}
