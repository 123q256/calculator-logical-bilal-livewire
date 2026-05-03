<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class PropertyDepreciationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $basis = 21000;
    public $recovery = 5;
    public $round = 'yes';
    public $date1;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->date1 = date('Y-m-d');
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->basis = $inputs->basis ?? 21000;
            $this->recovery = $inputs->recovery ?? 5;
            $this->round = $inputs->round ?? 'yes';
            $this->date1 = $inputs->date1 ?? date('Y-m-d');
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->basis = 21000;
        $this->recovery = 5;
        $this->round = 'yes';
        $this->date1 = date('Y-m-d');

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
            'basis' => $this->basis,
            'recovery' => $this->recovery,
            'round' => strtolower($this->round), // Ensure lowercase for model
            'date1' => $this->date1,
            'hiddent_currency' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->property($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Prepare chart data for Alpine.js
            $years = explode(',', trim($result['total_years'], ','));
            $bookValues = explode(',', trim($result['total_book_value'], ','));
            
            // Sync rounding with chart data
            $precision = (strtolower($this->round) === 'yes') ? 0 : 2;
            $bookValues = array_map(function($val) use ($precision) {
                return round((float)$val, $precision);
            }, $bookValues);

            $result['chartData'] = json_encode([
                'categories' => $years,
                'bookValues' => $bookValues,
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

        return view('livewire.calculators.property-depreciation-calculator');
    }
}
