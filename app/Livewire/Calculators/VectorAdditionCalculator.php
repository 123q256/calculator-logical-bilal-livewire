<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class VectorAdditionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $calculation = '3D';
    public $operation = '1';
    public $alpha = '7';
    public $beta = '7';
    public $vectora_representation = '1';
    public $ax = '3', $ay = '4', $az = '5';
    public $magnitude_x = '3', $direction_x = '4', $direction_x_unit = 'rad';
    public $vectorb_representation = '1';
    public $bx = '3', $by = '4', $bz = '5';
    public $magnitude_y = '3', $direction_y = '4', $direction_y_unit = 'rad';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calculation = $inputs['calculation'] ?? '3D';
            $this->operation = $inputs['operation'] ?? '1';
            $this->alpha = $inputs['alpha'] ?? '7';
            $this->beta = $inputs['beta'] ?? '7';
            $this->vectora_representation = $inputs['vectora_representation'] ?? '1';
            $this->ax = $inputs['ax'] ?? '3';
            $this->ay = $inputs['ay'] ?? '4';
            $this->az = $inputs['az'] ?? '5';
            $this->magnitude_x = $inputs['magnitude_x'] ?? '3';
            $this->direction_x = $inputs['direction_x'] ?? '4';
            $this->direction_x_unit = $inputs['direction_x_unit'] ?? 'rad';
            $this->vectorb_representation = $inputs['vectorb_representation'] ?? '1';
            $this->bx = $inputs['bx'] ?? '3';
            $this->by = $inputs['by'] ?? '4';
            $this->bz = $inputs['bz'] ?? '5';
            $this->magnitude_y = $inputs['magnitude_y'] ?? '3';
            $this->direction_y = $inputs['direction_y'] ?? '4';
            $this->direction_y_unit = $inputs['direction_y_unit'] ?? 'rad';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->calculation = '3D';
        $this->operation = '1';
        $this->alpha = '7';
        $this->beta = '7';
        $this->vectora_representation = '1';
        $this->ax = '3'; $this->ay = '4'; $this->az = '5';
        $this->magnitude_x = '3'; $this->direction_x = '4'; $this->direction_x_unit = 'rad';
        $this->vectorb_representation = '1';
        $this->bx = '3'; $this->by = '4'; $this->bz = '5';
        $this->magnitude_y = '3'; $this->direction_y = '4'; $this->direction_y_unit = 'rad';

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
            'calculation' => $this->calculation,
            'operation' => $this->operation,
            'alpha' => $this->alpha,
            'beta' => $this->beta,
            'vectora_representation' => $this->vectora_representation,
            'ax' => $this->ax,
            'ay' => $this->ay,
            'az' => $this->az,
            'magnitude_x' => $this->magnitude_x,
            'direction_x' => $this->direction_x,
            'direction_x_unit' => $this->direction_x_unit,
            'vectorb_representation' => $this->vectorb_representation,
            'bx' => $this->bx,
            'by' => $this->by,
            'bz' => $this->bz,
            'magnitude_y' => $this->magnitude_y,
            'direction_y' => $this->direction_y,
            'direction_y_unit' => $this->direction_y_unit,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->vector_addition($request);

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
        return view('livewire.calculators.vector-addition-calculator');
    }
}
