<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;
use Illuminate\Http\Request;

class RebarCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $first = 3;
    public $units1 = 'cm';
    public $second = 4;
    public $units2 = 'cm';
    public $third = 5;
    public $units3 = 'mm';
    public $four = 6;
    public $units4 = 'mm';
    public $five = 5;
    public $units5 = 'cm';
    public $six = 5;
    public $units6 = 'cm';

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        if (!empty($currancy)) {
            $this->currancy = $currancy;
        }

        // Restore state if the page was reloaded (Legacy mode)
        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }
        if (session()->has('validation_error')) {
            $this->error = session('validation_error');
        }
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->first = $inputs->input('first') ?? $this->first;
            $this->units1 = $inputs->input('units1') ?? $this->units1;
            $this->second = $inputs->input('second') ?? $this->second;
            $this->units2 = $inputs->input('units2') ?? $this->units2;
            $this->third = $inputs->input('third') ?? $this->third;
            $this->units3 = $inputs->input('units3') ?? $this->units3;
            $this->four = $inputs->input('four') ?? $this->four;
            $this->units4 = $inputs->input('units4') ?? $this->units4;
            $this->five = $inputs->input('five') ?? $this->five;
            $this->units5 = $inputs->input('units5') ?? $this->units5;
            $this->six = $inputs->input('six') ?? $this->six;
            $this->units6 = $inputs->input('units6') ?? $this->units6;
        }
    }

    public function calculate()
    {
        $request = new Request();
        $request->replace([
            'first'    => $this->first,
            'units1'   => $this->units1,
            'second'   => $this->second,
            'units2'   => $this->units2,
            'third'    => $this->third,
            'units3'   => $this->units3,
            'four'     => $this->four,
            'units4'   => $this->units4,
            'five'     => $this->five,
            'units5'   => $this->units5,
            'six'      => $this->six,
            'units6'   => $this->units6,
            'currancy' => $this->currancy,
        ]);

        $model = new Construction();
        $result = $model->rebar($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['first', 'units1', 'second', 'units2', 'third', 'units3', 'four', 'units4', 'five', 'units5', 'six', 'units6', 'error', 'detail']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'validation_error', 'scroll_to_result', 'calculator_back_inputs']);
            return redirect()->to(url()->previous() ?? '/');
        }
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
        return view('livewire.calculators.rebar-calculator');
    }
}
