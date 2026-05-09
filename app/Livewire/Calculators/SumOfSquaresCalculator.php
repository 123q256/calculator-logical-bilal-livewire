<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class SumOfSquaresCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $x = '55 62 35 32 50 57 54';
    public $seprate = ' ';
    public $seprateby = 'space';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->x = $inputs['x'] ?? '55 62 35 32 50 57 54';
            $this->seprate = $inputs['seprate'] ?? ' ';
            $this->seprateby = $inputs['seprateby'] ?? 'space';
        }
    }

    public function updatedSeprateby($value)
    {
        if ($value == 'space') {
            $this->seprate = ' ';
            $this->x = '55 62 35 32 50 57 54';
        } elseif ($value == ',') {
            $this->seprate = ',';
            $this->x = '55, 62, 35, 32, 50, 57, 54';
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
        $this->x = '55 62 35 32 50 57 54';
        $this->seprate = ' ';
        $this->seprateby = 'space';

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
            'x'         => $this->x,
            'seprate'   => $this->seprate,
            'seprateby' => $this->seprateby,
        ];

        $model = new Statistics();
        $result = $model->sum($request);

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
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 400);
            JS));
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
        return view('livewire.calculators.sum-of-squares-calculator');
    }
}
