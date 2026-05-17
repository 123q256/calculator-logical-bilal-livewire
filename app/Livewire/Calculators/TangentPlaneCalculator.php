<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class TangentPlaneCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form input properties
    public $calc_type = 'two';
    public $eq = 'x^3 - 3xy + y^3';
    public $x = '1';
    public $y = '2';
    public $z = '5';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $request = request();
        if ($request->has('eq')) {
            $this->eq = $request->eq;
        }
        if ($request->has('x')) {
            $this->x = $request->x;
        }
        if ($request->has('y')) {
            $this->y = $request->y;
        }
        if ($request->has('z')) {
            $this->z = $request->z;
        }
        if ($request->has('type')) {
            $this->calc_type = $request->type;
        }
    }

    public function updatedCalcType($value)
    {
        if ($value === 'three') {
            $this->eq = 'x^2 + y^2 + z^2 = 30';
            $this->y = '-2';
            $this->z = '5';
        } else {
            $this->eq = 'x^3 - 3xy + y^3';
            $this->y = '2';
        }
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'calc_type') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->calc_type = 'two';
        $this->eq = 'x^3 - 3xy + y^3';
        $this->x = '1';
        $this->y = '2';
        $this->z = '5';

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
        $request = request();
        $request->merge([
            'type' => $this->calc_type,
            'eq' => $this->eq,
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
        ]);

        $model = new Math();
        $result = $model->tpc($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $result['calc_type'] = $this->calc_type;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
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

        $this->error = $result['error'] ?? 'Please Check Your Input.';
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
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.tangent-plane-calculator');
    }
}
