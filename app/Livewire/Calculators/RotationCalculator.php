<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class RotationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $point_rotate_one = 1;
    public $point_rotate_two = 2;
    public $angle = 45;
    public $unit = 'radians';
    public $point_around_one = 56;
    public $point_around_two = 90;
    public $direction = 'anticlockwise';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->point_rotate_one = $inputs['point_rotate_one'] ?? 1;
            $this->point_rotate_two = $inputs['point_rotate_two'] ?? 2;
            $this->angle = $inputs['angle'] ?? 45;
            $this->unit = $inputs['unit'] ?? 'radians';
            $this->point_around_one = $inputs['point_around_one'] ?? 56;
            $this->point_around_two = $inputs['point_around_two'] ?? 90;
            $this->direction = $inputs['direction'] ?? 'anticlockwise';
        }
    }

  public function resetForm()
    {

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
        $request = (object)[
            'point_rotate_one' => $this->point_rotate_one,
            'point_rotate_two' => $this->point_rotate_two,
            'angle' => $this->angle,
            'unit' => $this->unit,
            'point_around_one' => $this->point_around_one,
            'point_around_two' => $this->point_around_two,
            'direction' => $this->direction,
        ];

        $model = new Math();
        $result = $model->rotation($request);

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
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
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
        return view('livewire.calculators.rotation-calculator');
    }
}
