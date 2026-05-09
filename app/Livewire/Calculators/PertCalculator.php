<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class PertCalculator extends Component
{
    public $optimistic = '5';
    public $optimistic_one = '9';
    public $optimistic_sec = '7';
    public $optimistic_unit = 'days';

    public $pessimistic = '9';
    public $pessimistic_one = '8';
    public $pessimistic_sec = '6';
    public $pessimistic_unit = 'days';

    public $most = '7';
    public $most_one = '9';
    public $most_sec = '7';
    public $most_unit = 'days';

    public $desired = '7';
    public $desired_one = '9';
    public $desired_sec = '7';
    public $desired_unit = 'days';

    public $output_unit = 'days';
    public $deviation_unit = 'days';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
        $this->dispatch('math-updated');
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->optimistic = $inputs->optimistic ?? '5';
            $this->optimistic_one = $inputs->optimistic_one ?? '9';
            $this->optimistic_sec = $inputs->optimistic_sec ?? '7';
            $this->optimistic_unit = $inputs->optimistic_unit ?? 'days';

            $this->pessimistic = $inputs->pessimistic ?? '9';
            $this->pessimistic_one = $inputs->pessimistic_one ?? '8';
            $this->pessimistic_sec = $inputs->pessimistic_sec ?? '6';
            $this->pessimistic_unit = $inputs->pessimistic_unit ?? 'days';

            $this->most = $inputs->most ?? '7';
            $this->most_one = $inputs->most_one ?? '9';
            $this->most_sec = $inputs->most_sec ?? '7';
            $this->most_unit = $inputs->most_unit ?? 'days';

            $this->desired = $inputs->desired ?? '7';
            $this->desired_one = $inputs->desired_one ?? '9';
            $this->desired_sec = $inputs->desired_sec ?? '7';
            $this->desired_unit = $inputs->desired_unit ?? 'days';

            $this->output_unit = $inputs->output_unit ?? 'days';
            $this->deviation_unit = $inputs->deviation_unit ?? 'days';
        }
    }

    public function resetForm()
    {
        $this->optimistic = '5'; $this->optimistic_one = '9'; $this->optimistic_sec = '7'; $this->optimistic_unit = 'days';
        $this->pessimistic = '9'; $this->pessimistic_one = '8'; $this->pessimistic_sec = '6'; $this->pessimistic_unit = 'days';
        $this->most = '7'; $this->most_one = '9'; $this->most_sec = '7'; $this->most_unit = 'days';
        $this->desired = '7'; $this->desired_one = '9'; $this->desired_sec = '7'; $this->desired_unit = 'days';
        $this->output_unit = 'days'; $this->deviation_unit = 'days';
        
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        $this->dispatch('math-updated');

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'optimistic' => $this->optimistic,
            'optimistic_one' => $this->optimistic_one,
            'optimistic_sec' => $this->optimistic_sec,
            'optimistic_unit' => $this->optimistic_unit,
            'pessimistic' => $this->pessimistic,
            'pessimistic_one' => $this->pessimistic_one,
            'pessimistic_sec' => $this->pessimistic_sec,
            'pessimistic_unit' => $this->pessimistic_unit,
            'most' => $this->most,
            'most_one' => $this->most_one,
            'most_sec' => $this->most_sec,
            'most_unit' => $this->most_unit,
            'desired' => $this->desired,
            'desired_one' => $this->desired_one,
            'desired_sec' => $this->desired_sec,
            'desired_unit' => $this->desired_unit,
            'output_unit' => $this->output_unit,
            'deviation_unit' => $this->deviation_unit,
        ];

        $model = new Statistics();
        $result = $model->pert($request);

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
        $this->dispatch('math-updated');
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
        return view('livewire.calculators.pert-calculator');
    }
}
