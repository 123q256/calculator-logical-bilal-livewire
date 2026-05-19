<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class AmplitudeAndPeriodCalculator extends Component
{
    public $trigonometric_unit = '1';
    public $first_number = '2';
    public $second_number = '3';
    public $third_number = '4';
    public $fourth_number = '5';
    public $x_not = '1';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->trigonometric_unit = $inputs['trigonometric_unit'] ?? '1';
            $this->first_number = $inputs['first_number'] ?? '2';
            $this->second_number = $inputs['second_number'] ?? '3';
            $this->third_number = $inputs['third_number'] ?? '4';
            $this->fourth_number = $inputs['fourth_number'] ?? '5';
            $this->x_not = $inputs['x_not'] ?? '1';
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function resetForm()
    {
        $this->trigonometric_unit = '1';
        $this->first_number = '2';
        $this->second_number = '3';
        $this->third_number = '4';
        $this->fourth_number = '5';
        $this->x_not = '1';

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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error']);
    }

    public function calculate()
    {
        if (!is_numeric($this->first_number) || !is_numeric($this->second_number) || 
            !is_numeric($this->third_number) || !is_numeric($this->fourth_number)) {
            $this->error = 'Please fill in all numerical fields.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        if (floatval($this->first_number) == 0) {
            $this->error = 'For A=0, this is not a trigonometric function!';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        if (floatval($this->second_number) == 0) {
            $this->error = 'For B=0, this is not a trigonometric function!';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }

        $inputs = [
            'trigonometric_unit' => $this->trigonometric_unit,
            'first_number' => $this->first_number,
            'second_number' => $this->second_number,
            'third_number' => $this->third_number,
            'fourth_number' => $this->fourth_number,
            'x_not' => $this->x_not,
        ];

        $request = request()->merge($inputs);

        $model = new Math();
        $result = $model->amplitude($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            foreach ($result as $key => $value) {
                if (is_float($value)) {
                    $result[$key] = round($value, 10);
                }
            }

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $inputs);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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

        $this->error = $result['error'] ?? 'Please check your inputs.';
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

        if (empty($this->detail) && session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        return view('livewire.calculators.amplitude-and-period-calculator', [
            'detail' => $this->detail,
        ]);
    }
}
