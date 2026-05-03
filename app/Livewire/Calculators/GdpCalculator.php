<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class GdpCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $consumption = 10;
    public $consumption_unit = 'million';
    public $investment = 8;
    public $investment_unit = 'million';
    public $purchases = 6;
    public $purchases_unit = 'million';
    public $exports = 4;
    public $exports_unit = 'million';
    public $imports = 2;
    public $imports_unit = 'million';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        // Set default units from lang if available
        $this->consumption_unit = $lang[6] ?? 'million';
        $this->investment_unit = $lang[6] ?? 'million';
        $this->purchases_unit = $lang[6] ?? 'million';
        $this->exports_unit = $lang[6] ?? 'million';
        $this->imports_unit = $lang[6] ?? 'million';

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->consumption = $inputs->consumption ?? 10;
            $this->consumption_unit = $inputs->consumption_unit ?? ($lang[6] ?? 'million');
            $this->investment = $inputs->investment ?? 8;
            $this->investment_unit = $inputs->investment_unit ?? ($lang[6] ?? 'million');
            $this->purchases = $inputs->purchases ?? 6;
            $this->purchases_unit = $inputs->purchases_unit ?? ($lang[6] ?? 'million');
            $this->exports = $inputs->exports ?? 4;
            $this->exports_unit = $inputs->exports_unit ?? ($lang[6] ?? 'million');
            $this->imports = $inputs->imports ?? 2;
            $this->imports_unit = $inputs->imports_unit ?? ($lang[6] ?? 'million');
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->consumption = 10;
        $this->investment = 8;
        $this->purchases = 6;
        $this->exports = 4;
        $this->imports = 2;
        
        $unit = $this->lang[6] ?? 'million';
        $this->consumption_unit = $unit;
        $this->investment_unit = $unit;
        $this->purchases_unit = $unit;
        $this->exports_unit = $unit;
        $this->imports_unit = $unit;

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
            'consumption' => $this->consumption,
            'consumption_unit' => $this->consumption_unit,
            'investment' => $this->investment,
            'investment_unit' => $this->investment_unit,
            'purchases' => $this->purchases,
            'purchases_unit' => $this->purchases_unit,
            'exports' => $this->exports,
            'exports_unit' => $this->exports_unit,
            'imports' => $this->imports,
            'imports_unit' => $this->imports_unit,
        ];

        $model = new Finance();
        $result = $model->gdp_cal($request);

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

        return view('livewire.calculators.gdp-calculator');
    }
}
