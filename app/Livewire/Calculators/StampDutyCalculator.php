<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class StampDutyCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $unit_type = 'uk'; // 'uk' or 'aus'
    
    // UK Properties
    public $uk_method = 'single';
    public $value = '5000000';
    
    // Australia Properties
    public $ausval = '20';
    public $aus_method = 'nsw';
    public $first = 'no';
    public $property = 'live';

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

    public function setUnitType($type)
    {
        $this->unit_type = $type;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->unit_type = 'uk';
        $this->uk_method = 'single';
        $this->value = '5000000';
        $this->ausval = '20';
        $this->aus_method = 'nsw';
        $this->first = 'no';
        $this->property = 'live';

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
        $requestData = [
            'unit_type'  => $this->unit_type,
            'uk_method'  => $this->uk_method,
            'value'      => $this->value,
            'ausval'     => $this->ausval,
            'aus_method' => $this->aus_method,
            'first'      => $this->first,
            'property'   => $this->property,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->stamp($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $requestData);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
           $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        if (session('scroll_to_result') || $this->detail) {
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
        return view('livewire.calculators.stamp-duty-calculator');
    }
}
