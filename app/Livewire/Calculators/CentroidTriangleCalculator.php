<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class CentroidTriangleCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $shap = '3';
    public $total = 3;
    public $points = [];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $this->points = [
            1 => ['x' => 7, 'y' => 5],
            2 => ['x' => 5, 'y' => 2],
            3 => ['x' => 9, 'y' => 11],
        ];

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            if (isset($inputs['shap'])) $this->shap = $inputs['shap'];
            if (isset($inputs['total'])) $this->total = $inputs['total'];
            for ($i = 1; $i <= 10; $i++) {
                if (isset($inputs['x' . $i])) $this->points[$i]['x'] = $inputs['x' . $i];
                if (isset($inputs['y' . $i])) $this->points[$i]['y'] = $inputs['y' . $i];
            }
        }
    }

  public function resetForm()
    {
        $this->shap = '3';
        $this->total = 3;
        $this->points = [
            1 => ['x' => 7, 'y' => 5],
            2 => ['x' => 5, 'y' => 2],
            3 => ['x' => 9, 'y' => 11],
        ];
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

  public function updated($propertyName)
    {
        if ($propertyName == 'shap') {
            if ($this->shap == '3') {
                $this->total = 3;
            }
        }

        if ($propertyName == 'total' || $propertyName == 'shap') {
             $limit = ($this->shap == '3') ? 3 : $this->total;
             for ($i = 1; $i <= $limit; $i++) {
                 if (!isset($this->points[$i])) {
                     $this->points[$i] = ['x' => $i * 2, 'y' => $i * 4];
                 }
             }
        }

        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $data = [
            'shap' => $this->shap,
            'total' => $this->total,
        ];

        $limit = ($this->shap == '3') ? 3 : $this->total;
        for ($i = 1; $i <= $limit; $i++) {
            $data['x' . $i] = $this->points[$i]['x'] ?? 0;
            $data['y' . $i] = $this->points[$i]['y'] ?? 0;
        }
        
        // For triangle case, model expects x1,y1,x2,y2,x3,y3 explicitly
        $request = (object)$data;

        $model = new Math();
        $result = $model->centroid($request);

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
        return view('livewire.calculators.centroid-triangle-calculator');
    }
}
