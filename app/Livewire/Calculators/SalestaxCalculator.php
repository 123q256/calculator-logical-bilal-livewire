<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class SalestaxCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form properties
    public $amount = '30';
    public $method = 'add';
    public $vat = '30';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->amount = '30';
        $this->method = 'add';
        $this->vat = '30';

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
        $requestData = [
            'amount' => $this->amount,
            'method' => $this->method,
            'vat'    => $this->vat,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->salestax($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            
            // Prepare chart data for Alpine.js
            $netPrice = $this->method == 'add' ? (float)$this->amount : (float)$result['netBill'];
            $vatAmount = (float)$result['vatAmount'];
            $result['chartData'] = json_encode([
                ['Net Price', $netPrice],
                ['Sale Tax', $vatAmount]
            ]);

            $this->detail = $result;
            $this->error = null;

            $this->dispatch('chart-updated', $result['chartData']);

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $requestData);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
        $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        if (session('scroll_to_result') || $this->detail) {
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
        return view('livewire.calculators.salestax-calculator');
    }
}
