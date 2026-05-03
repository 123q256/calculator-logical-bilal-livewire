<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class StockCalculator extends Component
{
    public $first = 15;
    public $second = 500;
    public $third = 5;
    public $t_unit = '%';
    public $four = 500;
    public $five = 5;
    public $f_unit = '%';
    public $cgt = 6;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = (!empty($currancy) && $currancy !== '$') ? $currancy : ($currancy ?: '$');
        
        // Final fallback if still empty
        if (empty($this->currancy)) {
            $this->currancy = '$';
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->first = $inputs->first ?? $this->first;
            $this->second = $inputs->second ?? $this->second;
            $this->third = $inputs->third ?? $this->third;
            $this->t_unit = $inputs->t_unit ?? $this->t_unit;
            $this->four = $inputs->four ?? $this->four;
            $this->five = $inputs->five ?? $this->five;
            $this->f_unit = $inputs->f_unit ?? $this->f_unit;
            $this->cgt = $inputs->cgt ?? $this->cgt;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['t_unit', 'f_unit'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->first = 15;
        $this->second = 500;
        $this->third = 5;
        $this->t_unit = '%';
        $this->four = 500;
        $this->five = 5;
        $this->f_unit = '%';
        $this->cgt = 6;

        $this->error = null;
        $this->detail = null;

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

    public function calculate()
    {
        // Map units manually to avoid model comparison errors
        $t_unit_mapped = trim($this->t_unit) === '%' ? '1' : '0.01';
        $f_unit_mapped = trim($this->f_unit) === '%' ? '1' : '0.01';

        $requestData = [
            'first' => (float)$this->first,
            'second' => (float)$this->second,
            'third' => (float)$this->third,
            't_unit' => $t_unit_mapped,
            'four' => (float)$this->four,
            'five' => (float)$this->five,
            'f_unit' => $f_unit_mapped,
            'cgt' => (float)$this->cgt,
            'mycurrency' => trim($this->currancy),
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->stock($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            // Clean numbers aggressively for the chart (remove everything except numbers, dots, and minus signs)
            $cleanNetBuy = preg_replace('/[^0-9.-]/', '', $result['netby_ans']);
            $cleanNetSell = preg_replace('/[^0-9.-]/', '', $result['netsa_ans']);

            $this->dispatch('calculator-calculated', [
                'netBuy' => (float)$cleanNetBuy,
                'netSell' => (float)$cleanNetSell
            ]);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
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
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.stock-calculator');
    }
}
