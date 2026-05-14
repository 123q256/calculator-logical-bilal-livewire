<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class IncidenceRateCalculator extends Component
{
    public $cases = '10';
    public $risk = '100';
    public $different_unit = 'No';
    public $population = '1000';
    public $per = '100000';
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
            $this->cases = $inputs['cases'] ?? '10';
            $this->risk = $inputs['risk'] ?? '100';
            $this->different_unit = $inputs['different_unit'] ?? 'No';
            $this->population = $inputs['population'] ?? '1000';
            $this->per = $inputs['per'] ?? '100000';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->cases = '10';
        $this->risk = '100';
        $this->different_unit = 'No';
        $this->population = '1000';
        $this->per = '100000';
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
        if (empty($this->risk) || $this->risk == 0) {
            $this->error = 'Risk population cannot be zero or empty.';
            return;
        }

        $request = (object)[
            'cases' => $this->cases,
            'risk' => $this->risk,
            'different_unit' => $this->different_unit,
            'population' => $this->population,
            'per' => $this->per,
        ];

        $model = new Health();
        $result = $model->incidence($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
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
        return view('livewire.calculators.incidence-rate-calculator');
    }
}
