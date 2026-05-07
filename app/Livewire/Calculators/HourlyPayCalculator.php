<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class HourlyPayCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';
    public $result_key = 1;

    // Form inputs
    public $paytype = '52';
    public $status = 'single';
    
    public $paidRows = [
        ['type' => 'hourly', 'working' => '8', 'wage' => '15', 'grosspay' => 'per_year']
    ];

    public $overtimeRows = [
        ['type' => 'overtime', 'hours' => '', 'wage' => '']
    ];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->paytype = $inputs['paytype'] ?? '52';
            $this->status = $inputs['status'] ?? 'single';
            $this->paidRows = $inputs['paidRows'] ?? $this->paidRows;
            $this->overtimeRows = $inputs['overtimeRows'] ?? $this->overtimeRows;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function addPaidRow()
    {
        if (count($this->paidRows) < 20) {
            $this->paidRows[] = ['type' => 'hourly', 'working' => '8', 'wage' => '15', 'grosspay' => 'per_year'];
        } else {
            $this->error = 'Max Limit Reached';
        }
    }

    public function removePaidRow($index)
    {
        if (count($this->paidRows) > 1) {
            unset($this->paidRows[$index]);
            $this->paidRows = array_values($this->paidRows);
        }
    }

    public function addOvertimeRow()
    {
        if (count($this->overtimeRows) < 20) {
            $this->overtimeRows[] = ['type' => 'overtime', 'hours' => '', 'wage' => ''];
        } else {
            $this->error = 'Max Limit Reached';
        }
    }

    public function removeOvertimeRow($index)
    {
        if (count($this->overtimeRows) > 1) {
            unset($this->overtimeRows[$index]);
            $this->overtimeRows = array_values($this->overtimeRows);
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->paidRows = [['type' => 'hourly', 'working' => '8', 'wage' => '15', 'grosspay' => 'per_year']];
        $this->overtimeRows = [['type' => 'overtime', 'hours' => '', 'wage' => '']];
        $this->paytype = '52';
        $this->status = 'single';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $this->result_key++;
        $this->detail = null;
        $this->error = null;
        $paidtype = [];
        $working = [];
        $grosspay = [];
        $wage = [];
        $overtimeType = [];
        $h_over = [];
        $w_over = [];

        foreach ($this->paidRows as $row) {
            $paidtype[] = $row['type'];
            $working[] = $row['working'];
            $grosspay[] = $row['grosspay'];
            $wage[] = $row['wage'];
        }

        foreach ($this->overtimeRows as $row) {
            $overtimeType[] = $row['type'];
            $h_over[] = $row['hours'];
            $w_over[] = $row['wage'];
        }

        $request = (object)[
            'paytype' => $this->paytype,
            'status' => $this->status,
            'paidtype' => $paidtype,
            'working' => $working,
            'grosspay' => $grosspay,
            'wage' => $wage,
            'overtimeType' => $overtimeType,
            'h_over' => $h_over,
            'w_over' => $w_over,
        ];

        $model = new EverydayLife();
        $result = $model->hourly_pay($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Prepare Chart Data (Matching Semester Grade Pattern)
            $chartData = [
                ['name' => 'Take Home', 'y' => (float)$result['take_home']],
                ['name' => 'Taxes', 'y' => (float)$result['total_tax']],
            ];

            $result['chartData'] = $chartData;
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'paytype' => $this->paytype,
                'status' => $this->status,
                'paidRows' => $this->paidRows,
                'overtimeRows' => $this->overtimeRows,
            ]);

            $this->dispatch('hourly-chart-updated', $chartData);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
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
        return view('livewire.calculators.hourly-pay-calculator');
    }
}
