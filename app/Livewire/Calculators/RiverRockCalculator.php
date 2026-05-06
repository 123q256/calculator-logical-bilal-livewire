<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class RiverRockCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $rock_type = '1430';
    public $density = '1430';
    public $density_unit = 't/m³';
    public $length = 12;
    public $length_unit = 'cm';
    public $width = 12;
    public $width_unit = 'cm';
    public $depth = 12;
    public $depth_unit = 'cm';
    public $wastage = 5;
    public $price = 12;
    public $price_unit = '';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->price_unit = $this->currancy . '/lb';
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->rock_type = $inputs->rock_type ?? '1430';
            $this->density = $inputs->density ?? '1430';
            $this->density_unit = $inputs->density_unit ?? 't/m³';
            $this->length = $inputs->length ?? 12;
            $this->length_unit = $inputs->length_unit ?? 'cm';
            $this->width = $inputs->width ?? 12;
            $this->width_unit = $inputs->width_unit ?? 'cm';
            $this->depth = $inputs->depth ?? 12;
            $this->depth_unit = $inputs->depth_unit ?? 'cm';
            $this->wastage = $inputs->wastage ?? 5;
            $this->price = $inputs->price ?? 12;
            $this->price_unit = $inputs->price_unit ?? ($this->currancy . '/lb');
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'rock_type') {
            if ($this->rock_type !== 'custom') {
                $this->density = $this->rock_type;
            }
        }

        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->rock_type = '1430';
        $this->density = '1430';
        $this->density_unit = 't/m³';
        $this->length = 12;
        $this->length_unit = 'cm';
        $this->width = 12;
        $this->width_unit = 'cm';
        $this->depth = 12;
        $this->depth_unit = 'cm';
        $this->wastage = 5;
        $this->price = 12;
        $this->price_unit = $this->currancy . '/lb';

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
            'rock_type'    => $this->rock_type,
            'density'      => $this->density,
            'density_unit' => $this->density_unit,
            'length'       => $this->length,
            'length_unit'  => $this->length_unit,
            'width'        => $this->width,
            'width_unit'   => $this->width_unit,
            'depth'        => $this->depth,
            'depth_unit'   => $this->depth_unit,
            'wastage'      => $this->wastage,
            'price'        => $this->price,
            'price_unit'   => $this->price_unit,
            'currancy'     => $this->currancy,
        ];

        $model = new EverydayLife();
        $result = $model->river((object)$requestData);
        
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
        return view('livewire.calculators.river-rock-calculator');
    }
}
