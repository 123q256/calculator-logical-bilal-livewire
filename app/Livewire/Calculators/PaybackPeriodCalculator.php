<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class PaybackPeriodCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $unit_type = 'same';
    
    // Same Cash Flow Inputs
    public $initial = 100000;
    public $cash = 30000;
    public $add_sub = 'in';
    public $in_de = 5;
    public $year = 5;
    public $discount = 5;

    // Different Cash Flow Inputs
    public $initial2 = 100000;
    public $discount2 = 5;
    public $years_data = [50000, 50000, 50000, 50000, 50000, 50000]; // 6 initial years

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->unit_type = $inputs->unit_type ?? 'same';
            
            if ($this->unit_type == 'same') {
                $this->initial = $inputs->initial ?? 100000;
                $this->cash = $inputs->cash ?? 30000;
                $this->add_sub = $inputs->add_sub ?? 'in';
                $this->in_de = $inputs->in_de ?? 5;
                $this->year = $inputs->year ?? 5;
                $this->discount = $inputs->discount ?? 5;
            } else {
                $this->initial2 = $inputs->initial2 ?? 100000;
                $this->discount2 = $inputs->discount2 ?? 5;
                
                // Extract dynamic years
                $this->years_data = [];
                $count = $inputs->count ?? 6;
                for ($i = 1; $i <= $count; $i++) {
                    $key = "year$i";
                    $this->years_data[] = $inputs->$key ?? 0;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        
        $this->initial = 100000;
        $this->cash = 30000;
        $this->add_sub = 'in';
        $this->in_de = 5;
        $this->year = 5;
        $this->discount = 5;

        $this->initial2 = 100000;
        $this->discount2 = 5;
        $this->years_data = [50000, 50000, 50000, 50000, 50000, 50000];

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

    public function addYear()
    {
        $this->years_data[] = 50000;
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
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function calculate()
    {
        $data = [
            'unit_type' => $this->unit_type,
            'currency' => $this->currancy,
        ];

        if ($this->unit_type == 'same') {
            $data['initial'] = $this->initial;
            $data['cash'] = $this->cash;
            $data['add_sub'] = $this->add_sub;
            $data['in_de'] = $this->in_de;
            $data['year'] = $this->year;
            $data['discount'] = $this->discount;
        } else {
            $data['initial2'] = $this->initial2;
            $data['discount2'] = $this->discount2;
            $data['count'] = count($this->years_data);
            foreach ($this->years_data as $index => $value) {
                $data['year' . ($index + 1)] = $value;
            }
        }

        $request = (object)$data;
        $model = new Finance();
        $result = $model->payback($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
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
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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

        return view('livewire.calculators.payback-period-calculator');
    }
}
