<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class ScaleCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $choice = '1';
    public $scaled_length = 4;
    public $scaled_length_unit = 'm';
    public $real_length = 1;
    public $real_length_unit = 'm';
    public $y1 = '';
    public $y2 = '';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->choice = $inputs->choice ?? '1';
            $this->scaled_length = $inputs->scaled_length ?? 4;
            $this->scaled_length_unit = $inputs->scaled_length_unit ?? 'm';
            $this->real_length = $inputs->real_length ?? 1;
            $this->real_length_unit = $inputs->real_length_unit ?? 'm';
            $this->y1 = $inputs->y1 ?? '';
            $this->y2 = $inputs->y2 ?? '';
        }
    }

    public function updatedChoice()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function setUnit($field, $val)
    {
        $this->$field = $val;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->choice = '1';
        $this->scaled_length = 4;
        $this->scaled_length_unit = 'm';
        $this->real_length = 1;
        $this->real_length_unit = 'm';
        $this->y1 = '';
        $this->y2 = '';

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
            'choice'             => $this->choice,
            'scaled_length'      => $this->scaled_length,
            'scaled_length_unit' => $this->scaled_length_unit,
            'real_length'        => $this->real_length,
            'real_length_unit'   => $this->real_length_unit,
            'y1'                 => $this->y1,
            'y2'                 => $this->y2,
        ];

        $model = new Physics();
        $result = $model->scale($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

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
            session()->flash('validation_error', $this->error);
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

        return view('livewire.calculators.scale-calculator');
    }
}
