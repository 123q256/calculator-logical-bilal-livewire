<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SgpaToPercentageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $calc_type = 'first';
    public $selection = '1';
    public $sgp = '3';
    public $number_of_semesters = '8';
    public $sum = '3.7';
    public $sgpa = ['3'];
    public $rowCount = 1;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calc_type = $inputs['type'] ?? 'first';
            $this->selection = $inputs['selection'] ?? '1';
            $this->sgp = $inputs['sgp'] ?? '3';
            $this->number_of_semesters = $inputs['number_of_semesters'] ?? '8';
            $this->sum = $inputs['sum'] ?? '3.7';
            $this->sgpa = $inputs['sgpa'] ?? ['3'];
            $this->rowCount = max(1, count($this->sgpa));
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->calc_type = 'first';
        $this->selection = '1';
        $this->sgp = '3';
        $this->number_of_semesters = '8';
        $this->sum = '3.7';
        $this->sgpa = ['3'];
        $this->rowCount = 1;

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

    public function addRow()
    {
        if (count($this->sgpa) < 12) {
            $this->sgpa[] = count($this->sgpa) + 1;
            $this->detail = null;
        }
    }

    public function calculate()
    {
        $requestData = [
            'type' => $this->calc_type,
            'selection' => $this->selection,
            'sgp' => $this->sgp,
            'number_of_semesters' => $this->number_of_semesters,
            'sum' => $this->sum,
            'sgpa' => array_values(array_filter($this->sgpa, fn($v) => $v !== '' && $v !== null)),
        ];
        
        array_walk_recursive($requestData, function (&$item) {
            if (is_float($item)) $item = (string) $item;
        });

        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->sgpa($request);

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
        return view('livewire.calculators.sgpa-to-percentage-calculator');
    }
}
