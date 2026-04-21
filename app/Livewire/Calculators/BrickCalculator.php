<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class BrickCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Wall Properties
    public $wall_type = 'single';
    public $wall_length = '24';
    public $wall_length_unit = 'cm';
    public $wall_width = '24';
    public $wall_width_unit = 'cm';
    public $wall_height = '24';
    public $wall_height_unit = 'cm';

    // Brick Properties
    public $brick_type = '7.625x3.625';
    public $brick_wastage = '24';
    public $mortar_joint_thickness = '24';
    public $mortar_joint_thickness_unit = 'cm';
    public $brick_length = '24';
    public $brick_length_unit = 'cm';
    public $brick_width = '24';
    public $brick_width_unit = 'mm';
    public $brick_height = '24';
    public $brick_height_unit = 'mm';

    // Mortar Properties
    public $with_motar = 'no';
    public $wet_volume = '24';
    public $wet_volume_unit = 'm³';
    public $mortar_wastage = '24';
    public $mortar_ratio = '1:5';
    public $bag_size = '24';
    public $bag_size_unit = 'kg';

    // Cost Properties
    public $price_per_brick = '24';
    public $price_of_cement = '24';
    public $price_sand_per_volume = '24';
    public $price_sand_volume_unit = 'm³';

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
        $this->reset([
            'error', 'detail', 'wall_type', 'wall_length', 'wall_length_unit', 'wall_width', 'wall_width_unit',
            'wall_height', 'wall_height_unit', 'brick_type', 'brick_wastage', 'mortar_joint_thickness',
            'mortar_joint_thickness_unit', 'brick_length', 'brick_length_unit', 'brick_width', 'brick_width_unit',
            'brick_height', 'brick_height_unit', 'with_motar', 'wet_volume', 'wet_volume_unit', 'mortar_wastage',
            'mortar_ratio', 'bag_size', 'bag_size_unit', 'price_per_brick', 'price_of_cement', 'price_sand_per_volume',
            'price_sand_volume_unit'
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
            'wall_type' => $this->wall_type,
            'wall_length' => $this->wall_length,
            'wall_length_unit' => $this->wall_length_unit,
            'wall_width' => $this->wall_width,
            'wall_width_unit' => $this->wall_width_unit,
            'wall_height' => $this->wall_height,
            'wall_height_unit' => $this->wall_height_unit,
            'brick_type' => $this->brick_type,
            'brick_wastage' => $this->brick_wastage,
            'mortar_joint_thickness' => $this->mortar_joint_thickness,
            'mortar_joint_thickness_unit' => $this->mortar_joint_thickness_unit,
            'brick_length' => $this->brick_length,
            'brick_length_unit' => $this->brick_length_unit,
            'brick_width' => $this->brick_width,
            'brick_width_unit' => $this->brick_width_unit,
            'brick_height' => $this->brick_height,
            'brick_height_unit' => $this->brick_height_unit,
            'with_motar' => $this->with_motar,
            'wet_volume' => $this->wet_volume,
            'wet_volume_unit' => $this->wet_volume_unit,
            'mortar_wastage' => $this->mortar_wastage,
            'mortar_ratio' => $this->mortar_ratio,
            'bag_size' => $this->bag_size,
            'bag_size_unit' => $this->bag_size_unit,
            'price_per_brick' => $this->price_per_brick,
            'price_of_cement' => $this->price_of_cement,
            'price_sand_per_volume' => $this->price_sand_per_volume,
            'price_sand_volume_unit' => $this->price_sand_volume_unit,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->brick($request);

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
        return view('livewire.calculators.brick-calculator');
    }
}
