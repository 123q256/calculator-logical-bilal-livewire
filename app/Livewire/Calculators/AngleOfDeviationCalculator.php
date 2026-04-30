<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class AngleOfDeviationCalculator extends Component
{
    public $incidence = 10;
    public $incidence_unit = 'degree';
    public $emergence = 35;
    public $emergence_unit = 'degree';
    public $prism = 35;
    public $prism_unit = 'degree';
    public $deviation_unit = 'degree';

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
            $this->incidence = $inputs->incidence ?? 10;
            $this->incidence_unit = $inputs->incidence_unit ?? 'degree';
            $this->emergence = $inputs->emergence ?? 35;
            $this->emergence_unit = $inputs->emergence_unit ?? 'degree';
            $this->prism = $inputs->prism ?? 35;
            $this->prism_unit = $inputs->prism_unit ?? 'degree';
            $this->deviation_unit = $inputs->deviation_unit ?? 'degree';
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

        $this->incidence = 10;
        $this->incidence_unit = 'degree';
        $this->emergence = 35;
        $this->emergence_unit = 'degree';
        $this->prism = 35;
        $this->prism_unit = 'degree';
        $this->deviation_unit = 'degree';

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
            'incidence'      => $this->incidence,
            'incidence_unit' => $this->incidence_unit,
            'emergence'      => $this->emergence,
            'emergence_unit' => $this->emergence_unit,
            'prism'          => $this->prism,
            'prism_unit'     => $this->prism_unit,
            'deviation_unit' => $this->deviation_unit,
        ];

        $model = new Physics();
        $result = $model->angle_deviation($request);

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
  
        return view('livewire.calculators.angle-of-deviation-calculator');
    }
}
