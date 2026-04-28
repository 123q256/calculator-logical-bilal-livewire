<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class ReynoldsNumberCalculator extends Component
{
    public $fluid_substance = 'custom';
    public $fluid_density = 1200;
    public $fluid_density_unit = 'kg/m³';
    public $dynamic_velocity = 1200;
    public $dynamic_velocity_unit = 'kg-m-s';
    public $fluid_velocity = 5;
    public $fluid_velocity_unit = 'm-s';
    public $linear_dimension = 5;
    public $linear_dimension_unit = 'm'; // Corrected default unit to 'm' as per model expectations (though blade had m-s?)

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

    public function updatedFluidSubstance($value)
    {
        if ($value !== 'custom') {
            $parts = explode('|', $value);
            $this->fluid_density = $parts[0];
            $this->dynamic_velocity = $parts[1];
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
        
        $this->fluid_substance = 'custom';
        $this->fluid_density = 1200;
        $this->dynamic_velocity = 1200;
        $this->fluid_velocity = 5;
        $this->linear_dimension = 5;

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
            'fluid_density' => 'required|numeric',
            'dynamic_velocity' => 'required|numeric',
            'fluid_velocity' => 'required|numeric',
            'linear_dimension' => 'required|numeric',
        ]);

        $request = (object)[
            'fluid_substance'       => $this->fluid_substance,
            'fluid_density'         => $this->fluid_density,
            'fluid_density_unit'    => $this->fluid_density_unit,
            'dynamic_velocity'      => $this->dynamic_velocity,
            'dynamic_velocity_unit' => $this->dynamic_velocity_unit,
            'fluid_velocity'        => $this->fluid_velocity,
            'fluid_velocity_unit'   => $this->fluid_velocity_unit,
            'linear_dimension'      => $this->linear_dimension,
            'linear_dimension_unit' => $this->linear_dimension_unit,
        ];

        $model = new Physics();
        $result = $model->reynolds($request);

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
        return view('livewire.calculators.reynolds-number-calculator');
    }
}
