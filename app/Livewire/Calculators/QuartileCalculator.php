<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class QuartileCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $seprateby = 'space';
    public $seprate = ' ';
    public $x = '12 32 12 33 4 21';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->seprateby = $inputs['seprateby'] ?? 'space';
            $this->seprate = $inputs['seprate'] ?? ' ';
            $this->x = $inputs['x'] ?? '12 32 12 33 4 21';
        }
    }

    public function updatedSeprateby($value)
    {
        if ($value == 'space') {
            $this->seprate = ' ';
            $this->x = '12 32 12 33 4 21';
        } elseif ($value == ',') {
            $this->seprate = ',';
            $this->x = '12, 32, 12, 33, 4, 21';
        } else {
            $this->seprate = '';
            $this->x = '';
        }
    }

    public function updated($property)
    {
        $this->error = null;
        $this->detail = null;
    }

  public function resetForm()
    {

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
            'seprateby' => $this->seprateby,
            'seprate'   => $this->seprate,
            'x'         => $this->x,
        ];


        $model = new Statistics();
        $result = $model->quartile($request);
        // dd($result);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('render-graph', { detail: %s }));
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 400);
            JS, json_encode($this->detail)));
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
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
        return view('livewire.calculators.quartile-calculator');
    }
}
