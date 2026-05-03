<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class DepreciationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $method = 'Straight';
    public $asset = 15000;
    public $salvage = 2500;
    public $year = 5;
    public $u_of_p = 1200;
    public $round = 'yes';
    public $conver = '0';
    public $date;
    public $Factor = 4;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->date = date('Y-m-d');
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->method = $inputs->method ?? 'Straight';
            $this->asset = $inputs->asset ?? 15000;
            $this->salvage = $inputs->salvage ?? 2500;
            $this->year = $inputs->year ?? 5;
            $this->u_of_p = $inputs->u_of_p ?? 1200;
            $this->round = $inputs->round ?? 'yes';
            $this->conver = $inputs->conver ?? '0';
            $this->date = $inputs->date ?? date('Y-m-d');
            $this->Factor = $inputs->Factor ?? 4;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->method = 'Straight';
        $this->asset = 15000;
        $this->salvage = 2500;
        $this->year = 5;
        $this->u_of_p = 1200;
        $this->round = 'yes';
        $this->conver = '0';
        $this->date = date('Y-m-d');
        $this->Factor = 4;

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
            'method' => $this->method,
            'asset' => $this->asset,
            'salvage' => $this->salvage,
            'year' => $this->year,
            'u_of_p' => $this->u_of_p,
            'round' => $this->round,
            'conver' => $this->conver,
            'date' => $this->date,
            'Factor' => $this->Factor,
            'hiddent_currency' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->depreciation($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Prepare chart data for Alpine.js only if data exists
            if (!empty($result['total_years'])) {
                $years = explode(',', trim($result['total_years'] ?? '', ','));
                $bookValues = explode(',', trim($result['book_des'] ?? '', ','));
                $depAmounts = explode(',', trim($result['des'] ?? '', ','));
                
                $result['chartData'] = json_encode([
                    'categories' => $years,
                    'bookValues' => array_map('floatval', $bookValues),
                    'depAmounts' => array_map('floatval', $depAmounts),
                ]);
            } else {
                $result['chartData'] = json_encode(['categories' => [], 'bookValues' => [], 'depAmounts' => []]);
            }

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

        return view('livewire.calculators.depreciation-calculator');
    }
}
