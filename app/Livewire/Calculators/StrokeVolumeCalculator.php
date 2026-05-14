<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class StrokeVolumeCalculator extends Component
{
    public $Cardiac = '10';
    public $Cardiac_unit = '/min l';
    public $heart = '20';
    public $height_ft = '10';
    public $height_in = '10';
    public $unit_ft_in = 'mm';
    public $height_cm = '24';
    public $unit_h_cm = 'mm';
    public $weight = '20';
    public $weight_unit = 'kg';
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
            $inputs = (object)session('calculator_back_inputs');
            $this->Cardiac = $inputs->Cardiac ?? $this->Cardiac;
            $this->Cardiac_unit = $inputs->Cardiac_unit ?? $this->Cardiac_unit;
            $this->heart = $inputs->heart ?? $this->heart;
            $this->height_ft = $inputs->height_ft ?? $this->height_ft;
            $this->height_in = $inputs->height_in ?? $this->height_in;
            $this->unit_ft_in = $inputs->unit_ft_in ?? $this->unit_ft_in;
            $this->height_cm = $inputs->height_cm ?? $this->height_cm;
            $this->unit_h_cm = $inputs->unit_h_cm ?? $this->unit_h_cm;
            $this->weight = $inputs->weight ?? $this->weight;
            $this->weight_unit = $inputs->weight_unit ?? $this->weight_unit;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->Cardiac = '10';
        $this->Cardiac_unit = '/min l';
        $this->heart = '20';
        $this->height_ft = '10';
        $this->height_in = '10';
        $this->unit_ft_in = 'mm';
        $this->height_cm = '24';
        $this->unit_h_cm = 'mm';
        $this->weight = '20';
        $this->weight_unit = 'kg';
        $this->error = null;
        $this->detail = null;

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
        $request = (object)[
            'Cardiac'      => $this->Cardiac,
            'Cardiac_unit' => $this->Cardiac_unit,
            'heart'        => $this->heart,
            'height_ft'    => $this->height_ft,
            'height_in'    => $this->height_in,
            'unit_ft_in'   => $this->unit_ft_in,
            'height_cm'    => $this->height_cm,
            'unit_h_cm'    => $this->unit_h_cm,
            'weight'       => $this->weight,
            'weight_unit'  => $this->weight_unit,
        ];

        $model = new Health();
        $result = $model->stroke($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.stroke-volume-calculator');
    }
}
