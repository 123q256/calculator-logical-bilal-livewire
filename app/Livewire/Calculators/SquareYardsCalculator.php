<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class SquareYardsCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $first = '8';
    public $unit1 = 'cm';
    public $second = '9';
    public $unit2 = 'cm';
    public $third = '9';
    public $unit3 = 'cm²';

    public $result_unit = 'cm²';
    public $showDropdown = null;

    protected $conversionFactors = [
        'in²' => 6.452,
        'cm²' => 1,
        'ft²' => 929,
        'yd²' => 8361,
        'm²' => 10000,
        'km²' => 10000000000,
        'a' => 1000000,
        'ac' => 40468560,
        'ha' => 100000000,
    ];

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
        $this->reset(['error', 'detail', 'first', 'unit1', 'second', 'unit2', 'third', 'unit3', 'result_unit']);
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
            'first' => $this->first,
            'unit1' => $this->unit1,
            'second' => $this->second,
            'unit2' => $this->unit2,
            'third' => $this->third,
            'unit3' => $this->unit3,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->square($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (array)$request);
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function getConvertedResultProperty()
    {
        if (!$this->detail || !isset($this->detail['yd_ans'])) {
            return 0;
        }

        $factor = $this->conversionFactors[$this->result_unit] ?? 1;
        return round($this->detail['yd_ans'] / $factor, 6);
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
        return view('livewire.calculators.square-yards-calculator', [
            'converted_result' => $this->converted_result
        ]);
    }
}
