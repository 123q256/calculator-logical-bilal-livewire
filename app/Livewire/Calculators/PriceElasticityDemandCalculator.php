<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class PriceElasticityDemandCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form properties
    public $unit_type = 'Price Elasticity'; // 'Price Elasticity' or 'Revenue'
    public $method = '1'; // '1' (Midpoint), '2' (Point), '3' (% Change)
    
    // Midpoint/Point inputs
    public $i_p = '';
    public $n_p = '';
    public $i_q = '';
    public $n_q = '';
    
    // % Change inputs
    public $quantity = '8.823'; // % change in quantity
    public $prince = '16.66';   // % change in price
    
    // Revenue inputs
    public $i_r = '';
    public $f_r = '';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

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
        if ($propertyName == 'method') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->unit_type = 'Price Elasticity';
        $this->method = '1';
        $this->i_p = '';
        $this->n_p = '';
        $this->i_q = '';
        $this->n_q = '';
        $this->quantity = '8.823';
        $this->prince = '16.66';
        $this->i_r = '';
        $this->f_r = '';

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
            'unit_type' => $this->unit_type,
            'method'    => $this->method,
            'i_p'       => $this->i_p,
            'n_p'       => $this->n_p,
            'i_q'       => $this->i_q,
            'n_q'       => $this->n_q,
            'quantity'  => $this->quantity,
            'prince'    => $this->prince,
            'i_r'       => $this->i_r,
            'f_r'       => $this->f_r,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->price($request);

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
            $this->error = $result['error'] ?? 'Please fill all required fields correctly.';
            $this->detail = null;
        }
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
        return view('livewire.calculators.price-elasticity-demand-calculator');
    }
}
