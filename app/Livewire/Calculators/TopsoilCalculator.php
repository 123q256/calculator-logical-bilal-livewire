<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class TopsoilCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $calculation_unit = '1';
    public $length = '15';
    public $length_unit = 'ft';
    public $width = '24';
    public $width_unit = 'ft';
    public $depth = '24';
    public $depth_unit = 'in';
    public $area = '15';
    public $area_unit = 'sq ft';
    
    public $purchase_unit = '1';
    public $bag_size = '5';
    public $bag_size_unit = 'cu ft';
    public $price_per_bag = '';
    public $price_per_ton = '';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        
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
        $this->reset([
            'error', 'detail', 'calculation_unit', 'length', 'length_unit', 
            'width', 'width_unit', 'depth', 'depth_unit', 'area', 'area_unit', 
            'purchase_unit', 'bag_size', 'bag_size_unit', 'price_per_bag', 'price_per_ton'
        ]);
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
        $requestData = [
            'length' => $this->length,
            'width' => $this->width,
            'depth' => $this->depth,
            'area' => $this->area,
            'length_unit' => $this->length_unit,
            'width_unit' => $this->width_unit,
            'depth_unit' => $this->depth_unit,
            'area_unit' => $this->area_unit,
            'calculation_unit' => $this->calculation_unit,
            'purchase_unit' => $this->purchase_unit,
            'bag_size' => $this->bag_size,
            'bag_size_unit' => $this->bag_size_unit,
            'price_per_bag' => $this->price_per_bag,
            'price_per_ton' => $this->price_per_ton,
        ];

        $request = (object) $requestData;
        $model = new Construction();
        $result = $model->topsoil($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.topsoil-calculator');
    }
}
