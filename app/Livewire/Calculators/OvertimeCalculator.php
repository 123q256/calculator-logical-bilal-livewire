<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class OvertimeCalculator extends Component
{
    public $pay = 5;
    public $per = 'hour';
    public $overtime_rate = 'half';
    public $multi = 1.5;
    public $time;
    public $over;
    
    public $circle_unit_result = 'month';
    
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';
    public $device = 'desktop';

    public $openDropdown = null;

    public $calName = null;
    public $calLink = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$', $device = 'desktop', $calName = null, $calLink = null)
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->device = $device;
        $this->calName = $calName;
        $this->calLink = $calLink;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->pay = $inputs->pay ?? $this->pay;
            $this->per = $inputs->per ?? $this->per;
            $this->overtime_rate = $inputs->overtime_rate ?? $this->overtime_rate;
            $this->multi = $inputs->multi ?? $this->multi;
            $this->time = $inputs->time ?? $this->time;
            $this->over = $inputs->over ?? $this->over;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'overtime_rate') {
            $this->detail = null;
            $this->error = null;
            
            if ($this->overtime_rate === 'half') {
                $this->multi = 1.5;
            } elseif ($this->overtime_rate === 'double') {
                $this->multi = 2;
            } elseif ($this->overtime_rate === 'triple') {
                $this->multi = 3;
            } else {
                $this->multi = null;
            }
        }
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->pay = 5;
        $this->per = 'hour';
        $this->overtime_rate = 'half';
        $this->multi = 1.5;
        $this->time = null;
        $this->over = null;
        
        $this->error = null;
        $this->detail = null;

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
            'pay' => $this->pay,
            'per' => $this->per,
            'multi' => $this->multi,
            'time' => $this->time,
            'over' => $this->over,
            'overtime_rate' => $this->overtime_rate,
            'overper' => 'h_m', // Default value to avoid Finance.php error
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->overtime($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);
            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

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
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
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

        return view('livewire.calculators.overtime-calculator');
    }
}
