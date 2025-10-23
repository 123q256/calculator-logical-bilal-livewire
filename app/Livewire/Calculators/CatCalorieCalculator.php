<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Illuminate\Validation\ValidationException;

class CatCalorieCalculator extends Component
{
    public $weight = 3;
    public $unit = 'kg';
    public $condition = 'Neutered adult';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $calName;
    public $calLink;
    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;

        $oldInputs = session('calculator_back_inputs');
        if ($oldInputs) {
            $this->weight = $oldInputs->weight ?? 3;
            $this->unit = $oldInputs->unit ?? 'kg';
            $this->condition = $oldInputs->condition ?? 'Neutered adult';
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->weight = 3;
        $this->unit = 'kg';
        $this->condition = 'Neutered adult';
        $this->error = null;
        $this->detail = null;
         return redirect()->to(url()->previous() ?? '/');
    }

    public function calculate()
    {
        try {
            $this->validate([
                'weight' => 'required|numeric|min:0.1',
                'unit' => 'required|string',
                'condition' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            $this->error = 'Please check your input.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $request = (object)[
            'weight' => $this->weight,
            'unit' => $this->unit,
            'condition' => $this->condition,
        ];
        $model = new \App\Models\Pets();
        $result = $model->cat($request); // use the correct method here

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;
            return redirect()->to(url()->previous() ?? '/');
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
    }

    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
        const el = document.getElementById('result-section');
        if (el) {
            const offset = 40;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
    JS);
        }


        return view('livewire.calculators.cat-calorie-calculator');
    }
}
