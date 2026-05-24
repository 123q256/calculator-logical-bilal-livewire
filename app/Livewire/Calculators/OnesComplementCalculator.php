<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class OnesComplementCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $cal = 'bnry_cal';
    public $dec = '5';
    public $bnry = '0101';
    public $hex = 'F';
    public $bits = '8';
    public $no_of_bits = '8';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->cal = $inputs['cal'] ?? 'bnry_cal';
            $this->dec = $inputs['dec'] ?? '5';
            $this->bnry = $inputs['bnry'] ?? '0101';
            $this->hex = $inputs['hex'] ?? 'F';
            $this->bits = $inputs['bits'] ?? '8';
            $this->no_of_bits = $inputs['no_of_bits'] ?? '8';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->cal = 'bnry_cal';
        $this->dec = '5';
        $this->bnry = '0101';
        $this->hex = 'F';
        $this->bits = '8';
        $this->no_of_bits = '8';

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

    public function currentBits()
    {
        if ($this->bits === 'other') {
            return intval($this->no_of_bits) ?: 8;
        }
        return intval($this->bits) ?: 8;
    }
    
    public function decMin()
    {
        $b = $this->currentBits();
        if ($b >= 55) return '';
        return -pow(2, $b - 1);
    }
    
    public function decMax()
    {
        $b = $this->currentBits();
        if ($b >= 55) return '';
        return pow(2, $b - 1) - 1;
    }
    
    public function decRangeText()
    {
        if ($this->currentBits() >= 55) return '';
        return $this->decMin() . ' to ' . $this->decMax();
    }
    
    public function bnryMaxLength()
    {
        return $this->currentBits();
    }
    
    public function bnryRangeText()
    {
        return $this->currentBits() . ' Digits (without leading zeros)';
    }

    public function calculate()
    {
        $request = (object)[
            'cal' => $this->cal,
            'dec' => $this->dec,
            'bnry' => $this->bnry,
            'hex' => $this->hex,
            'bits' => $this->bits,
            'no_of_bits' => $this->no_of_bits,
        ];

        $model = new Math();
        $result = $model->ones($request);

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
        return view('livewire.calculators.ones-complement-calculator');
    }
}
