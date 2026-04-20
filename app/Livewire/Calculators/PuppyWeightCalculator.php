<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Illuminate\Validation\ValidationException;

class PuppyWeightCalculator extends Component
{

    public $age = 12;
    public $age_selection = 'wks';
    public $weight = 4;
    public $weight_selection = 'kg';
    public $select_breed = 'Affenpinscher';
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $show_advanced = false;
    public $mode = 'first'; // instead of type
    public $calName ;
    public $calLink ;


    public function mount($type = 'calculator', $lang = [],$calName = null,$calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

            $this->age = $inputs->age ?? $this->age;
            $this->age_selection = $inputs->age_selection ?? $this->age_selection;
            $this->weight = $inputs->weight ?? $this->weight;
            $this->weight_selection = $inputs->weight_selection ?? $this->weight_selection;
            $this->select_breed = $inputs->select_breed ?? $this->select_breed;
            $this->mode = $inputs->type ?? $this->mode;
            $this->show_advanced = $this->mode === 'second'; // Restore advanced view
        }
    }
    public function resetForm()
    {
        $this->resetErrorBag(); // Optional: clear validation errors

        $this->age = 12;
        $this->age_selection = 'wks';
        $this->weight = 4;
        $this->weight_selection = 'kg';
        $this->select_breed = 'Affenpinscher';
        $this->mode = 'first';
        $this->show_advanced = false;
        $this->error = null;
        $this->detail = null;
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'validation_error', 'scroll_to_result', 'calculator_back_inputs']);
            return redirect()->to(url()->previous() ?? '/');
        }
    }


    public function toggleAdvanced()
    {
        $this->show_advanced = !$this->show_advanced;
        $this->mode = $this->show_advanced ? 'second' : 'first';
    }


    public function calculate()
    {

        try {
            $this->validate([
                'age' => 'required|numeric',
                'age_selection' => 'required',
                'weight' => 'required|numeric',
                'weight_selection' => 'required',
                'select_breed' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            $this->error = 'Please! Check your input.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }



        $request = (object) [
            'weight' => $this->weight,
            'weight_selection' => $this->weight_selection,
            'age' => $this->age,
            'age_selection' => $this->age_selection,
            'select_breed' => $this->select_breed,
            'type' => $this->mode,
        ];

        $model = new \App\Models\Pets();
        $result = $model->puppy($request); // You must define this method in your Pets model
        // dd($result);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('calculator_back_inputs', $request);
                session()->flash('scroll_to_result', true);
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
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.puppy-weight-calculator');
    }
}
