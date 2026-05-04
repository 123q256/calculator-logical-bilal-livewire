<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class CagrCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Tab tracking
    public $unit_type = 'one';

    // Inputs Tab 1
    public $starting_first = 100;
    public $ending_first = 1000;
    public $years_first = 3;
    public $months_first = 0;
    public $days_first = 0;

    // Inputs Tab 2
    public $starting_sec = 100;
    public $ending_sec = 1000;
    public $start_date;
    public $ending_date;

    // Inputs Tab 3
    public $starting_third = 100;
    public $cagr = 10;
    public $years_third = 3;
    public $months_third = 0;
    public $days_third = 0;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->start_date = date('Y-m-d');
        $this->ending_date = date('Y-m-d', strtotime('+7 days'));

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->unit_type = 'one';
        $this->starting_first = 100;
        $this->ending_first = 1000;
        $this->years_first = 3;
        $this->months_first = 0;
        $this->days_first = 0;

        $this->starting_sec = 100;
        $this->ending_sec = 1000;
        $this->start_date = date('Y-m-d');
        $this->ending_date = date('Y-m-d', strtotime('+7 days'));

        $this->starting_third = 100;
        $this->cagr = 10;
        $this->years_third = 3;
        $this->months_third = 0;
        $this->days_third = 0;

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
        $requestData = [
            'unit_type'      => $this->unit_type,
            'starting_first' => $this->starting_first,
            'ending_first'   => $this->ending_first,
            'years_first'    => $this->years_first,
            'months_first'   => $this->months_first,
            'days_first'     => $this->days_first,
            'starting_sec'   => $this->starting_sec,
            'ending_sec'     => $this->ending_sec,
            'start_date'     => $this->start_date,
            'ending_date'    => $this->ending_date,
            'starting_third' => $this->starting_third,
            'cagr'           => $this->cagr,
            'years_third'    => $this->years_third,
            'months_third'   => $this->months_third,
            'days_third'     => $this->days_third,
        ];

        $model = new Finance();
        $result = $model->cagr((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            // Calculate Data Points for Chart
            $dataPoints = [];
            if ($this->unit_type === 'one') {
                $val = $this->starting_first;
                $rate = $result['cagr_percentage'] / 100;
                $yrs = $result['table_year'];
            } elseif ($this->unit_type === 'two') {
                $val = $this->starting_sec;
                $rate = $result['cagr_percentage'] / 100;
                $yrs = $result['table_year'];
            } else {
                $val = $this->starting_third;
                $rate = $this->cagr / 100;
                $yrs = $this->years_third + ($this->months_third / 12) + ($this->days_third / 365);
            }

            for ($i = 0; $i <= ceil($yrs); $i++) {
                $dataPoints[] = [(int)$i, (float)round($val, 2)];
                $val += ($i < floor($yrs)) ? ($val * $rate) : (($val * $rate) * ($yrs - floor($yrs)));
            }
            $this->detail['dataPoints'] = $dataPoints;
            $this->detail['chartData'] = json_encode($dataPoints);

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $this->detail);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->dispatch('chart-updated', data: $dataPoints);
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
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
        return view('livewire.calculators.cagr-calculator');
    }
}
