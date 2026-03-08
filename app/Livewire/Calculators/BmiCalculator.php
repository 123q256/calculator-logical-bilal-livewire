<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class BmiCalculator extends Component
{
    public $error   = null;
    public $detail  = null;
    public $type    = 'calculator';
    public $lang    = [];
    public $calName;
    public $calLink;
    public $unit_type = 'lbs';
    public $stage     = 'adult';
    public $age       = '15';
    public $gender    = 'Male';
    public $ft_in     = '60';
    public $height_cm = '175';
    public $weight    = '160';

    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type    = $type;
        $this->lang    = $lang;
        $this->detail  = session('calculator_result');
        $this->error   = session('validation_error');

        if ($back = session('calculator_back_inputs')) {
            $this->unit_type = $back->unit_type ?? 'lbs';
            $this->stage     = $back->stage     ?? 'adult';
            $this->age       = $back->age       ?? '15';
            $this->gender    = $back->gender    ?? 'Male';
            $this->ft_in     = $back->ft_in     ?? '60';
            $this->height_cm = $back->height_cm ?? '175';
            $this->weight    = $back->weight    ?? '160';
        }
    }




    public function resetForm()
    {
        $this->resetErrorBag();
        $this->error   = null;
        $this->detail  = null;
        $this->unit_type = 'lbs';
        $this->stage     = 'adult';
        $this->age       = '15';
        $this->gender    = 'Male';
        $this->ft_in     = '60';
        $this->height_cm = '175';
        $this->weight    = '160';

        session()->forget(['calculator_result', 'validation_error', 'calculator_back_inputs', 'scroll_to_result']);
        
        return redirect()->to(url()->previous() ?? '/');
    }


    public function calculate()
    {
        $this->error = null;

        if ($this->stage === 'child') {
            if ($this->age < 2 || $this->age > 20) {
                $this->error = 'Child & Teen BMI is only supported for ages 2 to 20.';
                session()->flash('validation_error', $this->error);
                return;
            }
        }

        $request = (object)[
            'unit_type' => $this->unit_type,
            'stage'     => $this->stage,
            'age'       => $this->age,
            'gender'    => $this->gender,
            'ft_in'     => $this->ft_in,
            'height_cm' => $this->height_cm,
            'weight'    => $this->weight,
        ];

        $model  = new \App\Models\Health();
        $result = $model->bmi($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->put('calculator_back_inputs', $request);
            $this->error = null;
             $this->detail = $result;
            return; 
            // return redirect()->to(url()->previous() ?? '/');
        }

        $this->error  = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
        session()->flash('validation_error', $this->error);
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            JS);
        }

        return view('livewire.calculators.bmi-calculator');
    }
}
