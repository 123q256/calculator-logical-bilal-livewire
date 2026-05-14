<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class BreastfeedingCalorieCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $unit_type = 'lbs';
    public $age = 25;
    public $ft_in = '68';
    public $height_cm = 175;
    public $weight = 170;
    public $activity = '1.2';
    public $bf = '500';
    public $pregnant = '0';

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

    public function setUnitType($value)
    {
        $this->unit_type = $value;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->unit_type = 'lbs';
        $this->age = 25;
        $this->ft_in = '68';
        $this->height_cm = 175;
        $this->weight = 170;
        $this->activity = '1.2';
        $this->bf = '500';
        $this->pregnant = '0';

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
            'unit_type' => $this->unit_type,
            'age' => $this->age,
            'ft_in' => $this->ft_in,
            'height_cm' => $this->height_cm,
            'weight' => $this->weight,
            'activity' => $this->activity,
            'bf' => $this->bf,
            'pregnant' => $this->pregnant,
        ];

        $request = new \Illuminate\Http\Request($requestData);
        $model = new Health();
        $result = $model->breastfeeding($request);

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
        return view('livewire.calculators.breastfeeding-calorie-calculator');
    }
}
