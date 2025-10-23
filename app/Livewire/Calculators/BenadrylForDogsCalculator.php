<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Illuminate\Validation\ValidationException;

class BenadrylForDogsCalculator extends Component
{
    public $w = 25;
    public $w_unit = 'kg';
    public $result = null;
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
        // ✅ Set previous input if it exists in session
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $oldInputs = session('calculator_back_inputs');
        if ($oldInputs) {
            $this->w = $oldInputs->w ?? 25;
            $this->w_unit = $oldInputs->w_unit ?? 'g';
        }
    }


    public function resetForm()
    {
        $this->resetErrorBag(); // Clear validation errors
        $this->w = 25;
        $this->w_unit = 'kg';
        $this->error = null;
        $this->detail = null; // ✅ Hides the result
         return redirect()->to(url()->previous() ?? '/');
    }


    public function calculate()
    {
        try {
            $this->validate([
                'w' => 'required',
                'w_unit' => 'required',
            ]);
        } catch (ValidationException $e) {
            $this->error = 'Please! Check your input.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $request = (object)[
            'w' => $this->w,
            'w_unit' => $this->w_unit,
        ];
        $model = new \App\Models\Pets();
        $result = $model->benadryl($request);

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


    public function setUnit($unit)
    {
        $this->w_unit = $unit;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.benadryl-for-dogs-calculator');
    }
}
