<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class WattCalculator extends Component
{
    public $resistance;
    public $resistance_unit = 'Ω';
    public $current;
    public $current_unit = 'A';
    public $voltage;
    public $voltage_unit = 'V';
    public $power;
    public $power_unit = 'W';

    public $dropdowns = [];

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->resistance = $inputs->resistance ?? '';
            $this->resistance_unit = $inputs->resistance_unit ?? 'Ω';
            $this->current = $inputs->current ?? '';
            $this->current_unit = $inputs->current_unit ?? 'A';
            $this->voltage = $inputs->voltage ?? '';
            $this->voltage_unit = $inputs->voltage_unit ?? 'V';
            $this->power = $inputs->power ?? '';
            $this->power_unit = $inputs->power_unit ?? 'W';
        }
    }

    public function updated($propertyName)
    {
        if (strpos($propertyName, 'dropdowns') === false) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($id)
    {
        $this->dropdowns[$id] = !($this->dropdowns[$id] ?? false);
    }

    public function setUnit($property, $unit, $dropdownId = null)
    {
        $this->{$property} = $unit;
        if ($dropdownId) {
            $this->dropdowns[$dropdownId] = false;
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->resistance = '';
        $this->resistance_unit = 'Ω';
        $this->current = '';
        $this->current_unit = 'A';
        $this->voltage = '';
        $this->voltage_unit = 'V';
        $this->power = '';
        $this->power_unit = 'W';

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
        $request = (object)[
            'resistance'      => $this->resistance,
            'resistance_unit' => $this->resistance_unit,
            'current'         => $this->current,
            'current_unit'    => $this->current_unit,
            'voltage'         => $this->voltage,
            'voltage_unit'    => $this->voltage_unit,
            'power'           => $this->power,
            'power_unit'      => $this->power_unit,
        ];

        $model = new Physics();
        $result = $model->watt($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

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
            $this->error = $result['error'] ?? 'Please check your inputs. You must fill at least two fields.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
        }
    }


   public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.watt-calculator');
    }
}
