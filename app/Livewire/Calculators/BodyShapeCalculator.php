<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class BodyShapeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $device = 'desktop';

    // Form inputs
    public $gender = 'women';
    public $chest = '38.6';
    public $waist = '27.6';
    public $high = '37.4';
    public $hip = '39.4';
    public $bust_units = 'in';
    public $waist_units = 'in';
    public $high_units = 'in';
    public $hip_units = 'in';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        // Simple device detection
        $userAgent = request()->header('User-Agent');
        if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $userAgent)) {
            $this->device = 'mobile';
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->gender = $inputs->gender ?? $this->gender;
            $this->chest = $inputs->chest ?? $this->chest;
            $this->waist = $inputs->waist ?? $this->waist;
            $this->high = $inputs->high ?? $this->high;
            $this->hip = $inputs->hip ?? $this->hip;
            $this->bust_units = $inputs->bust_units ?? $this->bust_units;
            $this->waist_units = $inputs->waist_units ?? $this->waist_units;
            $this->high_units = $inputs->high_units ?? $this->high_units;
            $this->hip_units = $inputs->hip_units ?? $this->hip_units;
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
        $this->gender = 'women';
        $this->chest = '38.6';
        $this->waist = '27.6';
        $this->high = '37.4';
        $this->hip = '39.4';
        $this->bust_units = 'in';
        $this->waist_units = 'in';
        $this->high_units = 'in';
        $this->hip_units = 'in';

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
            'chest' => (float)$this->chest,
            'waist' => (float)$this->waist,
            'high' => (float)$this->high,
            'hip' => (float)$this->hip,
            'bust_units' => $this->bust_units,
            'waist_units' => $this->waist_units,
            'high_units' => $this->high_units,
            'hip_units' => $this->hip_units,
        ];

        $model = new Health();
        $result = $model->body_shape($request);

        if (!empty($result['shape'])) {
            $result['RESULT'] = 1; // Ensure RESULT is set for consistency
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

        $this->error = $result['error'] ?? 'Please Input Values!';
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
        return view('livewire.calculators.body-shape-calculator');
    }
}
