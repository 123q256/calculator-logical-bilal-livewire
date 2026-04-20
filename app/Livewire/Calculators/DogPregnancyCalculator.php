<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Illuminate\Validation\ValidationException;

class DogPregnancyCalculator extends Component
{
    // public $calData;
    public $e_date;
    public $error;
    public $type = 'calculator';
    public $lang = [];
    public $detail = null;
    public $calName;
    public $calLink;
    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        // $this->calData = $calData;
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;
        // ✅ Set previous input if it exists in session
        $oldInputs = session('calculator_back_inputs');
        $this->e_date = $oldInputs->e_date ?? '2022-08-20'; // Format: YYYY-MM-DD (Year-Month-Day)
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function resetForm()
    {
        $this->resetErrorBag(); // Optional: clear validation errors
        $this->e_date = '2022-08-20'; // set to today
        $this->error = null; // clear custom error
        $this->detail = null; // clear custom error
        // return redirect()->to(url()->previous() ?? '/');
    }


    public function calculate()
    {
        try {
            $this->validate([
                'e_date' => 'required|date',
            ]);
        } catch (ValidationException $e) {
            $this->error = 'Please! Check your input.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $request = (object)[
            'e_date' => $this->e_date
        ];

        $model = new \App\Models\Pets();
        $result = $model->dog_pre($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
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
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        // JS scroll into view if result was returned
    

        return view('livewire.calculators.dog-pregnancy-calculator');
    }
}
