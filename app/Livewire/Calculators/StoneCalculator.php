<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class StoneCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form fields
    public $selection = 1;
    public $material = '105';
    public $length = 7;
    public $length_unit = 'cm';
    public $width = 6;
    public $width_unit = 'cm';
    public $area = 6;
    public $area_unit = 'ft²';
    public $depth = 6;
    public $depth_unit = 'cm';
    public $volume = 6;
    public $volume_unit = 'ft³';
    public $price = null;
    public $price_unit = '$ per ton';
    public $currancy = '$';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->selection = $inputs->selection ?? 1;
            $this->material = $inputs->material ?? '105';
            $this->length = $inputs->length ?? 7;
            $this->length_unit = $inputs->length_unit ?? 'cm';
            $this->width = $inputs->width ?? 6;
            $this->width_unit = $inputs->width_unit ?? 'cm';
            $this->area = $inputs->area ?? 6;
            $this->area_unit = $inputs->area_unit ?? 'ft²';
            $this->depth = $inputs->depth ?? 6;
            $this->depth_unit = $inputs->depth_unit ?? 'cm';
            $this->volume = $inputs->volume ?? 6;
            $this->volume_unit = $inputs->volume_unit ?? 'ft³';
            $this->price = $inputs->price ?? null;
            $this->price_unit = $inputs->price_unit ?? '$ per ton';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function setSelection($val)
    {
        $this->selection = $val;
        $this->detail = null;
    }

    public function toggleDropdown($name)
    {
        if ($this->showDropdown === $name) {
            $this->showDropdown = null;
        } else {
            $this->showDropdown = $name;
        }
    }

    public function setUnit($dropdown, $unit)
    {
        $this->$dropdown = $unit;
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'selection', 'material', 'length', 'length_unit', 'width', 'width_unit', 'area', 'area_unit', 'depth', 'depth_unit', 'volume', 'volume_unit', 'price', 'price_unit'
        ]);

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

    public function calculate()
    {
        $request = (object)[
            'selection'     => $this->selection,
            'material'      => $this->material,
            'length'        => $this->length,
            'length_unit'   => $this->length_unit,
            'width'         => $this->width,
            'width_unit'    => $this->width_unit,
            'area'          => $this->area,
            'area_unit'     => $this->area_unit,
            'depth'         => $this->depth,
            'depth_unit'    => $this->depth_unit,
            'volume'        => $this->volume,
            'volume_unit'   => $this->volume_unit,
            'price'         => $this->price,
            'price_unit'    => $this->price_unit,
            'currancy'      => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->stone($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                $this->error = null;
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
                return;
            }
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->flash('validation_error', $this->error);
            return redirect()->to(url()->previous() ?? '/');
        } else {
            $this->detail = null;
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
        return view('livewire.calculators.stone-calculator');
    }
}
