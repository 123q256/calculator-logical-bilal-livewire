<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class TitrationCalculator extends Component
{
    public $cal = 'ma';
    public $ma = 2, $ma_unit = 'M';
    public $va = 3, $va_unit = 'ml';
    public $hp = 4;
    public $mb = 2, $mb_unit = 'M';
    public $vb = 6, $vb_unit = 'ml';
    public $oh = 7;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('validation_error')) {
            $this->error = session('validation_error');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal = $inputs->cal ?? 'ma';
            $this->ma = $inputs->ma ?? 2;
            $this->ma_unit = $inputs->ma_unit ?? 'M';
            $this->va = $inputs->va ?? 3;
            $this->va_unit = $inputs->va_unit ?? 'ml';
            $this->hp = $inputs->hp ?? 4;
            $this->mb = $inputs->mb ?? 2;
            $this->mb_unit = $inputs->mb_unit ?? 'M';
            $this->vb = $inputs->vb ?? 6;
            $this->vb_unit = $inputs->vb_unit ?? 'ml';
            $this->oh = $inputs->oh ?? 7;
        }
    }

    public function updatedCal()
    {
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'ma', 'va', 'hp', 'mb', 'vb', 'oh',
            'ma_unit', 'va_unit', 'mb_unit', 'vb_unit', 'cal'
        ]);
        $this->resetErrorBag();

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
            'cal' => $this->cal,
            'ma' => $this->ma,
            'ma_unit' => $this->ma_unit,
            'va' => $this->va,
            'va_unit' => $this->va_unit,
            'hp' => $this->hp,
            'mb' => $this->mb,
            'mb_unit' => $this->mb_unit,
            'vb' => $this->vb,
            'vb_unit' => $this->vb_unit,
            'oh' => $this->oh,
        ];

        $model = new Chemistry();
        $result = $model->titration($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
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
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
  
        return view('livewire.calculators.titration-calculator');
    }
}
