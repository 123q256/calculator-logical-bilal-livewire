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

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'validation_error', 'calculator_back_inputs', 'scroll_to_result']);
        
        // return redirect()->to(url()->previous() ?? '/');
        }
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
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {

            session()->flash('calculator_result', $result);
            session()->put('calculator_back_inputs', $request);
                                     $this->js(<<<'JS'
                $nextTick(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const top = el.getBoundingClientRect().top + window.scrollY - 60;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                });
            JS);
            return; 
            // return redirect()->to(url()->previous() ?? '/');
                    } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function render()
    {
        return view('livewire.calculators.bmi-calculator');
    }
}
