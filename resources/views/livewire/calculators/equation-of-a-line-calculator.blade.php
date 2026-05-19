<div>

 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="type" id="type" wire:model.live="type">
                        <option value="2">{{ $lang['2'] }}</option>
                        <option value="1">{{ $lang['3'] }}(m)</option>
                        <option value="3">{{ $lang['4'] }} (b) & {{ $lang['5'] }} (m)</option>
                        <option value="4">{{ $lang['6'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="x1" class="font-s-14 text-blue m">
                    @if($type == '3')
                        Intercept (c):
                    @else
                        X<sub class="text-blue font-s-12">1</sub>:
                    @endif
                </label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x1" id="x1" class="input" wire:model.live="x1" aria-label="input" />
                </div>
            </div>
            
            @if($type != '3')
            <div class="col-span-6 second">
                <label for="y1" class="font-s-14 text-blue">Y<sub class="text-blue font-s-12">1</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y1" id="y1" class="input" wire:model.live="y1" aria-label="input" />
                </div>
            </div>
            @endif
            
            <div class="col-span-6">
                <label for="x2" class="font-s-14 text-blue slope">
                    @if($type == '1')
                        Slope:
                    @elseif($type == '3')
                        Slope (m):
                    @else
                        X<sub class="text-blue font-s-12">2</sub>:
                    @endif
                </label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x2" id="x2" class="input" wire:model.live="x2" aria-label="input" />
                </div>
            </div>
            
            @if($type != '1' && $type != '3')
            <div class="col-span-6 fourth">
                <label for="y2" class="font-s-14 text-blue">Y<sub class="text-blue font-s-12">2</sub></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y2" id="y2" class="input" wire:model.live="y2" aria-label="input" />
                </div>
            </div>
            @endif
            
            @if($type == '4')
            <div class="col-span-6 five_a">
                <label for="x3" class="font-s-14 text-blue">X<sub class="text-blue font-s-12">3</sub></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x3" id="x3" class="input" wire:model.live="x3" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 five_b">
                <label for="y3" class="font-s-14 text-blue">Y<sub class="text-blue font-s-12">3</sub></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y3" id="y3" class="input" wire:model.live="y3" aria-label="input" />
                </div>
            </div>
            @endif
            
        </div>
    </div>
     @if ($componentType == 'calculator')
     @include('inc.button')
    @endif
    @if ($componentType=='widget')
    @include('inc.widget-button')
     @endif
 </div>

    @if(isset($detail) && isset($detail['type']))
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($componentType == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        @if ($detail['type']=='2' || $detail['type']=='1' || $detail['type']=='3')
                            <p class="mt-2 font-s18"><strong>{{ $lang['7'] }}</strong></p>
                            <p class="mt-2">y = mx + c</p>
                            <p class="mt-2">y = {{ $detail['slope'].'x' }} {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</p>
                            <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto mt-2">
                                <table class="w-full font-s-16">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang['5'] }} (m)</td>
                                        <td class="py-2 border-b">{{ (($detail['slope'] != '') ? $detail['slope'] : '0.0') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Y - {{ $lang['4'] }} (b)</td>
                                        <td class="py-2 border-b">{{ $detail['b'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">X - {{ $lang['4'] }}</td>
                                        <td class="py-2 border-b">{{ $detail['x_intercept'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        
                        @if ($detail['type']=='2')
                            <p class="mt-3"><strong>{{ $lang['8'] }}</strong></p>
                            <p class="mt-3">{{ $lang['9'] }} 1:</p>
                            <p class="mt-3"> {{ $lang['10'] }} P = {{ "(".$x1." , ".$y1.") and Q = (".$x2." , ".$y2.")." }}</p>
                            <p class="mt-3">{{ $lang['11'] }} P=(x1,y1) and Q=(x2,y2) {{ $lang['12'] }}</p>
                            <p class="mt-3">\( m=\frac{y2-y1}{x2-x1}\)</p>
                            <p class="mt-3">{{ $lang['13'] }} x1 = {{ $x1." , y1 = ".$y1.", x2 = ".$x2." , y2 = ".$y2 }}</p>
                            <p class="mt-3">{{ $lang['9'] }} 2:</p>
                            <p class="mt-3">{{ $lang['14'] }}:</p>
                            <p class="mt-3">\( m=\frac{ {{ "(".$y2.") - (".$y1.")" }} }{ {{ "(".$x2.") - (".$x1.")" }} }=\frac{ {{ $detail['y'] }} }{ {{ $detail['x'] }} }={{ $detail['slope'] }} \)</p>
                            <p class="mt-3"> {{ $lang['9'] }} 3:</p>
                            <p class="mt-3">{{ $lang['15'] }} b=y1−m⋅x1 (or b=y2−m⋅x2, {{ $lang['16'] }}).</p>
                            <p class="mt-3">b = {{ $y1." - (".$detail['slope'].") ⋅ (".$x1.") = ".$detail['b'] }}</p>
                            <p class="mt-3"> {{ $lang['9'] }} 4:</p>
                            <p class="mt-3">{{ $lang['17'] }} y=mx+b.</p>
                            <p class="mt-3">y = {{ $detail['slope'].'x' }} {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</p>
                            <p class="mt-3">{{ $lang['18'] }}:</p>
                            <p class="mt-3">y = {{ $detail['slope'].'x' }} {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</p>
                            <p class="mt-3">{{ $lang['19'] }}:</p>
                            <p class="mt-3">y - {{ "(".$y1.") = ".$detail['slope']." ⋅ ( x - (".$x1."))" }}</p>
                            <p class="mt-3">{{ $lang['19'] }}:</p>
                            <p class="mt-3">y - {{ "(".$y2.") = ".$detail['slope']." ⋅ ( x - (".$x2."))" }}</p>
                            <p class="mt-3">{{ $lang['20'] }}:</p>
                            <p class="mt-3">{{ $detail['slope'].'x' }} - y {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }} = 0</p>
                            
                            <div wire:ignore x-init="setTimeout(() => { if (typeof drawGraph === 'function') drawGraph('2', '{{ $x1 }}', '{{ $y1 }}', '{{ $x2 }}', '{{ $y2 }}'); }, 200)">
                                <div id="box1" class="col-lg-10 mt-4 mx-auto" style="height: 500px;"></div>
                            </div>
                        @endif
                        
                        @if ($detail['type']=='1')
                            <p class="mt-3"><strong>{{ $lang['8'] }}</strong></p>
                            <p class="mt-3">{{ $lang['9'] }} 1:</p>
                            <p class="mt-3">{{ $lang['21'] }} m = {{ $x2." and the point  P = (".$x1." , ".$y1.")." }}</p>
                            <p class="mt-3">{{ $lang['9'] }} 2:</p>
                            <p class="mt-3">{{ $lang['15'] }} b=y1−m⋅x1</p>
                            <p class="mt-3">b = {{ $y1." - (".$x2.") ⋅ (".$x1.") = ".$detail['b'] }}</p>
                            <p class="mt-3"> {{ $lang['9'] }} 3:</p>
                            <p class="mt-3">{{ $lang['17'] }} y=mx+b.</p>
                            <p class="mt-3">y = {{ $detail['slope'].'x' }} {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</p>
                            <p class="mt-3">{{ $lang['18'] }}:</p>
                            <p class="mt-3">y = {{ $detail['slope'].'x' }} {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</p>
                            <p class="mt-3">{{ $lang['19'] }}:</p>
                            <p class="mt-3">y - {{ "(".$y1.") = ".$detail['slope']." ⋅ ( x - (".$x1."))" }}</p>
                            <p class="mt-3">{{ $lang['20'] }}:</p>
                            <p class="mt-3">{{ $detail['slope'].'x' }} - y {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }} = 0</p>
                            
                            <div wire:ignore x-init="setTimeout(() => { if (typeof drawGraph === 'function') drawGraph('1', '{{ $x1 }}', '{{ $y1 }}', '{{ $x2 }}', '0'); }, 200)">
                                <div id="box2" class="col-lg-10 mt-4 mx-auto" style="height: 500px;"></div>
                            </div>
                        @endif
                        
                        @if ($detail['type']=='3')
                            <p class="mt-3"><strong>{{ $lang['8'] }}</strong></p>
                            <p class="mt-3">{{ $lang['9'] }} 1:</p>
                            <p class="mt-3">m = {{ $detail['slope'].", b = ".$x1 }}</p>
                            <p class="mt-3">y = {{ "(".$detail['slope'].")x + (".$x1.")" }}</p>
                            <p class="mt-3">y = {{ $detail['slope'].'x' }} {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</p>
                            
                            <div wire:ignore x-init="setTimeout(() => { if (typeof drawGraph === 'function') drawGraph('3', '{{ $x1 }}', '0', '0', '0'); }, 200)">
                                <div id="box3" class="col-lg-10 mt-4 mx-auto" style="height: 500px;"></div>
                            </div>
                        @endif
                        
                        @if ($detail['type']=='4')
                            <p class="mt-3"><strong>{{ $lang['22'] }}</strong></p>
                            <p class="mt-3">\( \frac{ {{ "x - (".$x1.")" }} }{ {{ $detail['f_down'] }} }=\frac{ {{ "y - (".$x2.")" }} }{ {{ $detail['s_down'] }} }=\frac{ {{ "z - (".$x3.")" }} }{ {{ $detail['t_down'] }} } \)</p>
                            <p class="mt-3"><strong>{{ $lang['8'] }}</strong></p>
                            <p class="mt-3">{{ $lang['9'] }} 1:</p>
                            <p class="mt-3">{{ $lang['23'] }}:</p>
                            <p class="mt-3">\( \frac{x - xa}{xb - xa}=\frac{y - ya}{yb - ya}=\frac{z - za}{zb - za} \)</p>
                            <p class="mt-3">{{ $lang['9'] }} 2:</p>
                            <p class="mt-3">{{ $lang['24'] }}:</p>
                            <p class="mt-3">\( \frac{ {{ "x - (".$x1.")" }} }{ {{ "(".$y1.") - (".$x1.")" }} }=\frac{ {{ "y - (".$x2.")" }} }{ {{ "(".$y2.") - (".$x2.")" }} }=\frac{ {{ "z - (".$x3.")" }} }{ {{ "(".$y3.") - (".$x3.")" }} } \)</p>
                            <p class="mt-3">{{ $lang['9'] }} 3:</p>
                            <p class="mt-3">{{ $lang['25'] }}:</p>
                            <p class="mt-3">\( \frac{ {{ "x - (".$x1.")" }} }{ {{ $detail['f_down'] }} }=\frac{ {{ "y - (".$x2.")" }} }{ {{ $detail['s_down'] }} }=\frac{ {{ "z - (".$x3.")" }} }{ {{ $detail['t_down'] }} } \)</p>
                            <p class="mt-3">{{ $lang['26'] }}</p>
                            <p class="mt-3">\(
                                        \begin{cases}
                                        x = & \text{ {{ $detail['f_down'] }} } t + {{ "(".$x1.")" }} \\
                                        y = & \text{ {{ $detail['s_down'] }} } t + {{ "(".$x2.")" }} \\
                                        z = & \text{ {{ $detail['t_down'] }} } t + {{ "(".$x3.")" }}
                                        \end{cases} \)
                            </p>
                            <p class="mt-3"><strong>{{ $lang['8'] }}</strong></p>
                            <p class="mt-3">{{ $lang['9'] }} 1:</p>
                            <p class="mt-3">{{ $lang['27'] }}:</p>
                            <p class="mt-3"> \(
                                \begin{cases}
                                    x = & \text{lt + x₁}\\
                                    y = & \text{mt + y₁}\\
                                    z = & \text{nt + z₁}
                                \end{cases} \)
                            </p>
                            <p class="mt-3">
                                where
                            </p>
                            <p class="mt-3">\( \{ l; m; n\} - coordinates \quad of \quad a \quad directing \quad vector\quad. \quad We \quad can \quad use \quad \overline{AB} \)</p>
                            <p class="mt-3">(x1, y1, z1) - coordinates of a point on line. We can use the coordinates of a point A</p>
                            <p class="mt-3">{{ $lang['9'] }} 2:</p>
                            <p class="mt-3">
                                \( \overline{AB}=\{ xb - xa; yb - ya; zb - za\} =\{ {{ "(".$y1.") - (".$x1."); (".$y2.") - (".$x2."); (".$y3.") - (".$x3.")" }} \}=\{ {{ $detail['f_down'].";".$detail['s_down'].";".$detail['t_down'] }} \} \)
                            </p>
                            <p class="mt-3">{{ $lang['9'] }} 3:</p>
                            <p class="mt-3">{{ $lang['28'] }}:</p>
                            <p class="mt-3">
                                \( \begin{cases}
                                    x = & \text{ {{ $detail['f_down'] }} } t + {{ "(".$x1.")" }} \\
                                    y = & \text{ {{ $detail['s_down'] }} } t + {{ "(".$x2.")" }} \\
                                    z = & \text{ {{ $detail['t_down'] }} } t + {{ "(".$x3.")" }}
                                \end{cases} \)
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body); window.MJrerender = function() { renderMathInElement(document.body); }"></script>
        <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
        <script>
            window.MJrerender = function() {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            }
            window.drawGraph = function(type, x1, y1, x2, y2) {
                if (typeof JXG === 'undefined') return;
                try {
                    if (type === "1") {
                        var board = JXG.JSXGraph.initBoard('box2', {boundingbox: [-15, 15, 15, -15], axis:true});
                        var p1 = board.create('point', [parseFloat(x1), parseFloat(y1)],{name:'p1'});
                        var p2 = board.create('point', [parseFloat(x2), 0],{name:'p2'});
                        var l1 = board.create('line', [p1,p2], {straightFirst:false, straightLast:false});
                    } else if (type === "2") {
                        var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [-15, 15, 15, -15], axis:true});
                        var p1 = board.create('point', [parseFloat(x1), parseFloat(y1)],{name:'p1'});
                        var p2 = board.create('point', [parseFloat(x2), parseFloat(y2)],{name:'p2'});
                        var l1 = board.create('line', [p1,p2], {straightFirst:false, straightLast:false});
                    } else if (type === "3") {
                        var board = JXG.JSXGraph.initBoard('box3', {boundingbox: [-15, 15, 15, -15], axis:true});
                        var p1 = board.create('point', [0, parseFloat(x1)]);
                        var l1 = board.create('line', [p1, [1.0, 1.0]]);
                    }
                } catch(e) {
                    console.error(e);
                }
            }
        </script>
    @endpush
</form>

</div>
