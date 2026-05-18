<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class DilationCalculator extends Component
{
    // Public Input Properties
    public $nbr = '2';
    public $dil = '3';
    public $a1 = '2';
    public $z1 = '3';
    public $a2 = '4';
    public $z2 = '5';
    public $a3 = '6';
    public $z3 = '7';
    public $a4 = '8';
    public $z4 = '9';
    public $a5 = '10';
    public $z5 = '11';
    public $a6 = '12';
    public $z6 = '13';
    public $a7 = '14';
    public $z7 = '15';
    public $a8 = '16';
    public $z8 = '17';

    // Component State
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
            $this->nbr = $inputs['nbr'] ?? '2';
            $this->dil = $inputs['dil'] ?? '3';
            $this->a1 = $inputs['a1'] ?? '2';
            $this->z1 = $inputs['z1'] ?? '3';
            $this->a2 = $inputs['a2'] ?? '4';
            $this->z2 = $inputs['z2'] ?? '5';
            $this->a3 = $inputs['a3'] ?? '6';
            $this->z3 = $inputs['z3'] ?? '7';
            $this->a4 = $inputs['a4'] ?? '8';
            $this->z4 = $inputs['z4'] ?? '9';
            $this->a5 = $inputs['a5'] ?? '10';
            $this->z5 = $inputs['z5'] ?? '11';
            $this->a6 = $inputs['a6'] ?? '12';
            $this->z6 = $inputs['z6'] ?? '13';
            $this->a7 = $inputs['a7'] ?? '14';
            $this->z7 = $inputs['z7'] ?? '15';
            $this->a8 = $inputs['a8'] ?? '16';
            $this->z8 = $inputs['z8'] ?? '17';
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->nbr = '2';
        $this->dil = '3';
        $this->a1 = '2';
        $this->z1 = '3';
        $this->a2 = '4';
        $this->z2 = '5';
        $this->a3 = '6';
        $this->z3 = '7';
        $this->a4 = '8';
        $this->z4 = '9';
        $this->a5 = '10';
        $this->z5 = '11';
        $this->a6 = '12';
        $this->z6 = '13';
        $this->a7 = '14';
        $this->z7 = '15';
        $this->a8 = '16';
        $this->z8 = '17';

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
        $request = (object)[
            'nbr' => $this->nbr,
            'dil' => $this->dil,
            'a1' => $this->a1,
            'z1' => $this->z1,
            'a2' => $this->a2,
            'z2' => $this->z2,
            'a3' => $this->a3,
            'z3' => $this->z3,
            'a4' => $this->a4,
            'z4' => $this->z4,
            'a5' => $this->a5,
            'z5' => $this->z5,
            'a6' => $this->a6,
            'z6' => $this->z6,
            'a7' => $this->a7,
            'z7' => $this->z7,
            'a8' => $this->a8,
            'z8' => $this->z8,
        ];

        $model = new Math();
        $result = $model->dilation($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
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

        $this->error = $result['error'] ?? 'Please! Check Your Input.';
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
        return view('livewire.calculators.dilation-calculator');
    }
}
