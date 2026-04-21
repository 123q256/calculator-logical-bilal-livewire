<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class SonotubeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $size_unit = '16 (40.64 cm)';
    public $height = '120';
    public $height_unit = 'cm';
    public $quantity = '1';
    public $concerete_mix_unit = ""; // Will be set in mount to $lang['7']
    public $density = '6';
    public $density_unit = 'kg/m³';
    public $concrete_ratio_unit = '1:5:10 (5.0 MPa or 725 psi)';
    public $bag_size = '10';
    public $bag_size_unit = 'kg';
    public $waste = '5';
    public $Cost_bag_mix = '10';
    public $Cost_of_cement = '50';
    public $Cost_of_cement_unit = '$ cm³'; // Placeholder, will be updated with currency
    public $Cost_of_sand = '50';
    public $Cost_of_sand_unit = '$ m³';
    public $Cost_of_gravel = '50';
    public $Cost_of_gravel_unit = '$ m³';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->concerete_mix_unit = $lang['7'] ?? "I'll get pre-mixed concrete bags";
        
        $this->Cost_of_cement_unit = $this->currancy . ' cm³';
        $this->Cost_of_sand_unit = $this->currancy . ' m³';
        $this->Cost_of_gravel_unit = $this->currancy . ' m³';

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

    public function updatedConcereteMixUnit()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updatedSizeUnit()
    {
        $this->detail = null;
        $this->error = null;
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
        $this->reset(['error', 'detail', 'size_unit', 'height', 'height_unit', 'quantity', 'density', 'bag_size', 'waste', 'Cost_bag_mix', 'Cost_of_cement', 'Cost_of_sand', 'Cost_of_gravel']);
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
            'size_unit' => $this->size_unit,
            'height' => $this->height,
            'height_unit' => $this->height_unit,
            'quantity' => $this->quantity,
            'concerete_mix_unit' => $this->concerete_mix_unit,
            'density' => $this->density,
            'density_unit' => $this->density_unit,
            'concrete_ratio_unit' => $this->concrete_ratio_unit,
            'bag_size' => $this->bag_size,
            'bag_size_unit' => $this->bag_size_unit,
            'waste' => $this->waste,
            'Cost_bag_mix' => $this->Cost_bag_mix,
            'Cost_of_cement' => $this->Cost_of_cement,
            'Cost_of_cement_unit' => $this->Cost_of_cement_unit,
            'Cost_of_sand' => $this->Cost_of_sand,
            'Cost_of_sand_unit' => $this->Cost_of_sand_unit,
            'Cost_of_gravel' => $this->Cost_of_gravel,
            'Cost_of_gravel_unit' => $this->Cost_of_gravel_unit,
        ];

        $model = new Construction();
        $result = $model->sonotube($request);

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
        return view('livewire.calculators.sonotube-calculator');
    }
}
