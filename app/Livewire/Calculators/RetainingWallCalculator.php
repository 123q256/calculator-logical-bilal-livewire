<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class RetainingWallCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $wall_length = '7';
    public $wall_length_unit = 'yd';
    public $wall_height = '12';
    public $wall_height_unit = 'yd';
    public $block_height = '1';
    public $block_height_unit = 'in';
    public $cap_height = '12';
    public $cap_height_unit = 'in';
    public $block_length = '6';
    public $block_length_unit = 'ft';
    public $cap_length = '12';
    public $cap_length_unit = 'in';
    public $wall_block_price = '10';
    public $cap_block_price = '5';
    public $backfill_thickness = '30';
    public $backfill_thickness_unit = 'cm';
    public $backfill_length = '10';
    public $backfill_length_unit = 'ft';
    public $backfill_height = '10';
    public $backfill_height_unit = 'ft';
    public $backfill_price = '10';
    public $backfill_price_unit = 'lb';

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
            'error', 'detail', 'wall_length', 'wall_length_unit', 'wall_height', 'wall_height_unit',
            'block_height', 'block_height_unit', 'cap_height', 'cap_height_unit', 'block_length',
            'block_length_unit', 'cap_length', 'cap_length_unit', 'wall_block_price', 'cap_block_price',
            'backfill_thickness', 'backfill_thickness_unit', 'backfill_length', 'backfill_length_unit',
            'backfill_height', 'backfill_height_unit', 'backfill_price', 'backfill_price_unit'
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
            'wall_length' => $this->wall_length,
            'wall_length_unit' => $this->wall_length_unit,
            'wall_height' => $this->wall_height,
            'wall_height_unit' => $this->wall_height_unit,
            'block_height' => $this->block_height,
            'block_height_unit' => $this->block_height_unit,
            'cap_height' => $this->cap_height,
            'cap_height_unit' => $this->cap_height_unit,
            'block_length' => $this->block_length,
            'block_length_unit' => $this->block_length_unit,
            'cap_length' => $this->cap_length,
            'cap_length_unit' => $this->cap_length_unit,
            'wall_block_price' => $this->wall_block_price,
            'cap_block_price' => $this->cap_block_price,
            'backfill_thickness' => $this->backfill_thickness,
            'backfill_thickness_unit' => $this->backfill_thickness_unit,
            'backfill_length' => $this->backfill_length,
            'backfill_length_unit' => $this->backfill_length_unit,
            'backfill_height' => $this->backfill_height,
            'backfill_height_unit' => $this->backfill_height_unit,
            'backfill_price' => $this->backfill_price,
            'backfill_price_unit' => $this->backfill_price_unit,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->retaining($request);
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
        return view('livewire.calculators.retaining-wall-calculator');
    }
}
