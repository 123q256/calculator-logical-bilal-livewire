<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request(); @endphp
            <div class="col-span-12">
                <label for="type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="type" id="type">
                        <option value="2"><?=$lang['2']?></option>
                        <option value="1" {{ isset($request->type) && $request->type == '1' ? 'selected' : '' }}><?=$lang['3']?>(m)</option>
                        <option value="3" {{ isset($request->type) && $request->type == '3' ? 'selected' : '' }}><?=$lang['4']?> (b) & <?=$lang['5']?> (m)</option>
                        <option value="4" {{ isset($request->type) && $request->type == '4' ? 'selected' : '' }}><?=$lang['6']?></option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="x1" class="font-s-14 text-blue m">
                    @if(isset($request->type) && $request->type == '3')
                        Intercept (c):
                    @else
                        X<sub class="text-blue font-s-12">1</sub>:
                    @endif
                </label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x1" id="x1" class="input" value="{{ isset($request->x1) ? $request->x1 : '2' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($request->type) && $request->type == '3' ? 'hidden' : '' }} second">
                <label for="y1" class="font-s-14 text-blue">Y<sub class="text-blue font-s-12">1</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y1" id="y1" class="input" value="{{ isset($request->y1) ? $request->y1 : '21' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="x2" class="font-s-14 text-blue slope">
                    @if(isset($request->type) && $request->type == '1')
                        Slope:
                    @elseif(isset($request->type) && $request->type == '3')
                        Slope (m):
                    @else
                        X<sub class="text-blue font-s-12">2</sub>:
                    @endif
                </label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x2" id="x2" class="input" value="{{ isset($request->x2) ? $request->x2 : '11' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($request->type) && ($request->type == '1' || $request->type == '3') ? 'hidden' : '' }} fourth">
                <label for="y2" class="font-s-14 text-blue">Y<sub class="text-blue font-s-12">2</sub></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y2" id="y2" class="input" value="{{ isset($request->y2) ? $request->y2 : '5' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($request->type) && $request->type == '4' ? '' : 'hidden' }} five_a">
                <label for="x3" class="font-s-14 text-blue">X<sub class="text-blue font-s-12">3</sub></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x3" id="x3" class="input" value="{{ isset($request->x3) ? $request->x3 : '2' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($request->type) && $request->type == '4' ? '' : 'hidden' }} five_b">
                <label for="y3" class="font-s-14 text-blue">Y<sub class="text-blue font-s-12">3</sub></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y3" id="y3" class="input" value="{{ isset($request->y3) ? $request->y3 : '7' }}" aria-label="input" />
                </div>
            </div>
            
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>

    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <?php if (($detail['type']=='2') || ($detail['type']=='1') || ($detail['type']=='3')) { ?>
                            <p class="mt-2 font-s18"><strong><?=$lang['7']?></strong></p>
                            <p class="mt-2">y = mx + c</p>
                            <p class="mt-2">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-16">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><?=$lang['5']?> (m)</td>
                                        <td class="py-2 border-b"><?=(($detail['slope']!='')?$detail['slope']:'0.0')?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Y - <?=$lang['4']?> (b)</td>
                                        <td class="py-2 border-b"><?=$detail['b']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">X - <?=$lang['4']?></td>
                                        <td class="py-2 border-b"><?=round((-1)*$detail['b']/$detail['slope'],2)?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <?php if($detail['type']=='2'){ ?>
                            <p class="mt-3"><strong><?=$lang['8']?></strong></p>
                            <p class="mt-3"><?=$lang['9']?> 1:</p>
                            <p class="mt-3"> <?=$lang['10']?> P = <?php echo "(".$request->x1." , ".$request->y1.") and Q = (".$request->x2." , ".$request->y2."). "; ?></p>
                            <p class="mt-3"><?=$lang['11']?> P=(x1,y1) and Q=(x2,y2) <?=$lang['12']?></p>
                            <p class="mt-3">\( m=\frac{y2-y1}{x2-x1}\)</p>
                            <p class="mt-3"><?=$lang['13']?> x1 = <?php echo $request->x1." , y1 = ".$request->y1.", x2 = ".$request->x2." , y2 = ".$request->y2; ?></p>
                            <p class="mt-3"><?=$lang['9']?> 2:</p>
                            <p class="mt-3"><?=$lang['14']?>:</p>
                            <p class="mt-3">\( m=\frac{<?php echo "(".$request->y2.") - (".$request->y1.")"; ?>}{<?php echo "(".$request->x2.") - (".$request->x1.")"; ?>}=\frac{<?php echo $detail['y']; ?>}{<?php echo $detail['x']; ?>}=<?php echo $detail['slope']; ?> \)</p>
                            <p class="mt-3"> <?=$lang['9']?> 3:</p>
                            <p class="mt-3"><?=$lang['15']?> b=y1−m⋅x1 (or b=y2−m⋅x2, <?=$lang['16']?>).</p>
                            <p class="mt-3">b = <?php echo $request->y1." - (".$detail['slope'].") ⋅ (".$request->x1.") = ".$detail['b']; ?></p>
                            <p class="mt-3"> <?=$lang['9']?> 4:</p>
                            <p class="mt-3"><?=$lang['17']?> y=mx+b.</p>
                            <p class="mt-3">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></p>
                            <p class="mt-3"><?=$lang['18']?>:</p>
                            <p class="mt-3">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></p>
                            <p class="mt-3"><?=$lang['19']?>:</p>
                            <p class="mt-3">y - <?php echo "(".$request->y1.") = ".$detail['slope']." ⋅ ( x - (".$request->x1."))"; ?></p>
                            <p class="mt-3"><?=$lang['19']?>:</p>
                            <p class="mt-3">y - <?php echo "(".$request->y2.") = ".$detail['slope']." ⋅ ( x - (".$request->x2."))"; ?></p>
                            <p class="mt-3"><?=$lang['20']?>:</p>
                            <p class="mt-3"><?=$detail['slope'].'x'?> - y <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?> = 0</p>
                            <div id="box1" class="col-lg-10 mt-4 mx-auto" style="height: 500px;"></div>
                        <?php } ?>
                        <?php if($detail['type']=='1'){ ?>
                            <p class="mt-3"><strong><?=$lang['8']?></strong></p>
                            <p class="mt-3"><?=$lang['9']?> 1:</p>
                            <p class="mt-3"><?=$lang['21']?> m = <?php echo $request->x2." and the point  P = (".$request->x1." , ".$request->y1."). "; ?></p>
                                <p class="mt-3"><?=$lang['9']?> 2:</p>
                            <p class="mt-3"><?=$lang['15']?> b=y1−m⋅x1</p>
                            <p class="mt-3">b = <?php echo $request->y1." - (".$request->x2.") ⋅ (".$request->x1.") = ".$detail['b']; ?></p>
                            <p class="mt-3"> <?=$lang['9']?> 3:</p>
                            <p class="mt-3"><?=$lang['17']?> y=mx+b.</p>
                            <p class="mt-3">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></p>
                            <p class="mt-3"><?=$lang['18']?>:</p>
                            <p class="mt-3">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></p>
                            <p class="mt-3"><?=$lang['19']?>:</p>
                            <p class="mt-3">y - <?php echo "(".$request->y1.") = ".$detail['slope']." ⋅ ( x - (".$request->x1."))"; ?></p>
                            <p class="mt-3"><?=$lang['20']?>:</p>
                            <p class="mt-3"><?=$detail['slope'].'x'?> - y <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?> = 0</p>
                            <div id="box2" class="col-lg-10 mt-4 mx-auto" style="height: 500px;"></div>
                        <?php } ?>
                        <?php if($detail['type']=='3'){ ?>
                            <p class="mt-3"><strong><?=$lang['8']?></strong></p>
                            <p class="mt-3"><?=$lang['9']?> 1:</p>
                            <p class="mt-3">m = <?php echo $detail['slope'].", b = ".$request->x1; ?></p>
                            <p class="mt-3">y = <?php echo "(".$detail['slope'].")x + (".$request->x1.")"; ?></p>
                            <p class="mt-3">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></p>
                            <div id="box3" class="col-lg-10 mt-4 mx-auto" style="height: 500px;"></div>
                        <?php } ?>
                        <?php if($detail['type']=='4'){ ?>
                            <p class="mt-3"><strong><?=$lang['22']?></strong></p>
                            <p class="mt-3">\( \frac{<?php echo "x - (".$_POST['x1'].")"; ?>}{<?php echo $detail['f_down']; ?>}=\frac{<?php echo "y - (".$_POST['x2'].")"; ?>}{<?php echo $detail['s_down']; ?>}=\frac{<?php echo "z - (".$_POST['x3'].")"; ?>}{<?php echo $detail['t_down']; ?>} \)</p>
                            <p class="mt-3"><strong><?=$lang['8']?></strong></p>
                            <p class="mt-3"><?=$lang['9']?> 1:</p>
                            <p class="mt-3"><?=$lang['23']?>:</p>
                            <p class="mt-3">\( \frac{x - xa}{xb - xa}=\frac{y - ya}{yb - ya}=\frac{z - za}{zb - za} \)</p>
                            <p class="mt-3"><?=$lang['9']?> 2:</p>
                            <p class="mt-3"><?=$lang['24']?>:</p>
                            <p class="mt-3">\( \frac{<?php echo "x - (".$_POST['x1'].")"; ?>}{<?php echo "(".$_POST['y1'].") - (".$_POST['x1'].")"; ?>}=\frac{<?php echo "y - (".$_POST['x2'].")"; ?>}{<?php echo "(".$_POST['y2'].") - (".$_POST['x2'].")"; ?>}=\frac{<?php echo "z - (".$_POST['x3'].")"; ?>}{<?php echo "(".$_POST['y3'].") - (".$_POST['x3'].")"; ?>} \)</p>
                            <p class="mt-3"><?=$lang['9']?> 3:</p>
                            <p class="mt-3"><?=$lang['25']?>:</p>
                            <p class="mt-3">\( \frac{<?php echo "x - (".$_POST['x1'].")"; ?>}{<?php echo $detail['f_down']; ?>}=\frac{<?php echo "y - (".$_POST['x2'].")"; ?>}{<?php echo $detail['s_down']; ?>}=\frac{<?php echo "z - (".$_POST['x3'].")"; ?>}{<?php echo $detail['t_down']; ?>} \)</p>
                            <p class="mt-3"><?=$lang['26']?></p>
                            <p class="mt-3">\(
                                        \begin{cases}
                                        x = & \text{<?php echo $detail['f_down']; ?>$t$ + <?php echo "(".$_POST['x1'].")" ?>}\\
                                        y = & \text{<?php echo $detail['s_down']; ?>$t$ + <?php echo "(".$_POST['x2'].")" ?>}\\
                                        z = & \text{<?php echo $detail['t_down']; ?>$t$ + <?php echo "(".$_POST['x3'].")" ?>}
                                        \end{cases} \)
                            </p>
                            <p class="mt-3"><strong><?=$lang['8']?></strong></p>
                            <p class="mt-3"><?=$lang['9']?> 1:</p>
                            <p class="mt-3"><?=$lang['27']?>:</p>
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
                            <p class="mt-3"><?=$lang['9']?> 2:</p>
                            <p class="mt-3">
                                \( \overline{AB}=\{ xb - xa; yb - ya; zb - za\} =\{<?php echo "(".$_POST['y1'].") - (".$_POST['x1']."); (".$_POST['y2'].") - (".$_POST['x2']."); (".$_POST['y3'].") - (".$_POST['x3'].")"; ?>\}=\{<?php echo $detail['f_down'].";".$detail['s_down'].";".$detail['t_down']; ?>\} \)
                            </p>
                            <p class="mt-3"><?=$lang['9']?> 3:</p>
                            <p class="mt-3"><?=$lang['28']?>:</p>
                            <p class="mt-3">
                                \( \begin{cases}
                                    x = & \text{<?php echo $detail['f_down']; ?>$t$ + <?php echo "(".$_POST['x1'].")" ?>}\\
                                    y = & \text{<?php echo $detail['s_down']; ?>$t$ + <?php echo "(".$_POST['x2'].")" ?>}\\
                                    z = & \text{<?php echo $detail['t_down']; ?>$t$ + <?php echo "(".$_POST['x3'].")" ?>}
                                \end{cases} \)
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @isset($detail)
            <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
            @if($request->type == "1")
                <script>
                    var board = JXG.JSXGraph.initBoard('box2', {boundingbox: [-15, 15, 15, -15], axis:true});
                    var p1 = board.create('point', [{{$request->x1}}, {{$request->y1}}],{name:'p1'});
                    var p2 = board.create('point', [{{$request->x2}}, 0],{name:'p2'});
                    var l1 = board.create('line', [p1,p2], {straightFirst:false, straightLast:false});
                </script>
            @elseif($request->type == "2")
                <script>
                    var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [-15, 15, 15, -15], axis:true});
                    var p1 = board.create('point', [{{$request->x1}}, {{$request->y1}}],{name:'p1'});
                    var p2 = board.create('point', [{{$request->x2}}, {{$request->y2}}],{name:'p2'});
                    var l1 = board.create('line', [p1,p2], {straightFirst:false, straightLast:false});
                </script>
            @elseif($request->type == "3")
                <script>
                    var board = JXG.JSXGraph.initBoard('box3', {boundingbox: [-15, 15, 15, -15], axis:true});
                    var p1 = board.create('point', [0, {{$request->x1}}]);
                    var l1 = board.create('line', [p1, [1.0, 1.0]]);
                </script>
            @endif
        @endisset
        <script>
            document.getElementById('type').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementsByClassName('m')[0].innerHTML = 'X<sub class="text-blue font-s-12">1</sub>:';
                    document.getElementsByClassName('slope')[0].textContent = 'Slope:';
                    ['.second'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.five_a', '.five_b', '.fourth'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "2"){
                    document.getElementsByClassName('m')[0].innerHTML = 'X<sub class="text-blue font-s-12">1</sub>:';
                    document.getElementsByClassName('slope')[0].innerHTML = 'X<sub class="text-blue font-s-12">2</sub>:';
                    ['.second', '.fourth'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.five_a', '.five_b'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "3"){
                    document.getElementsByClassName('m')[0].textContent = 'Intercept (c):';
                    document.getElementsByClassName('slope')[0].textContent = 'Slope (m):';
                    ['.five_a', '.five_b', '.second', '.fourth'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "4"){
                    document.getElementsByClassName('m')[0].innerHTML = 'X<sub class="text-blue font-s-12">1</sub>:';
                    document.getElementsByClassName('slope')[0].innerHTML = 'X<sub class="text-blue font-s-12">2</sub>:';
                    ['.five_a', '.five_b', '.fourth', '.second'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
