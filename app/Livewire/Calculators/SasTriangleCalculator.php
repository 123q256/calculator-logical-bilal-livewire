<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SasTriangleCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $first = 5;
    public $unit1 = 'm';
    public $second = 3;
    public $unit2 = 'cm';
    public $third = 2;
    public $unit3 = 'pi';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->first = $inputs['first'] ?? 5;
            $this->unit1 = $inputs['unit1'] ?? 'm';
            $this->second = $inputs['second'] ?? 3;
            $this->unit2 = $inputs['unit2'] ?? 'cm';
            $this->third = $inputs['third'] ?? 2;
            $this->unit3 = $inputs['unit3'] ?? 'pi';
        }
    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;
        $this->reset(['first', 'unit1', 'second', 'unit2', 'third', 'unit3']);

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
        $request = (object)[
            'first' => $this->first,
            'unit1' => $this->unit1,
            'second' => $this->second,
            'unit2' => $this->unit2,
            'third' => $this->third,
            'unit3' => $this->unit3,
        ];

        $model = new Math();
        $result = $model->sas($request);

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
    
        return view('livewire.calculators.sas-triangle-calculator');
    }
}
