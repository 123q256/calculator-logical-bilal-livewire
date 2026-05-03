<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class RentIncreaseCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $rent = 2000;
    public $year = 50;
    public $numbers = 2;
    public $numbers_unit = 'yrs';
    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->rent = $inputs->rent ?? 2000;
            $this->year = $inputs->year ?? 50;
            $this->numbers = $inputs->numbers ?? 2;
            $this->numbers_unit = $inputs->numbers_unit ?? 'yrs';
        }
    }

    public function toggleDropdown($dropdown)
    {
        $this->openDropdown = ($this->openDropdown === $dropdown) ? null : $dropdown;
    }

    public function closeDropdown()
    {
        $this->openDropdown = null;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->closeDropdown();
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->rent = 2000;
        $this->year = 50;
        $this->numbers = 2;
        $this->numbers_unit = 'yrs';

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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'rent' => $this->rent,
            'year' => $this->year,
            'numbers' => $this->numbers,
            'numbers_unit' => $this->numbers_unit,
        ];

        $model = new Finance();
        $result = $model->rent($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.rent-increase-calculator');
    }
}
