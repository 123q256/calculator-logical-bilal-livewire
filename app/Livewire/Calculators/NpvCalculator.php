<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class NpvCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form fields
    public $initial = 10000;
    public $discount = 10;
    public $year_flows = [5000, 5000, 5000, 5000, 5000, 5000];

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->initial = $inputs->initial ?? 10000;
            $this->discount = $inputs->discount ?? 10;
            $this->year_flows = $inputs->year ?? [5000, 5000, 5000, 5000, 5000, 5000];
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function addYear()
    {
        if (count($this->year_flows) < 100) {
            $this->year_flows[] = 5000;
        } else {
            $this->js("alert('Only 100 Fields are Allowed')");
        }
    }

    public function removeYear($index)
    {
        unset($this->year_flows[$index]);
        $this->year_flows = array_values($this->year_flows);
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->initial = 10000;
        $this->discount = 10;
        $this->year_flows = [5000, 5000, 5000, 5000, 5000, 5000];

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
            'initial' => $this->initial,
            'discount' => $this->discount,
            'year' => $this->year_flows,
        ];

        $model = new Finance();
        $result = $model->npv($request);

        if (empty($result['error'])) {
            $result['chartData'] = $result['dataPoints'];
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

            // Dispatch event for Highcharts update
            $this->dispatch('chart-updated', $result['dataPoints']);

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
            $this->error = $result['error'];
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

        return view('livewire.calculators.npv-calculator');
    }
}
