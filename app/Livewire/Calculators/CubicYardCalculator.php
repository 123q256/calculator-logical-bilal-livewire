<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class CubicYardCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $operations = '3';
    public $extra_area = '8';
    public $extra_units = 'ft²';
    public $first = '8';
    public $units1 = 'in';
    public $second = '8';
    public $units2 = 'in';
    public $third = '8';
    public $units3 = 'in';
    public $four = '17';
    public $units4 = 'in';
    public $five = '17';
    public $units5 = 'in';
    public $fiveb = '17';
    public $price = '17';
    public $price_unit = 'ft³';
    public $quantity = '1';

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
            'error', 'detail', 'operations', 'extra_area', 'extra_units', 'first', 'units1', 'second', 'units2', 'third', 'units3', 'four', 'units4', 'five', 'units5', 'fiveb', 'price', 'price_unit', 'quantity'
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
            'operations' => $this->operations,
            'extra_area' => $this->extra_area,
            'extra_units' => $this->extra_units,
            'first' => $this->first,
            'units1' => $this->units1,
            'second' => $this->second,
            'units2' => $this->units2,
            'third' => $this->third,
            'units3' => $this->units3,
            'four' => $this->four,
            'units4' => $this->units4,
            'five' => $this->five,
            'units5' => $this->units5,
            'fiveb' => $this->fiveb,
            'price' => $this->price,
            'price_unit' => $this->price_unit,
            'quantity' => $this->quantity,
            'currancy' => $this->currancy,
        ];

        $request = (object) $requestData;
        $model = new Construction();
        $result = $model->yard($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
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
            
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
            }
        }
    }

    private function getShapeConfig()
    {
        $configs = [
            '3' => ['show' => ['1','2','3','6'], 'labels' => ['first'=>'Depth:', 'second'=>'Length:', 'third'=>'Width:'], 'placeholders' => ['first'=>'Depth', 'second'=>'Length', 'third'=>'Width'], 'image' => 'cubic-yards-rectangle.png'],
            '4' => ['show' => ['1','2','6'], 'labels' => ['first'=>'Depth:', 'second'=>'Side Length:'], 'placeholders' => ['first'=>'Depth', 'second'=>'Side Length'], 'image' => 'cubic-yards-square.png'],
            '5' => ['show' => ['1','2','3','4','6'], 'labels' => ['first'=>'Depth:', 'second'=>'Inner Length:', 'third'=>'Inner Width:', 'four'=>'Border Width:'], 'placeholders' => ['first'=>'Depth', 'second'=>'Inner Length', 'third'=>'Inner Width', 'four'=>'Border Width'], 'image' => 'cubic-yards-rectangle-border.png'],
            '6' => ['show' => ['1','2','6'], 'labels' => ['first'=>'Depth:', 'second'=>'Diameter:'], 'placeholders' => ['first'=>'Depth', 'second'=>'Diameter'], 'image' => 'cubic-yards-circle.png'],
            '7' => ['show' => ['1','2','3','6'], 'labels' => ['first'=>'Depth:', 'second'=>'Inner Diameter:', 'third'=>'Border Width:'], 'placeholders' => ['first'=>'Depth', 'second'=>'Inner Diameter', 'third'=>'Border Width'], 'image' => 'cubic-yards-circle-border.png'],
            '8' => ['show' => ['1','2','3','6'], 'labels' => ['first'=>'Depth:', 'second'=>'Outer Diameter:', 'third'=>'Inner Diameter:'], 'placeholders' => ['first'=>'Depth', 'second'=>'Outer Diameter', 'third'=>'Inner Diameter'], 'image' => 'cubic-yards-annulus.png'],
            '9' => ['show' => ['1','2','3','4','6'], 'labels' => ['first'=>'Depth:', 'second'=>'Side a Length:', 'third'=>'Side b Length:', 'four'=>'Side c Length:'], 'placeholders' => ['first'=>'Depth', 'second'=>'Side a Length', 'third'=>'Side b Length', 'four'=>'Side c Length'], 'image' => 'cubic-yards-triangle.png'],
            '10' => ['show' => ['1','2','3','4','6'], 'labels' => ['first'=>'Depth:', 'second'=>'Side a Length:', 'third'=>'Side b Length:', 'four'=>'Height h:'], 'placeholders' => ['first'=>'Depth', 'second'=>'Side a Length', 'third'=>'Side b Length', 'four'=>'Height h'], 'image' => 'cubic-yards-trapezoid.png'],
            '11' => ['show' => ['1','6'], 'labels' => ['first'=>'Length and Depth / Height:'], 'placeholders' => ['first'=>'Length and Depth / Height'], 'image' => 'cube_yard.png'],
            '12' => ['show' => ['1','2','6'], 'labels' => ['first'=>'Radius:', 'second'=>'Depth / Height:'], 'placeholders' => ['first'=>'Radius', 'second'=>'Depth / Height'], 'image' => 'cylinder_yard.png'],
            '13' => ['show' => ['1','2','3','6'], 'labels' => ['first'=>'Outer Radius:', 'second'=>'Inner Radius:', 'third'=>'Depth:'], 'placeholders' => ['first'=>'Outer Radius', 'second'=>'Inner Radius', 'third'=>'Depth'], 'image' => 'hollow-cylinder_yard.png'],
            '14' => ['show' => ['1','6'], 'labels' => ['first'=>'Radius:'], 'placeholders' => ['first'=>'Radius'], 'image' => 'hemisphere_yard.png'],
            '15' => ['show' => ['1','2','6'], 'labels' => ['first'=>'Radius:', 'second'=>'Depth / Height:'], 'placeholders' => ['first'=>'Radius', 'second'=>'Depth / Height'], 'image' => 'cone_yard.png'],
            '16' => ['show' => ['2','6','extra'], 'labels' => ['second'=>'Depth / Height:'], 'placeholders' => ['second'=>'Depth / Height'], 'image' => 'pyramid_yard.png'],
            '17' => ['show' => ['2','6','extra'], 'labels' => ['second'=>'Depth / Height:'], 'placeholders' => ['second'=>'Depth / Height'], 'image' => 'other_yard.png'],
        ];
        return $configs[$this->operations] ?? $configs['3'];
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
        
        return view('livewire.calculators.cubic-yard-calculator', [
            'shapeConfig' => $this->getShapeConfig()
        ]);
    }
}
