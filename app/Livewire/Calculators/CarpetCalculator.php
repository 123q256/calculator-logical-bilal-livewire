<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class CarpetCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $shape = 'Rectangle';
    public $length = '8';
    public $length_unit = 'm';
    public $width = '30';
    public $width_unit = 'm';
    public $radius = '30';
    public $radius_unit = 'm';
    public $axis_a = '30';
    public $axis_a_unit = 'm';
    public $axis_b = '30';
    public $axis_b_unit = 'm';
    public $side = '30';
    public $side_unit = 'm';
    public $sides = '30';
    public $sides_unit = 'm';
    public $carpet = '30';
    public $carpet_unit = 'm²';
    public $price = '30';
    public $price_unit = 'm²';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        
        // Initialize translated shape if available
        if (isset($lang[2])) {
            $this->shape = $lang[2];
        }

        // Initialize price unit with currency
        $this->price_unit = $this->currancy . ' m²';

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

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'length', 'width', 'radius', 'axis_a', 'axis_b', 'side', 'sides', 'carpet', 'price']);
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
        
        // Determine the internal shape name for the model
        $internalShape = 'Rectangle';
        if ($this->shape === ($this->lang[3] ?? 'Circle')) $internalShape = 'Circle';
        elseif ($this->shape === ($this->lang[4] ?? 'Ellipse')) $internalShape = 'Ellipse';
        elseif ($this->shape === ($this->lang[5] ?? 'Pentagon')) $internalShape = 'Pentagon';
        elseif ($this->shape === ($this->lang[6] ?? 'Hexagon')) $internalShape = 'Hexagon';
        elseif ($this->shape === ($this->lang[7] ?? 'Other')) $internalShape = 'Other';

        $request = (object)[
            'shape' => $internalShape,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'width' => $this->width,
            'width_unit' => $this->width_unit,
            'radius' => $this->radius,
            'radius_unit' => $this->radius_unit,
            'axis_a' => $this->axis_a,
            'axis_a_unit' => $this->axis_a_unit,
            'axis_b' => $this->axis_b,
            'axis_b_unit' => $this->axis_b_unit,
            'side' => $this->side,
            'side_unit' => $this->side_unit,
            'sides' => $this->sides,
            'sides_unit' => $this->sides_unit,
            'carpet' => $this->carpet,
            'carpet_unit' => $this->carpet_unit,
            'price' => $this->price,
            'price_unit' => $this->price_unit,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->carpet($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
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
        return view('livewire.calculators.carpet-calculator');
    }
}
