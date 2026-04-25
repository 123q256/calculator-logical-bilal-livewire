<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class CombinedGasLawCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $calculation = '1';
    public $pressure_one = 10;
    public $pressure_one_unit = 'Pa';
    public $pressure_two = 7;
    public $pressure_two_unit = 'Pa';
    public $volume_one = 12;
    public $volume_one_unit = 'm³';
    public $volume_two = 2;
    public $volume_two_unit = 'm³';
    public $temp_one = 5;
    public $temp_one_unit = '°C';
    public $temp_two = 8;
    public $temp_two_unit = '°C';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calculation = $inputs->calculation ?? '1';
            $this->pressure_one = $inputs->pressure_one ?? 10;
            $this->pressure_one_unit = $inputs->pressure_one_unit ?? 'Pa';
            $this->pressure_two = $inputs->pressure_two ?? 7;
            $this->pressure_two_unit = $inputs->pressure_two_unit ?? 'Pa';
            $this->volume_one = $inputs->volume_one ?? 12;
            $this->volume_one_unit = $inputs->volume_one_unit ?? 'm³';
            $this->volume_two = $inputs->volume_two ?? 2;
            $this->volume_two_unit = $inputs->volume_two_unit ?? 'm³';
            $this->temp_one = $inputs->temp_one ?? 5;
            $this->temp_one_unit = $inputs->temp_one_unit ?? '°C';
            $this->temp_two = $inputs->temp_two ?? 8;
            $this->temp_two_unit = $inputs->temp_two_unit ?? '°C';
        }
    }

    public function updatedCalculation()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->calculation = '1';
        $this->pressure_one = 10;
        $this->pressure_two = 7;
        $this->volume_one = 12;
        $this->volume_two = 2;
        $this->temp_one = 5;
        $this->temp_two = 8;

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
        $request = (object)[
            'calculation'       => $this->calculation,
            'pressure_one'      => $this->pressure_one,
            'pressure_one_unit' => $this->pressure_one_unit,
            'pressure_two'      => $this->pressure_two,
            'pressure_two_unit' => $this->pressure_two_unit,
            'volume_one'        => $this->volume_one,
            'volume_one_unit'   => $this->volume_one_unit,
            'volume_two'        => $this->volume_two,
            'volume_two_unit'   => $this->volume_two_unit,
            'temp_one'          => $this->temp_one,
            'temp_one_unit'     => $this->temp_one_unit,
            'temp_two'          => $this->temp_two,
            'temp_two_unit'     => $this->temp_two_unit,
        ];

        $model = new Chemistry();
        $result = $model->combined($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        return view('livewire.calculators.combined-gas-law-calculator');
    }
}
