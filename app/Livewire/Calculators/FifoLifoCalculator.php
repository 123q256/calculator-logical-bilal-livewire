<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class FifoLifoCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $purchases = [];
    public $unit_sold = 35;
    public $method = 'FIFO';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->purchases = $inputs['purchases'] ?? [];
            $this->unit_sold = $inputs['unit_sold'] ?? 35;
            $this->method = $inputs['method'] ?? 'FIFO';
        } else {
            $this->purchases = [
                ['units' => 10, 'price' => 150],
                ['units' => 15, 'price' => 100],
                ['units' => 25, 'price' => 200],
                ['units' => '', 'price' => ''],
            ];
        }
    }

    public function addRow()
    {
        $this->purchases[] = ['units' => '', 'price' => ''];
        $this->updated();
    }

    public function addMultipleRows($count)
    {
        for ($j = 0; $j < $count; $j++) {
            $this->purchases[] = ['units' => '', 'price' => ''];
        }
        $this->updated();
    }

    public function removeRow($index)
    {
        unset($this->purchases[$index]);
        $this->purchases = array_values($this->purchases);
        $this->updated();
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->purchases = [
            ['units' => 10, 'price' => 150],
            ['units' => 15, 'price' => 100],
            ['units' => 25, 'price' => 200],
            ['units' => '', 'price' => ''],
        ];
        $this->unit_sold = 35;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        session()->flash('scroll_to_top', true);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result', 'scroll_to_top']);
    }

    public function calculate($method)
    {
        $this->method = $method;
        $this->error = null;
        session()->forget('scroll_to_top');

        $validPurchases = [];
        $totalUnitsAvailable = 0;
        $totalCOGP = 0;

        foreach ($this->purchases as $p) {
            if (is_numeric($p['units']) && is_numeric($p['price'])) {
                $units = floatval($p['units']);
                $price = floatval($p['price']);
                $validPurchases[] = [
                    'units' => $units,
                    'price' => $price,
                    'cogp' => $units * $price
                ];
                $totalUnitsAvailable += $units;
                $totalCOGP += ($units * $price);
            }
        }

        if (empty($validPurchases)) {
            $this->error = "Please enter at least one valid purchase.";
            return;
        }

        if (!is_numeric($this->unit_sold)) {
            $this->error = "Please enter valid units sold.";
            return;
        }

        $unitsToSell = floatval($this->unit_sold);
        if ($unitsToSell > $totalUnitsAvailable) {
            $this->error = "Total Unit Sold must be less than or equal to Total Units Available ($totalUnitsAvailable).";
            return;
        }

        $calcPurchases = $validPurchases;
        if ($method === 'LIFO') {
            $calcPurchases = array_reverse($calcPurchases);
        }

        $cogs = 0;
        $tempUnitsSold = $unitsToSell;
        $tableRows = [];

        foreach ($calcPurchases as $index => $p) {
            $soldFromThis = 0;
            if ($tempUnitsSold > 0) {
                if ($tempUnitsSold >= $p['units']) {
                    $soldFromThis = $p['units'];
                } else {
                    $soldFromThis = $tempUnitsSold;
                }
                $tempUnitsSold -= $soldFromThis;
            }

            $cogs += ($soldFromThis * $p['price']);
            $remaining = $p['units'] - $soldFromThis;

            $tableRows[] = [
                'sr' => $index + 1,
                'units' => $p['units'],
                'price' => $p['price'],
                'cogp' => $p['cogp'],
                'sold' => $soldFromThis,
                'remaining' => $remaining,
                'cogs' => $soldFromThis * $p['price'],
                'iv' => $remaining * $p['price']
            ];
        }

        $result = [
            'RESULT' => 1,
            'cogp' => $totalCOGP,
            'cogs' => $cogs,
            'ending' => $totalCOGP - $cogs,
            'total_units' => $totalUnitsAvailable,
            'total_sold' => $unitsToSell,
            'rows' => $tableRows,
            'method' => $method
        ];

        $this->detail = $result;
        session()->flash('calculator_result', $result);
        session()->flash('calculator_back_inputs', [
            'purchases' => $this->purchases,
            'unit_sold' => $this->unit_sold,
            'method' => $this->method
        ]);
        session()->flash('scroll_to_result', true);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
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

        if (session('scroll_to_top')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('input-form');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.fifo-lifo-calculator');
    }
}
