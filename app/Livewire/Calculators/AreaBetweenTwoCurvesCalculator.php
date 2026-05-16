<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class AreaBetweenTwoCurvesCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';

    // Inputs
    public $EnterEq1 = '6x+x^3';
    public $EnterEq2 = '6x + 4';
    public $upper = '3';
    public $lower = '1';
    public $with = 'x';

    public function mount($type = 'calculator')
    {
        $this->type = $type;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->EnterEq1 = $inputs['EnterEq1'] ?? '6x+x^3';
            $this->EnterEq2 = $inputs['EnterEq2'] ?? '6x + 4';
            $this->upper = $inputs['upper'] ?? '3';
            $this->lower = $inputs['lower'] ?? '1';
            $this->with = $inputs['with'] ?? 'x';
        }
    }

    public function resetForm()
    {
        $this->EnterEq1 = '6x+x^3';
        $this->EnterEq2 = '6x + 4';
        $this->upper = '3';
        $this->lower = '1';
        $this->with = 'x';
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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        if (empty($this->EnterEq1) || empty($this->EnterEq2) || empty($this->upper) || empty($this->lower)) {
            $this->error = 'Please! Check Your Input.';
            return;
        }

        $request = new class($this->EnterEq1, $this->EnterEq2, $this->upper, $this->lower, $this->with) {
            public $EnterEq1;
            public $EnterEq2;
            public $upper;
            public $lower;
            public $with;

            public function __construct($e1, $e2, $u, $l, $w) {
                $this->EnterEq1 = $e1;
                $this->EnterEq2 = $e2;
                $this->upper = $u;
                $this->lower = $l;
                $this->with = $w;
            }

            public function all() {
                return [
                    'EnterEq1' => $this->EnterEq1,
                    'EnterEq2' => $this->EnterEq2,
                    'upper' => $this->upper,
                    'lower' => $this->lower,
                    'with' => $this->with,
                ];
            }
        };

        $model = new Math();
        $result = $model->area($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request->all());

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                 session()->flash('scroll_to_result', true);
                 return redirect()->to(url()->previous() ?? '/');
            } else {
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

        $this->error = $result['error'] ?? 'Please! Check Your Input.';
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
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

        $lang = [];
        $file = 'area-between-two-curves-calculator';
        if (app()->getLocale() != 'en') {
            $file = app()->getLocale() . '-' . $file;
        }
        
        $path = public_path("keys/{$file}.txt");
        if (file_exists($path)) {
            $data = json_decode(file_get_contents($path), true);
            if (isset($data['lang_keys'])) {
                $lang = json_decode($data['lang_keys'], true);
            }
        }

        return view('livewire.calculators.area-between-two-curves-calculator', [
            'lang' => $lang
        ]);
    }
}
