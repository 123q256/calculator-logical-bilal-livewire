<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class PricePerSquareFootCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $calc_type = '1';
    public $pp = '290000';
    public $area_measure = '1400';
    public $area_measure_unit = 'ft²';
    public $compare = '1';
    public $pp1 = '290000';
    public $area_measure1 = '1400';
    public $area_measure_unit1 = 'ft²';
    public $compare2 = '1';
    public $pp2 = '290000';
    public $area_measure2 = '1400';
    public $area_measure_unit2 = 'ft²';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        if (!empty($currancy)) {
            $this->currancy = $currancy;
        }

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

    public function toggleOverlay($id)
    {
        $this->showDropdown = ($this->showDropdown === $id) ? null : $id;
    }

    public function setUnit($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        $this->showDropdown = null;
    }

    public function updatedCalcType()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updatedCompare()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updatedCompare2()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'calc_type', 'pp', 'area_measure', 'area_measure_unit',
            'compare', 'pp1', 'area_measure1', 'area_measure_unit1', 'compare2',
            'pp2', 'area_measure2', 'area_measure_unit2'
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
            'calculate' => $this->calc_type,
            'pp' => $this->pp,
            'pp_unit' => $this->currancy,
            'area_measure' => $this->area_measure,
            'area_measure_unit' => $this->area_measure_unit,
            'compare' => $this->compare,
            'pp1' => $this->pp1,
            'pp1_unit' => $this->currancy,
            'area_measure1' => $this->area_measure1,
            'area_measure_unit1' => $this->area_measure_unit1,
            'compare2' => $this->compare2,
            'pp2' => $this->pp2,
            'pp2_unit' => $this->currancy,
            'area_measure2' => $this->area_measure2,
            'area_measure_unit2' => $this->area_measure_unit2,
        ];

        $model = new Construction();
        $result = $model->price($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

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
                    }, 100);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
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
                    }, 100);
                JS);
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.price-per-square-foot-calculator');
    }
}
