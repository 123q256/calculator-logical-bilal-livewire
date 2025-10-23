<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class PearsonAgeCalculator extends Component
{
    public $date1 = '1999-11-05';
    public $date = '';
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $calName ;
    public $calLink ;


    public function mount($type = 'calculator', $lang = [],$calName = null,$calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;
        $this->date = now()->format('Y-m-d');
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

            $this->date = $inputs->date ?? $this->date;
            $this->date1 = $inputs->date1 ?? $this->date1;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag(); // Optional: clear validation errors

        $this->date = now()->format('Y-m-d');
        $this->date1 = '1999-11-05';
        $this->detail = null;
         return redirect()->to(url()->previous() ?? '/');
    }



    public function calculate()
    {

        try {
            $this->validate([
                'date1' => 'required|date',
                'date' => 'required|date|after_or_equal:date1',
            ]);
        } catch (ValidationException $e) {
            $this->error = 'Please! Check your input.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $request = (object) [
            'date1' => $this->date1,
            'date' => $this->date,
        ];

        $model = new \App\Models\Pets();
        $result = $model->pearson($request); // You must define this method in your Pets model
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            return redirect()->to(url()->previous() ?? '/');
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
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.pearson-age-calculator');
    }
}
