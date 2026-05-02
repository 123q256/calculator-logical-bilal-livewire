<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;
use DateTime;

class MacrsDepreciationCalculator extends Component
{
    public $basic = 700000;
    public $percent = 90;
    public $sal = 90;
    public $method = '200';
    public $ads_ = '2.5';
    public $period = '3';
    public $conver = '3';
    public $date;
    public $round = 'yes';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->date = date('Y-m-d');

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->basic = $inputs->basic ?? 700000;
            $this->percent = $inputs->percent ?? 90;
            $this->sal = $inputs->sal ?? 90;
            $this->method = $inputs->method ?? '200';
            $this->ads_ = $inputs->ads_ ?? '2.5';
            $this->period = $inputs->period ?? '3';
            $this->conver = $inputs->conver ?? '3';
            $this->date = $inputs->date ?? date('Y-m-d');
            $this->round = $inputs->round ?? 'yes';
        }
    }

    public function resetForm()
    {
        $this->reset(['basic', 'percent', 'sal', 'method', 'ads_', 'period', 'conver', 'date', 'round', 'detail', 'error']);
        $this->basic = 700000;
        $this->percent = 90;
        $this->sal = 90;
        $this->method = '200';
        $this->ads_ = '2.5';
        $this->period = '3';
        $this->conver = '3';
        $this->date = date('Y-m-d');
        $this->round = 'yes';

        session()->forget([
            'calculator_result',
            'calculator_back_inputs',
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
            'basic' => $this->basic,
            'percent' => $this->percent,
            'sal' => $this->sal,
            'method' => $this->method,
            'ads_' => $this->ads_,
            'period' => $this->period,
            'conver' => $this->conver,
            'date' => $this->date,
            'round' => $this->round,
            'mycurrancy' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->macrs($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Convert comma-separated strings to [x, y] pairs for Highcharts
            $years = array_filter(explode(',', $result['total_years'] ?? ''));
            $evs = array_filter(explode(',', $result['total_ev'] ?? ''));
            
            $chartData = [];
            foreach (array_values($years) as $i => $year) {
                if (isset($evs[$i])) {
                    $chartData[] = [(int)$year, (float)$evs[$i]];
                }
            }
            
            $result['chartData'] = json_encode($chartData);

            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            $this->dispatch('chartUpdated', data: $chartData);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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

        return view('livewire.calculators.macrs-depreciation-calculator');
    }
}
