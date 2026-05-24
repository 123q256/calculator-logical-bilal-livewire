<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class TestCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $grades = '2';
    public $first = '50';
    public $second = '15';
    public $increment = '1';
    public $aplus = '97';
    public $a = '93';
    public $aminus = '90';
    public $bplus = '87';
    public $b = '83';
    public $bminus = '80';
    public $cplus = '77';
    public $c = '73';
    public $cminus = '70';
    public $dplus = '67';
    public $d = '63';
    public $dminus = '63';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->grades = $inputs['grades'] ?? $this->grades;
            $this->first = $inputs['first'] ?? $this->first;
            $this->second = $inputs['second'] ?? $this->second;
            $this->increment = $inputs['increment'] ?? $this->increment;
            $this->aplus = $inputs['aplus'] ?? $this->aplus;
            $this->a = $inputs['a'] ?? $this->a;
            $this->aminus = $inputs['aminus'] ?? $this->aminus;
            $this->bplus = $inputs['bplus'] ?? $this->bplus;
            $this->b = $inputs['b'] ?? $this->b;
            $this->bminus = $inputs['bminus'] ?? $this->bminus;
            $this->cplus = $inputs['cplus'] ?? $this->cplus;
            $this->c = $inputs['c'] ?? $this->c;
            $this->cminus = $inputs['cminus'] ?? $this->cminus;
            $this->dplus = $inputs['dplus'] ?? $this->dplus;
            $this->d = $inputs['d'] ?? $this->d;
            $this->dminus = $inputs['dminus'] ?? $this->dminus;
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->grades = '2';
        $this->first = '50';
        $this->second = '15';
        $this->increment = '1';
        $this->aplus = '97';
        $this->a = '93';
        $this->aminus = '90';
        $this->bplus = '87';
        $this->b = '83';
        $this->bminus = '80';
        $this->cplus = '77';
        $this->c = '73';
        $this->cminus = '70';
        $this->dplus = '67';
        $this->d = '63';
        $this->dminus = '63';

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
        $requestData = [
            'grades' => $this->grades,
            'first' => $this->first,
            'second' => $this->second,
            'increment' => $this->increment,
            'aplus' => $this->aplus,
            'a' => $this->a,
            'aminus' => $this->aminus,
            'bplus' => $this->bplus,
            'b' => $this->b,
            'bminus' => $this->bminus,
            'cplus' => $this->cplus,
            'c' => $this->c,
            'cminus' => $this->cminus,
            'dplus' => $this->dplus,
            'd' => $this->d,
            'dminus' => $this->dminus,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->test($request);

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
        return view('livewire.calculators.test-calculator');
    }
}
