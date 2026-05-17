<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class DoubleAngleCalculator extends Component
{
   public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $unit = '1';
    public $angle = '45';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        if (is_array($this->detail)) {
            foreach ($this->detail as $key => $value) {
                if (is_float($value)) {
                    $this->detail[$key] = (string)round($value, 10);
                }
            }
        }
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->unit = $inputs['unit'] ?? '1';
            $this->angle = $inputs['angle'] ?? '45';
        }
    }

  public function resetForm()
    {

        $this->error = null;
        $this->detail = null;
        $this->unit = '1';
        $this->angle = '45';

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
        $inputs = [
            'unit' => $this->unit,
            'angle' => $this->angle,
        ];

        $model = new Math();
        $result = $model->double((object)$inputs);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            foreach ($result as $key => $value) {
                if (is_float($value)) {
                    $result[$key] = (string)round($value, 10);
                }
            }
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $inputs);
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
        return view('livewire.calculators.double-angle-calculator');
    }
}
