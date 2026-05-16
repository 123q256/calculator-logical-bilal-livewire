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
            $result['x1_used'] = $this->x1;
            $result['y1_used'] = $this->y1;
            $result['x2_used'] = $this->x2;
            $result['y2_used'] = $this->y2;
            
            // Critical: Use a numeric array to avoid double quotes in the HTML attribute.
            // This prevents the x-data attribute from breaking and rendering as text.
            $result['chartData'] = json_encode([
                (float)$this->x1,
                (float)$this->y1,
                (float)$this->x2,
                (float)$this->y2,
                (float)$result['x'],
                (float)$result['y']
            ]);

            // Critical: Calculate bounding box values in PHP to match legacy logic exactly
            $x2_bound = (($this->x2 < 0) ? $this->x2 - 10 : "-" . $this->x2 + 10);
            $x1_bound = (($this->x1 < 0) ? ($this->x1 - 10) * (-1) : $this->x1 + 10);
            $y2_bound = (($this->y2 < 0) ? $this->y2 - 10 : "-" . $this->y2 + 10);
            $y1_bound = (($this->y1 < 0) ? ($this->y1 - 10) * (-1) : $this->y1 + 10);

            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);

            $x2_bound = (($this->x2 < 0) ? $this->x2 - 10 : "-" . $this->x2 + 10);
            $x1_bound = (($this->x1 < 0) ? ($this->x1 - 10) * (-1) : $this->x1 + 10);
            $y2_bound = (($this->y2 < 0) ? $this->y2 - 10 : "-" . $this->y2 + 10);
            $y1_bound = (($this->y1 < 0) ? ($this->y1 - 10) * (-1) : $this->y1 + 10);

            $this->js(<<<JS
                setTimeout(() => {
                    if (typeof JXG !== 'undefined' && document.getElementById('box1')) {
                        if (JXG.JSXGraph.boards['box1']) {
                            JXG.JSXGraph.freeBoard(JXG.JSXGraph.boards['box1']);
                        }
                        document.getElementById('box1').innerHTML = '';
                        var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [{$x2_bound}, {$y1_bound}, {$x1_bound}, {$y2_bound}], axis:true});
                        var p1 = board.create('point', [{$this->x1}, {$this->y1}], {name:'X',size:4});
                        var p2 = board.create('point', [{$this->x2}, {$this->y2}], {name:'Y',size:4});
                        var p3 = board.create('point', [{$result['x']}, {$result['y']}], {name:'Midpoint',size:4});
                        board.create('line', [p1, p2]);
                    }
                }, 200);
            JS);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
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
