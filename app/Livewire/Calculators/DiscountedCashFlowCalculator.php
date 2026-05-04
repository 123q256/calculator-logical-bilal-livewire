<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class DiscountedCashFlowCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $main_unit;
    public $fcff_inputs = [50, 50]; // Default FCFF values
    public $cash = 50;
    public $outstanding = 60000;
    public $perpetual = 4.48;
    public $wacc = 9.94;
    public $shares = 1000;
    public $price = 17;

    public $earnings = 200;
    public $discount = 11;
    public $growth = 200;
    public $growth_time = 1;
    public $growth_time_one = 200;
    public $growth_time_sec = 1;
    public $growth_unit = 'mos';

    public $terminal = 200;
    public $terminal_time = 1;
    public $terminal_one = 200;
    public $terminal_sec = 1;
    public $terminal_unit = 'mos';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->main_unit = $lang[2] ?? 'Free cash flow to firm (FCFF)';

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
            $this->fcff_inputs = $this->detail['input'] ?? [50, 50];
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
            if (isset($inputs['input'])) {
                $this->fcff_inputs = $inputs['input'];
            }
        }
    }

    public function addInput()
    {
        if (count($this->fcff_inputs) < 8) {
            $this->fcff_inputs[] = 50;
        }
    }

    public function removeInput($index)
    {
        if (count($this->fcff_inputs) > 1) {
            unset($this->fcff_inputs[$index]);
            $this->fcff_inputs = array_values($this->fcff_inputs);
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->main_unit = $this->lang[2] ?? 'Free cash flow to firm (FCFF)';
        $this->fcff_inputs = [50, 50];
        $this->cash = 50;
        $this->outstanding = 60000;
        $this->perpetual = 4.48;
        $this->wacc = 9.94;
        $this->shares = 1000;
        $this->price = 17;
        $this->earnings = 200;
        $this->discount = 11;
        $this->growth = 200;
        $this->growth_time = 1;
        $this->growth_time_one = 200;
        $this->growth_time_sec = 1;
        $this->growth_unit = 'mos';
        $this->terminal = 200;
        $this->terminal_time = 1;
        $this->terminal_one = 200;
        $this->terminal_sec = 1;
        $this->terminal_unit = 'mos';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect(request()->header('Referer'));
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $requestData = [
            'main_unit' => $this->main_unit,
            'input' => $this->fcff_inputs,
            'cash' => $this->cash,
            'outstanding' => $this->outstanding,
            'perpetual' => $this->perpetual,
            'wacc' => $this->wacc,
            'shares' => $this->shares,
            'price' => $this->price,
            'earnings' => $this->earnings,
            'discount' => $this->discount,
            'growth' => $this->growth,
            'growth_time' => $this->growth_time,
            'growth_time_one' => $this->growth_time_one,
            'growth_time_sec' => $this->growth_time_sec,
            'growth_unit' => $this->growth_unit,
            'terminal' => $this->terminal,
            'terminal_time' => $this->terminal_time,
            'terminal_one' => $this->terminal_one,
            'terminal_sec' => $this->terminal_sec,
            'terminal_unit' => $this->terminal_unit,
        ];

        $model = new Finance();
        $result = $model->discounted((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect(request()->header('Referer'));
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
        return view('livewire.calculators.discounted-cash-flow-calculator');
    }
}
