<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class DegreesOfFreedomCalculator extends Component
{
    public $selection = '1';
    public $sample_size = '2';
    public $sample_size_one = '5';
    public $sample_size_two = '4';
    public $variance_one = '6';
    public $variance_two = '3';
    public $c1 = '7';
    public $r1 = '2';
    public $k1 = '1.5';
    public $d1 = '2.5';
    public $d2 = '2.7';
    public $h = '7';
    public $sample_mean = '3';
    public $standard_deviation_three = '5';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
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
            $this->selection = $inputs->selection ?? '1';
            $this->sample_size = $inputs->sample_size ?? '2';
            $this->sample_size_one = $inputs->sample_size_one ?? '5';
            $this->sample_size_two = $inputs->sample_size_two ?? '4';
            $this->variance_one = $inputs->variance_one ?? '6';
            $this->variance_two = $inputs->variance_two ?? '3';
            $this->c1 = $inputs->c1 ?? '7';
            $this->r1 = $inputs->r1 ?? '2';
            $this->k1 = $inputs->k1 ?? '1.5';
            $this->d1 = $inputs->d1 ?? '2.5';
            $this->d2 = $inputs->d2 ?? '2.7';
            $this->h = $inputs->h ?? '7';
            $this->sample_mean = $inputs->sample_mean ?? '3';
            $this->standard_deviation_three = $inputs->standard_deviation_three ?? '5';
        }
    }

    public function resetForm()
    {
        $this->selection = '1';
        $this->sample_size = '2';
        $this->sample_size_one = '5';
        $this->sample_size_two = '4';
        $this->variance_one = '6';
        $this->variance_two = '3';
        $this->c1 = '7';
        $this->r1 = '2';
        $this->k1 = '1.5';
        $this->d1 = '2.5';
        $this->d2 = '2.7';
        $this->h = '7';
        $this->sample_mean = '3';
        $this->standard_deviation_three = '5';
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
            'selection' => $this->selection,
            'sample_size' => $this->sample_size,
            'sample_size_one' => $this->sample_size_one,
            'sample_size_two' => $this->sample_size_two,
            'variance_one' => $this->variance_one,
            'variance_two' => $this->variance_two,
            'c1' => $this->c1,
            'r1' => $this->r1,
            'k1' => $this->k1,
            'd1' => $this->d1,
            'd2' => $this->d2,
            'h' => $this->h,
            'sample_mean' => $this->sample_mean,
            'standard_deviation_three' => $this->standard_deviation_three,
        ];

        $model = new Statistics();
        $result = $model->degrees($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
        return view('livewire.calculators.degrees-of-freedom-calculator');
    }
}
