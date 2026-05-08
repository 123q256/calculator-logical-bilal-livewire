<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class EmpiricalRuleCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $form = 'summary';
    public $mean = '105';
    public $deviation = '25';
    public $type_r = '2';
    public $x = '12,43,11,2,33,76,12';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'form', 'mean', 'deviation', 'type_r', 'x']);
        $this->form = 'summary';
        $this->mean = '105';
        $this->deviation = '25';
        $this->type_r = '2';
        $this->x = '12,43,11,2,33,76,12';

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
            'form'      => $this->form,
            'mean'      => $this->mean,
            'deviation' => $this->deviation,
            'type_r'    => $this->type_r,
            'x'         => $this->x,
        ];

        $model = new Statistics();
        $result = $model->empirical($request);
        
        if (empty($result['error'])) {
            // Calculate bell curve points for Highcharts
            $points = [];
            $mean = $result['mean'];
            $stdDev = $result['devi'];
            if ($stdDev > 0) {
                $step = $stdDev / 10;
                for ($x = $mean - 4 * $stdDev; $x <= $mean + 4 * $stdDev; $x += $step) {
                    $y = (1 / ($stdDev * sqrt(2 * M_PI))) * exp(-0.5 * pow(($x - $mean) / $stdDev, 2));
                    $points[] = [round($x, 2), round($y, 4)];
                }
            }
            $result['chartData'] = $points;

            $result['RESULT'] = 1;
            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('render-graph', { detail: %s }));
                }, 400);
            JS, json_encode($this->detail)));
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result') && env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            $this->js(sprintf(<<<'JS'
                $nextTick(() => {
                    window.dispatchEvent(new CustomEvent('render-graph', { detail: %s }));
                });
            JS, json_encode($this->detail)));
        }
        return view('livewire.calculators.empirical-rule-calculator');
    }
}
