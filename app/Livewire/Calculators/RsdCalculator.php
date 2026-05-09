<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class RsdCalculator extends Component
{
    public $form = 'raw';
    public $x = '12, 23, 45, 33, 65, 54, 54';
    public $mean = '20.75';
    public $deviation = '8.3016';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->form = $inputs->form ?? 'raw';
            $this->x = $inputs->x ?? '12, 23, 45, 33, 65, 54, 54';
            $this->mean = $inputs->mean ?? '20.75';
            $this->deviation = $inputs->deviation ?? '8.3016';
        }
    }

    public function resetForm()
    {
        $this->form = 'raw';
        $this->x = '12, 23, 45, 33, 65, 54, 54';
        $this->mean = '20.75';
        $this->deviation = '8.3016';
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
            'form' => $this->form,
            'x' => $this->x,
            'mean' => $this->mean,
            'deviation' => $this->deviation,
        ];

        $model = new Statistics();
        $result = $model->rsd($request);

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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.rsd-calculator');
    }
}
