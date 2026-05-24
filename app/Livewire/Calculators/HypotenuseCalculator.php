<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class HypotenuseCalculator extends Component
{
     public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $cal_from = 'two_sides';
    public $cal = 'hypo';
    public $cal_with = 'a_angle';
    public $cal_with1 = 'area_a';
    public $area = '75';
    public $area_unit = 'cm²';
    public $a = '75';
    public $a_unit = 'cm';
    public $angle_a = '75';
    public $angle_a_unit = 'deg';
    public $b = '75';
    public $b_unit = 'cm';
    public $angle_b = '75';
    public $angle_b_unit = 'deg';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal_from = $inputs['cal_from'] ?? 'two_sides';
            $this->cal = $inputs['cal'] ?? 'hypo';
            $this->cal_with = $inputs['cal_with'] ?? 'a_angle';
            $this->cal_with1 = $inputs['cal_with1'] ?? 'area_a';
            $this->area = $inputs['area'] ?? '75';
            $this->area_unit = $inputs['area_unit'] ?? 'cm²';
            $this->a = $inputs['a'] ?? '75';
            $this->a_unit = $inputs['a_unit'] ?? 'cm';
            $this->angle_a = $inputs['angle_a'] ?? '75';
            $this->angle_a_unit = $inputs['angle_a_unit'] ?? 'deg';
            $this->b = $inputs['b'] ?? '75';
            $this->b_unit = $inputs['b_unit'] ?? 'cm';
            $this->angle_b = $inputs['angle_b'] ?? '75';
            $this->angle_b_unit = $inputs['angle_b_unit'] ?? 'deg';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->cal_from = 'two_sides';
        $this->cal = 'hypo';
        $this->cal_with = 'a_angle';
        $this->cal_with1 = 'area_a';
        $this->area = '75';
        $this->area_unit = 'cm²';
        $this->a = '75';
        $this->a_unit = 'cm';
        $this->angle_a = '75';
        $this->angle_a_unit = 'deg';
        $this->b = '75';
        $this->b_unit = 'cm';
        $this->angle_b = '75';
        $this->angle_b_unit = 'deg';

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

    public function showCalInput() { return $this->cal_from === 'area_side'; }
    public function showCalWith() { return $this->cal_from === 'angle_side'; }
    public function showCalWith1() { return $this->cal_from === 'area_side' && $this->cal === 'hypo'; }
    public function showAreaInput() {
        if ($this->cal_from !== 'area_side') return false;
        return in_array($this->cal, ['hypo', 'side_a', 'side_b']);
    }
    public function showAInput() {
        if ($this->cal_from === 'two_sides') return true;
        if ($this->cal_from === 'angle_side' && $this->cal_with === 'a_angle') return true;
        if ($this->cal_from === 'area_side') {
            if ($this->cal === 'hypo' && $this->cal_with1 === 'area_a') return true;
            if ($this->cal === 'area') return true;
            if ($this->cal === 'side_b') return true;
        }
        return false;
    }
    public function showBInput() {
        if ($this->cal_from === 'two_sides') return true;
        if ($this->cal_from === 'angle_side' && $this->cal_with === 'b_angle') return true;
        if ($this->cal_from === 'area_side') {
            if ($this->cal === 'hypo' && $this->cal_with1 === 'area_b') return true;
            if ($this->cal === 'area') return true;
            if ($this->cal === 'side_a') return true;
        }
        return false;
    }
    public function showAngleAInput() { return $this->cal_from === 'angle_side' && $this->cal_with === 'a_angle'; }
    public function showAngleBInput() { return $this->cal_from === 'angle_side' && $this->cal_with === 'b_angle'; }

    public function calculate()
    {
        $request = (object)[
            'cal_from' => $this->cal_from,
            'cal' => $this->cal,
            'cal_with' => $this->cal_with,
            'cal_with1' => $this->cal_with1,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'a' => $this->a,
            'a_unit' => $this->a_unit,
            'angle_a' => $this->angle_a,
            'angle_a_unit' => $this->angle_a_unit,
            'b' => $this->b,
            'b_unit' => $this->b_unit,
            'angle_b' => $this->angle_b,
            'angle_b_unit' => $this->angle_b_unit,
        ];

        $model = new Math();
        $result = $model->hypotenuse($request);

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
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');
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
        return view('livewire.calculators.hypotenuse-calculator');
    }
}
