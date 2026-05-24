<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class HexCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $calc_type = 'first';
    public $bnr_frs = '8AB';
    public $bnr_slc = 'add';
    public $bnr_sec = 'B78';
    
    public $options = '1';
    public $nmbr = '34A';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calc_type = $inputs['type'] ?? 'first';
            $this->bnr_frs = $inputs['bnr_frs'] ?? '8AB';
            $this->bnr_slc = $inputs['bnr_slc'] ?? 'add';
            $this->bnr_sec = $inputs['bnr_sec'] ?? 'B78';
            $this->options = $inputs['options'] ?? '1';
            $this->nmbr = $inputs['nmbr'] ?? '34A';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->calc_type = 'first';
        $this->bnr_frs = '8AB';
        $this->bnr_slc = 'add';
        $this->bnr_sec = 'B78';
        $this->options = '1';
        $this->nmbr = '34A';

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

    public function updatedOptions($value)
    {
        switch ($value) {
            case '1':
                $this->nmbr = '34A';
                break;
            case '2':
                $this->nmbr = '42';
                break;
            case '3':
                $this->nmbr = '54f';
                break;
            case '4':
                $this->nmbr = '101010';
                break;
        }
        $this->detail = null;
    }

    public function calculate()
    {
        $requestData = [
            'type' => $this->calc_type,
            'bnr_frs' => $this->bnr_frs,
            'bnr_slc' => $this->bnr_slc,
            'bnr_sec' => $this->bnr_sec,
            'options' => $this->options,
            'nmbr' => $this->nmbr,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->hex($request);

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
        return view('livewire.calculators.hex-calculator');
    }
}
