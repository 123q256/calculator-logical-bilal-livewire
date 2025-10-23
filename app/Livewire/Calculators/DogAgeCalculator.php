<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Illuminate\Validation\ValidationException;

class DogAgeCalculator extends Component
{

    public $a = 4;
    public $b = 4;
    public $c = 4;
    public $age = 4;
    public $brd = '1';
    public $dogBreed = '0';
    public $dogAge = '0';
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $operations = '2';
    public $calName;
    public $calLink;


    public function resetForm()
    {
        $this->resetErrorBag(); // Clears validation errors

        $this->a = 4;
        $this->b = 4;
        $this->c = 4;
        $this->age = 4;
        $this->brd = '1';
        $this->dogBreed = '0';
        $this->dogAge = '0';
        $this->operations = '2';
        $this->detail = null;
        return redirect()->to(url()->previous() ?? '/');
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
            $this->a = $inputs->a ?? $this->a;
            $this->b = $inputs->b ?? $this->b;
            $this->c = $inputs->c ?? $this->c;
            $this->age = $inputs->age ?? $this->age;
            $this->dogBreed = $inputs->dogBreed ?? $this->dogBreed;
            $this->dogAge = $inputs->dogAge ?? $this->dogAge;
            $this->operations = $inputs->operations ?? $this->operations;
            $this->brd = $inputs->brd ?? $this->brd;
        }
    }
    public function changeOperation($value)
    {
        $this->operations = $value;
        session()->put('last_selected_operation', $value);
        $this->detail = null;
    }

    public function calculate()
    {

        $request = (object)[
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'age' => $this->age,
            'dogBreed' => $this->dogBreed,
            'dogAge' => $this->dogAge,
            'operations' => $this->operations,
            'brd' => $this->brd,
        ];

        $model = new \App\Models\Pets();
        $result = $model->dog($request);
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
        return view('livewire.calculators.dog-age-calculator');
    }
}
