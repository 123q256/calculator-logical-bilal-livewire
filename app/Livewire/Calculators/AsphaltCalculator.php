<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class AsphaltCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form Fields
    public $cal = 'lwt';
    public $length = 24;
    public $length_unit = 'cm';
    public $width = 10;
    public $width_unit = 'cm';
    public $area = 10;
    public $area_unit = 'm²';
    public $depth = 15;
    public $depth_unit = 'cm';
    public $volume = 15;
    public $volume_unit = 'm³';
    public $density = 12;
    public $density_unit = 'kg/m³';
    public $cs_depth = 15;
    public $cs_depth_unit = 'cm';
    public $depth_dr = 15;
    public $depth_dr_unit = 'cm';
    public $cost = 15;
    public $cost_unit = '$ kg';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->cost_unit = $currancy . ' kg';

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

    public function toggleOverlay($dropdown)
    {
        $this->showDropdown = ($this->showDropdown === $dropdown) ? null : $dropdown;
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->showDropdown = null;
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

    public function calculate()
    {
        $this->error = null;
        $request = (object)[
            'cal' => $this->cal,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'width' => $this->width,
            'width_unit' => $this->width_unit,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'depth' => $this->depth,
            'depth_unit' => $this->depth_unit,
            'volume' => $this->volume,
            'volume_unit' => $this->volume_unit,
            'density' => $this->density,
            'density_unit' => $this->density_unit,
            'cs_depth' => $this->cs_depth,
            'cs_depth_unit' => $this->cs_depth_unit,
            'depth_dr' => $this->depth_dr,
            'depth_dr_unit' => $this->depth_dr_unit,
            'cost' => $this->cost,
            'cost_unit' => $this->cost_unit,
        ];

        $model = new Construction();
        $result = $model->asphalt($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (array)$request);
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
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
        return view('livewire.calculators.asphalt-calculator');
    }
}
