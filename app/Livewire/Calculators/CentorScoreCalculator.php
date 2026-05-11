<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class CentorScoreCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $age = '';
    public $tonsils = '0';
    public $cough = '0';
    public $lymph = '0';
    public $temp = '';
    public $unit = '°C';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->age = $inputs->age ?? $this->age;
            $this->tonsils = $inputs->tonsils ?? $this->tonsils;
            $this->cough = $inputs->cough ?? $this->cough;
            $this->lymph = $inputs->lymph ?? $this->lymph;
            $this->temp = $inputs->temp ?? $this->temp;
            $this->unit = $inputs->unit ?? $this->unit;
        }
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function setUnit($value)
    {
        $this->unit = $value;
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->age = '';
        $this->tonsils = '0';
        $this->cough = '0';
        $this->lymph = '0';
        $this->temp = '';
        $this->unit = '°C';

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
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'age' => $this->age,
            'tonsils' => $this->tonsils,
            'cough' => $this->cough,
            'lymph' => $this->lymph,
            'temp' => $this->temp,
            'unit' => $this->unit,
        ]);

        $model = new Health();
        $result = $model->centor($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
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
        return view('livewire.calculators.centor-score-calculator');
    }
}
