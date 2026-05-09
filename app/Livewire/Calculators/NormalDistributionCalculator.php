<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class NormalDistributionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $operations = '4'; // Default to Normal Distribution
    public $find_compare = '1'; 
    public $f_first = '0.95';
    public $f_second = '0';
    public $f_third = '1';
    public $mean = '100';
    public $deviation = '15';
    public $a = '110';
    public $b = '';
    public $c = '';
    public $d = '';
    public $e1 = '';
    public $e2 = '';
    public $f = '';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->operations = $inputs->operations ?? '4';
            $this->find_compare = $inputs->find_compare ?? '1';
            $this->f_first = $inputs->f_first ?? '0.95';
            $this->f_second = $inputs->f_second ?? '0';
            $this->f_third = $inputs->f_third ?? '1';
            $this->mean = $inputs->mean ?? '100';
            $this->deviation = $inputs->deviation ?? '15';
            $this->a = $inputs->a ?? '110';
            $this->b = $inputs->b ?? '';
            $this->c = $inputs->c ?? '';
            $this->d = $inputs->d ?? '';
            $this->e1 = $inputs->e1 ?? '';
            $this->e2 = $inputs->e2 ?? '';
            $this->f = $inputs->f ?? '';
        }

        if (!$this->detail && !$this->error) {
            // $this->calculate(); // Removed to prevent result showing on reload
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
        $this->operations = '4';
        $this->find_compare = '1';
        $this->f_first = '0.95';
        $this->f_second = '0';
        $this->f_third = '1';
        $this->mean = '100';
        $this->deviation = '15';
        $this->a = '110';
        $this->b = '';
        $this->c = '';
        $this->d = '';
        $this->e1 = '';
        $this->e2 = '';
        $this->f = '';

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'operations'   => $this->operations,
            'find_compare' => $this->find_compare,
            'f_first'      => $this->f_first,
            'f_second'     => $this->f_second,
            'f_third'      => $this->f_third,
            'mean'         => $this->mean,
            'deviation'    => $this->deviation,
            'a'            => $this->a,
            'b'            => $this->b,
            'c'            => $this->c,
            'd'            => $this->d,
            'e1'           => $this->e1,
            'e2'           => $this->e2,
            'f'            => $this->f,
        ];

        $model = new Statistics();
        $result = $model->normal($request);

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
        return view('livewire.calculators.normal-distribution-calculator');
    }
}
