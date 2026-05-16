<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SlopeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

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
        $this->calc_type = '2';
        $this->x1 = '2';
        $this->y1 = '3';
        $this->x2 = '4';
        $this->y2 = '5';
        $this->dis = '13';
        $this->m = '';
        $this->angle = '5';
        $this->x = '3';
        $this->y = '-9';
        $this->b = '11';

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
        $this->detail = null;
        $this->error = null;
    }

    public $calc_type = '2';
    public $x1 = '2';
    public $y1 = '3';
    public $x2 = '4';
    public $y2 = '5';
    public $dis = '13';
    public $m = '';
    public $angle = '5';
    public $x = '3';
    public $y = '-9';
    public $b = '11';

    public $renderCount = 0;

    public function calculate()
    {
        $request = request();
        $request->merge([
            'type' => $this->calc_type,
            'x1' => $this->x1,
            'x2' => $this->x2,
            'y1' => $this->y1,
            'y2' => $this->y2,
            'dis' => $this->dis,
            'm' => $this->m,
            'angle' => $this->angle,
            'x' => $this->x,
            'y' => $this->y,
            'b' => $this->b,
        ]);

        $model = new Math();
        $result = $model->slope($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->renderCount++;
            $result['calc_type'] = $this->calc_type;
            
            // Prepare chart data based on type
            $chartData = ['type' => $this->calc_type];
            
            if ($this->calc_type == '2' || $this->calc_type == '3') {
                $x1 = (float)$this->x1;
                $y1 = (float)$this->y1;
                $x2 = (float)($this->calc_type == '2' ? $this->x2 : ($result['x2'] ?? 0));
                $y2 = (float)($this->calc_type == '2' ? $this->y2 : ($result['y2'] ?? 0));
                
                // Better bounding box: focus on the points
                $minX = min($x1, $x2); $maxX = max($x1, $x2);
                $minY = min($y1, $y2); $maxY = max($y1, $y2);
                $padX = max(abs($maxX - $minX) * 0.5, 5);
                $padY = max(abs($maxY - $minY) * 0.5, 5);
                
                $chartData['box1'] = [
                    'bounds' => [$minX - $padX, $maxY + $padY, $maxX + $padX, $minY - $padY],
                    'p1' => [$x1, $y1],
                    'p2' => [$x2, $y2]
                ];
            } elseif ($this->calc_type == '1') {
                // Right box (box1)
                $x2r = (float)($result['x2r'] ?? 0); $y2r = (float)($result['y2r'] ?? 0);
                $xr = (float)($result['xr'] ?? 0); $yr = (float)($result['yr'] ?? 0);
                
                $minXr = min($xr, $x2r); $maxXr = max($xr, $x2r);
                $minYr = min($yr, $y2r); $maxYr = max($yr, $y2r);
                $padXr = max(abs($maxXr - $minXr) * 0.5, 5);
                $padYr = max(abs($maxYr - $minYr) * 0.5, 5);
                
                $chartData['box1'] = [
                    'bounds' => [$minXr - $padXr, $maxYr + $padYr, $maxXr + $padXr, $minYr - $padYr],
                    'p1' => [$xr, $yr],
                    'p2' => [$x2r, $y2r]
                ];
                
                // Left box (box)
                $x2l = (float)($result['x2l'] ?? 0); $y2l = (float)($result['y2l'] ?? 0);
                $xl = (float)($result['xl'] ?? 0); $yl = (float)($result['yl'] ?? 0);
                
                $minXl = min($xl, $x2l); $maxXl = max($xl, $x2l);
                $minYl = min($yl, $y2l); $maxYl = max($yl, $y2l);
                $padXl = max(abs($maxXl - $minXl) * 0.5, 5);
                $padYl = max(abs($maxYl - $minYl) * 0.5, 5);
                
                $chartData['box'] = [
                    'bounds' => [$minXl - $padXl, $maxYl + $padYl, $maxXl + $padXl, $minYl - $padYl],
                    'p1' => [$xl, $yl],
                    'p2' => [$x2l, $y2l]
                ];
            }

            $result['chartData'] = json_encode($chartData);
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            $this->dispatch('chartUpdated', $chartData);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (window.MathJax) MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 150);
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.slope-calculator');
    }
}
