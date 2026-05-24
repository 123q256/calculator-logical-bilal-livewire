<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SurfaceAreaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $operations = '3';
    public $shape = '1';
    public $first = '12';
    public $unit1 = 'm';
    public $second = '7';
    public $unit2 = 'm';
    public $third = '7';
    public $unit3 = 'm';
    public $four = '7';
    public $unit4 = 'm';
    public $pi = '3.141593';
    public $circle_unit_result = 'cm²';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->operations = $inputs['operations'] ?? $this->operations;
            $this->shape = $inputs['shape'] ?? $this->shape;
            $this->first = $inputs['first'] ?? $this->first;
            $this->unit1 = $inputs['unit1'] ?? $this->unit1;
            $this->second = $inputs['second'] ?? $this->second;
            $this->unit2 = $inputs['unit2'] ?? $this->unit2;
            $this->third = $inputs['third'] ?? $this->third;
            $this->unit3 = $inputs['unit3'] ?? $this->unit3;
            $this->four = $inputs['four'] ?? $this->four;
            $this->unit4 = $inputs['unit4'] ?? $this->unit4;
            $this->pi = $inputs['pi'] ?? $this->pi;
            $this->circle_unit_result = $inputs['circle_unit_result'] ?? $this->circle_unit_result;
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->operations = '3';
        $this->shape = '1';
        $this->first = '12';
        $this->unit1 = 'm';
        $this->second = '7';
        $this->unit2 = 'm';
        $this->third = '7';
        $this->unit3 = 'm';
        $this->four = '7';
        $this->unit4 = 'm';
        $this->pi = '3.141593';
        $this->circle_unit_result = 'cm²';

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
            'operations' => $this->operations,
            'shape' => $this->shape,
            'first' => $this->first,
            'unit1' => $this->unit1,
            'second' => $this->second,
            'unit2' => $this->unit2,
            'third' => $this->third,
            'unit3' => $this->unit3,
            'four' => $this->four,
            'unit4' => $this->unit4,
            'pi' => $this->pi,
            'circle_unit_result' => $this->circle_unit_result,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->surface_area($request);

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
        return view('livewire.calculators.surface-area-calculator');
    }
}
