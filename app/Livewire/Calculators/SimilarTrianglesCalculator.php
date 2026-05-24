<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SimilarTrianglesCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $calc_type = '1';
    public $similarity = 'SSS';
    public $ABC_f = '15';
    public $ABC_f_unit = 'cm';
    public $ABC_f_deg_rad = 'rad';
    public $ABC_s = '15';
    public $ABC_s_unit = 'cm';
    public $ABC_s_deg_rad = 'rad';
    public $ABC_t = '15';
    public $ABC_t_unit = 'cm';
    public $ABC_t_deg_rad = 'rad';
    public $ABC_corresponding = '12';
    public $ABC_corresponding_unit = 'cm';
    public $scale_factor = '14';
    public $DEF_f = '15';
    public $DEF_f_unit = 'cm';
    public $DEF_f_deg_rad = 'rad';
    public $DEF_s = '15';
    public $DEF_s_unit = 'cm';
    public $DEF_s_deg_rad = 'rad';
    public $DEF_t = '15';
    public $DEF_t_unit = 'cm';
    public $DEF_t_deg_rad = 'rad';
    public $DEF_corresponding = '21';
    public $DEF_corresponding_unit = 'kg';


  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

        }
    }

    public function resetForm()
    {
        $lang = $this->lang;
        $type = $this->type;
        $this->reset();
        $this->lang = $lang;
        $this->type = $type;
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
        $requestData = get_object_vars($this);
        // Map calc_type to type for the Math model
        $requestData['type'] = $this->calc_type;
        $request = new \Illuminate\Http\Request();
        $request->replace($requestData);

        $model = new Math();
        $result = $model->similar($request);

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
        return view('livewire.calculators.similar-triangles-calculator');
    }
}
