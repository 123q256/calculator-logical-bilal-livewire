<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class DunkCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $hoopType = '8';
    public $height = 243.84;
    public $height_unit = 'cm';
    public $mass = 243;
    public $mass_unit = 'kg';
    public $acceleration = 40;
    public $acceleration_unit = 'm/s²';
    public $palm_size = 40;
    public $palm_size_unit = 'cm';
    public $standing = 40;
    public $standing_unit = 'cm';

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

    public function updatedHoopType($value)
    {
        if ($value === "7") {
            $this->height = "213.36";
        } else if ($value === "8") {
            $this->height = "243.84";
        } else if ($value === "9") {
            $this->height = "274.3";
        } else if ($value === "10") {
            $this->height = "304.8";
        } else if ($value === "custom") {
            $this->height = "";
        }
        $this->updated('height');
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
        $this->reset(['hoopType', 'height', 'height_unit', 'mass', 'mass_unit', 'acceleration', 'acceleration_unit', 'palm_size', 'palm_size_unit', 'standing', 'standing_unit', 'detail', 'error']);

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
            'height' => $this->height,
            'height_unit' => $this->height_unit,
            'mass' => $this->mass,
            'mass_unit' => $this->mass_unit,
            'acceleration' => $this->acceleration,
            'acceleration_unit' => $this->acceleration_unit,
            'palm_size' => $this->palm_size,
            'palm_size_unit' => $this->palm_size_unit,
            'standing' => $this->standing,
            'standing_unit' => $this->standing_unit,
        ];

        $model = new EverydayLife();
        $result = $model->dunk((object)$requestData);

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
        return view('livewire.calculators.dunk-calculator');
    }
}
