<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class FrictionLossCalculator extends Component
{
    public $pipe_diameter = 12;
    public $pipe_diameter_unit = 'm';
    public $pipe_length = 10;
    public $pipe_length_unit = 'm';
    public $volumetric = 10;
    public $volumetric_unit = 'm³/s';
    public $material = '130';

    public $dropdowns = [];

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
            $this->pipe_diameter = $inputs->pipe_diameter ?? 12;
            $this->pipe_diameter_unit = $inputs->pipe_diameter_unit ?? 'm';
            $this->pipe_length = $inputs->pipe_length ?? 10;
            $this->pipe_length_unit = $inputs->pipe_length_unit ?? 'm';
            $this->volumetric = $inputs->volumetric ?? 10;
            $this->volumetric_unit = $inputs->volumetric_unit ?? 'm³/s';
            $this->material = $inputs->material ?? '130';
        }
    }

    public function updated($propertyName)
    {
        if (strpos($propertyName, 'dropdowns') === false) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($id)
    {
        $this->dropdowns[$id] = !($this->dropdowns[$id] ?? false);
    }

    public function setUnit($property, $unit, $dropdownId = null)
    {
        $this->{$property} = $unit;
        if ($dropdownId) {
            $this->dropdowns[$dropdownId] = false;
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->pipe_diameter = 12;
        $this->pipe_diameter_unit = 'm';
        $this->pipe_length = 10;
        $this->pipe_length_unit = 'm';
        $this->volumetric = 10;
        $this->volumetric_unit = 'm³/s';
        $this->material = '130';

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
            'pipe_diameter'      => (float)$this->pipe_diameter,
            'pipe_diameter_unit' => $this->pipe_diameter_unit,
            'pipe_length'        => (float)$this->pipe_length,
            'pipe_length_unit'   => $this->pipe_length_unit,
            'volumetric'         => (float)$this->volumetric,
            'volumetric_unit'    => $this->volumetric_unit,
            'material'           => $this->material,
        ];

        $model = new Physics();
        $result = $model->friction_loss($request);

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
   

        return view('livewire.calculators.friction-loss-calculator');
    }
}
