<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class PooledVarianceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $calc_type = 'equal'; // type in request
    public $ronding = 4;
    public $option = 'sum';
    public $s1 = 2;
    public $s2 = 5;
    public $n1 = 2;
    public $n2 = 4;
    public $g1 = "1, 2, 3, 4, 5";
    public $g2 = "2, 2, 3, 2, 2";

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calc_type = $inputs->type ?? 'equal';
            $this->ronding = $inputs->ronding ?? 4;
            $this->option = $inputs->option ?? 'sum';
            $this->s1 = $inputs->s1 ?? 2;
            $this->s2 = $inputs->s2 ?? 5;
            $this->n1 = $inputs->n1 ?? 2;
            $this->n2 = $inputs->n2 ?? 4;
            $this->g1 = $inputs->g1 ?? $this->g1;
            $this->g2 = $inputs->g2 ?? $this->g2;
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
        $this->calc_type = 'equal';
        $this->ronding = 4;
        $this->option = 'sum';
        $this->s1 = 2;
        $this->s2 = 5;
        $this->n1 = 2;
        $this->n2 = 4;
        $this->g1 = "1, 2, 3, 4, 5";
        $this->g2 = "2, 2, 3, 2, 2";

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'type'    => $this->calc_type,
            'ronding' => $this->ronding,
            'option'  => $this->option,
            's1'      => $this->s1,
            's2'      => $this->s2,
            'n1'      => $this->n1,
            'n2'      => $this->n2,
            'g1'      => $this->g1,
            'g2'      => $this->g2,
        ];

        $model = new Statistics();
        $result = $model->pooled($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->js('if (typeof MJrerender === "function") { MJrerender(); }');
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
        return view('livewire.calculators.pooled-variance-calculator');
    }
}
