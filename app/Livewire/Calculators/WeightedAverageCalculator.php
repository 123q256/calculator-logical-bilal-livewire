<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class WeightedAverageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $weights = ['5', '8', '15', '53', '53', '51', '25', '56', '53', '50'];
    public $values = ['6', '9', '18', '80', '67', '54', '28', '57', '54', '43'];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->weights = $inputs['weight'] ?? $this->weights;
            $this->values = $inputs['value'] ?? $this->values;
        }
    }

    public function addRow()
    {
        if (count($this->weights) < 20) {
            $this->weights[] = '';
            $this->values[] = '';
        } else {
            $this->error = 'Only Twenty Fields are Allowed';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->weights = ['5', '8', '15', '53', '53', '51', '25', '56', '53', '50'];
        $this->values = ['6', '9', '18', '80', '67', '54', '28', '57', '54', '43'];

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

  public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $requestData = [
            'weight' => $this->weights,
            'value' => $this->values,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->weighted($request);

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
                        if (typeof MJrerender === 'function') MJrerender();
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
        return view('livewire.calculators.weighted-average-calculator');
    }
}
