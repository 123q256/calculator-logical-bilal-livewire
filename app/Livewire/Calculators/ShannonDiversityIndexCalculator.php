<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class ShannonDiversityIndexCalculator extends Component
{
    public $seprateby = 'space';
    public $seprate = ' ';
    public $x = '55 62 35 32 50 57 54';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
    {
        if ($propertyName === 'seprateby') {
            if ($this->seprateby === 'space') {
                $this->seprate = ' ';
                $this->x = '12 32 12 33 4 21';
            } elseif ($this->seprateby === ',') {
                $this->seprate = ',';
                $this->x = '12, 32, 12, 33, 4, 21';
            } else {
                $this->seprate = '';
            }
        }
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
            $this->seprateby = $inputs->seprateby ?? 'space';
            $this->seprate = $inputs->seprate ?? ' ';
            $this->x = $inputs->x ?? '55 62 35 32 50 57 54';
        }
    }

    public function resetForm()
    {
        $this->seprateby = 'space';
        $this->seprate = ' ';
        $this->x = '55 62 35 32 50 57 54';
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
            'seprate' => $this->seprate,
            'x' => $this->x,
        ];

        $model = new Statistics();
        $result = $model->shannon($request);

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
        return view('livewire.calculators.shannon-diversity-index-calculator');
    }
}
