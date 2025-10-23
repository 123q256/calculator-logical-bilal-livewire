<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class DogCrateSizeCalculator extends Component
{

    public $showUnitDropdown = false;
    public $height = 3;
    public $h_units = 'm';
    public $length = 4;
    public $l_units = 'in';
    public $extra_lenght = '5.1';
    public $showLengthUnitDropdown = false;
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $calName;
    public $calLink;
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
            $this->height = $inputs->height ?? $this->height;
            $this->h_units = $inputs->h_units ?? $this->h_units;
            $this->length = $inputs->length ?? $this->length;
            $this->l_units = $inputs->l_units ?? $this->l_units;
            $this->extra_lenght = $inputs->extra_lenght ?? $this->extra_lenght;
        }
    }

    public function changeMethod()
    {
        $this->detail = null; // or whatever logic you need
    }




    public function resetForm()
    {
        $this->resetErrorBag(); // Clears validation errors

        $this->height = 3;
        $this->h_units = 'm';
        $this->length = 4;
        $this->l_units =  'in';
        $this->extra_lenght = '5.1';
        $this->detail = null;
         return redirect()->to(url()->previous() ?? '/');
    }


    public function setLengthUnit($unit)
    {
        $this->l_units = $unit;
        $this->showLengthUnitDropdown = false;
    }

    public function setHeightUnit($unit)
    {
        $this->h_units = $unit;
        $this->showUnitDropdown = false;
    }


    public function calculate()
    {

        $request = (object)[
            'height' => $this->height,
            'h_units' => $this->h_units,
            'length' => $this->length,
            'l_units' => $this->l_units,
            'extra_lenght' => $this->extra_lenght,

        ];

        $model = new \App\Models\Pets();
        $result = $model->dog_crate_size($request);
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
        return view('livewire.calculators.dog-crate-size-calculator');
    }
}
