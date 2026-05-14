<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class ScientificNotationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator'; // system type (calculator/widget)
    public $mode = 'converter'; // operation mode (converter/calculator)
    public $lang = [];

    // Converter inputs
    public $decimal = '1.356 x 10^5';

    // Calculator inputs
    public $nbr1 = '3.12';
    public $pwr1 = '4';
    public $opr = '+';
    public $nbr2 = '1.52';
    public $pwr2 = '-2';

    // Interactive Result Properties
    public $power = 0;
    public $mantissa = '';
    public $originalNumber = 0;

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

        if ($this->detail) {
            $this->initResult($this->detail['ans'], $this->detail['right']);
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function switchMode($newMode)
    {
        $this->mode = $newMode;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->decimal = '1.356 x 10^5';
        $this->nbr1 = '3.12';
        $this->pwr1 = '4';
        $this->opr = '+';
        $this->nbr2 = '1.52';
        $this->pwr2 = '-2';
        $this->power = 0;
        $this->mantissa = '';
        $this->originalNumber = 0;

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

    public function initResult($val, $pwr)
    {
        $this->originalNumber = floatval($val);
        $this->power = intval($pwr);
        $this->updateDisplay();
    }

    public function updateDisplay()
    {
        $str = explode('.', strval($this->originalNumber));
        $dp = (count($str) > 1) ? strlen($str[1]) : 0;
        $dp += $this->power;
        $dp = max(0, min(20, $dp));
        
        $this->mantissa = number_format($this->originalNumber / pow(10, $this->power), $dp, '.', '');
    }

    public function raisePower()
    {
        $this->power++;
        $this->updateDisplay();
    }

    public function lowerPower()
    {
        $this->power--;
        $this->updateDisplay();
    }

    public function calculate()
    {
        $requestData = [
            'type' => $this->mode,
            'decimal' => $this->decimal,
            'nbr1' => $this->nbr1,
            'pwr1' => $this->pwr1,
            'opr' => $this->opr,
            'nbr2' => $this->nbr2,
            'pwr2' => $this->pwr2,
        ];

        $request = new \Illuminate\Http\Request($requestData);
        $model = new Math();
        $result = $model->scientific($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->initResult($result['ans'], $result['right']);
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
        return view('livewire.calculators.scientific-notation-calculator');
    }
}
