<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class WaistToHipRatioCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $gender = 'male';
    public $w = '12';
    public $h = '40';
    public $unit = 'in';
    public $unit1 = 'in';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->gender = $inputs->gender ?? $this->gender;
            $this->w = $inputs->w ?? $this->w;
            $this->h = $inputs->h ?? $this->h;
            $this->unit = $inputs->unit ?? $this->unit;
            $this->unit1 = $inputs->unit1 ?? $this->unit1;
        }
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->gender = 'male';
        $this->w = '12';
        $this->h = '40';
        $this->unit = 'in';
        $this->unit1 = 'in';

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
        $request = (object) [
            'gender' => $this->gender,
            'w' => $this->w,
            'h' => $this->h,
            'unit' => $this->unit,
            'unit1' => $this->unit1,
        ];

        $model = new Health();
        $result = $model->waist($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $result['request'] = $request; // Ensure request is available in detail
            
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
        return view('livewire.calculators.waist-to-hip-ratio-calculator');
    }
}
