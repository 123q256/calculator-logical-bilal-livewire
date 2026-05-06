<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class MoistureContentCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $wet = 12;
    public $wet_unit = 'mg';
    public $dry = 1.5;
    public $dry_unit = 'mg';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->wet = $inputs->wet ?? 12;
            $this->wet_unit = $inputs->wet_unit ?? 'mg';
            $this->dry = $inputs->dry ?? 1.5;
            $this->dry_unit = $inputs->dry_unit ?? 'mg';
        }
    }

    public function toggleDropdown($id)
    {
        $this->showDropdown = ($this->showDropdown === $id) ? null : $id;
    }

    public function setUnit($type, $unit)
    {
        $property = $type . '_unit';
        if (property_exists($this, $property)) {
            $this->$property = $unit;
        }
        $this->showDropdown = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->wet = 12;
        $this->wet_unit = 'mg';
        $this->dry = 1.5;
        $this->dry_unit = 'mg';

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
            'wet'      => $this->wet,
            'wet_unit' => $this->wet_unit,
            'dry'      => $this->dry,
            'dry_unit' => $this->dry_unit,
        ];

        $model = new EverydayLife();
        $result = $model->moisture((object)$requestData);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (object)$requestData);
                $this->error = null;

                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
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
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
        }
        return view('livewire.calculators.moisture-content-calculator');
    }
}
