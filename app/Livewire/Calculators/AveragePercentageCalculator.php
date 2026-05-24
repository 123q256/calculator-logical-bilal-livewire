<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class AveragePercentageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $same_sample = 'no';
    public $entries = [
        ['percentage' => '', 'sample' => ''],
        ['percentage' => '', 'sample' => '']
    ];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->same_sample = $inputs['same_sample'] ?? $this->same_sample;
            
            if (isset($inputs['percentage']) && is_array($inputs['percentage'])) {
                $newEntries = [];
                foreach ($inputs['percentage'] as $i => $pct) {
                    $newEntries[] = [
                        'percentage' => $pct,
                        'sample' => $inputs['sample'][$i] ?? ''
                    ];
                }
                $this->entries = $newEntries;
            }
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->same_sample = 'no';
        $this->entries = [
            ['percentage' => '', 'sample' => ''],
            ['percentage' => '', 'sample' => '']
        ];

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
        $percentages = array_column($this->entries, 'percentage');
        $samples = array_column($this->entries, 'sample');

        $requestData = [
            'same_sample' => $this->same_sample,
            'percentage' => $percentages,
            'sample' => $samples,
        ];
        $request = clone request();
        $request->replace($requestData);

        $model = new Math();
        $result = $model->avg_percentage($request);

        if (is_array($result)) {
            foreach ($result as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $result[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $result[$key] = 'INF';
                    }
                }
            }
        }

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') renderMathInElement(document.body);
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
        return view('livewire.calculators.average-percentage-calculator');
    }
}
