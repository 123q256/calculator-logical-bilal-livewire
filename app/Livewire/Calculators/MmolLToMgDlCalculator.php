<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class MmolLToMgDlCalculator extends Component
{
    // Default Values
    public $solve = "1"; // 1 for mmol/L to mg/dl, 2 for mg/dl to mmol/L
    public $input_value = 7;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
    }

    public function updated($propertyName)
    {
        // Hide result whenever any input is changed
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->solve = "1";
        $this->input_value = 7;
        $this->error = null;
        $this->detail = null;
    }

    public function calculate()
    {
        $request = (object)[
            'solve' => $this->solve,
            'input' => $this->input_value,
        ];

        $model = new Chemistry();
        $result = $model->mmol($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
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
            $this->error = $result['error'] ?? 'Please check your input.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.mmol-l-to-mg-dl-calculator');
    }
}
