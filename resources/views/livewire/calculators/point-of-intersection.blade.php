<div>
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <p class="col-span-12 mx-2 text-center mb-1"><strong>{{$lang[1]}}</strong></p>
            <div class="col-span-12 flex items-center justify-center">
                <div class="mx-2 py-2 relative">
                    <input type="number" step="any" wire:model.live="x1" class="input" aria-label="input" />
                    <span class="input_unit">x</span>
                </div>
                <div class="mx-2">+</div>
                <div class="mx-2 py-2 relative">
                    <input type="number" step="any" wire:model.live="y1" class="input" aria-label="input" />
                    <span class="input_unit">y</span>
                </div>
                <div class="mx-2">=</div>
                <div class="mx-2 py-2">
                    <input type="number" step="any" wire:model.live="c1" class="input" aria-label="input" />
                </div>
            </div>
            <p class="col-span-12 mx-2 text-center mb-1 mt-2"><strong>{{$lang[2]}}</strong></p>
            <div class="col-span-12 flex items-center justify-center">
                <div class="mx-2 py-2 relative">
                    <input type="number" step="any" wire:model.live="x2" class="input" aria-label="input" />
                    <span class="input_unit">x</span>
                </div>
                <div class="mx-2">+</div>
                <div class="mx-2 py-2 relative">
                    <input type="number" step="any" wire:model.live="y2" class="input" aria-label="input" />
                    <span class="input_unit">y</span>
                </div>
                <div class="mx-2">=</div>
                <div class="mx-2 py-2">
                    <input type="number" step="any" wire:model.live="c2" class="input" aria-label="input" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-100 text-[18px]">
                                    @if(is_numeric($detail['x']))
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>{{ $lang['3'] }} x =</strong></td>
                                            <td class="py-2 border-b">{{$detail['x']}}</td>
                                        </tr>
                                    @endif
                                    @if(is_numeric($detail['x']))
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>{{ $lang['3'] }} y =</strong></td>
                                            <td class="py-2 border-b">{{$detail['y']}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-2">{{$lang['5']}}</p>
                                <p class="mt-2">
                                    x = (y<sub class="font-s-14">1</sub> × c<sub class="font-s-14">2</sub>) - 
                                    (<span class="quadratic_fraction">
                                        <span class="num">(y<sub class="font-s-14">2</sub> × c<sub class="font-s-14">1</sub>)</span>
                                        <span>(x<sub class="font-s-14">1</sub> × y<sub class="font-s-14">2</sub>) - (x<sub class="font-s-14">2</sub> × y<sub class="font-s-14">1</sub>)</span>
                                    </span> )
                                </p>
                                <p class="mt-2">
                                    y = (x<sub class="font-s-14">2</sub> × c<sub class="font-s-14">1</sub>) - 
                                    (<span class="quadratic_fraction">
                                        <span class="num">(x<sub class="font-s-14">1</sub> × c<sub class="font-s-14">2</sub>)</span>
                                        <span>(x<sub class="font-s-14">1</sub> × y<sub class="font-s-14">2</sub>) - (x<sub class="font-s-14">2</sub> × y<sub class="font-s-14">1</sub>)</span>
                                    </span> )
                                </p>
                                <p class="mt-2">
                                    x = (y<sub class="font-s-14">1</sub> × c<sub class="font-s-14">2</sub>) - 
                                    (<span class="quadratic_fraction">
                                        <span class="num">({{$y2}} × {{$c1}})</span>
                                        <span>({{$x1}} × {{$y2}}) - ({{$x2}} × {{$y1}})</span>
                                    </span> )
                                </p>
                                <p class="mt-2">
                                    x = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$detail['x1num']}}</span>
                                        <span>{{$detail['x1den']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    x = {{safe_round($detail['x'])}}
                                </p>
                                <p class="mt-2">
                                    y = ({{$x2}} × {{$c1}}) - 
                                    (<span class="quadratic_fraction">
                                        <span class="num">({{$x1}} × {{$c2}})</span>
                                        <span>({{$x1}} × {{$y2}}) - ({{$x2}} × {{$y1}})</span>
                                    </span> )
                                </p>
                                <p class="mt-2">
                                    y = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$detail['y1num']}}</span>
                                        <span>{{$detail['y1den']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2">{{$lang['4']}}</p>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                                 wire:key="graph-main-{{ $renderCount }}" 
                                 x-data="{
                                     initGraph() {
                                         if (typeof JXG === 'undefined') { setTimeout(() => this.initGraph(), 200); return; }
                                         this.$nextTick(() => {
                                             const el = document.getElementById('box1');
                                             if (!el) return;
                                             el.innerHTML = '';
                                             const board = JXG.JSXGraph.initBoard('box1', {boundingbox: [-50, 50, 50, -50], axis: true, showCopyright: false});
                                             const p1 = board.create('point', [{{safe_round($detail['th']*-1) }},{{safe_round($detail['Line1'][$detail['th']*-1])}}],{name:'p1'});
                                             const p2 = board.create('point', [{{safe_round($detail['th']-1)}}, {{safe_round($detail['Line1'][$detail['th']-1])}}],{name:'p2'});
                                             board.create('line', [p1,p2], {straightFirst:false, straightLast:false});
                                             const p3 = board.create('point', [{{safe_round($detail['th']*-1) }},{{safe_round($detail['Line2'][$detail['th']*-1])}}],{name:'p3'});
                                             const p4 = board.create('point', [{{safe_round($detail['th']-1)}},{{safe_round($detail['Line2'][$detail['th']-1])}}],{name:'p4'});
                                             const p5 = board.create('point', [{{safe_round($detail['x'])}}, {{safe_round($detail['y'])}}],{name:'Point of Intersection'});
                                             board.create('line', [p3,p4], {straightFirst:false, straightLast:false});
                                         });
                                     }
                                 }" 
                                 x-init="initGraph()"
                                 wire:ignore>
                                <div id="box1" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraph.css" />
        <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
    @endpush
</form>
</div>
