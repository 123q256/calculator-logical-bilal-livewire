<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class FlowRateCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $conversion_type = '1';
    public $choice_unit = 'cp';
    public $volume = 12;
    public $volume_unit = 'fluid-ounce';
    public $time = 12;
    public $time_unit = 'second';
    public $diameter = 12;
    public $diameter_unit = 'cm';
    public $velocity = 12;
    public $velocity_unit = 'ms';
    public $density = 12;
    public $density_unit = 'kg';
    public $filled = 12;
    public $filled_unit = 'cm';
    public $height = 12;
    public $height_unit = 'cm';
    public $width = 12;
    public $width_unit = 'cm';
    public $cross = 12;
    public $cross_unit = 'cm²';
    public $top_width = 12;
    public $top_width_unit = 'cm';
    public $bottom_width = 2;
    public $bottom_width_unit = 'cm';
    public $pressure_start = 2;
    public $pressure_start_unit = 'Pa';
    public $pressure_end = 45;
    public $pressure_end_unit = 'Pa';
    public $pipe_length = 45;
    public $pipe_length_unit = 'cm';
    public $dynamic_viscosity = 45;
    public $dynamic_viscosity_unit = 'kgms';

    public $openDropdown = null;

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
        if ($propertyName !== 'openDropdown') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($name, $value)
    {
        $this->$name = $value;
        $this->openDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function getFlowImage()
    {
        if ($this->conversion_type == '2') {
            return asset('images/pressure.png');
        }
        
        if ($this->conversion_type == '3') {
            return null; // No image for volume/time
        }

        switch ($this->choice_unit) {
            case 'cp': return asset('images/circular.png?v=1');
            case 'cpf': return asset('images/circular_partial.png');
            case 'rec': return asset('images/recta.png');
            case 'other': return asset('images/oth.png');
            default: return asset('images/circular.png?v=1');
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->conversion_type = '1';
        $this->choice_unit = 'cp';
        $this->volume = 12;
        $this->volume_unit = 'fluid-ounce';
        $this->time = 12;
        $this->time_unit = 'second';
        $this->diameter = 12;
        $this->diameter_unit = 'cm';
        $this->velocity = 12;
        $this->velocity_unit = 'ms';
        $this->density = 12;
        $this->density_unit = 'kg';
        $this->filled = 12;
        $this->filled_unit = 'cm';
        $this->height = 12;
        $this->height_unit = 'cm';
        $this->width = 12;
        $this->width_unit = 'cm';
        $this->cross = 12;
        $this->cross_unit = 'cm²';
        $this->top_width = 12;
        $this->top_width_unit = 'cm';
        $this->bottom_width = 2;
        $this->bottom_width_unit = 'cm';
        $this->pressure_start = 2;
        $this->pressure_start_unit = 'Pa';
        $this->pressure_end = 45;
        $this->pressure_end_unit = 'Pa';
        $this->pipe_length = 45;
        $this->pipe_length_unit = 'cm';
        $this->dynamic_viscosity = 45;
        $this->dynamic_viscosity_unit = 'kgms';

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
        $requestData = [
            'conversion_type'        => $this->conversion_type,
            'choice_unit'            => $this->choice_unit,
            'volume'                 => $this->volume,
            'volume_unit'            => $this->volume_unit,
            'time'                   => $this->time,
            'time_unit'              => $this->time_unit,
            'diameter'               => $this->diameter,
            'diameter_unit'          => $this->diameter_unit,
            'velocity'               => $this->velocity,
            'velocity_unit'          => $this->velocity_unit,
            'density'                => $this->density,
            'density_unit'           => $this->density_unit,
            'filled'                 => $this->filled,
            'filled_unit'            => $this->filled_unit,
            'height'                 => $this->height,
            'height_unit'            => $this->height_unit,
            'width'                  => $this->width,
            'width_unit'             => $this->width_unit,
            'cross'                  => $this->cross,
            'cross_unit'             => $this->cross_unit,
            'top_width'              => $this->top_width,
            'top_width_unit'         => $this->top_width_unit,
            'bottom_width'           => $this->bottom_width,
            'bottom_width_unit'      => $this->bottom_width_unit,
            'pressure_start'         => $this->pressure_start,
            'pressure_start_unit'    => $this->pressure_start_unit,
            'pressure_end'           => $this->pressure_end,
            'pressure_end_unit'      => $this->pressure_end_unit,
            'pipe_length'            => $this->pipe_length,
            'pipe_length_unit'       => $this->pipe_length_unit,
            'dynamic_viscosity'      => $this->dynamic_viscosity,
            'dynamic_viscosity_unit' => $this->dynamic_viscosity_unit,
        ];

        $request = (object)$requestData;

        $model = new Physics();
        $result = $model->flow($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $requestData);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        if (session('scroll_to_result') || $this->detail) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.flow-rate-calculator');
    }
}
