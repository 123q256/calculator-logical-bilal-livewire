<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class TensionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $type_field = '1'; // Renamed from 'type' to avoid conflicts
    public $lang = [];

    // Form Fields
    public $operations1 = '2';
    public $operations2 = '1';
    public $first = '9';
    public $unit1 = 'mg';
    public $second = '56';
    public $unit2 = 'mg';
    public $third = '34';
    public $unit3 = 'mg';
    public $four = '9.865';
    public $unit4 = 'm/s²';
    public $five = '50';
    public $unit5 = 'deg';
    public $six = '45';
    public $unit6 = 'deg';
    public $seven = '7';
    public $unit7 = 'N';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if ($key === 'type') {
                    $this->type_field = $value;
                } elseif (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function toggleDropdown($dropdown)
    {
        if ($this->openDropdown === $dropdown) {
            $this->openDropdown = null;
        } else {
            $this->openDropdown = $dropdown;
        }
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->openDropdown = null;
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        
        $this->type_field = '1';
        $this->operations1 = '2';
        $this->operations2 = '1';
        $this->first = '9';
        $this->unit1 = 'mg';
        $this->second = '56';
        $this->unit2 = 'mg';
        $this->third = '34';
        $this->unit3 = 'mg';
        $this->four = '9.865';
        $this->unit4 = 'm/s²';
        $this->five = '50';
        $this->unit5 = 'deg';
        $this->six = '45';
        $this->unit6 = 'deg';
        $this->seven = '7';
        $this->unit7 = 'N';

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
        $requestData = [
            'type' => $this->type_field,
            'operations1' => $this->operations1,
            'operations2' => $this->operations2,
            'first' => $this->first,
            'unit1' => $this->unit1,
            'second' => $this->second,
            'unit2' => $this->unit2,
            'third' => $this->third,
            'unit3' => $this->unit3,
            'four' => $this->four,
            'unit4' => $this->unit4,
            'five' => $this->five,
            'unit5' => $this->unit5,
            'six' => $this->six,
            'unit6' => $this->unit6,
            'seven' => $this->seven,
            'unit7' => $this->unit7,
        ];

        $model = new Physics();
        $result = $model->tension($requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);

                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->dispatch('initKaTeX');
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
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.tension-calculator');
    }
}
