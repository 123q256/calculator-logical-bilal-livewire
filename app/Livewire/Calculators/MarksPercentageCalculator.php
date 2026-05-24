<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class MarksPercentageCalculator extends Component
{
     public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $type_mode = 'first';
    public $first = '34';
    public $second = '50';
    
    public $sub_name = [''];
    public $s_marks = [''];
    public $a_marks = [''];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->type_mode = $inputs['type'] ?? $this->type_mode;
            $this->first = $inputs['first'] ?? $this->first;
            $this->second = $inputs['second'] ?? $this->second;
            $this->sub_name = $inputs['sub_name'] ?? $this->sub_name;
            $this->s_marks = $inputs['s_marks'] ?? $this->s_marks;
            $this->a_marks = $inputs['a_marks'] ?? $this->a_marks;
        }
    }

    public function addRow()
    {
        if (count($this->sub_name) < 6) {
            $this->sub_name[] = '';
            $this->s_marks[] = '';
            $this->a_marks[] = '';
        } else {
            $this->error = $this->lang['16'] ?? 'Maximum limit reached';
        }
    }

    public function removeRow($index)
    {
        unset($this->sub_name[$index]);
        unset($this->s_marks[$index]);
        unset($this->a_marks[$index]);
        
        $this->sub_name = array_values($this->sub_name);
        $this->s_marks = array_values($this->s_marks);
        $this->a_marks = array_values($this->a_marks);
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->type_mode = 'first';
        $this->first = '34';
        $this->second = '50';
        $this->sub_name = [''];
        $this->s_marks = [''];
        $this->a_marks = [''];

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
            'type' => $this->type_mode,
            'first' => $this->first,
            'second' => $this->second,
            'sub_name' => $this->sub_name,
            's_marks' => $this->s_marks,
            'a_marks' => $this->a_marks,
        ];
        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->marks($request);

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
        return view('livewire.calculators.marks-percentage-calculator');
    }
}
