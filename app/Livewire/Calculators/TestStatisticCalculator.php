<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class TestStatisticCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $test_radio = 'data'; // data, sem, sd
    public $row_data = "78\n82\n86\n85\n73\n82";
    public $row_data1 = "69\n50\n34\n18\n66\n55";
    
    // Group 1 (SEM)
    public $mean = 100;
    public $sem = 3;
    public $n = 5;
    
    // Group 2 (SEM)
    public $mean1 = 50;
    public $sem1 = 30;
    public $n1 = 17;
    
    // Group 1 (SD)
    public $mean_sec = 100;
    public $sd_sec = 3;
    public $n_sec = 5;
    
    // Group 2 (SD)
    public $mean_sec1 = 50;
    public $sd_sec1 = 30;
    public $n_sec2 = 17;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->test_radio = $inputs->test_radio ?? 'data';
            $this->row_data = $inputs->row_data ?? $this->row_data;
            $this->row_data1 = $inputs->row_data1 ?? $this->row_data1;
            $this->mean = $inputs->mean ?? $this->mean;
            $this->sem = $inputs->sem ?? $this->sem;
            $this->n = $inputs->n ?? $this->n;
            $this->mean1 = $inputs->mean1 ?? $this->mean1;
            $this->sem1 = $inputs->sem1 ?? $this->sem1;
            $this->n1 = $inputs->n1 ?? $this->n1;
            $this->mean_sec = $inputs->mean_sec ?? $this->mean_sec;
            $this->sd_sec = $inputs->sd_sec ?? $this->sd_sec;
            $this->n_sec = $inputs->n_sec ?? $this->n_sec;
            $this->mean_sec1 = $inputs->mean_sec1 ?? $this->mean_sec1;
            $this->sd_sec1 = $inputs->sd_sec1 ?? $this->sd_sec1;
            $this->n_sec2 = $inputs->n_sec2 ?? $this->n_sec2;
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
        $this->test_radio = 'data';
        $this->row_data = "78\n82\n86\n85\n73\n82";
        $this->row_data1 = "69\n50\n34\n18\n66\n55";
        $this->mean = 100; $this->sem = 3; $this->n = 5;
        $this->mean1 = 50; $this->sem1 = 30; $this->n1 = 17;
        $this->mean_sec = 100; $this->sd_sec = 3; $this->n_sec = 5;
        $this->mean_sec1 = 50; $this->sd_sec1 = 30; $this->n_sec2 = 17;

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'test_radio' => $this->test_radio,
            'row_data'   => $this->row_data,
            'row_data1'  => $this->row_data1,
            'mean'       => $this->mean,
            'sem'        => $this->sem,
            'n'          => $this->n,
            'mean1'      => $this->mean1,
            'sem1'       => $this->sem1,
            'n1'         => $this->n1,
            'mean_sec'   => $this->mean_sec,
            'sd_sec'     => $this->sd_sec,
            'n_sec'      => $this->n_sec,
            'mean_sec1'  => $this->mean_sec1,
            'sd_sec1'    => $this->sd_sec1,
            'n_sec2'     => $this->n_sec2,
        ];

        $model = new Statistics();
        $result = $model->test($request);

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
        return view('livewire.calculators.test-statistic-calculator');
    }
}
