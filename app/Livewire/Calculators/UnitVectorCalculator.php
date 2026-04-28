<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class UnitVectorCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $method = 'normalize';
    public $dimen = '3d';
    public $find = 'x';
    public $find1 = 'x';
    public $x = '2';
    public $y = '3';
    public $z = '5';
    public $fx = '0.3';
    public $fy = '0.2';
    public $fz = '0.4';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session()->pull('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session()->pull('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function calculate()
    {
        $requestData = [
            'method' => $this->method,
            'dimen'  => $this->dimen,
            'find'   => $this->find,
            'find1'  => $this->find1,
            'x'      => $this->x,
            'y'      => $this->y,
            'z'      => $this->z,
            'fx'     => $this->fx,
            'fy'     => $this->fy,
            'fz'     => $this->fz,
        ];

        $model = new Physics();
        $result = $model->unit_vector((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->error = null;
            $this->dispatch('initKaTeX');
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
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->method = 'normalize';
        $this->dimen = '3d';
        $this->x = '2';
        $this->y = '3';
        $this->z = '5';
        $this->fx = '0.3';
        $this->fy = '0.2';
        $this->fz = '0.4';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['method', 'dimen', 'find', 'find1', 'x', 'y', 'z', 'fx', 'fy', 'fz'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function render()
    {
        if (session()->pull('scroll_to_result')) {
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

        return view('livewire.calculators.unit-vector-calculator');
    }
}
