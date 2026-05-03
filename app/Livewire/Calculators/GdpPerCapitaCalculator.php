<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class GdpPerCapitaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $real = 5;
    public $real_unit = 'thousand';
    public $population = 4;
    public $population_unit = 'thousand';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        // Set default units from lang if available
        $this->real_unit = $lang[6] ?? 'thousand';
        $this->population_unit = $lang[6] ?? 'thousand';

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->real = $inputs->real ?? 5;
            $this->real_unit = $inputs->real_unit ?? ($lang[6] ?? 'thousand');
            $this->population = $inputs->population ?? 4;
            $this->population_unit = $inputs->population_unit ?? ($lang[6] ?? 'thousand');
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->real = 5;
        $this->population = 4;
        $this->real_unit = $this->lang[6] ?? 'thousand';
        $this->population_unit = $this->lang[6] ?? 'thousand';

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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'real' => $this->real,
            'real_unit' => $this->real_unit,
            'population' => $this->population,
            'population_unit' => $this->population_unit,
        ];

        $model = new Finance();
        $result = $model->gdp($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.gdp-per-capita-calculator');
    }
   
}
