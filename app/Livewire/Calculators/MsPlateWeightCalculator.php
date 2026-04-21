<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class MsPlateWeightCalculator extends Component
{
    public $error;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $st_type = '7715';
    public $st_shape = '1';
    public $length = '6';
    public $length_unit = 'cm';
    public $width = '6';
    public $width_unit = 'cm';
    public $thickness = '6';
    public $thickness_unit = 'cm';
    public $side = '6';
    public $side_unit = 'cm';
    public $diameter = '6';
    public $diameter_unit = 'cm';
    public $area = '6';
    public $area_unit = 'cm²';
    public $quantity = '5';

    public $showDropdown = null;

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

    public function toggleOverlay($id)
    {
        if ($this->showDropdown === $id) {
            $this->showDropdown = null;
        } else {
            $this->showDropdown = $id;
        }
    }

    public function setUnit($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        $this->showDropdown = null;
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'st_type', 'st_shape', 'length', 'length_unit',
            'width', 'width_unit', 'thickness', 'thickness_unit', 'side',
            'side_unit', 'diameter', 'diameter_unit', 'area', 'area_unit', 'quantity'
        ]);
        $this->resetErrorBag();
        session()->forget(['calculator_result', 'validation_error', 'calculator_back_inputs', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $this->error = null;
        $request = (object)[
            'st_type' => $this->st_type,
            'st_shape' => $this->st_shape,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'width' => $this->width,
            'width_unit' => $this->width_unit,
            'thickness' => $this->thickness,
            'thickness_unit' => $this->thickness_unit,
            'side' => $this->side,
            'side_unit' => $this->side_unit,
            'diameter' => $this->diameter,
            'diameter_unit' => $this->diameter_unit,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'quantity' => $this->quantity,
        ];

        $model = new Construction();
        $result = $model->ms($request);

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
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
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
        return view('livewire.calculators.ms-plate-weight-calculator');
    }
}
