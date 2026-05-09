<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class ErrorPropagationCalculator extends Component
{
    public $optionSelect = 'addition';
    public $x = '850';
    public $delta_x = '600';
    public $y = '400';
    public $delta_y = '900';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
        $this->dispatch('math-updated');
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->optionSelect = $inputs->optionSelect ?? 'addition';
            $this->x = $inputs->x ?? '850';
            $this->delta_x = $inputs->delta_x ?? '600';
            $this->y = $inputs->y ?? '400';
            $this->delta_y = $inputs->delta_y ?? '900';
        }
    }

    public function resetForm()
    {
        $this->optionSelect = 'addition';
        $this->x = '850';
        $this->delta_x = '600';
        $this->y = '400';
        $this->delta_y = '900';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        $this->dispatch('math-updated');

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'optionSelect' => $this->optionSelect,
            'x' => $this->x,
            'delta_x' => $this->delta_x,
            'y' => $this->y,
            'delta_y' => $this->delta_y,
        ];

        $model = new Statistics();
        $result = $model->error_propagation($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->dispatch('math-updated');
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
        $this->dispatch('math-updated');
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
        return view('livewire.calculators.error-propagation-calculator');
    }
}
