<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class AmoxicillinPediatricDosageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $age = '4';
    public $age_unit = 'Years'; // Default to Years to match model expectations
    public $weight = '15';
    public $weight_unit = 'kg';
    public $med_type = '1';
    public $general_dosing = '1';
    public $route = '1';
    public $dosag = '';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        // Map language units to model-friendly strings if they are translated
        // However, usually it's safer to use the standard ones or ensure translations match
        $this->age_unit = $this->lang['4'] ?? 'Years'; 

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

    public function updated($propertyName)
    {
        // Clear results when any input changes
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->age = '4';
        $this->age_unit = $this->lang['4'] ?? 'Years';
        $this->weight = '15';
        $this->weight_unit = 'kg';
        $this->med_type = '1';
        $this->general_dosing = '1';
        $this->route = '1';
        $this->dosag = '';

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

    public function calculate()
    {
        $request = (object)[
            'age'            => (float)$this->age,
            'age_unit'       => $this->age_unit,
            'weight'         => (float)$this->weight,
            'weight_unit'    => $this->weight_unit,
            'med_type'       => $this->med_type,
            'general_dosing' => $this->general_dosing,
            'route'          => $this->route,
            'dosag'          => $this->dosag !== '' ? (float)$this->dosag : '',
        ];

        $model = new Health();
        $result = $model->amoxicillin($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
        return view('livewire.calculators.amoxicillin-pediatric-dosage-calculator');
    }
}
