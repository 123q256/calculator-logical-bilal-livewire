<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class DistanceFormulaCalculator extends Component
{
   public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $data = [
        'type' => '2P',
        'dimen' => '2D',
        '2px1' => '', '2px2' => '',
        '3px1' => '', '3px2' => '', '3px3' => '',
        'x1' => '', 'y1' => '', 'm' => '', 'b' => '', 'm2' => '', 'b2' => '',
        '3x1' => '', '3y1' => '', '3z1' => '',
        '4x1' => '', '4y1' => '', '4z1' => '', '4k1' => '',
        'x2' => '', 'y2' => '',
        '3x2' => '', '3y2' => '', '3z2' => '',
        '4x2' => '', '4y2' => '', '4z2' => '', '4k2' => '',
        'x3' => '', 'y3' => '',
        '3x3' => '', '3y3' => '', '3z3' => '',
        '4x3' => '', '4y3' => '', '4z3' => '', '4k3' => ''
    ];


  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

        }
    }

    public function resetForm()
    {
        $lang = $this->lang;
        $type = $this->type;
        $this->reset();
        $this->lang = $lang;
        $this->type = $type;
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
        $requestData = $this->data;
        $request = new \Illuminate\Http\Request();
        $request->replace($requestData);

        $model = new Math();
        $result = $model->dis_formula($request);

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
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');
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
        return view('livewire.calculators.distance-formula-calculator');
    }
}
