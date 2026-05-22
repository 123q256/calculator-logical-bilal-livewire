<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class TwosComplementCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $submit = 'distance';
    public $cal = 'dec_cal';
    public $bits = '8';
    public $dec = '5';
    public $bnry = '0101';
    public $hex = 'F';
    public $no_of_bits = '8';
    public $no = '11101';
    public $action = '+';
    public $no1 = '10110';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->submit = $inputs['selection'] ?? 'distance';
            $this->cal = $inputs['cal'] ?? 'dec_cal';
            $this->dec = $inputs['dec'] ?? '5';
            $this->bnry = $inputs['bnry'] ?? '0101';
            $this->hex = $inputs['hex'] ?? 'F';
            $this->bits = $inputs['bits'] ?? '8';
            $this->no_of_bits = $inputs['no_of_bits'] ?? '8';
            $this->no = $inputs['no'] ?? '11101';
            $this->no1 = $inputs['no1'] ?? '10110';
            $this->action = $inputs['action'] ?? '+';
        }
    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;

        $this->submit = 'distance';
        $this->cal = 'dec_cal';
        $this->bits = '8';
        $this->dec = '5';
        $this->bnry = '0101';
        $this->hex = 'F';
        $this->no_of_bits = '8';
        $this->no = '11101';
        $this->action = '+';
        $this->no1 = '10110';

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
        $request = new \Illuminate\Http\Request([
            'selection' => $this->submit,
            'cal' => $this->cal,
            'dec' => $this->dec,
            'bnry' => $this->bnry,
            'hex' => $this->hex,
            'bits' => $this->bits,
            'no_of_bits' => $this->no_of_bits,
            'no' => $this->no,
            'no1' => $this->no1,
            'action' => $this->action,
        ]);

        $model = new Math();
        $result = $model->twos($request);

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
        return view('livewire.calculators.twos-complement-calculator');
    }
}
