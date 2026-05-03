<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class CarDepreciationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $car_cost = 21000;
    public $c_age = 5;
    public $car_year = 4;
    public $rate_level = '3';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->car_cost = $inputs->car_cost ?? 21000;
            $this->c_age = $inputs->c_age ?? 5;
            $this->car_year = $inputs->car_year ?? 4;
            $this->rate_level = $inputs->rate_level ?? '3';
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->car_cost = 21000;
        $this->c_age = 5;
        $this->car_year = 4;
        $this->rate_level = '3';

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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'car_cost' => $this->car_cost,
            'c_age' => $this->c_age,
            'car_year' => $this->car_year,
            'rate_level' => $this->rate_level,
            'hiddent_currency' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->car_dep($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Prepare chart data for Alpine.js
            $years = explode(',', trim($result['total_years'], ','));
            $bookValues = explode(',', trim($result['total_book_value'], ','));
            
            $result['chartData'] = json_encode([
                'categories' => $years,
                'bookValues' => array_map('floatval', $bookValues),
            ]);

            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
             $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
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

        return view('livewire.calculators.car-depreciation-calculator');
    }
}
