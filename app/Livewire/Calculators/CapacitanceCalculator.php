<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class CapacitanceCalculator extends Component
{
    public $area = 9;
    public $area_unit = 'mm²';
    public $permittivity = '0.000000000008854';
    public $distance = 9;
    public $dis_unit = 'mm';

    public $area_open = false;
    public $dis_open = false;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->area = $inputs->area ?? 9;
            $this->area_unit = $inputs->area_unit ?? 'mm²';
            $this->permittivity = $inputs->permittivity ?? 0.000000000008854;
            $this->distance = $inputs->distance ?? 9;
            $this->dis_unit = $inputs->dis_unit ?? 'mm';
        }
    }

    public function setAreaUnit($unit)
    {
        $this->area_unit = $unit;
        $this->area_open = false;
        $this->detail = null;
    }

    public function setDisUnit($unit)
    {
        $this->dis_unit = $unit;
        $this->dis_open = false;
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'area_open' && $propertyName !== 'dis_open') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->area = 9;
        $this->area_unit = 'mm²';
        $this->permittivity = '0.000000000008854';
        $this->distance = 9;
        $this->dis_unit = 'mm';

        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'area'         => $this->area,
            'area_unit'    => $this->area_unit,
            'permittivity' => $this->permittivity,
            'distance'     => $this->distance,
            'dis_unit'     => $this->dis_unit,
        ];

        $model = new Physics();
        $result = $model->capacitance($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.capacitance-calculator');
    }
}
