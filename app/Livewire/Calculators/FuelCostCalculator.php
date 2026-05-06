<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class FuelCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $distance = 12;
    public $d_units = 'km';
    public $f_efficiency = 12;
    public $f_eff_units = 'L/100km';
    public $f_price = 12;
    public $f_p_units = '$/liter';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = session('currency', '$');
        $this->f_p_units = $this->currancy . '/liter';
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->distance = $inputs->distance ?? 12;
            $this->d_units = $inputs->d_units ?? 'km';
            $this->f_efficiency = $inputs->f_efficiency ?? 12;
            $this->f_eff_units = $inputs->f_eff_units ?? 'L/100km';
            $this->f_price = $inputs->f_price ?? 12;
            $this->f_p_units = $inputs->f_p_units ?? $this->currancy . '/liter';
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

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
            'distance'     => $this->distance,
            'd_units'      => $this->d_units,
            'f_efficiency' => $this->f_efficiency,
            'f_eff_units'  => $this->f_eff_units,
            'f_price'      => $this->f_price,
            'f_p_units'    => $this->f_p_units,
            'currancy'     => $this->currancy,
        ];

        $model = new EverydayLife();
        $result = $model->fuel((object)$requestData);
        
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.fuel-cost-calculator');
    }
}
