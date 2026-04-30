<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Physics;
class WavePeriodCalculator extends Component
{
    public $sim_adv = 'simple';
    public $frequency = 20;
    public $wavelength = 15;
    public $wave_speed = 50;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->sim_adv = $inputs->sim_adv ?? 'simple';
            $this->frequency = $inputs->frequency ?? 20;
            $this->wavelength = $inputs->wavelength ?? 15;
            $this->wave_speed = $inputs->wave_speed ?? 50;
        }
    }

    public function setTab($tab)
    {
        $this->sim_adv = $tab;
        $this->detail = null;
        $this->error = null;
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

        $this->sim_adv = 'simple';
        $this->frequency = 20;
        $this->wavelength = 15;
        $this->wave_speed = 50;

        $this->error = null;
        $this->detail = null;

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
            'sim_adv'       => $this->sim_adv,
            'frequency'     => (float)$this->frequency,
            'frequency_sec' => null, // Added to satisfy the model
            'wavelength'    => (float)$this->wavelength,
            'wave_speed'    => (float)$this->wave_speed,
        ];

        $model = new Physics();
        $result = $model->wave_period($request);

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
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.wave-period-calculator');
    }


}
