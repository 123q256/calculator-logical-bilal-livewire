<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class ParallelogramCalculator extends Component
{
    // Public Input Properties
    public $slct1 = '10';
    public $rad1 = '7';
    public $side1 = '4';
    public $side2 = '6';
    public $pi = '3.1415926535898';
    public $unit = 'm';

    // Component State
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->slct1 = $inputs['slct1'] ?? '10';
            $this->rad1  = $inputs['rad1']  ?? '7';
            $this->side1 = $inputs['side1'] ?? '4';
            $this->side2 = $inputs['side2'] ?? '6';
            $this->pi    = $inputs['pi']    ?? '3.1415926535898';
            $this->unit  = $inputs['unit']  ?? 'm';
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->slct1 = '10';
        $this->rad1  = '7';
        $this->side1 = '4';
        $this->side2 = '6';
        $this->pi    = '3.1415926535898';
        $this->unit  = 'm';

        $this->error  = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result',
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error  = null;
    }

    public function calculate()
    {
        $request = (object)[
            'slct1' => $this->slct1,
            'rad1'  => $this->rad1,
            'side1' => $this->side1,
            'side2' => $this->side2,
            'pi'    => $this->pi,
            'unit'  => $this->unit,
        ];

        $model  = new Math();
        $result = $model->parallelogram($request);

        if (is_array($result)) {
            foreach ($result as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $result[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $result[$key] = 'INF';
                    }
                }
            }
        }

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error  = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
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

        $this->error  = $result['error'] ?? 'Please! Check Your Input.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    public function getHeading1()
    {
        if (in_array($this->slct1, ['1', '3', '4', '11', '16', '17'])) {
            return "Angle A = C (°):";
        }
        if ($this->slct1 == '2') {
            return "Angle B = D (°):";
        }
        if (in_array($this->slct1, ['5', '7', '12', '13', '14', '15', '18'])) {
            return "Side Length a:";
        }
        if (in_array($this->slct1, ['6', '8', '10', '19'])) {
            return "Side Length b:";
        }
        if ($this->slct1 == '9') {
            return "Height h:";
        }
        return "Side Length b:";
    }

    public function getHeading2()
    {
        if (in_array($this->slct1, ['3', '11', '16'])) {
            return "Side Length a:";
        }
        if (in_array($this->slct1, ['7', '12', '13', '14', '15', '17'])) {
            return "Side Length b:";
        }
        if (in_array($this->slct1, ['4', '10'])) {
            return "Height h:";
        }
        if (in_array($this->slct1, ['5', '6'])) {
            return "Perimeter P:";
        }
        if (in_array($this->slct1, ['8', '9'])) {
            return "Area K:";
        }
        if (in_array($this->slct1, ['18', '19'])) {
            return "Diagonal p:";
        }
        return "Side Length b:";
    }

    public function getHeading3()
    {
        if ($this->slct1 == '11') {
            return "Side Length b:";
        }
        if ($this->slct1 == '12') {
            return "Diagonal p:";
        }
        if (in_array($this->slct1, ['13', '18', '19'])) {
            return "Diagonal q:";
        }
        if ($this->slct1 == '14') {
            return "Height h:";
        }
        if (in_array($this->slct1, ['15', '16', '17'])) {
            return "Area K:";
        }
        return "Height h:";
    }

    public function isSide1Visible()
    {
        return !in_array($this->slct1, ['1', '2']);
    }

    public function isSide2Visible()
    {
        return in_array($this->slct1, ['11', '12', '13', '14', '15', '16', '17', '18', '19']);
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
        return view('livewire.calculators.parallelogram-calculator');
    }
}
