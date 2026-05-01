<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class GearRatioCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type_calc = 'calculator';
    public $lang = [];

    // Form properties
    public $type = 'first'; // Mode: 'first' (Gear Ratio), 'second' (Speed Calculator)
    
    // Simple Gear Ratio Inputs
    public $f_first = 15;
    public $f_second = 10;
    public $f_third = 9;
    public $ft_unit = 'rpm';
    public $f_four = 5;
    public $ff_unit = 'Nm';

    // Speed Calculator Inputs
    public $transmissions = 'Magnum XL 2.66 - .50';
    public $s_first = 100;
    public $s_second = 45;
    public $s_third = 20;
    public $s_four = 26;
    public $s_five = 8;
    public $s_six = 6;

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type_calc = $type;
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

    public function updatedType()
    {
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
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'type', 'f_first', 'f_second', 'f_third', 'ft_unit', 'f_four', 'ff_unit', 'transmissions', 's_first', 's_second', 's_third', 's_four', 's_five', 's_six']);
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }

    }

    public function calculate()
    {
        $request = [
            'type'          => $this->type,
            'f_first'       => $this->f_first,
            'f_second'      => $this->f_second,
            'f_third'       => $this->f_third,
            'ft_unit'       => $this->ft_unit,
            'f_four'        => $this->f_four,
            'ff_unit'       => $this->ff_unit,
            'transmissions' => $this->transmissions,
            's_first'       => $this->s_first,
            's_second'      => $this->s_second,
            's_third'       => $this->s_third,
            's_four'        => $this->s_four,
            's_five'        => $this->s_five,
            's_six'         => $this->s_six,
        ];

        $model = new Physics();
        $result = $model->gear($request);

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
                    }, 100);
            JS);
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.gear-ratio-calculator');
    }
}
