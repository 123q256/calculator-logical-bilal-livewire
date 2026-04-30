<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class AngleOfRefractionCalculator extends Component
{
    public $calculation = 'from2';
    public $medium1 = 'vacuum';
    public $n1 = 1;
    public $medium2 = 'air';
    public $n2 = 1.000293;
    public $angle_first = 5;
    public $angle_f_unit = 'deg';
    public $angle_second = 5;
    public $angle_s_unit = 'deg';

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
            $this->calculation = $inputs->calculation ?? 'from2';
            $this->medium1 = $inputs->medium1 ?? 'vacuum';
            $this->n1 = $inputs->n1 ?? 1;
            $this->medium2 = $inputs->medium2 ?? 'air';
            $this->n2 = $inputs->n2 ?? 1.000293;
            $this->angle_first = $inputs->angle_first ?? 5;
            $this->angle_f_unit = $inputs->angle_f_unit ?? 'deg';
            $this->angle_second = $inputs->angle_second ?? 5;
            $this->angle_s_unit = $inputs->angle_s_unit ?? 'deg';
        }
    }

    public function updatedMedium1($value)
    {
        $this->n1 = $this->getMediumIndex($value);
        $this->detail = null;
    }

    public function updatedMedium2($value)
    {
        $this->n2 = $this->getMediumIndex($value);
        $this->detail = null;
    }

    private function getMediumIndex($medium)
    {
        $indices = [
            'vacuum'  => 1,
            'air'     => 1.000293,
            'water'   => 1.333,
            'ethanol' => 1.36,
            'ice'     => 1.31,
            'acrylic' => 1.49,
            'window'  => 1.52,
            'diamond' => 2.419,
            'custom'  => null,
        ];
        return $indices[$medium] ?? 1;
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

    public function updated($propertyName)
    {
        if (strpos($propertyName, 'dropdowns') === false) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->calculation = 'from2';
        $this->medium1 = 'vacuum';
        $this->n1 = 1;
        $this->medium2 = 'air';
        $this->n2 = 1.000293;
        $this->angle_first = 5;
        $this->angle_f_unit = 'deg';
        $this->angle_second = 5;
        $this->angle_s_unit = 'deg';

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
            'calculation'  => $this->calculation,
            'medium1'      => $this->medium1,
            'n1'           => (float)$this->n1,
            'medium2'      => $this->medium2,
            'n2'           => (float)$this->n2,
            'angle_first'  => (float)$this->angle_first,
            'angle_f_unit' => $this->angle_f_unit,
            'angle_second' => (float)$this->angle_second,
            'angle_s_unit' => $this->angle_s_unit,
        ];

        $model = new Physics();
        $result = $model->angle_refraction($request);

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
        return view('livewire.calculators.angle-of-refraction-calculator');
  
    }
}
