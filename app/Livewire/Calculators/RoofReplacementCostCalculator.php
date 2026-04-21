<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class RoofReplacementCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $size1 = '46';
    public $size2 = '44';
    public $slop = 'seven';
    public $difficulty = 'Medium';
    public $existing = 'yes';
    public $floor = '2';
    public $material = '1';
    public $region = 'na';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
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

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'size1', 'size2', 'slop', 'difficulty', 'existing', 'floor', 'material', 'region']);
        $this->resetErrorBag();

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
        $request = (object)[
            'size1'      => $this->size1,
            'size2'      => $this->size2,
            'slop'       => $this->slop,
            'difficulty' => $this->difficulty,
            'existing'   => $this->existing,
            'floor'      => $this->floor,
            'material'   => $this->material,
            'region'     => $this->region,
        ];

        $model = new Construction();
        $result = $model->roof_replacement($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (array)$request);
                return redirect()->to(url()->previous() ?? '/');
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.roof-replacement-cost-calculator');
    }
}
