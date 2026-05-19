<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class PowerReducingFormulaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $know = 1;
    public $angle = 30;
    public $angle_unit = 'deg';
    public $sinx = '';
    public $sin2x = '';
    public $cosx = '';
    public $cos2x = '';
    public $tanx = '';
    public $tan2x = '';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->know = $inputs->know ?? 1;
            $this->angle = $inputs->angle ?? 30;
            $this->angle_unit = $inputs->angle_unit ?? 'deg';
            $this->sinx = $inputs->sinx ?? '';
            $this->sin2x = $inputs->sin2x ?? '';
            $this->cosx = $inputs->cosx ?? '';
            $this->cos2x = $inputs->cos2x ?? '';
            $this->tanx = $inputs->tanx ?? '';
            $this->tan2x = $inputs->tan2x ?? '';
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->know = 1;
        $this->angle = 30;
        $this->angle_unit = 'deg';
        $this->sinx = '';
        $this->sin2x = '';
        $this->cosx = '';
        $this->cos2x = '';
        $this->tanx = '';
        $this->tan2x = '';
        $this->error = null;
        $this->detail = null;

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
        $request = (object)[
            'know' => $this->know,
            'angle' => $this->angle,
            'angle_unit' => $this->angle_unit,
            'sinx' => $this->sinx,
            'sin2x' => $this->sin2x,
            'cosx' => $this->cosx,
            'cos2x' => $this->cos2x,
            'tanx' => $this->tanx,
            'tan2x' => $this->tan2x,
        ];

        $model = new Math();
        $result = $model->pow_red($request);

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
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
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
        }
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
        return view('livewire.calculators.power-reducing-formula-calculator');
    }
}
