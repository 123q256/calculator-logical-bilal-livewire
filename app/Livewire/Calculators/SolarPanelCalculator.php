<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class SolarPanelCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $first = '1300';
    public $units1 = 'yr';
    public $calculation_type = '1'; // operations1
    public $operations2 = '1&&Afghanistan (Kabul)'; // country
    public $operations3 = '1&&Alberta (Calgary)'; // can_city
    public $operations4 = '1&&Alaska (Anchorage)'; // usa_city
    public $second = '50';
    public $third = '50';
    public $four = '85';
    public $five = '5';
    public $units5 = 'm²';
    public $six = '7';
    public $units6 = 'cm²';
    public $seven = '300';
    public $units7 = 'W';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        $this->detail = session('calculator_result');
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
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
        if ($propertyName == 'calculation_type') {
            $this->detail = null;
        }
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['detail', 'error', 'first', 'second', 'third', 'four', 'five', 'six', 'seven']);
        
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'first' => $this->first,
            'units1' => $this->units1,
            'operations1' => $this->calculation_type,
            'operations2' => $this->operations2,
            'operations3' => $this->operations3,
            'operations4' => $this->operations4,
            'second' => $this->second,
            'third' => $this->third,
            'four' => $this->four,
            'five' => $this->five,
            'units5' => $this->units5,
            'six' => $this->six,
            'units6' => $this->units6,
            'seven' => $this->seven,
            'units7' => $this->units7,
        ];

        $model = new Physics();
        $result = $model->solar((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.solar-panel-calculator');
    }
}
