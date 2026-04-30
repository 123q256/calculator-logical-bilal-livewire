<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class ForceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Main Modes: m1 (Force Calculator), m2 (Net Force Calculator)
    public $unit_type = 'm1';

    // m1 properties
    public $cal = 'f';
    public $f = 10;
    public $f_unit = 'dyn';
    public $m = 4;
    public $m_unit = 'ug';
    public $a = 4;
    public $a_unit = 'in_s2';
    public $sigfig = 'auto';

    // m2 properties
    public $question = 'yes';
    public $a_f = 15;
    public $g_f = 15;
    public $f_v = '13,9,8,15,7';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'openDropdown' && !str_contains($propertyName, 'unit')) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function setUnitType($val)
    {
        $this->unit_type = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'unit_type', 'cal', 'f', 'f_unit', 'm', 'm_unit', 'a', 'a_unit', 'sigfig', 'question', 'a_f', 'g_f', 'f_v']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = [
            'unit_type' => $this->unit_type,
            'cal'       => $this->cal,
            'f'         => $this->f,
            'f_unit'    => $this->f_unit,
            'm'         => $this->m,
            'm_unit'    => $this->m_unit,
            'a'         => $this->a,
            'a_unit'    => $this->a_unit,
            'sigfig'    => $this->sigfig,
            'question'  => $this->question,
            'a_f'       => $this->a_f,
            'g_f'       => $this->g_f,
            'f_v'       => $this->f_v,
        ];

        $model = new Physics();
        $result = $model->force((object)$request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            
            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
            $this->dispatch('math-rendered');
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
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
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.force-calculator');
    }
}
