<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class ProteinCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $age = 24;
    public $gender = 'male';
    public $weight = 175.26;
    public $weight_unit = 'kg';
    public $activity_level = 'sedentary';
    public $protein_for = 'general';
    public $height_ft = 5;
    public $height_in = 12;
    public $height_cm = 175.26;
    public $height_unit = 'ft/in';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
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
        $this->detail = null;
        $this->error = null;
    }

    public function setUnit($field, $value)
    {
        if ($field === 'height_unit') {
            $this->height_unit = $value;
        } else {
            $this->$field = $value;
        }
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->age = 24;
        $this->gender = 'male';
        $this->weight = 175.26;
        $this->weight_unit = 'kg';
        $this->activity_level = 'sedentary';
        $this->protein_for = 'general';
        $this->height_ft = 5;
        $this->height_in = 12;
        $this->height_cm = 175.26;
        $this->height_unit = 'ft/in';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'age' => $this->age,
            'gender' => $this->gender,
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit === 'lbs' ? 'lb' : $this->weight_unit, // Model expects 'lb' for pounds
            'activity_level' => $this->activity_level,
            'protein_for' => $this->protein_for,
            'height_ft' => $this->height_ft,
            'height_in' => $this->height_in,
            'height_cm' => $this->height_cm,
            'unit_ft_in' => $this->height_unit,
        ];

        $request = new \Illuminate\Http\Request($requestData);
        $model = new Health();
        $result = $model->protein($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.protein-calculator');
    }
}
