<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class AngleBetweenTwoVectorsCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $dimen = '3d';
    public $a_rep = 'coor';
    public $b_rep = 'coor';
    public $ax = '3';
    public $ay = '4';
    public $az = '5';
    public $a1 = '3';
    public $a2 = '4';
    public $a3 = '5';
    public $b1 = '5';
    public $b2 = '6';
    public $b3 = '11';
    public $bx = '3';
    public $by = '4';
    public $bz = '5';
    public $aa1 = '3';
    public $aa2 = '4';
    public $aa3 = '5';
    public $bb1 = '4';
    public $bb2 = '9';
    public $bb3 = '12';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->dimen = $inputs['dimen'] ?? '3d';
            $this->a_rep = $inputs['a_rep'] ?? 'coor';
            $this->b_rep = $inputs['b_rep'] ?? 'coor';
            $this->ax = $inputs['ax'] ?? '3';
            $this->ay = $inputs['ay'] ?? '4';
            $this->az = $inputs['az'] ?? '5';
            $this->a1 = $inputs['a1'] ?? '3';
            $this->a2 = $inputs['a2'] ?? '4';
            $this->a3 = $inputs['a3'] ?? '5';
            $this->b1 = $inputs['b1'] ?? '5';
            $this->b2 = $inputs['b2'] ?? '6';
            $this->b3 = $inputs['b3'] ?? '11';
            $this->bx = $inputs['bx'] ?? '3';
            $this->by = $inputs['by'] ?? '4';
            $this->bz = $inputs['bz'] ?? '5';
            $this->aa1 = $inputs['aa1'] ?? '3';
            $this->aa2 = $inputs['aa2'] ?? '4';
            $this->aa3 = $inputs['aa3'] ?? '5';
            $this->bb1 = $inputs['bb1'] ?? '4';
            $this->bb2 = $inputs['bb2'] ?? '9';
            $this->bb3 = $inputs['bb3'] ?? '12';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->dimen = '3d';
        $this->a_rep = 'coor';
        $this->b_rep = 'coor';
        $this->ax = '3';
        $this->ay = '4';
        $this->az = '5';
        $this->a1 = '3';
        $this->a2 = '4';
        $this->a3 = '5';
        $this->b1 = '5';
        $this->b2 = '6';
        $this->b3 = '11';
        $this->bx = '3';
        $this->by = '4';
        $this->bz = '5';
        $this->aa1 = '3';
        $this->aa2 = '4';
        $this->aa3 = '5';
        $this->bb1 = '4';
        $this->bb2 = '9';
        $this->bb3 = '12';

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
        $this->dispatch('math-updated');
    }

    public function is3D() { return $this->dimen === '3d'; }
    public function showACoor() { return $this->a_rep === 'coor'; }
    public function showAPoints() { return $this->a_rep === 'point'; }
    public function showBCoor() { return $this->b_rep === 'coor'; }
    public function showBPoints() { return $this->b_rep === 'point'; }

    public function calculate()
    {
        $request = (object)[
            'dimen' => $this->dimen,
            'a_rep' => $this->a_rep,
            'b_rep' => $this->b_rep,
            'ax' => $this->ax,
            'ay' => $this->ay,
            'az' => $this->az,
            'a1' => $this->a1,
            'a2' => $this->a2,
            'a3' => $this->a3,
            'b1' => $this->b1,
            'b2' => $this->b2,
            'b3' => $this->b3,
            'bx' => $this->bx,
            'by' => $this->by,
            'bz' => $this->bz,
            'aa1' => $this->aa1,
            'aa2' => $this->aa2,
            'aa3' => $this->aa3,
            'bb1' => $this->bb1,
            'bb2' => $this->bb2,
            'bb3' => $this->bb3,
        ];

        $model = new Math();
        $result = $model->angle($request);

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
        return view('livewire.calculators.angle-between-two-vectors-calculator');
    }
}
