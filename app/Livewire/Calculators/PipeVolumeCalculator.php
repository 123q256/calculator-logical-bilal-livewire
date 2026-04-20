<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;
use Illuminate\Http\Request;

class PipeVolumeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $inner_diameter = 9;
    public $inner_diameter_unit = 'cm';
    public $length = 12;
    public $length_unit = 'cm';
    public $density = 12;
    public $density_unit = 'kg/m³';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        // Restore state if the page was reloaded (Legacy mode)
        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }
        if (session()->has('validation_error')) {
            $this->error = session('validation_error');
        }
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->inner_diameter = $inputs->inner_diameter ?? $this->inner_diameter;
            $this->inner_diameter_unit = $inputs->inner_diameter_unit ?? $this->inner_diameter_unit;
            $this->length = $inputs->length ?? $this->length;
            $this->length_unit = $inputs->length_unit ?? $this->length_unit;
            $this->density = $inputs->density ?? $this->density;
            $this->density_unit = $inputs->density_unit ?? $this->density_unit;
        }
    }

    public function calculate()
    {
        $request = (object)[
            'inner_diameter' => $this->inner_diameter,
            'inner_diameter_unit' => $this->inner_diameter_unit,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'density' => $this->density,
            'density_unit' => $this->density_unit,
        ];

        $model = new Construction();
        $result = $model->pipe($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        $this->reset(['inner_diameter', 'inner_diameter_unit', 'length', 'length_unit', 'density', 'density_unit', 'error', 'detail']);
       
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'validation_error', 'scroll_to_result', 'calculator_back_inputs']);
            return redirect()->to(url()->previous() ?? '/');
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
        return view('livewire.calculators.pipe-volume-calculator');
    }
}
