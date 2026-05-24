<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class LawOfCosinesCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $cal = 'aa';
    public $side_a = '12';
    public $side_a_unit = 'm';
    public $side_b = '12';
    public $side_b_unit = 'cm';
    public $side_c = '4';
    public $side_c_unit = 'cm';
    public $angle_a = '4';
    public $angle_a_unit = 'deg';
    public $angle_b = '4';
    public $angle_b_unit = 'deg';
    public $angle_c = '4';
    public $angle_c_unit = 'deg';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal = $inputs['cal'] ?? 'aa';
            $this->side_a = $inputs['side_a'] ?? '12';
            $this->side_a_unit = $inputs['side_a_unit'] ?? 'm';
            $this->side_b = $inputs['side_b'] ?? '12';
            $this->side_b_unit = $inputs['side_b_unit'] ?? 'cm';
            $this->side_c = $inputs['side_c'] ?? '4';
            $this->side_c_unit = $inputs['side_c_unit'] ?? 'cm';
            $this->angle_a = $inputs['angle_a'] ?? '4';
            $this->angle_a_unit = $inputs['angle_a_unit'] ?? 'deg';
            $this->angle_b = $inputs['angle_b'] ?? '4';
            $this->angle_b_unit = $inputs['angle_b_unit'] ?? 'deg';
            $this->angle_c = $inputs['angle_c'] ?? '4';
            $this->angle_c_unit = $inputs['angle_c_unit'] ?? 'deg';
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        // Reset to defaults
        $this->cal = 'aa';
        $this->side_a = '12';
        $this->side_a_unit = 'm';
        $this->side_b = '12';
        $this->side_b_unit = 'cm';
        $this->side_c = '4';
        $this->side_c_unit = 'cm';
        $this->angle_a = '4';
        $this->angle_a_unit = 'deg';
        $this->angle_b = '4';
        $this->angle_b_unit = 'deg';
        $this->angle_c = '4';
        $this->angle_c_unit = 'deg';

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

      public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }
    public function calculate()
    {
        $request = (object)[
            'cal'           => $this->cal,
            'side_a'        => $this->side_a,
            'side_a_unit'   => $this->side_a_unit,
            'side_b'        => $this->side_b,
            'side_b_unit'   => $this->side_b_unit,
            'side_c'        => $this->side_c,
            'side_c_unit'   => $this->side_c_unit,
            'angle_a'       => $this->angle_a,
            'angle_a_unit'  => $this->angle_a_unit,
            'angle_b'       => $this->angle_b,
            'angle_b_unit'  => $this->angle_b_unit,
            'angle_c'       => $this->angle_c,
            'angle_c_unit'  => $this->angle_c_unit,
        ];

        $model = new Math();
        $result = $model->law_of_cosines($request);
        // dd($result);
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
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'cal'          => $this->cal,
                'side_a'       => $this->side_a,
                'side_a_unit'  => $this->side_a_unit,
                'side_b'       => $this->side_b,
                'side_b_unit'  => $this->side_b_unit,
                'side_c'       => $this->side_c,
                'side_c_unit'  => $this->side_c_unit,
                'angle_a'      => $this->angle_a,
                'angle_a_unit' => $this->angle_a_unit,
                'angle_b'      => $this->angle_b,
                'angle_b_unit' => $this->angle_b_unit,
                'angle_c'      => $this->angle_c,
                'angle_c_unit' => $this->angle_c_unit,
            ]);
            $this->error = null;
            $this->dispatch('show-result');

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const rootEl = typeof $wire !== 'undefined' && $wire.$el ? $wire.$el : document.body;
                        if (typeof renderMathInElement === 'function') renderMathInElement(rootEl);
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
        return view('livewire.calculators.law-of-cosines-calculator');
    }
}
