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

  public function updated()
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
            $result['calc_type'] = $this->calc_type;
            $result['x1_used'] = $this->x1;
            $result['x2_used'] = $this->x2;
            $result['y1_used'] = $this->y1;
            $result['y2_used'] = $this->y2;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request->all());
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                
                $jsPayload = '';
                if ($this->calc_type == '2') {
                    $tx2 = ($this->x2 < 0) ? ($this->x2 - 10) : ((-1 * floatval($this->x2)) + 10);
                    $tx1 = ($this->x1 < 0) ? (($this->x1 - 10) * -1) : ($this->x1 + 10);
                    $ty2 = ($this->y2 < 0) ? ($this->y2 - 10) : ((-1 * floatval($this->y2)) + 10);
                    $ty1 = ($this->y1 < 0) ? (($this->y1 - 10) * -1) : ($this->y1 + 10);
                    $jsPayload = "
                        if (document.getElementById('box1')) {
                            if (JXG.JSXGraph.boards['box1']) JXG.JSXGraph.freeBoard(JXG.JSXGraph.boards['box1']);
                            document.getElementById('box1').innerHTML = '';
                            var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [{$tx2}, {$ty1}, {$tx1}, {$ty2}], axis:true});
                            var p1 = board.create('point', [{$this->x1}, {$this->y1}]);
                            var p2 = board.create('point', [{$this->x2}, {$this->y2}]);
                            var l1 = board.create('line', [p1, p2]);
                        }
                    ";
                } elseif ($this->calc_type == '3') {
                    $nx2 = $result['x2'] ?? 0;
                    $ny2 = $result['y2'] ?? 0;
                    $tx2 = ($nx2 < 0) ? ($nx2 - 10) : ((-1 * floatval($nx2)) + 10);
                    $tx1 = ($this->x1 < 0) ? (($this->x1 - 10) * -1) : ($this->x1 + 10);
                    $ty2 = ($ny2 < 0) ? ($ny2 - 10) : ((-1 * floatval($ny2)) + 10);
                    $ty1 = ($this->y1 < 0) ? (($this->y1 - 10) * -1) : ($this->y1 + 10);
                    $jsPayload = "
                        if (document.getElementById('box1')) {
                            if (JXG.JSXGraph.boards['box1']) JXG.JSXGraph.freeBoard(JXG.JSXGraph.boards['box1']);
                            document.getElementById('box1').innerHTML = '';
                            var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [{$tx2}, {$ty1}, {$tx1}, {$ty2}], axis:true});
                            var p1 = board.create('point', [{$this->x1}, {$this->y1}]);
                            var p2 = board.create('point', [{$nx2}, {$ny2}]);
                            var l1 = board.create('line', [p1, p2]);
                        }
                    ";
                } elseif ($this->calc_type == '1') {
                    $x2r = $result['x2r'] ?? 0; $y2r = $result['y2r'] ?? 0;
                    $xr = $result['xr'] ?? 0; $yr = $result['yr'] ?? 0;
                    $tx2r = ($x2r < 0) ? ($x2r - 10) : ((-1 * floatval($x2r)) + 10);
                    $txr = ($xr < 0) ? (($xr - 10) * -1) : ($xr + 10);
                    $ty2r = ($y2r < 0) ? ($y2r - 10) : ((-1 * floatval($y2r)) + 10);
                    $tyr = ($yr < 0) ? (($yr - 10) * -1) : ($yr + 10);
                    
                    $x2l = $result['x2l'] ?? 0; $y2l = $result['y2l'] ?? 0;
                    $xl = $result['xl'] ?? 0; $yl = $result['yl'] ?? 0;
                    $tx2l = ($x2l < 0) ? ($x2l - 10) : ((-1 * floatval($x2l)) + 10);
                    $txl = ($xl < 0) ? (($xl - 10) * -1) : ($xl + 10);
                    $ty2l = ($y2l < 0) ? ($y2l - 10) : ((-1 * floatval($y2l)) + 10);
                    $tyl = ($yl < 0) ? (($yl - 10) * -1) : ($yl + 10);

                    $jsPayload = "
                        if (document.getElementById('box1')) {
                            if (JXG.JSXGraph.boards['box1']) JXG.JSXGraph.freeBoard(JXG.JSXGraph.boards['box1']);
                            document.getElementById('box1').innerHTML = '';
                            var board1 = JXG.JSXGraph.initBoard('box1', {boundingbox: [{$tx2r}, {$tyr}, {$txr}, {$ty2r}], axis:true});
                            var p1_1 = board1.create('point', [{$xr}, {$yr}]);
                            var p2_1 = board1.create('point', [{$x2r}, {$y2r}]);
                            var l1_1 = board1.create('line', [p1_1, p2_1]);
                        }
                        if (document.getElementById('box')) {
                            if (JXG.JSXGraph.boards['box']) JXG.JSXGraph.freeBoard(JXG.JSXGraph.boards['box']);
                            document.getElementById('box').innerHTML = '';
                            var board2 = JXG.JSXGraph.initBoard('box', {boundingbox: [{$tx2l}, {$tyl}, {$txl}, {$ty2l}], axis:true});
                            var p1_2 = board2.create('point', [{$xl}, {$yl}]);
                            var p2_2 = board2.create('point', [{$x2l}, {$y2l}]);
                            var l1_2 = board2.create('line', [p1_2, p2_2]);
                        }
                    ";
                }

                $this->js(<<<JS
                    setTimeout(() => {
                        if (window.MathJax) {
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        }
                        if (typeof JXG !== 'undefined') {
                            {$jsPayload}
                        }
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
