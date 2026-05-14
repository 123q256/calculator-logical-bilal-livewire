<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class HeightCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Method Selection
    public $method = 'calculator1';

    // Khamis-Roche Inputs (Calculator 1)
    public $age = '4.5';
    public $gender = '0';
    public $c_height_ft = 3;
    public $c_height_in = 1;
    public $c_height_cm = 180;
    public $c_unit_h = 'ft/in';
    public $c_weight_lbs = 38;
    public $c_weight_kg = 17.2;
    public $c_unit_w = 'lbs';
    public $m_height_ft_1 = 5;
    public $m_height_in_1 = 5;
    public $m_height_cm_1 = 166;
    public $m_unit_h_1 = 'ft/in';
    public $f_height_ft_1 = 5;
    public $f_height_in_1 = 9;
    public $f_height_cm_1 = 176;
    public $f_unit_h_1 = 'ft/in';

    // Mid-Parental Inputs (Calculator 2)
    public $m_height_ft_2 = 5;
    public $m_height_in_2 = 9;
    public $m_height_cm_2 = 175;
    public $m_unit_h_2 = 'ft/in';
    public $f_height_ft_2 = 5;
    public $f_height_in_2 = 9;
    public $f_height_cm_2 = 180;
    public $f_unit_h_2 = 'ft/in';

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
        $this->detail = null;
        $this->error = null;
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        // Reset to defaults
        $this->method = 'calculator1';
        $this->age = '4.5';
        $this->gender = '0';
        $this->c_height_ft = 3;
        $this->c_height_in = 1;
        $this->c_height_cm = 180;
        $this->c_unit_h = 'ft/in';
        $this->c_weight_lbs = 38;
        $this->c_weight_kg = 17.2;
        $this->c_unit_w = 'lbs';
        $this->m_height_ft_1 = 5;
        $this->m_height_in_1 = 5;
        $this->m_height_cm_1 = 166;
        $this->m_unit_h_1 = 'ft/in';
        $this->f_height_ft_1 = 5;
        $this->f_height_in_1 = 9;
        $this->f_height_cm_1 = 176;
        $this->f_unit_h_1 = 'ft/in';
        $this->m_height_ft_2 = 5;
        $this->m_height_in_2 = 9;
        $this->m_height_cm_2 = 175;
        $this->m_unit_h_2 = 'ft/in';
        $this->f_height_ft_2 = 5;
        $this->f_height_in_2 = 9;
        $this->f_height_cm_2 = 180;
        $this->f_unit_h_2 = 'ft/in';

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
        $requestData = [];

        if ($this->method === 'calculator1') {
            $requestData = [
                'calculator_n' => 'calculator1',
                'age' => $this->age,
                'gender' => $this->gender,
                'c-height-ft' => $this->c_height_ft,
                'c-height-in' => $this->c_height_in,
                'c-height-cm' => $this->c_height_cm,
                'c-unit_h' => $this->c_unit_h,
                'c-weight-lbs' => $this->c_weight_lbs,
                'c-weight-kg' => $this->c_weight_kg,
                'c-unit_w' => $this->c_unit_w,
                'm-height-ft' => $this->m_height_ft_1,
                'm-height-in' => $this->m_height_in_1,
                'm-height-cm' => $this->m_height_cm_1,
                'mother_1_unit' => $this->m_unit_h_1,
                'f-height-ft' => $this->f_height_ft_1,
                'f-height-in' => $this->f_height_in_1,
                'f-height-cm' => $this->f_height_cm_1,
                'father_1_unit' => $this->f_unit_h_1,
            ];
        } else {
            $requestData = [
                'calculator_name' => 'calculator2',
                'm-height-ft' => $this->m_height_ft_2,
                'm-height-in' => $this->m_height_in_2,
                'height-cm' => $this->m_height_cm_2, // Note: health model uses 'height-cm' for mother in calc2
                'f-height-ft' => $this->f_height_ft_2,
                'f-height-in' => $this->f_height_in_2,
                'f-height-cm' => $this->f_height_cm_2,
                'mother_entry_unit' => $this->m_unit_h_2,
                'father_entry_unit' => $this->f_unit_h_2,
            ];
        }

        $request = new \Illuminate\Http\Request($requestData);
        $model = new Health();
        $result = $model->height_cal($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
        return view('livewire.calculators.height-calculator');
    }
}
