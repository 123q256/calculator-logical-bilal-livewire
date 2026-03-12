<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class SalaryCalculator extends Component
{
    public $error;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $calName;
    public $calLink;
    public $currancy = '$'; // Fixed typo if intended, or following existing naming

    // Form inputs with default values
    public $salary = '15';
    public $per = 'Hourly';
    public $hours = '40';
    public $days = '5';
    public $holidays = '12';
    public $vacation = '15';
    public $are = '1';
    public $tax = '';

    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null, $currancy = '$')
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        
        // Restore input state from session
        if (session()->has('calculator_back_inputs')) {
            $backInputs = session('calculator_back_inputs');
            foreach ($backInputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function resetForm(): void
    {
        $this->reset([
            'error', 'detail', 'salary', 'per', 'hours', 'days', 'holidays', 'vacation', 'are', 'tax'
        ]);
        $this->resetErrorBag();
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error']);
    }

    public function calculate()
    {
        $requestData = [
            'salary'   => $this->salary,
            'per'      => $this->per,
            'hours'    => $this->hours,
            'days'     => $this->days,
            'holidays' => $this->holidays,
            'vacation' => $this->vacation,
            'are'      => $this->are,
            'tax'      => $this->tax,
        ];

        // Compatibility with Finance model for 'Annual'
        if ($this->per === 'Annual') {
            $requestData['Annual'] = true;
        }

        $request = (object)$requestData;

        $model  = new \App\Models\Finance();
        $result = $model->salary($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $requestData);
             $this->error = null;
             $this->detail = $result;
             $this->js(<<<'JS'
                $nextTick(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const top = el.getBoundingClientRect().top + window.scrollY - 50;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                });
            JS);
                return;
            // return redirect()->to(url()->previous() ?? '/');
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
    }

    public function render()
    {
        return view('livewire.calculators.salary-calculator');
    }
}
