<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class SandCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $shape = '0'; // 0: Rectangular, 1: Circular
    public $g = 'g1'; // g1: By Dimensions, g2: By Area, g3: By Volume
    public $length = '10';
    public $length_unit = 'ft';
    public $width = '10';
    public $width_unit = 'ft';
    public $area = '100';
    public $area_unit = 'ft²';
    public $depth = '2';
    public $depth_unit = 'in';
    public $volume = '20';
    public $volume_unit = 'ft³';
    public $density = '100';
    public $density_unit = 'lb/ft³';
    public $mass_price = '';
    public $mass_price_unit = 'lb'; // Default will be prefixed with currency in mount
    public $volume_price = '';
    public $volume_price_unit = 'ft³'; // Default will be prefixed with currency in mount
    public $diameter = '10';
    public $diameter_unit = 'ft';
    public $c_price = '';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';

        // Set default currency-prefixed units
        $this->mass_price_unit = $this->currancy . 'lb';
        $this->volume_price_unit = $this->currancy . 'ft³';

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

    public function setUnit($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'length', 'width', 'area', 'depth', 'volume', 'density', 'mass_price', 'volume_price', 'diameter', 'c_price']);
        $this->resetErrorBag();

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
            'shape' => $this->shape,
            'g' => $this->g,
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
            'mass_price' => $this->mass_price,
            'mass_price_unit' => $this->mass_price_unit,
            'volume_price' => $this->volume_price,
            'volume_price_unit' => $this->volume_price_unit,
            'diameter' => $this->diameter,
            'diameter_unit' => $this->diameter_unit,
            'c_price' => $this->c_price,
            'hiddencurrancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->sand($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1 || isset($result['weight'])) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (array)$request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
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
        return view('livewire.calculators.sand-calculator');
    }
}
