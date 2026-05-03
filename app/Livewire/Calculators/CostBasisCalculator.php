<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Finance;

class CostBasisCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form fields
    public $stock = 200;
    public $shares = [15, 15];
    public $prices = [15, 15];

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->stock = $inputs->stock ?? 200;
            $this->shares = (array)($inputs->shares ?? [15, 15]);
            $this->prices = (array)($inputs->prices ?? [15, 15]);
        }
    }

    public function addRow()
    {
        if (count($this->shares) < 100) {
            $this->shares[] = 15;
            $this->prices[] = 15;
        }
    }

    public function removeRow($index)
    {
        if (count($this->shares) > 2) {
            unset($this->shares[$index]);
            unset($this->prices[$index]);
            $this->shares = array_values($this->shares);
            $this->prices = array_values($this->prices);
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->stock = 200;
        $this->shares = [15, 15];
        $this->prices = [15, 15];

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
    }

    public function calculate()
    {
        $request = (object)[
            'stock'  => $this->stock,
            'shares' => $this->shares,
            'prices' => $this->prices,
        ];

        $model = new Finance();
        $result = $model->cost_basis($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
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
        return view('livewire.calculators.cost-basis-calculator');
    }
}
