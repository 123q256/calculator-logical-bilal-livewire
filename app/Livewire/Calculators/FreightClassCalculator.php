<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class FreightClassCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';
    public $showDropdown = null;

    public function toggleDropdown($dropdownName)
    {
        $this->showDropdown = ($this->showDropdown === $dropdownName) ? null : $dropdownName;
    }

    public function setUnit($unitName, $value)
    {
        if (property_exists($this, $unitName)) {
            $this->$unitName = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
    }

    public $length = '12';
    public $length_unit = 'cm';
    public $width = '12';
    public $width_unit = 'cm';
    public $height = '146';
    public $height_unit = 'cm';
    public $weight = '146';
    public $weight_unit = 'cm';
    public $pq = '1';
    public $fr = '146';
    public $fr_unit = '$/lb';

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

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
        $this->reset([
            'length', 'length_unit',
            'width', 'width_unit',
            'height', 'height_unit',
            'weight', 'weight_unit',
            'pq',
            'fr', 'fr_unit',
            'detail', 'error'
        ]);

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
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'width' => $this->width,
            'width_unit' => $this->width_unit,
            'height' => $this->height,
            'height_unit' => $this->height_unit,
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit,
            'pq' => $this->pq,
            'fr' => $this->fr,
            'fr_unit' => $this->fr_unit,
            'currancy' => $this->currancy,
            'submit' => true,
        ];

        $model = new EverydayLife();
        $result = $model->freight((object)$requestData);

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
            $this->detail = null;
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
        return view('livewire.calculators.freight-class-calculator');
    }
}
