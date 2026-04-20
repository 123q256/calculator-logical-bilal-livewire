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
        $this->detail = null;
        $this->error  = null;

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'validation_error']);
        }
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

        $this->error  = null;
        $this->detail = null;

        $this->room_unit   = '1';
        $this->area        = 8;
        $this->area_unit   = 'in';
        $this->length      = 5;
        $this->length_unit = 'm';
        $this->width       = 6;
        $this->width_unit  = 'm';
        $this->height      = 3;
        $this->height_unit = 'm';
        $this->weight      = 17;
        $this->weight_unit = 'lbs';
        $this->quantity    = '1';
        $this->price       = '';
        $this->price_unit  = 'ft³';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result',
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'type'        => $this->type,
            'lang'        => $this->lang,
            'room_unit'   => $this->room_unit,
            'currancy'    => $this->currancy,
            'area'        => $this->area,
            'area_unit'   => $this->area_unit,
            'length'      => $this->length,
            'length_unit' => $this->length_unit,
            'width'       => $this->width,
            'width_unit'  => $this->width_unit,
            'height'      => $this->height,
            'height_unit' => $this->height_unit,
            'weight'      => $this->weight,
            'weight_unit' => $this->weight_unit,
            'quantity'    => $this->quantity,
            'price'       => $this->price,
            'price_unit'  => $this->price_unit,
        ];

        $model  = new Construction();
        $result = $model->cubic($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error  = null;

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
                        // Draw cube after Livewire DOM update
                        setTimeout(() => {
                            if (document.getElementById('myCanvas')) {
                                drawCube();
                            }
                        }, 400);
                    }, 100);
                JS);
            }
        } else {
            $this->error  = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
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
                setTimeout(() => {
                    if (document.getElementById('myCanvas')) {
                        drawCube();
                    }
                }, 300);
            JS);
        }

        return view('livewire.calculators.cubic-feet-calculator');
    }
}
