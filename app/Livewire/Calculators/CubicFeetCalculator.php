<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class CubicFeetCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $room_unit = '1';
    public $currancy;
    public $area = 8;
    public $area_unit = 'in';
    public $length = 5;
    public $length_unit = 'm';
    public $width = 6;
    public $width_unit = 'm';
    public $height = 3;
    public $height_unit = 'm';
    public $weight = 17;
    public $weight_unit = 'lbs';
    public $quantity = '1';
    public $price = '';
    public $price_unit = 'ft³';
    protected $listeners = ['refreshCube' => '$refresh'];

    public function mount($type = 'calculator', $lang = [], $currancy = null)
    {
        $this->currancy = $currancy ?? $this->currancy;
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            foreach (session('calculator_back_inputs') as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function changeRoom_unit()
    {
        // Agar koi logic chalani ho change par to yahan karein
    }
    public function setAreaUnit($unit)
    {
        $this->area_unit = $unit;
    }
    public function setLengthUnit($unit)
    {
        $this->length_unit = $unit;
    }


    public function setWidthUnit($unit)
    {
        $this->width_unit = $unit;
    }



    public function setHeightUnit($unit)
    {
        $this->height_unit = $unit;
    }
    public function setWeightUnit($unit)
    {
        $this->weight_unit = $unit;
    }
    public function setPriceUnit($unit)
    {
        $this->price_unit = $unit;
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

        return redirect()->to(url()->previous() ?? '/');
    }

    public function calculate()
    {
        $request = (object)[
            'type'         => $this->type,
            'lang'         => $this->lang,
            'room_unit'    => $this->room_unit,
            'currancy'     => $this->currancy,
            'area'         => $this->area,
            'area_unit'    => $this->area_unit,
            'length'       => $this->length,
            'length_unit'  => $this->length_unit,
            'width'        => $this->width,
            'width_unit'   => $this->width_unit,
            'height'       => $this->height,
            'height_unit'  => $this->height_unit,
            'weight'       => $this->weight,
            'weight_unit'  => $this->weight_unit,
            'quantity'     => $this->quantity,
            'price'        => $this->price,
            'price_unit'   => $this->price_unit,
        ];
        // dd($request);
        $model = new Construction();
        $result = $model->cubic($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            return redirect()->to(url()->previous() ?? '/');
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = 30;
                    const top = el.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                    
                    // Initialize the cube drawing after scroll
                    setTimeout(() => {
                        if (document.getElementById('myCanvas')) {
                            drawCube();
                        }
                    }, 500);
                }
            JS);
        } else {
            $this->js(<<<'JS'
                if (document.getElementById('myCanvas')) {
                    drawCube();
                }
            JS);
        }

        return view('livewire.calculators.cubic-feet-calculator');
    }
}
