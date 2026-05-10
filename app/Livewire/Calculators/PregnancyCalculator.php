<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class PregnancyCalculator extends Component
{
    public $method = 'Last';
    public $date;
    public $cycle = 28;
    public $ivf = '3-day embryo';
    public $week = 21;
    public $days = 5;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->date = date('Y-m-d');
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->method = $inputs->method ?? 'Last';
            $this->date = $inputs->date ?? date('Y-m-d');
            $this->cycle = $inputs->cycle ?? 28;
            $this->ivf = $inputs->ivf ?? '3-day embryo';
            $this->week = $inputs->week ?? 21;
            $this->days = $inputs->days ?? 5;
        }
    }

    public function resetForm()
    {
        $this->method = 'Last';
        $this->date = date('Y-m-d');
        $this->cycle = 28;
        $this->ivf = '3-day embryo';
        $this->week = 21;
        $this->days = 5;
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        $this->dispatch('reset-calculator');
    }

    public function calculate()
    {
        // Handle the typo in the model if necessary
        $calcMethod = $this->method;
        if ($calcMethod === 'Ultrasound') {
            $calcMethod = 'Ulrasound'; // Match the typo in Health.php:19466
        }

        $request = (object)[
            'method' => $calcMethod,
            'date'   => $this->date,
            'cycle'  => $this->cycle,
            'ivf'    => $this->ivf,
            'week'   => $this->week,
            'days'   => $this->days,
        ];

        $model = new Health();
        $result = $model->pregnancy($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('render-graph', { detail: %s }));
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 400);
            JS, json_encode($this->detail)));
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('render-graph', { detail: %s }));
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 400);
            JS, json_encode($this->detail)));
        }
        return view('livewire.calculators.pregnancy-calculator');
    }
}
