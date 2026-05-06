<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class FabricCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $fabric = 150;
    public $fabric_unit = 'cm';
    public $width = 40;
    public $width_unit = 'cm';
    public $length = 50;
    public $length_unit = 'cm';
    public $piece = 4;
    public $unit = 'm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->fabric = $inputs->fabric ?? 150;
            $this->fabric_unit = $inputs->fabric_unit ?? 'cm';
            $this->width = $inputs->width ?? 40;
            $this->width_unit = $inputs->width_unit ?? 'cm';
            $this->length = $inputs->length ?? 50;
            $this->length_unit = $inputs->length_unit ?? 'cm';
            $this->piece = $inputs->piece ?? 4;
            $this->unit = $inputs->unit ?? 'm';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->fabric = 150;
        $this->fabric_unit = 'cm';
        $this->width = 40;
        $this->width_unit = 'cm';
        $this->length = 50;
        $this->length_unit = 'cm';
        $this->piece = 4;
        $this->unit = 'm';
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
            'fabric'      => $this->fabric,
            'fabric_unit' => $this->fabric_unit,
            'width'       => $this->width,
            'width_unit'  => $this->width_unit,
            'length'      => $this->length,
            'length_unit' => $this->length_unit,
            'piece'       => $this->piece,
            'unit'        => $this->unit,
        ];

        $model = new EverydayLife();
        $result = $model->fabric($request);

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
        return view('livewire.calculators.fabric-calculator');
    }
}
