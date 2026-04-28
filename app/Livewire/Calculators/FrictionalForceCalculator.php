<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class FrictionalForceCalculator extends Component
{
    public $calc_method = '4';
    public $fr_co = 0.2;
    public $force = 1200;
    public $force_unit = 'N';
    public $fr = 1200;
    public $fr_unit = 'N';
    public $mass = 13;
    public $plane = 13;
    public $gravity = 9.81;

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
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

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
            'calculate'  => $this->calc_method,
            'fr_co'      => $this->fr_co,
            'force'      => $this->force,
            'force_unit' => $this->force_unit,
            'fr'         => $this->fr,
            'fr_unit'    => $this->fr_unit,
            'mass'       => $this->mass,
            'plane'      => $this->plane,
            'gravity'    => $this->gravity,
        ];

        $model = new Physics();
        $result = $model->frictional($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);

            $this->dispatch('initKaTeX');
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            session()->flash('validation_error', $this->error);
            return redirect()->to(url()->previous() ?? '/');
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
        return view('livewire.calculators.frictional-force-calculator');
    }
}
