<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class TileCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $calculation_unit = '1';
    public $total_area = '10';
    public $total_area_unit = 'sq cm';
    public $area_length = '15';
    public $area_length_unit = 'cm';
    public $area_width = '15';
    public $area_width_unit = 'cm';
    public $tile_length = '15';
    public $tile_length_unit = 'm';
    public $tile_width = '15';
    public $tile_width_unit = 'm';
    public $gap_size = '15';
    public $gap_size_unit = 'm';
    public $waste = '10';
    public $price = '';
    public $price_unit = 'tile';
    public $box_size = '';

    // UI State
    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calculation_unit = $inputs->calculation_unit ?? '1';
            $this->total_area = $inputs->total_area ?? '10';
            $this->total_area_unit = $inputs->total_area_unit ?? 'sq cm';
            $this->area_length = $inputs->area_length ?? '15';
            $this->area_length_unit = $inputs->area_length_unit ?? 'cm';
            $this->area_width = $inputs->area_width ?? '15';
            $this->area_width_unit = $inputs->area_width_unit ?? 'cm';
            $this->tile_length = $inputs->tile_length ?? '15';
            $this->tile_length_unit = $inputs->tile_length_unit ?? 'm';
            $this->tile_width = $inputs->tile_width ?? '15';
            $this->tile_width_unit = $inputs->tile_width_unit ?? 'm';
            $this->gap_size = $inputs->gap_size ?? '15';
            $this->gap_size_unit = $inputs->gap_size_unit ?? 'm';
            $this->waste = $inputs->waste ?? '10';
            $this->price = $inputs->price ?? '';
            $this->price_unit = $inputs->price_unit ?? 'tile';
            $this->box_size = $inputs->box_size ?? '';
        }
    }

    public function toggleOverlay($name)
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
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'calculation_unit', 'total_area', 'total_area_unit', 
            'area_length', 'area_length_unit', 'area_width', 'area_width_unit', 
            'tile_length', 'tile_length_unit', 'tile_width', 'tile_width_unit', 
            'gap_size', 'gap_size_unit', 'waste', 'price', 'price_unit', 'box_size', 
            'showDropdown'
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
            'calculation_unit' => $this->calculation_unit,
            'total_area' => $this->total_area,
            'total_area_unit' => $this->total_area_unit,
            'area_length' => $this->area_length,
            'area_length_unit' => $this->area_length_unit,
            'area_width' => $this->area_width,
            'area_width_unit' => $this->area_width_unit,
            'tile_length' => $this->tile_length,
            'tile_length_unit' => $this->tile_length_unit,
            'tile_width' => $this->tile_width,
            'tile_width_unit' => $this->tile_width_unit,
            'gap_size' => $this->gap_size,
            'gap_size_unit' => $this->gap_size_unit,
            'waste' => $this->waste,
            'price' => $this->price,
            'price_unit' => $this->price_unit,
            'box_size' => $this->box_size,
            'currency' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->tile($request);
        
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
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
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
        return view('livewire.calculators.tile-calculator');
    }
}
