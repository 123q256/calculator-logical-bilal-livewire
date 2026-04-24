<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class PaverCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $operations = '3';
    public $first = '8';
    public $second = '8';
    public $third = '10';
    public $four = '15';
    public $fiveb = '15';
    public $units1 = 'in';
    public $units2 = 'in';
    public $units3 = 'in';
    public $units4 = 'in';
    public $price = '';
    public $cost = '';
    public $price_unit = 'ft²';
    public $cost_unit = 'ft²';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->price_unit = $this->currancy . ' ft²';
        $this->cost_unit = $this->currancy . ' ft²';

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
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

    public function setUnit($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->operations = '3';
        $this->first = '8';
        $this->second = '8';
        $this->third = '10';
        $this->four = '15';
        $this->fiveb = '15';
        $this->units1 = 'in';
        $this->units2 = 'in';
        $this->units3 = 'in';
        $this->units4 = 'in';
        $this->price = '';
        $this->cost = '';
        $this->price_unit = $this->currancy . ' ft²';
        $this->cost_unit = $this->currancy . ' ft²';

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
            'first' => $this->first,
            'second' => $this->second,
            'third' => $this->third,
            'four' => $this->four,
            'fiveb' => $this->fiveb,
            'units1' => $this->units1,
            'units2' => $this->units2,
            'units3' => $this->units3,
            'units4' => $this->units4,
            'price' => $this->price,
            'cost' => $this->cost,
            'cost_unit' => $this->cost_unit,
            'currancy' => $this->currancy,
            'price_unit' => $this->price_unit,
        ];

        $request = (object)$requestData;

        $model = new Construction();
        $result = $model->paver($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $this->all());
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
            session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.paver-calculator');
    }
}
