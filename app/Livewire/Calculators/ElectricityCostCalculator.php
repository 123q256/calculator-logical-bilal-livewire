<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class ElectricityCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Toggle between 'simple' and 'advance'
    public $unit_type = 'simple';

    // Simple Mode Fields
    public $first = '13';
    public $units1 = 'mW';
    public $second = '9';
    public $third = '3';
    public $units3 = 'days';

    // Advance Mode Fields
    public $uc_appliance = '2000';
    public $f_first = '2000';
    public $f_second = '9';
    public $f_third = '15';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        // Currency Detection
        $this->detectCurrency();

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    protected function detectCurrency()
    {
        $ip = request()->ip();
        if ($ip === '127.0.0.1') {
            $this->currancy = '$';
            return;
        }

        try {
            $response = @file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
            if ($response !== false) {
                $dataArray = json_decode($response, true);
                $this->currancy = $dataArray["geoplugin_currencySymbol_UTF8"] ?? '$';
            }
        } catch (\Exception $e) {
            $this->currancy = '$';
        }
    }

    public function toggleDropdown($dropdown)
    {
        if ($this->openDropdown === $dropdown) {
            $this->openDropdown = null;
        } else {
            $this->openDropdown = $dropdown;
        }
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->openDropdown = null;
        $this->detail = null;
    }

    public function updatedUcAppliance($value)
    {
        if ($value !== 'other') {
            $this->f_first = $value;
        }
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function setUnitType($type)
    {
        $this->unit_type = $type;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        
        $this->unit_type = 'simple';
        $this->first = '13';
        $this->units1 = 'mW';
        $this->second = '9';
        $this->third = '3';
        $this->units3 = 'days';
        $this->uc_appliance = '2000';
        $this->f_first = '2000';
        $this->f_second = '9';
        $this->f_third = '15';

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
            'first' => $this->first,
            'units1' => $this->units1,
            'second' => $this->second,
            'third' => $this->third,
            'units3' => $this->units3,
            'f_first' => $this->f_first,
            'f_second' => $this->f_second,
            'f_third' => $this->f_third,
            'uc_appliance' => $this->uc_appliance,
        ];

        $model = new Physics();
        $result = $model->electricity((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);

                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            }
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

        return view('livewire.calculators.electricity-cost-calculator');
    }
}
