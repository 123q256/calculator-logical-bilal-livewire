<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class GramsToCaloriesCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $carbohydrate = 25;
    public $carbo_unit = 'g';
    public $protein = 25;
    public $protein_unit = 'g';
    public $fat = 25;
    public $fat_unit = 'g';

    // UI State
    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'showDropdown') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleOverlay($id)
    {
        $this->showDropdown = ($this->showDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->showDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['carbohydrate', 'carbo_unit', 'protein', 'protein_unit', 'fat', 'fat_unit', 'detail', 'error', 'showDropdown']);
        
        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $this->error = null;

        $request = (object)[
            'carbohydrate' => (float)$this->carbohydrate,
            'carbo_unit'   => $this->carbo_unit,
            'protein'      => (float)$this->protein,
            'protein_unit' => $this->protein_unit,
            'fat'          => (float)$this->fat,
            'fat_unit'     => $this->fat_unit,
        ];

        $model = new Health();
        $result = $model->grams_to_calories($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            return;
        }

        $this->error = $result['error'] ?? 'Please check your inputs.';
        $this->detail = null;
    }

    public function render()
    {
        return view('livewire.calculators.grams-to-calories-calculator');
    }
}
