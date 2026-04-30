<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class IndexOfRefractionCalculator extends Component
{
    public $selection = '1';
    public $medium_v = '0';
    public $medium_value = 1200;
    public $medium_value_unit = 'm/s';
    public $medium_v2 = '0';
    public $medium_value2 = 1200;
    public $medium_value_unit1 = 'm/s';

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
            $this->selection = $inputs->selection ?? '1';
            $this->medium_v = $inputs->medium_v ?? '0';
            $this->medium_value = $inputs->medium_value ?? 1200;
            $this->medium_value_unit = $inputs->medium_value_unit ?? 'm/s';
            $this->medium_v2 = $inputs->medium_v2 ?? '0';
            $this->medium_value2 = $inputs->medium_value2 ?? 1200;
            $this->medium_value_unit1 = $inputs->medium_value_unit1 ?? 'm/s';
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

        $this->selection = '1';
        $this->medium_v = '0';
        $this->medium_value = 1200;
        $this->medium_value_unit = 'm/s';
        $this->medium_v2 = '0';
        $this->medium_value2 = 1200;
        $this->medium_value_unit1 = 'm/s';

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
            'selection'          => $this->selection,
            'medium_v'           => $this->medium_v,
            'medium_value'       => $this->medium_value,
            'medium_value_unit'  => $this->medium_value_unit,
            'medium_value_unit1' => $this->medium_value_unit1,
            'medium_v2'          => $this->medium_v2,
            'medium_value2'      => $this->medium_value2,
        ];

        $model = new Physics();
        $result = $model->index($request);

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
        return view('livewire.calculators.index-of-refraction-calculator');
    }
}
