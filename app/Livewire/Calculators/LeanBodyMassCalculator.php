<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class LeanBodyMassCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $gender = 'Male';
    public $height_ft = 5;
    public $height_in = 9;
    public $height_cm = 175;
    public $weight = 175;
    public $unit = 'lbs';
    public $unit_h = 'ft/in';
    public $formula = 'Boer';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->gender = $inputs->gender ?? $this->gender;
            $this->height_ft = $inputs->{'height-ft'} ?? $this->height_ft;
            $this->height_in = $inputs->{'height-in'} ?? $this->height_in;
            $this->height_cm = $inputs->{'height-cm'} ?? $this->height_cm;
            $this->weight = $inputs->weight ?? $this->weight;
            $this->unit = $inputs->unit ?? $this->unit;
            $this->unit_h = $inputs->unit_ft_in ?? $this->unit_h;
            $this->formula = $inputs->formula ?? $this->formula;
        }
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->gender = 'Male';
        $this->height_ft = 5;
        $this->height_in = 9;
        $this->height_cm = 175;
        $this->weight = 175;
        $this->unit = 'lbs';
        $this->unit_h = 'ft/in';
        $this->formula = 'Boer';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'gender' => $this->gender,
            'height-ft' => $this->height_ft,
            'height-in' => $this->height_in,
            'height-cm' => $this->height_cm,
            'weight' => $this->weight,
            'unit' => $this->unit,
            'unit_ft_in' => $this->unit_h,
            'formula' => $this->formula,
        ];

        $model = new Health();
        $result = $model->lean($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
        }
        return view('livewire.calculators.lean-body-mass-calculator');
    }
}
