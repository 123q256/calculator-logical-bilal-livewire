<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class SampleDistributionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $mean = 0.5;
    public $deviation = 1.5;
    public $size = 65;
    public $probability = 'two_tailed';
    public $x1 = 0.2;
    public $x2 = 0.8;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->mean = $inputs->mean ?? 0.5;
            $this->deviation = $inputs->deviation ?? 1.5;
            $this->size = $inputs->size ?? 65;
            $this->probability = $inputs->probability ?? 'two_tailed';
            $this->x1 = $inputs->x1 ?? 0.2;
            $this->x2 = $inputs->x2 ?? 0.8;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->mean = 0.5;
        $this->deviation = 1.5;
        $this->size = 65;
        $this->probability = 'two_tailed';
        $this->x1 = 0.2;
        $this->x2 = 0.8;

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'mean'        => $this->mean,
            'deviation'   => $this->deviation,
            'size'        => $this->size,
            'probability' => $this->probability,
            'x1'          => $this->x1,
            'x2'          => $this->x2,
        ];

        $model = new Statistics();
        $result = $model->sample($request);

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
            $this->dispatch('chart-updated', [
                'chartData' => $result['chartData'],
                'chartData2' => $result['chartData2'],
                'probability' => $this->probability
            ]);
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
        return view('livewire.calculators.sample-distribution-calculator');
    }
}
