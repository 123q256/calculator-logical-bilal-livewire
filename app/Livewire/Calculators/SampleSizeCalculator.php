<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class SampleSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $population = 'sample'; // Infinite (sample) or Finite (margin)
    public $given_unit = 'standard';
    public $confidence_unit = '95%';
    public $margin = 5;
    public $standard = 2;
    public $proportion = 50;
    public $n_finite = 10;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->population = $inputs->population ?? 'sample';
            $this->given_unit = $inputs->given_unit ?? 'standard';
            $this->confidence_unit = $inputs->confidence_unit ?? '95%';
            $this->margin = $inputs->margin ?? 5;
            $this->standard = $inputs->standard ?? 2;
            $this->proportion = $inputs->proportion ?? 50;
            $this->n_finite = $inputs->n_finite ?? 10;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function setPopulation($value)
    {
        $this->population = $value;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->population = 'sample';
        $this->given_unit = 'standard';
        $this->confidence_unit = '95%';
        $this->margin = 5;
        $this->standard = 2;
        $this->proportion = 50;
        $this->n_finite = 10;

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'population'      => $this->population,
            'given_unit'      => $this->given_unit,
            'confidence_unit' => $this->confidence_unit,
            'margin'          => $this->margin,
            'standard'        => $this->standard,
            'proportion'      => $this->proportion,
            'n_finite'        => $this->n_finite,
        ];

        $model = new Statistics();
        $result = $model->sample_size($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->dispatch('math-updated');
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.sample-size-calculator');
    }
}
