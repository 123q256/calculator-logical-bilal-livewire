<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class CovarianceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $formula = '1';
    public $set_x = '5, 12, 18, 23, 45';
    public $set_y = '2, 8, 18, 20, 28';
    public $between = '0.5';
    public $devi_x = '10';
    public $devi_y = '4';
    public $matrix = '[13 , 44 , 25],[43 , 65 , 76],[12 , 54 , 8]';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'formula', 'set_x', 'set_y', 'between', 'devi_x', 'devi_y', 'matrix']);
        $this->formula = '1';
        $this->set_x = '5, 12, 18, 23, 45';
        $this->set_y = '2, 8, 18, 20, 28';
        $this->between = '0.5';
        $this->devi_x = '10';
        $this->devi_y = '4';
        $this->matrix = '[13 , 44 , 25],[43 , 65 , 76],[12 , 54 , 8]';

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
            'formula' => $this->formula,
            'set_x'   => $this->set_x,
            'set_y'   => $this->set_y,
            'between' => $this->between,
            'devi_x'  => $this->devi_x,
            'devi_y'  => $this->devi_y,
            'matrix'  => $this->matrix,
        ];

        $model = new Statistics();
        $result = $model->covariance($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('render-math'));
                }, 400);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result') && env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            $this->js(<<<'JS'
                $nextTick(() => {
                    window.dispatchEvent(new CustomEvent('render-math'));
                });
            JS);
        }
        return view('livewire.calculators.covariance-calculator');
    }
}
