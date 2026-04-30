<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class OrbitalPeriodCalculator extends Component
{
    public $density = 10;
    public $density_unit = 'kg/m³';
    public $Semi = 10;
    public $Semi_unit = 'km';
    public $first = 10;
    public $first_unit = 'kg';
    public $second = 10;
    public $second_unit = 'kg';

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
            $this->density = $inputs->density ?? 10;
            $this->density_unit = $inputs->density_unit ?? 'kg/m³';
            $this->Semi = $inputs->Semi ?? 10;
            $this->Semi_unit = $inputs->Semi_unit ?? 'km';
            $this->first = $inputs->first ?? 10;
            $this->first_unit = $inputs->first_unit ?? 'kg';
            $this->second = $inputs->second ?? 10;
            $this->second_unit = $inputs->second_unit ?? 'kg';
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

        $this->density = 10;
        $this->density_unit = 'kg/m³';
        $this->Semi = 10;
        $this->Semi_unit = 'km';
        $this->first = 10;
        $this->first_unit = 'kg';
        $this->second = 10;
        $this->second_unit = 'kg';

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
            'density'      => (float)$this->density,
            'density_unit' => $this->density_unit,
            'Semi'         => (float)$this->Semi,
            'Semi_unit'    => $this->Semi_unit,
            'first'        => (float)$this->first,
            'first_unit'   => $this->first_unit,
            'second'       => (float)$this->second,
            'second_unit'  => $this->second_unit,
        ];

        $model = new Physics();
        $result = $model->orbital($request);

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
            $this->error = $result['error'] ?? 'Something went wrong.';
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
        return view('livewire.calculators.orbital-period-calculator');
    }
}
