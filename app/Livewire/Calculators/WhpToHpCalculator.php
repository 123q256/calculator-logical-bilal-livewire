<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class WhpToHpCalculator extends Component
{
    public $calculation_type = 'whpToHp';
    public $whp = 230;
    public $dt = '.10';
    public $ehp = 230;
    public $dtlf = '1.1';

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
            $this->calculation_type = $inputs->type ?? 'whpToHp';
            $this->whp = $inputs->whp ?? 230;
            $this->dt = $inputs->dt ?? '.10';
            $this->ehp = $inputs->ehp ?? 230;
            $this->dtlf = $inputs->dtlf ?? '1.1';
        }
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

        $this->calculation_type = 'whpToHp';
        $this->whp = 230;
        $this->dt = '.10';
        $this->ehp = 230;
        $this->dtlf = '1.1';

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
            'type' => $this->calculation_type,
            'whp'  => $this->whp,
            'dt'   => $this->dt,
            'ehp'  => $this->ehp,
            'dtlf' => $this->dtlf,
        ];

        $model = new Physics();
        $result = $model->whp($request);

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
        return view('livewire.calculators.whp-to-hp-calculator');
    }
}
