<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class MidpointCalculator extends Component
{
    public $x1 = '9';
    public $y1 = '13';
    public $x2 = '15';
    public $y2 = '-9';
    
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
            $this->x1 = $inputs['x1'] ?? '9';
            $this->y1 = $inputs['y1'] ?? '13';
            $this->x2 = $inputs['x2'] ?? '15';
            $this->y2 = $inputs['y2'] ?? '-9';
        }
    }

    public function resetForm()
    {
        $this->x1 = '9';
        $this->y1 = '13';
        $this->x2 = '15';
        $this->y2 = '-9';
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

    public $renderCount = 0;

    public function calculate()
    {
        $this->validate([
            'x1' => 'required|numeric',
            'y1' => 'required|numeric',
            'x2' => 'required|numeric',
            'y2' => 'required|numeric',
        ]);

        $request = (object)[
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x2' => $this->x2,
            'y2' => $this->y2,
        ];

        $model = new Math();
        $result = $model->midpoint($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->renderCount++;
            
            // Better bounding box: focus on the points
            $x1 = (float)$this->x1; $y1 = (float)$this->y1;
            $x2 = (float)$this->x2; $y2 = (float)$this->y2;
            $mx = (float)$result['x']; $my = (float)$result['y'];

            $minX = min($x1, $x2, $mx); $maxX = max($x1, $x2, $mx);
            $minY = min($y1, $y2, $my); $maxY = max($y1, $y2, $my);
            $padX = max(abs($maxX - $minX) * 0.5, 5);
            $padY = max(abs($maxY - $minY) * 0.5, 5);

            $chartData = [
                'bounds' => [$minX - $padX, $maxY + $padY, $maxX + $padX, $minY - $padY],
                'p1' => [$x1, $y1],
                'p2' => [$x2, $y2],
                'mid' => [$mx, $my],
            ];
            
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.midpoint-calculator');
    }
}
