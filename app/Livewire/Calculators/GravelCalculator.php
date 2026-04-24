<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class GravelCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $from = 'rec'; // rec or cic
    public $to_calculate = '1'; // 1: length/area/volume, 2: length/area, 3: volume
    public $length = '24';
    public $l_unit = 'm';
    public $width = '10';
    public $w_unit = 'm';
    public $area = '15';
    public $a_unit = 'm²';
    public $depth = '15';
    public $d_unit = 'cm';
    public $volume = '15';
    public $v_unit = 'm²'; // Note: Blade had m², likely should be m³ but keeping for consistency if model expects it
    public $density = '104.88';
    public $dn_unit = 'lb/ft³';
    public $diameter = '15';
    public $dia_unit = 'm³'; // Note: Blade had m³, likely should be m/cm but keeping for consistency
    public $price = '';
    public $p_unit = '$ lbs';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->p_unit = $this->currancy . ' lbs';

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
        $this->reset(['error', 'detail', 'from', 'to_calculate', 'length', 'width', 'area', 'depth', 'volume', 'density', 'diameter', 'price']);
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
            'from' => $this->from,
            'to_calculate' => $this->to_calculate,
            'length' => $this->length,
            'l_unit' => $this->l_unit,
            'width' => $this->width,
            'w_unit' => $this->w_unit,
            'area' => $this->area,
            'a_unit' => $this->a_unit,
            'depth' => $this->depth,
            'd_unit' => $this->d_unit,
            'volume' => $this->volume,
            'v_unit' => $this->v_unit,
            'density' => $this->density,
            'dn_unit' => $this->dn_unit,
            'diameter' => $this->diameter,
            'dia_unit' => $this->dia_unit,
            'price' => $this->price,
            'p_unit' => $this->p_unit,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->gravel($request);
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
        return view('livewire.calculators.gravel-calculator');
    }
}
