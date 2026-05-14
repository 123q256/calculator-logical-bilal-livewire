<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class ProstateVolumeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $length = 3;
    public $length_unit = 'cm';
    public $width = 3;
    public $width_unit = 'cm';
    public $height = 3;
    public $height_unit = 'cm';
    public $psa = '';

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

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['length', 'length_unit', 'width', 'width_unit', 'height', 'height_unit', 'psa'])) {
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->length = 3;
        $this->length_unit = 'cm';
        $this->width = 3;
        $this->width_unit = 'cm';
        $this->height = 3;
        $this->height_unit = 'cm';
        $this->psa = '';

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
        if (!is_numeric($this->length) || !is_numeric($this->width) || !is_numeric($this->height)) {
            $this->error = 'Please enter valid numbers for dimensions.';
            return;
        }

        $request = (object)[
            'length'      => $this->length,
            'length_unit' => $this->length_unit,
            'width'       => $this->width,
            'width_unit'  => $this->width_unit,
            'height'      => $this->height,
            'height_unit' => $this->height_unit,
            'psa'         => $this->psa,
        ];

        $model = new Health();
        $result = $model->prostate($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.prostate-volume-calculator');
    }
}
