<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class TonnageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $material = '1476';
    public $unit_weight = '1476';
    public $length = 12;
    public $length_units = 'm';
    public $width = 12;
    public $width_units = 'm';
    public $depth = 12;
    public $depth_units = 'm';
    public $price_per = 12;
    public $price_per_units = 'kg';
    public $wastage = 4;

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

    public function updatedMaterial($value)
    {
        $this->unit_weight = $value;
        $this->updated('unit_weight');
    }

    public function setUnit($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
        $this->updated($name);
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function resetForm()
    {
        $this->reset(['material', 'unit_weight', 'length', 'length_units', 'width', 'width_units', 'depth', 'depth_units', 'price_per', 'price_per_units', 'wastage', 'detail', 'error']);

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
            'unit_weight' => $this->unit_weight,
            'length' => $this->length,
            'length_units' => $this->length_units,
            'width' => $this->width,
            'width_units' => $this->width_units,
            'depth' => $this->depth,
            'depth_units' => $this->depth_units,
            'price_per' => $this->price_per,
            'price_per_units' => $this->price_per_units,
            'wastage' => $this->wastage,
        ];

        $model = new EverydayLife();
        $result = $model->tonnage((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        return view('livewire.calculators.tonnage-calculator');
    }
}
