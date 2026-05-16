<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class LogAntilogCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $method = 'log';
    public $x = '13';
    public $y = '10';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['method'])) $this->method = $inputs['method'];
            if (isset($inputs['x'])) $this->x = $inputs['x'];
            if (isset($inputs['y'])) $this->y = $inputs['y'];
        }
    }

  public function resetForm()
    {
        $this->method = 'log';
        $this->x = '13';
        $this->y = '10';
        $this->error = null;
        $this->detail = null;

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

  public function updated($propertyName)
    {
        if ($propertyName == 'method') {
            if ($this->method == 'ln') {
                $this->y = 'e';
            } else {
                $this->y = '10';
            }
        }
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        if (($this->method == 'log' || $this->method == 'ln') && is_numeric($this->y) && floatval($this->y) <= 0) {
            $this->error = 'Log base must be greater than 0.';
            session()->flash('validation_error', $this->error);
            return;
        }

        $request = (object)[
            'method' => $this->method,
            'x' => $this->x,
            'y' => $this->y,
        ];

        $model = new Math();
        $result = $model->log($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (isset($result['ans'])) {
                if (is_infinite($result['ans'])) {
                    $result['ans'] = ($result['ans'] < 0) ? '-INF' : 'INF';
                } elseif (is_nan($result['ans'])) {
                    $result['ans'] = 'undefined';
                }
            }

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
        return view('livewire.calculators.log-antilog-calculator');
    }
}
