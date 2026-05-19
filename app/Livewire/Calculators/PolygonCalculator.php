<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class PolygonCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $operations = 5;
    public $npolygon = '';
    public $calculation = '01';
    public $labl = '12';
    public $units = 'm';
    public $pie = '3.1415926535898';

    // Dropdown state
    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->operations = $inputs['operations'] ?? 5;
            $this->npolygon = $inputs['npolygon'] ?? '';
            $this->calculation = $inputs['calculation'] ?? '01';
            $this->labl = $inputs['labl'] ?? '12';
            $this->units = $inputs['units'] ?? 'm';
            $this->pie = $inputs['pie'] ?? '3.1415926535898';
        }
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($name, $value)
    {
        $this->$name = $value;
        $this->openDropdown = null;
    }

    public function resetForm()
    {
        $this->operations = 5;
        $this->npolygon = '';
        $this->calculation = '01';
        $this->labl = '12';
        $this->units = 'm';
        $this->pie = '3.1415926535898';
        $this->error = null;
        $this->detail = null;
        $this->openDropdown = null;

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
            'operations' => $this->operations,
            'npolygon' => $this->npolygon,
            'calculation' => $this->calculation,
            'labl' => $this->labl,
            'pie' => $this->pie,
            'units' => $this->units,
        ];

        $model = new Math();
        $result = $model->polygon($request);

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
        return view('livewire.calculators.polygon-calculator');
    }
}
