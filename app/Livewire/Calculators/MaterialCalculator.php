<?php
namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class MaterialCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $operations = '1';
    public $first = '3';
    public $units1 = 'cm';
    public $second = '3';
    public $units2 = 'cm';
    public $third = '3';
    public $units3 = 'ft';
    public $four = '6';
    public $units4 = 'ft';
    public $five = '5';
    public $units5 = 'in³';
    public $six = '8';
    public $units6 = 'lb';
    public $seven = '8';
    public $units7 = 'in³';
    public $ex_drop = '105';

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

    public function updatedOperations()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'operations', 'first', 'units1', 'second', 'units2',
            'third', 'units3', 'four', 'units4', 'five', 'units5', 'six', 'units6',
            'seven', 'units7', 'ex_drop'
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
            'operations' => $this->operations,
            'first' => $this->first,
            'units1' => $this->units1,
            'second' => $this->second,
            'units2' => $this->units2,
            'third' => $this->third,
            'units3' => $this->units3,
            'four' => $this->four,
            'units4' => $this->units4,
            'five' => $this->five,
            'units5' => $this->units5,
            'six' => $this->six,
            'units6' => $this->units6,
            'seven' => $this->seven,
            'units7' => $this->units7,
            'ex_drop' => $this->ex_drop,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->material($request);

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
        return view('livewire.calculators.material-calculator');
    }
}
