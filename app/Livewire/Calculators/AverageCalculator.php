<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class AverageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $x = '55 62 35 32 50 57 54';
    public $more = 'space';
    public $seprate = '';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['x'])) $this->x = $inputs['x'];
            if (isset($inputs['more'])) $this->more = $inputs['more'];
            if (isset($inputs['seprate'])) $this->seprate = $inputs['seprate'];
        }
    }

  public function resetForm()
    {
        $this->x = '55 62 35 32 50 57 54';
        $this->more = 'space';
        $this->seprate = '';
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
        if ($propertyName == 'more') {
            if ($this->more == 'space') {
                $this->x = str_replace(',', ' ', $this->x);
                $this->seprate = '';
            } elseif ($this->more == ',') {
                $this->x = str_replace(' ', ',', $this->x);
                $this->seprate = ',';
            }
        }
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'x' => $this->x,
            'more' => $this->more,
            'seprate' => $this->seprate,
        ];

        $model = new Math();
        $result = $model->average($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Prepare Highcharts data
            $repeat = array_count_values($result['numbers']);
            ksort($repeat);
            $chartData = [];
            foreach ($repeat as $val => $freq) {
                $chartData[] = [(float)$val, (int)$freq];
            }
            $result['chartData'] = json_encode($chartData);

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
        return view('livewire.calculators.average-calculator');
    }
}
