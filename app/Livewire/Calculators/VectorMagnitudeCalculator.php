<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class VectorMagnitudeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $dem = '3';
    public $a_rep = 'coor';
    
    // Coordinate Fields
    public $ax = '3';
    public $ay = '4';
    public $az = '4';
    public $w = '4';
    public $t = '2';

    // Point A Fields
    public $a1 = '2';
    public $a2 = '2';
    public $a3 = '2';
    public $a4 = '2';
    public $a5 = '1';

    // Point B Fields
    public $b1 = '1';
    public $b2 = '1';
    public $b3 = '1';
    public $b4 = '3';
    public $b5 = '2';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->dem = '3';
        $this->a_rep = 'coor';
        $this->ax = '3';
        $this->ay = '4';
        $this->az = '4';
        $this->w = '4';
        $this->t = '2';
        $this->a1 = '2';
        $this->a2 = '2';
        $this->a3 = '2';
        $this->a4 = '2';
        $this->a5 = '1';
        $this->b1 = '1';
        $this->b2 = '1';
        $this->b3 = '1';
        $this->b4 = '3';
        $this->b5 = '2';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'dem' => $this->dem,
            'a_rep' => $this->a_rep,
            'ax' => $this->ax,
            'ay' => $this->ay,
            'az' => $this->az,
            'w' => $this->w,
            't' => $this->t,
            'a1' => $this->a1,
            'a2' => $this->a2,
            'a3' => $this->a3,
            'a4' => $this->a4,
            'a5' => $this->a5,
            'b1' => $this->b1,
            'b2' => $this->b2,
            'b3' => $this->b3,
            'b4' => $this->b4,
            'b5' => $this->b5,
        ];

        $model = new Physics();
        $result = $model->vector((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->error = null;
            $this->js(<<<'JS'
                setTimeout(() => {
                    if (window.MathJax) {
                        if (MathJax.typesetPromise) {
                            MathJax.typesetPromise();
                        } else if (MathJax.Hub && MathJax.Hub.Queue) {
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        }
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    if (window.MathJax) {
                        if (MathJax.typesetPromise) {
                            MathJax.typesetPromise();
                        } else if (MathJax.Hub && MathJax.Hub.Queue) {
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        }
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.vector-magnitude-calculator');
    }
}
