<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class MarginalCostCalculator extends Component
{
    public $unit_type = 'sr';
    
    // SR mode
    public $dc = 50;
    public $dq = 40;
    public $dq_unit = 'units';
    
    // GR mode
    public $cc = 50;
    public $fc = 50;
    public $cq = 30;
    public $cq_unit = 'units';
    public $fq = 20;
    public $fq_unit = 'units';
    
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
        $this->currancy = $currancy;

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->unit_type = $inputs->unit_type ?? $this->unit_type;
            $this->dc = $inputs->dc ?? $this->dc;
            $this->dq = $inputs->dq ?? $this->dq;
            $this->dq_unit = $inputs->dq_unit ?? $this->dq_unit;
            $this->cc = $inputs->cc ?? $this->cc;
            $this->fc = $inputs->fc ?? $this->fc;
            $this->cq = $inputs->cq ?? $this->cq;
            $this->cq_unit = $inputs->cq_unit ?? $this->cq_unit;
            $this->fq = $inputs->fq ?? $this->fq;
            $this->fq_unit = $inputs->fq_unit ?? $this->fq_unit;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function setUnitType($type)
    {
        $this->unit_type = $type;
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
          $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->unit_type = 'sr';
        $this->dc = 50;
        $this->dq = 40;
        $this->dq_unit = 'units';
        $this->cc = 50;
        $this->fc = 50;
        $this->cq = 30;
        $this->cq_unit = 'units';
        $this->fq = 20;
        $this->fq_unit = 'units';
        
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
        $requestData = [
            'unit_type' => $this->unit_type,
            'dc' => $this->dc,
            'dq' => $this->dq,
            'dq_unit' => $this->dq_unit,
            'cc' => $this->cc,
            'fc' => $this->fc,
            'cq' => $this->cq,
            'cq_unit' => $this->cq_unit,
            'fq' => $this->fq,
            'fq_unit' => $this->fq_unit,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->marginal($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Prepare chart data for Highcharts
            $result['chartData'] = json_encode([
                ['name' => $this->lang[19] ?? 'Total Cost', 'y' => (float)$result['dc']],
                ['name' => $this->lang[13] ?? 'Marginal Cost', 'y' => (float)$result['mc']]
            ]);

            $this->detail = $result;
            $this->error = null;
            
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->dispatch('chart-updated', $result['chartData']);

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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.marginal-cost-calculator');
    }
}
