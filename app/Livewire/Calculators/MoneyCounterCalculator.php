<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Finance;

class MoneyCounterCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$'; // Base currency symbol for generic use

    // Form fields
    public $currency = 'INR';
    public $checkbox1 = true;
    public $checkbox2 = true;
    public $checkbox3 = false;
    
    public $bank_notes = [];
    public $coins = [];
    public $rolls = [];

    protected $currency_info = [
        'USD' => [
            'notes' => ['$ 1', '$ 2', '$ 5', '$ 10', '$ 20', '$ 50', '$ 100'],
            'coins' => ['1 ¢', '5 ¢', '10 ¢', '25 ¢', '50 ¢', '$ 1'],
            'rolls' => ['1 ¢', '5 ¢', '10 ¢', '25 ¢', '50 ¢', '$ 1'],
            'symbol' => '$'
        ],
        'EUR' => [
            'notes' => ['€ 5', '€ 10', '€ 20', '€ 50', '€ 100', '€ 200', '€ 500'],
            'coins' => ['1 c', '2 c', '5 c', '10 c', '20 c', '50 c', '€ 1', '€ 2'],
            'rolls' => ['1 c', '2 c', '5 c', '10 c', '20 c', '50 c', '€ 1', '€ 2'],
            'symbol' => '€'
        ],
        'JPY' => [
            'notes' => ['¥ 1000', '¥ 2000', '¥ 5000', '¥ 10000'],
            'coins' => ['¥ 1', '¥ 5', '¥ 10', '¥ 50', '¥ 100', '¥ 500'],
            'rolls' => ['¥ 1', '¥ 5', '¥ 10', '¥ 50', '¥ 100', '¥ 500'],
            'symbol' => '¥'
        ],
        'GBP' => [
            'notes' => ['£ 5', '£ 10', '£ 20', '£ 50'],
            'coins' => ['1 p', '2 p', '5 p', '10 p', '20 p', '50 p', '£ 1', '£ 2'],
            'rolls' => ['1 p', '2 p', '5 p', '10 p', '20 p', '50 p', '£ 1', '£ 2'],
            'symbol' => '£'
        ],
        'AUD' => [
            'notes' => ['$ 5', '$ 10', '$ 20', '$ 50', '$ 100'],
            'coins' => ['5 c', '10 c', '20 c', '50 c', '$ 1', '$ 2'],
            'rolls' => ['5 c', '10 c', '20 c', '50 c', '$ 1', '$ 2'],
            'symbol' => '$'
        ],
        'CAD' => [
            'notes' => ['$ 1', '$ 5', '$ 10', '$ 20', '$ 50', '$ 100'],
            'coins' => ['1 ¢', '5 ¢', '10 ¢', '25 ¢', '50 ¢', '$ 1', '$ 2'],
            'rolls' => ['1 ¢', '5 ¢', '10 ¢', '25 ¢', '50 ¢', '$ 1', '$ 2'],
            'symbol' => '$'
        ],
        'CHF' => [
            'notes' => ['fr 10', 'fr 20', 'fr 50', 'fr 100', 'fr 200', 'fr 1000'],
            'coins' => ['5 c', '10 c', '20 c', 'fr ½', 'fr 1', 'fr 2', 'fr 5'],
            'rolls' => ['5 c', '10 c', '20 c', 'fr ½', 'fr 1', 'fr 2', 'fr 5'],
            'symbol' => 'fr'
        ],
        'SEK' => [
            'notes' => ['kr 20', 'kr 50', 'kr 100', 'kr 200', 'kr 500', 'kr 1000'],
            'coins' => ['kr 1', 'kr 2', 'kr 5', 'kr 10'],
            'rolls' => ['kr 1', 'kr 2', 'kr 5', 'kr 10'],
            'symbol' => 'kr'
        ],
        'MXN' => [
            'notes' => ['$ 20', '$ 50', '$ 100', '$ 200', '$ 500', '$ 1000'],
            'coins' => ['5 ¢', '10 ¢', '20 ¢', '50 ¢', '$ 1', '$ 2', '$ 5', '$ 10', '$ 20'],
            'rolls' => [],
            'symbol' => '$'
        ],
        'NZD' => [
            'notes' => ['$ 10', '$ 20', '$ 50', '$ 100'],
            'coins' => ['10 c', '20 c', '50 c', '$ 1', '$ 2'],
            'rolls' => ['10 c', '20 c', '50 c', '$ 1', '$ 2'],
            'symbol' => '$'
        ],
        'INR' => [
            'notes' => ['₹ 2', '₹ 5', '₹ 10', '₹ 20', '₹ 50', '₹ 100', '₹ 200', '₹ 500', '₹ 2000'],
            'coins' => ['50 paise', '₹ 1', '₹ 2', '₹ 5', '₹ 10', '₹ 20'],
            'rolls' => ['50 paise', '₹ 1', '₹ 2', '₹ 5', '₹ 10', '₹ 20'],
            'symbol' => '₹'
        ],
        'PHP' => [
            'notes' => ['₱ 20', '₱ 50', '₱ 100', '₱ 200', '₱ 500', '₱ 1000'],
            'coins' => ['1 ¢', '5 ¢', '10 ¢', '25 ¢', '₱ 1', '₱ 5', '₱ 10', '₱ 20'],
            'rolls' => [],
            'symbol' => '₱'
        ],
    ];

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        // The parent view might pass $currancy but we manage it dynamically based on selection
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->currency = $inputs->currency ?? 'INR';
            $this->checkbox1 = $inputs->checkbox1 ?? true;
            $this->checkbox2 = $inputs->checkbox2 ?? true;
            $this->checkbox3 = $inputs->checkbox3 ?? false;
            $this->bank_notes = (array)($inputs->bank_notes ?? []);
            $this->coins = (array)($inputs->coins ?? []);
            $this->rolls = (array)($inputs->rolls ?? []);
        } else {
            $this->initArrays();
        }
    }

    protected function initArrays()
    {
        // Default values based on user image:
        // Notes: 1, 3, 5, 7, 9, 11, 13, 15, 17
        // Coins: 2, 4, 6, 8, 9, 10, 12, 14, 16
        // Rolls: 1, 2, 3, 4, 5, 6, 7, 8, 9

        $this->bank_notes = [1, 3, 5, 7, 9, 11, 13, 15, 17, ''];
        $this->coins = [2, 4, 6, 8, 9, 10, 12, 14, 16, ''];
        $this->rolls = [1, 2, 3, 4, 5, 6, 7, 8, 9, ''];
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        // Reset to default values
        $this->currency = 'INR';
        $this->checkbox1 = true;
        $this->checkbox2 = true;
        $this->checkbox3 = false;
        
        $this->initArrays();

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
        if ($propertyName === 'currency') {
            $this->initArrays();
        }
    }

    public function calculate()
    {
        $request = (object)[
            'currency' => $this->currency,
            'checkbox1' => $this->checkbox1,
            'checkbox2' => $this->checkbox2,
            'checkbox3' => $this->checkbox3,
            'bank_notes' => $this->bank_notes,
            'coins' => $this->coins,
            'rolls' => $this->rolls,
        ];

        $model = new Finance();
        $result = $model->money($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function getLabelsProperty()
    {
        return $this->currency_info[$this->currency] ?? $this->currency_info['INR'];
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
        return view('livewire.calculators.money-counter-calculator', [
            'labels' => $this->labels
        ]);
    }
}
