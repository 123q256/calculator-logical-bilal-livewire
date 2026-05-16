<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class DecimalToFractionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $dec = '2.5634';
    public $repeat = '0';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['dec'])) $this->dec = $inputs['dec'];
            if (isset($inputs['repeat'])) $this->repeat = $inputs['repeat'];
        }
    }

    public function resetForm()
    {
        $this->dec = '2.5634';
        $this->repeat = '0';
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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        if ($this->repeat > 0) {
            if (strpos($this->dec, '.') === false) {
                $this->error = "Please include a decimal point for repeating decimals.";
                $this->detail = null;
                return;
            }
            $parts = explode('.', $this->dec);
            if (strlen($parts[1]) < $this->repeat) {
                $this->error = "Repeating digits cannot be more than the decimal places.";
                $this->detail = null;
                return;
            }
        }

        $request = (object)[
            'dec' => $this->dec,
            'repeat' => $this->repeat,
        ];

        $model = new Math();
        $result = $model->decimal($request);

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
                        if (typeof window.MJrerender === 'function') window.MJrerender();
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
        return view('livewire.calculators.decimal-to-fraction-calculator');
    }
}
