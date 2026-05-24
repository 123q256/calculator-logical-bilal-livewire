<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class VennDiagramCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $selection = 'twoset';
    
    // 2-Set Properties
    public $venn_name = 'Venn diagram 2 Set';
    public $ta = 'A';
    public $tb = 'B';
    public $a = '10';
    public $b = '20';
    public $u = '30';
    public $c = '40';

    // 3-Set Properties
    public $venn_name3 = 'Venn diagram 3 Set';
    public $ta3 = 'A';
    public $tb3 = 'B';
    public $tc3 = 'C';
    public $a3 = '10';
    public $b3 = '20';
    public $c3 = '30';
    public $u3 = '40';
    public $anb3 = '50';
    public $bnc3 = '60';
    public $cna3 = '70';
    public $anbnc = '80';

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->selection = $inputs['selection'] ?? 'twoset';
            $this->venn_name = $inputs['venn_name'] ?? 'Venn diagram 2 Set';
            $this->ta = $inputs['ta'] ?? 'A';
            $this->tb = $inputs['tb'] ?? 'B';
            $this->a = $inputs['a'] ?? '10';
            $this->b = $inputs['b'] ?? '20';
            $this->u = $inputs['u'] ?? '30';
            $this->c = $inputs['c'] ?? '40';

            $this->venn_name3 = $inputs['venn_name3'] ?? 'Venn diagram 3 Set';
            $this->ta3 = $inputs['ta3'] ?? 'A';
            $this->tb3 = $inputs['tb3'] ?? 'B';
            $this->tc3 = $inputs['tc3'] ?? 'C';
            $this->a3 = $inputs['a3'] ?? '10';
            $this->b3 = $inputs['b3'] ?? '20';
            $this->c3 = $inputs['c3'] ?? '30';
            $this->u3 = $inputs['u3'] ?? '40';
            $this->anb3 = $inputs['anb3'] ?? '50';
            $this->bnc3 = $inputs['bnc3'] ?? '60';
            $this->cna3 = $inputs['cna3'] ?? '70';
            $this->anbnc = $inputs['anbnc'] ?? '80';
        }
    }

  public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->selection = 'twoset';
        $this->venn_name = 'Venn diagram 2 Set';
        $this->ta = 'A';
        $this->tb = 'B';
        $this->a = '10';
        $this->b = '20';
        $this->u = '30';
        $this->c = '40';

        $this->venn_name3 = 'Venn diagram 3 Set';
        $this->ta3 = 'A';
        $this->tb3 = 'B';
        $this->tc3 = 'C';
        $this->a3 = '10';
        $this->b3 = '20';
        $this->c3 = '30';
        $this->u3 = '40';
        $this->anb3 = '50';
        $this->bnc3 = '60';
        $this->cna3 = '70';
        $this->anbnc = '80';

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
            'selection' => $this->selection,
            'venn_name' => $this->venn_name,
            'ta' => $this->ta,
            'tb' => $this->tb,
            'a' => $this->a,
            'b' => $this->b,
            'u' => $this->u,
            'c' => $this->c,
            'venn_name3' => $this->venn_name3,
            'ta3' => $this->ta3,
            'tb3' => $this->tb3,
            'tc3' => $this->tc3,
            'a3' => $this->a3,
            'b3' => $this->b3,
            'c3' => $this->c3,
            'u3' => $this->u3,
            'anb3' => $this->anb3,
            'bnc3' => $this->bnc3,
            'cna3' => $this->cna3,
            'anbnc' => $this->anbnc,
        ];
        
        array_walk_recursive($requestData, function (&$item) {
            if (is_float($item)) $item = (string) $item;
        });

        $request = new \Illuminate\Http\Request($requestData);

        $model = new Math();
        $result = $model->venn($request);

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
        return view('livewire.calculators.venn-diagram-calculator');
    }
}
