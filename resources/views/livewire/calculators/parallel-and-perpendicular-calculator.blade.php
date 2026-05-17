<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="form" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="form" id="form" wire:model.live="form">
                            <option value="1">Standard Form</option>
                            <option value="2">Slope - Intercept Form</option>
                        </select>
                    </div>
                </div>
                <p class="col-span-12 my-2  text-[14px] text-center">
                    <strong id="changeText">
                        @if($form === '2')
                            y = Ax + B
                        @else
                            Ax + By + C = 0
                        @endif
                    </strong>
                </p>
                <div class="{{ $form === '2' ? 'col-span-6' : 'col-span-4' }} mt-0 mt-lg-2 px-2" id="aValue">
                    <label for="a" class="label">{{$lang['5']}} A</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="a" id="a" class="input" wire:model.live="a" aria-label="input"/>
                    </div>
                </div>
                <div class="{{ $form === '2' ? 'col-span-6' : 'col-span-4' }} mt-0 mt-lg-2 px-2" id="bValue">
                    <label for="b" class="label">{{$lang['5']}} B</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="b" id="b" class="input" wire:model.live="b" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-4 {{ $form === '2' ? 'hidden' : '' }}" id="cValue">
                    <label for="c" class="label">{{$lang['5']}} C</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="c" id="c" class="input" wire:model.live="c" aria-label="input"/>
                    </div>
                </div>
                <p class="col-span-12 my-2  text-[14px] text-center"><strong>Input Point</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="p1" class="label">{{$lang['6']}} 1</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="p1" id="p1" class="input" wire:model.live="p1" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="p2" class="label">{{$lang['6']}} 2</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="p2" id="p2" class="input" wire:model.live="p2" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="method" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="method" id="method" wire:model.live="method">
                            <option value="1">{{$lang['3']}}</option>
                            <option value="2">{{$lang['4']}}</option>
                        </select>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            @if($detail['form']==1)
                                <p class="mt-2 text-[18px]">\( y = {{($detail['btm']!==1)?'\\frac{'.$detail['upr'].'}{'.$detail['btm'].'}':$detail['upr']}}x {{($detail['upr2'])>0?'+':'-'}} {{($detail['btm2']!==1)?'\\frac{'.abs($detail['upr2']).'}{'.$detail['btm2'].'}':abs($detail['upr2'])}}\)</p>
                                <p class="mt-3"><strong>{{$lang['8']}}:</strong></p>
                                <p class="mt-3">{{$lang['9']}}:</p>
                                <p class="mt-3">\( {{$detail['a']}}x {{($detail['b'])>0?'+'.$detail['b']:$detail['b']}}y {{($detail['c'])>0?'+'.$detail['c']:$detail['c']}} = 0 \)</p>
                                <p class="mt-3">{{$lang['10']}}:</p>
                                <p class="mt-3">\( ({{$detail['p1'].' , '.$detail['p2']}}) \)</p>
                                @if($detail['method']==='1')
                                    <p class="mt-3">{{$lang['11']}} \( y = {{($detail['btm']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['btm'].'}':$detail['upr']}}x {{($detail['upr1'])<0?'-':'+'}} {{($detail['btm1']!=1)?'\\frac{'.abs($detail['upr1']).'}{'.$detail['btm1'].'}':abs($detail['upr1'])}}\)</p>
                                    <p class="mt-3">{{$lang['12']}} \( m = {{($detail['btm']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['btm'].'}':$detail['upr']}}\)</p>
                                    <p class="mt-3">{{$lang['13']}} \( y = {{($detail['btm']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['btm'].'}':$detail['upr']}}x + a\)</p>
                                @else
                                    <p class="mt-3">{{$lang['11']}} \( y = {{($detail['btm_']!=1)?'\\frac{'.$detail['upr_'].'}{'.abs($detail['btm_']).'}':$detail['upr_']}}x {{($detail['upr1'])<0?'-':'+'}} {{($detail['btm1']!=1)?'\\frac{'.abs($detail['upr1']).'}{'.$detail['btm1'].'}':abs($detail['upr1'])}}\)</p>
                                    <p class="mt-3">{{$lang['14']}} \( m = {{($detail['btm']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['btm'].'}':$detail['upr']}}\)</p>
                                    <p class="mt-3">{{$lang['16']}} \( y = {{($detail['btm']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['btm'].'}':$detail['upr']}}x + a\)</p>
                                @endif
                                <p class="mt-3">{{$lang['15']}} \( {{$detail['p2']}} = ({{($detail['btm']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['btm'].'}':$detail['upr']}}).({{$detail['p1']}}) + a\)</p>
                                <p class="mt-3">{{$lang['18']}}, \( a = {{($detail['btm2']!=1)?'\\frac{'.$detail['upr2'].'}{'.$detail['btm2'].'}':$detail['upr2']}}\)</p>
                                <p class="mt-3">{{$lang['17']}} \( y = {{($detail['btm']!==1)?'\\frac{'.$detail['upr'].'}{'.$detail['btm'].'}':$detail['upr']}}x {{($detail['upr2'])>0?'+':'-'}} {{($detail['btm2']!==1)?'\\frac{'.abs($detail['upr2']).'}{'.$detail['btm2'].'}':abs($detail['upr2'])}}\)</p>
                            @else
                                @if($detail['method']==='2')
                                    <p class="mt-2 text-[18px]">
                                        \( y = {{($detail['btm2'])!=1?'\\frac{'.$detail['upr2'].'}{'.$detail['btm2'].'}':$detail['upr2']}} {{($detail['upr'])===-1?'-':'+'}} \frac{x}{{{$detail['au']}}}\)
                                    </p>
                                    <p class="mt-3"><strong>{{$lang['8']}}:</strong></p>
                                    <p class="mt-3">{{$lang['9']}}:</p>
                                    <p class="mt-3">\( y = {{$detail['a']}}x {{($detail['b'])>0?'+'.$detail['b']:$detail['b']}}\)</p>
                                    <p class="mt-3">{{$lang['10']}}:</p>
                                    <p class="mt-3">\( ({{$detail['p1'].' , '.$detail['p2']}})\)</p>
                                    <p class="mt-3">{{$lang['11']}} \( y = {{$detail['a']}}x {{($detail['b'])>0?'+'.$detail['b']:$detail['b']}}\)</p>
                                    <p class="mt-3">{{$lang['14']}} \( m = {{($detail['au']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['au'].'}':$detail['upr']}}\)</p>
                                    <p class="mt-3">{{$lang['16']}} \( y = {{($detail['au']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['au'].'}':$detail['upr']}}x + a\)</p>
                                    <p class="mt-3">{{$lang['15']}} \( {{$detail['p2']}} = ({{($detail['au']!=1)?'\\frac{'.$detail['upr'].'}{'.$detail['au'].'}':$detail['upr']}}).({{$detail['p1']}}) + a\)</p>
                                    <p class="mt-3">{{$lang['18']}}, \( a = {{($detail['btm2']!=1)?'\\frac{'.$detail['upr2'].'}{'.$detail['btm2'].'}':$detail['upr2']}}\)</p>
                                    <p class="mt-3">{{$lang['17']}} \( y = {{($detail['btm2'])!=1?'\\frac{'.$detail['upr2'].'}{'.$detail['btm2'].'}':$detail['upr2']}} {{($detail['upr'])===-1?'-':'+'}} \frac{x}{{{$detail['au']}}}\)</p>
                                @else
                                    <p class="mt-2 text-[18px]">
                                        \( y = {{$detail['a']}}x {{($detail['au'])>0?'+'.$detail['au']:$detail['au']}}\)
                                    </p>
                                    <p class="mt-3"><strong>{{$lang['8']}}:</strong></p>
                                    <p class="mt-3">{{$lang['9']}}:</p>
                                    <p class="mt-3">\( y = {{$detail['a']}}x {{($detail['b'])>0?'+'.$detail['b']:$detail['b']}}\)</p>
                                    <p class="mt-3">{{$lang['10']}}:</p>
                                    <p class="mt-3">\( ({{$detail['p1'].' , '.$detail['p2']}})\)</p>
                                    <p class="mt-3">{{$lang['11']}} \( y = {{$detail['a']}}x {{($detail['b'])>0?'+'.$detail['b']:$detail['b']}}y \)</p>
                                    <p class="mt-3">{{$lang['12']}} \( m = {{$detail['a']}}\)</p>
                                    <p class="mt-3">{{$lang['13']}} \( y = {{$detail['a']}}x + a\)</p>
                                    <p class="mt-3">{{$lang['15']}} \( {{$detail['p2']}} = ({{$detail['a']}}).({{$detail['p1']}}) + a\)</p>
                                    <p class="mt-3">{{$lang['18']}}, \( a = {{$detail['au']}}\)</p>
                                    <p class="mt-3">{{$lang['17']}} \( y = {{$detail['a']}}x {{($detail['au'])>0?'+'.$detail['au']:$detail['au']}}\)</p>
                                @endif
                            @endif
                        </div>
                        @php
                            $chartData = ['p1' => [0,0], 'p2' => [0,0], 'p3' => [0,0], 'p4' => [0,0]];
                            if(isset($detail)){
                                if($detail['form']==1){ 
                                    $y = $detail['upr2']/$detail['btm2'];
                                    $x = 0;
                                    if ($detail['btm']<0) {
                                        $detail['upr'] = -$detail['upr'];
                                        $detail['btm'] = abs($detail['btm']);
                                    }
                                    $x1 = $x + $detail['btm'];
                                    $y1 = $y + $detail['upr'];
                                    $y_ = $detail['upr1']/$detail['btm1'];
                                    $x_ = 0;
                                    if($detail['method']==='1'){
                                        $x_1 = $x_ + $detail['btm'];
                                        $y_1 = $y_ + $detail['upr'];
                                    }else{
                                        $x_1 = $x_ - $detail['btm_'];
                                        $y_1 = $y_ + $detail['upr_'];
                                    }
                                }else{
                                    if($detail['method']==='1'){
                                        $y = $detail['au'];
                                        $x = 0;
                                        $x1 = $x + 1;
                                        $y1 = $y + $detail['a'];
                                        $y_ = $detail['b'];
                                        $x_ = 0;
                                        $x_1 = $x_ + 1;
                                        $y_1 = $y_ + $detail['a'];
                                    }else{
                                        $y = ($detail['upr'])===-1?$detail['au']*(-1):$detail['au'];
                                        $x = 0;
                                        $x1 = $x + $detail['btm2'];
                                        $y1 = $y + $detail['upr2'];
                                        $y_ = $detail['b'];
                                        $x_ = 0;

                                        $x_1 = $x_ - $detail['au'];
                                        $y_1 = $y_ + $detail['upr'];
                                    }
                                }
                                $chartData = [
                                    'p1' => [$x, $y],
                                    'p2' => [$x1, $y1],
                                    'p3' => [$x_, $y_],
                                    'p4' => [$x_1, $y_1],
                                ];
                            }
                        @endphp
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                             wire:key="graph-{{ $renderCount }}" 
                             x-data='{
                                 chartData: @json($chartData),
                                 initGraph() {
                                     if (typeof JXG === "undefined") {
                                         setTimeout(() => this.initGraph(), 200);
                                         return;
                                     }
                                     const board = JXG.JSXGraph.initBoard("box1", {
                                         axis: true,
                                         showCopyright: false
                                     });
                                     const p1a = board.create("point", this.chartData.p1, {name: "", size: 2, withLabel: false, visible: false});
                                     const p2a = board.create("point", this.chartData.p2, {name: "", size: 2, withLabel: false, visible: false});
                                     board.create("line", [p1a, p2a], {strokeColor: "#0072c6"});
                                     
                                     const p1b = board.create("point", this.chartData.p3, {name: "", size: 2, withLabel: false, visible: false});
                                     const p2b = board.create("point", this.chartData.p4, {name: "", size: 2, withLabel: false, visible: false});
                                     board.create("line", [p1b, p2b], {strokeColor: "#28a745"});
                                 }
                             }' 
                             x-init="initGraph()">
                            <div id="box1" class="jxgbox" style="width:100%; aspect-ratio: 1/1;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('math-updated', (event) => {
                setTimeout(() => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            });

            // Initial render
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }
        });
    </script>
    @endpush
</form>
</div>
