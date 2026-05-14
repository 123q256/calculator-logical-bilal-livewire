<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class BishopScoreCalculator extends Component
{
    public $effacement = '0';
    public $consistency = '0';
    public $fetal_station = '2';
    public $head_position = '0';
    public $dilation = '1';
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
            $this->effacement = $inputs['effacement'] ?? '0';
            $this->consistency = $inputs['consistency'] ?? '0';
            $this->fetal_station = $inputs['fetal_station'] ?? '2';
            $this->head_position = $inputs['head_position'] ?? '0';
            $this->dilation = $inputs['dilation'] ?? '1';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->effacement = '0';
        $this->consistency = '0';
        $this->fetal_station = '2';
        $this->head_position = '0';
        $this->dilation = '1';
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

    public function calculate()
    {
        $request = (object)[
            'effacement' => $this->effacement,
            'consistency' => $this->consistency,
            'fetal_station' => $this->fetal_station,
            'head_position' => $this->head_position,
            'dilation' => $this->dilation,
        ];

        $model = new Health();
        $result = $model->bishop($request);

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
        return view('livewire.calculators.bishop-score-calculator');
    }
}
