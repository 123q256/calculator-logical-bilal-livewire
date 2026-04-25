<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class MolarMassCalculator extends Component
{
    public $f = 'CO2';
    public $cmpnd = 'none';
    public $elem = 'none';
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
            if (is_object($inputs) || is_array($inputs)) {
                foreach ($inputs as $key => $value) {
                    if (property_exists($this, $key)) {
                        $this->$key = $value;
                    }
                }
            }
        }
    }

    public function updatedCmpnd($value)
    {
        if ($value !== 'none') {
            $this->elem = 'none';
            $this->f = $value;
        }
    }

    public function updatedElem($value)
    {
        if ($value !== 'none') {
            $this->cmpnd = 'none';
            $this->f = $value;
        }
    }

    public function updatedF($value)
    {
        $this->cmpnd = 'none';
        $this->elem = 'none';
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'f', 'cmpnd', 'elem']);
        $this->resetErrorBag();

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
            'f' => $this->f
        ];

        $model = new Chemistry();
        $result = $model->molar($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $chartData = [];
            if (isset($result['elem']) && isset($result['frac'])) {
                for ($i = 0; $i < count($result['elem']) - 1; $i++) {
                    $chartData[] = [$result['elem'][$i], (float)$result['frac'][$i]];
                }
            }
            $result['chartData'] = $chartData;
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (object)['f' => $this->f, 'cmpnd' => $this->cmpnd, 'elem' => $this->elem]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->dispatch('math-updated');
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', (object)['f' => $this->f, 'cmpnd' => $this->cmpnd, 'elem' => $this->elem]);
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
            const offset = 30;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
       JS);
        }
        return view('livewire.calculators.molar-mass-calculator');
    }
}

 
