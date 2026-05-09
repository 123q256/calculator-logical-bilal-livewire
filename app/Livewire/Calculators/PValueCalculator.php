<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class PValueCalculator extends Component
{
    public $with = 'z';
    public $tail = '2';
    public $score = '0.02';
    public $deg = '3';
    public $deg2 = '3';
    public $degree_freedom = '12';
    public $level = '.05';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated()
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->with = $inputs->with ?? 'z';
            $this->tail = $inputs->tail ?? '2';
            $this->score = $inputs->score ?? '0.02';
            $this->deg = $inputs->deg ?? '3';
            $this->deg2 = $inputs->deg2 ?? '3';
            $this->degree_freedom = $inputs->degree_freedom ?? '12';
            $this->level = $inputs->level ?? '.05';
        }
    }

    public function resetForm()
    {
        $this->with = 'z';
        $this->tail = '2';
        $this->score = '0.02';
        $this->deg = '3';
        $this->deg2 = '3';
        $this->degree_freedom = '12';
        $this->level = '.05';

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
            'with' => $this->with,
            'tail' => $this->tail,
            'score' => $this->score,
            'deg' => $this->deg,
            'deg2' => $this->deg2,
            'degree_freedom' => $this->degree_freedom,
            'level' => $this->level,
        ];

        $model = new Statistics();
        $result = $model->p($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
            
            $this->detail = $result;
            if ($this->with == 'q') {
                $this->dispatch('tukey-calculate');
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.p-value-calculator');
    }
}
