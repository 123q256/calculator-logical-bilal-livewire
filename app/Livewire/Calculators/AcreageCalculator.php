<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class AcreageCalculator extends Component
{

       public $error;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $calName;
    public $calLink;

    public $to_cal = '1';
    public $length = '4';
    public $length_unit = 'cm';
    public $width = '4';
    public $width_unit = 'cm';
    public $area = '12';
    public $area_unit = 'm²';
    public $price = '';
    public $price_unit = '$/m²';
    public $currancy = '$';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->price_unit = $this->currancy . '/m²';

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

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'to_cal', 'length', 'length_unit', 'width', 
            'width_unit', 'area', 'area_unit', 'price'
        ]);
        $this->resetErrorBag();
        session()->forget(['calculator_result', 'validation_error', 'calculator_back_inputs', 'scroll_to_result']);
        return redirect()->to(url()->previous() ?? '/');
    }

    public function updatedToCal()
    {
        $this->detail = null;
        session()->forget(['calculator_result', 'validation_error']);
    }

    public function calculate()
    {
        $this->error = null;
        $request = (object)[
            'to_cal'      => $this->to_cal,
            'length'      => $this->length,
            'length_unit' => $this->length_unit,
            'width'       => $this->width,
            'width_unit'  => $this->width_unit,
            'area'        => $this->area,
            'area_unit'   => $this->area_unit,
            'price'       => $this->price,
            'price_unit'  => $this->price_unit,
            'currancy'    => $this->currancy,
        ];

        $model  = new \App\Models\Construction();
        $result = $model->acreage($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->put('calculator_back_inputs', $request);
            $this->error = null;
            return redirect()->to(url()->previous() ?? '/');
        }

        $this->error  = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
        session()->flash('validation_error', $this->error);
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

    public function render()
    {
            if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            JS);
        }
        return view('livewire.calculators.acreage-calculator');
    }
}
