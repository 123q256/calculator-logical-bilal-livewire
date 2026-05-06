<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class TeslaChargingCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $main_unit = 'Full Capacity Charging Cost';
    public $battery = '3';
    public $electricity = '4';
    public $type_ev = '1'; // renamed to avoid conflict with $type
    public $price = '4';
    public $distance = '4';
    public $units = 'km';
    public $currancy = '$';

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        $this->currancy = session('currancy', '$');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                $targetKey = ($key === 'type') ? 'type_ev' : $key;
                if (property_exists($this, $targetKey)) {
                    $this->$targetKey = $value;
                }
            }
        }

        // Standard keys for inc.button
        $this->lang['calculate'] = $this->lang['calculate'] ?? ($this->lang['calculate_btn'] ?? 'Calculate');
        $this->lang['reset'] = $this->lang['reset'] ?? ($this->lang['reset_btn'] ?? 'Reset');
    }

    public function resetForm()
    {
        $this->reset(['main_unit', 'battery', 'electricity', 'type_ev', 'price', 'distance', 'units', 'detail', 'error']);
        
        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'main_unit' => $this->main_unit,
            'battery' => $this->battery,
            'electricity' => $this->electricity,
            'type' => $this->type_ev,
            'price' => $this->price,
            'distance' => $this->distance,
            'units' => $this->units,
        ];

        $model = new EverydayLife();
        $result = $model->tesla((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Generate chart data (percentage vs cost)
            $chartData = [];
            for ($i = 0; $i <= 100; $i += 5) {
                $chartData[] = [$i, round($result['cost'] * ($i / 100), 2)];
            }
            $result['chartData'] = json_encode($chartData);
            
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->dispatch('chart-updated', chartData: $chartData, cost: $result['cost']);
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
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
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.tesla-charging-calculator');
    }
}
