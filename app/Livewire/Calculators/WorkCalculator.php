<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class WorkCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $method = 'work';
    public $method1 = 'fnd';
    public $find = 'work';
    public $find1 = 'power';
    public $find2 = 'work2';

    public $f = '5';
    public $f_unit = 'n';
    public $d = '5';
    public $d_unit = 'mm';
    public $m = '5';
    public $m_unit = 'kg';
    public $v0 = '5';
    public $v0_unit = 'ms';
    public $v1 = '5';
    public $v1_unit = 'ms';
    public $w = '5';
    public $w_unit = 'J';
    public $p = '5';
    public $p_unit = 'W';
    public $t = '5';
    public $t_unit = 'sec';

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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->method = 'work';
        $this->method1 = 'fnd';
        $this->find = 'work';
        $this->find1 = 'power';
        $this->find2 = 'work2';
        $this->f = '5';
        $this->f_unit = 'n';
        $this->d = '5';
        $this->d_unit = 'mm';
        $this->m = '5';
        $this->m_unit = 'kg';
        $this->v0 = '5';
        $this->v0_unit = 'ms';
        $this->v1 = '5';
        $this->v1_unit = 'ms';
        $this->w = '5';
        $this->w_unit = 'J';
        $this->p = '5';
        $this->p_unit = 'W';
        $this->t = '5';
        $this->t_unit = 'sec';

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
            'method' => $this->method,
            'method1' => $this->method1,
            'find' => $this->find,
            'find1' => $this->find1,
            'find2' => $this->find2,
            'f' => $this->f,
            'f_unit' => $this->f_unit,
            'd' => $this->d,
            'd_unit' => $this->d_unit,
            'm' => $this->m,
            'm_unit' => $this->m_unit,
            'v0' => $this->v0,
            'v0_unit' => $this->v0_unit,
            'v1' => $this->v1,
            'v1_unit' => $this->v1_unit,
            'w' => $this->w,
            'w_unit' => $this->w_unit,
            'p' => $this->p,
            'p_unit' => $this->p_unit,
            't' => $this->t,
            't_unit' => $this->t_unit,
        ];

        $model = new Physics();
        $result = $model->work((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->error = null;
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

        return view('livewire.calculators.work-calculator');
    }
}
