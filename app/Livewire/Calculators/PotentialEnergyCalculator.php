<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class PotentialEnergyCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $cal = 'pe';
    public $mass = '50';
    public $mass_unit = 'kg';
    public $gravity = '9.80665';
    public $gravity_unit = 'm_s2';
    public $height = '5';
    public $height_unit = 'm';
    public $pe = '50';
    public $pe_unit = 'j';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session()->pull('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session()->pull('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function toggleDropdown($id)
    {
        $this->openDropdown = ($this->openDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        $this->openDropdown = null;
    }

    public function calculate()
    {
        $requestData = [
            'cal' => $this->cal,
            'mass' => $this->mass,
            'mass_unit' => $this->mass_unit,
            'gravity' => $this->gravity,
            'gravity_unit' => $this->gravity_unit,
            'height' => $this->height,
            'height_unit' => $this->height_unit,
            'pe' => $this->pe,
            'pe_unit' => $this->pe_unit,
        ];

        $model = new Physics();
        $result = $model->potential((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->error = null;
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
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->cal = 'pe';
        $this->mass = '50';
        $this->mass_unit = 'kg';
        $this->gravity = '9.80665';
        $this->height = '5';
        $this->pe = '50';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['cal', 'mass', 'mass_unit', 'gravity', 'gravity_unit', 'height', 'height_unit', 'pe', 'pe_unit'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function render()
    {
        if (session()->pull('scroll_to_result')) {
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

        return view('livewire.calculators.potential-energy-calculator');
    }
}
