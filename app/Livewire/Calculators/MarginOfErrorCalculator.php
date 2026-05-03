<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class MarginOfErrorCalculator extends Component
{
    public $per = '1.96@95';
    public $x = 50;
    public $y = 30;
    public $z = 60;

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
            $inputs = session('calculator_back_inputs');
            $this->per = $inputs->per ?? '1.96@95';
            $this->x = $inputs->x ?? 50;
            $this->y = $inputs->y ?? 30;
            $this->z = $inputs->z ?? 60;
        }
    }

    public function resetForm()
    {
        $this->reset(['per', 'x', 'y', 'z', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'per' => $this->per,
            'x'   => $this->x,
            'y'   => $this->y,
            'z'   => $this->z,
        ];

        $model = new Finance();
        $result = $model->margin($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
        }
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
        return view('livewire.calculators.margin-of-error-calculator');
    }
}
