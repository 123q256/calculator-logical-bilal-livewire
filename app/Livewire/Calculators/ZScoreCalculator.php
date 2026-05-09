<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class ZScoreCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $to_calculate = 'dp';
    public $pvalue = '0.13';
    public $x = '2, 4, 6, 8, 10, 12';
    public $smvalue = '6';
    public $snvalue = '12';
    public $dsvalue = '5';
    public $pmvalue = '3';
    public $psdvalue = '2';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->to_calculate = $inputs['to_calculate'] ?? 'dp';
            $this->pvalue = $inputs['pvalue'] ?? '0.13';
            $this->x = $inputs['x'] ?? '2, 4, 6, 8, 10, 12';
            $this->smvalue = $inputs['smvalue'] ?? '6';
            $this->snvalue = $inputs['snvalue'] ?? '12';
            $this->dsvalue = $inputs['dsvalue'] ?? '5';
            $this->pmvalue = $inputs['pmvalue'] ?? '3';
            $this->psdvalue = $inputs['psdvalue'] ?? '2';
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
        $this->to_calculate = 'dp';
        $this->pvalue = '0.13';
        $this->x = '2, 4, 6, 8, 10, 12';
        $this->smvalue = '6';
        $this->snvalue = '12';
        $this->dsvalue = '5';
        $this->pmvalue = '3';
        $this->psdvalue = '2';

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
            'to_calculate' => $this->to_calculate,
            'pvalue'       => $this->pvalue,
            'x'            => $this->x,
            'smvalue'      => $this->smvalue,
            'snvalue'      => $this->snvalue,
            'dsvalue'      => $this->dsvalue,
            'pmvalue'      => $this->pmvalue,
            'psdvalue'     => $this->psdvalue,
        ];

        $model = new Statistics();
        $result = $model->z($request);

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
        return view('livewire.calculators.z-score-calculator');
    }
}
