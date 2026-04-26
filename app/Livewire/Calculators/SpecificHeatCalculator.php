<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class SpecificHeatCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $find = 'specific_heat';
    public $by = 'change';
    public $q = '20';
    public $q_unit = 'J';
    public $it = '20';
    public $it_unit = '°C';
    public $ft = '20';
    public $ft_unit = '°C';
    public $dt = '20';
    public $dt_unit = '°C';
    public $m = '20';
    public $m_unit = 'kg';
    public $c = '20';
    public $c_unit = 'J/(kg·K)';
    public $sub = 'select';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function toggleDropdown($id)
    {
        $this->openDropdown = ($this->openDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        $this->openDropdown = null;
    }

    public function updatedSub($value)
    {
        if ($value !== 'select') {
            $parts = explode('@', $value);
            if (count($parts) >= 1) {
                $this->c = $parts[0];
                $this->c_unit = 'J/(kg·K)';
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->find = 'specific_heat';
        $this->by = 'change';
        $this->q = '20';
        $this->q_unit = 'J';
        $this->it = '20';
        $this->it_unit = '°C';
        $this->ft = '20';
        $this->ft_unit = '°C';
        $this->dt = '20';
        $this->dt_unit = '°C';
        $this->m = '20';
        $this->m_unit = 'kg';
        $this->c = '20';
        $this->c_unit = 'J/(kg·K)';
        $this->sub = 'select';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'find' => $this->find,
            'by' => $this->by,
            'q' => $this->q,
            'q_unit' => $this->q_unit,
            'it' => $this->it,
            'it_unit' => $this->it_unit,
            'ft' => $this->ft,
            'ft_unit' => $this->ft_unit,
            'dt' => $this->dt,
            'dt_unit' => $this->dt_unit,
            'm' => $this->m,
            'm_unit' => $this->m_unit,
            'c' => $this->c,
            'c_unit' => $this->c_unit,
            'sub' => $this->sub,
        ];

        $model = new Physics();
        // The model uses array access $request['find']
        $result = $model->specific($requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->error = null;
            $this->js(<<<'JS'
                setTimeout(() => {
                    if (window.MathJax) {
                        MathJax.typesetPromise();
                    }
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

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    if (window.MathJax) {
                        MathJax.typesetPromise();
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.specific-heat-calculator');
    }
}
