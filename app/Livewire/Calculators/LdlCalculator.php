<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class LdlCalculator extends Component
{
    public $total = '';
    public $total_unit = 'mmol/L';
    public $high = '';
    public $high_unit = 'mmol/L';
    public $triglycerides = '';
    public $triglycerides_unit = 'mmol/L';
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
            $inputs = (object)session('calculator_back_inputs');
            $this->total = $inputs->total ?? $this->total;
            $this->total_unit = $inputs->total_unit ?? $this->total_unit;
            $this->high = $inputs->high ?? $this->high;
            $this->high_unit = $inputs->high_unit ?? $this->high_unit;
            $this->triglycerides = $inputs->triglycerides ?? $this->triglycerides;
            $this->triglycerides_unit = $inputs->triglycerides_unit ?? $this->triglycerides_unit;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->total = '';
        $this->total_unit = 'mmol/L';
        $this->high = '';
        $this->high_unit = 'mmol/L';
        $this->triglycerides = '';
        $this->triglycerides_unit = 'mmol/L';
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
            'total'              => $this->total,
            'total_unit'         => $this->total_unit,
            'high'               => $this->high,
            'high_unit'          => $this->high_unit,
            'triglycerides'      => $this->triglycerides,
            'triglycerides_unit' => $this->triglycerides_unit,
        ];

        $model = new Health();
        $result = $model->ldl($request);

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
        return view('livewire.calculators.ldl-calculator');
    }
}
