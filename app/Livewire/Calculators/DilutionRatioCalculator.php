<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class DilutionRatioCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $final_volume = '';
    public $final_unit = 'liter';
    public $dilution_ratio = '';
    public $concentrate_volume = '';
    public $concentrate_unit = 'liter';
    public $water_volume = '';
    public $water_unit = 'liter';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->final_volume = $inputs->final_volume ?? '';
            $this->final_unit = $inputs->final_unit ?? 'liter';
            $this->dilution_ratio = $inputs->dilution_ratio ?? '';
            $this->concentrate_volume = $inputs->concentrate_volume ?? '';
            $this->concentrate_unit = $inputs->concentrate_unit ?? 'liter';
            $this->water_volume = $inputs->water_volume ?? '';
            $this->water_unit = $inputs->water_unit ?? 'liter';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->final_volume = '';
        $this->final_unit = 'liter';
        $this->dilution_ratio = '';
        $this->concentrate_volume = '';
        $this->concentrate_unit = 'liter';
        $this->water_volume = '';
        $this->water_unit = 'liter';

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
        $requestData = [
            'final_volume'       => $this->final_volume,
            'final_unit'         => $this->final_unit,
            'dilution_ratio'     => $this->dilution_ratio,
            'concentrate_volume' => $this->concentrate_volume,
            'concentrate_unit'   => $this->concentrate_unit,
            'water_volume'       => $this->water_volume,
            'water_unit'         => $this->water_unit,
        ];

        $model = new EverydayLife();
        $result = $model->dilution((object)$requestData);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (object)$requestData);
                $this->error = null;

                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
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
        return view('livewire.calculators.dilution-ratio-calculator');
    }
}
