<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class DogFoodCalculator extends Component
{
    public $weight = 4;
    public $weight_unit = 'kg';
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $type_unit = 'Puppy - 0 to 4 months';
    public $calName;
    public $calLink;
    public function onTypeUnitChange()
    {
        $this->detail = null; // clear custom error
    }



    public function setWeightUnit($unit)
    {
        $this->weight_unit = $unit;
    }



    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            // New values you're adding
            $this->weight = $inputs->weight ?? $this->weight;
            $this->weight_unit = $inputs->weight_unit ?? $this->weight_unit;
            $this->type_unit = $inputs->type_unit ?? $this->type_unit;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag(); // Optional: clear validation errors
        $this->weight = 4;
        $this->weight_unit = 'kg';
        $this->type_unit = 'Puppy - 0 to 4 months';
        $this->error = null; // clear custom error
        $this->detail = null; // clear custom error
        return redirect()->to(url()->previous() ?? '/');
    }




    public function calculate()
    {

        $request = (object)[
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit,
            'type_unit' => $this->type_unit,

        ];
        $model = new \App\Models\Pets();
        $result = $model->dog_food($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            return redirect()->to(url()->previous() ?? '/'); // fallback if referer not available
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
    }



    public function render()
    {

        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
        const el = document.getElementById('result-section');
        if (el) {
            const offset = 30;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
    JS);
        }
        return view('livewire.calculators.dog-food-calculator');
    }
}
