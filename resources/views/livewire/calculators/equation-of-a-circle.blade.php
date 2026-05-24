<div x-data="{ from: $wire.entangle('from') }">
<style>
    [x-cloak] { display: none !important; }
</style>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            <div class="col-span-12">
                <label for="from" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" wire:model.live="from" id="from">
                        <option value="1">(x - A)² + (y - B)² = C</option>
                        <option value="2">x = A + r cos(α), y = B + r sin(α)</option>
                        <option value="3">x² + y² + Dx + Ey + F = 0</option>
                        <option value="4">{{$lang[2]}}</option>
                        <option value="5">{{$lang[3]}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 standardEquation" x-show="from == '1' || from == '2' || from == '3'" style="{{ in_array($from ?? '1', ['1', '2', '3']) ? '' : 'display: none;' }}">
                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[18px]">
                        <strong id="changeText" x-text="from == '2' ? 'Parametric Equation: x = A + r cos(α), y = B + r sin(α)' : (from == '3' ? 'General Form: x² + y² + Dx + Ey + F = 0' : 'Standard Form: (x - A)² + (y - B)² = C')">
                        </strong>
                    </p>
                    <div class="col-span-4">
                        <label for="a" class="label enter_a" x-text="from == '3' ? 'D' : 'A'"></label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="a" id="a" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="b" class="label enter_b" x-text="from == '3' ? 'E' : 'B'"></label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="b" id="b" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="c" class="label enter_c" x-text="from == '2' ? 'r' : (from == '3' ? 'F' : 'C')"></label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="c" id="c" class="input" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 circlePoints" x-show="from == '4' || from == '5'" style="{{ in_array($from ?? '1', ['4', '5']) ? '' : 'display: none;' }}">
                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[18px]"><strong>{{$lang['5']}} (x,y)</strong></p>
                    <div class="px-2 mt-0 mt-lg-2 xInput" :class="from == '5' ? 'col-span-6' : 'col-span-4'">
                        <label for="x1" class="label">x</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="x1" id="x1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="px-2 mt-0 mt-lg-2 yInput" :class="from == '5' ? 'col-span-6' : 'col-span-4'">
                        <label for="y1" class="label">y</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="y1" id="y1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4 radiusInput" x-show="from == '4'">
                        <label for="r" class="label">{{$lang['6']}}</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="r" id="r" class="input" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 centerPoints" x-show="from == '5'" style="{{ ($from ?? '1') == '5' ? '' : 'display: none;' }}">
                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[18px]"><strong>{{$lang['7']}} (h,k)</strong></p>
                    <div class="col-span-6">
                        <label for="h1" class="label">h</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="h1" id="h1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="k1" class="label">k</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="k1" id="k1" class="input" aria-label="input" />
                        </div>
                    </div>
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{$lang[8]}}</strong></td>
                                        <td class="py-2 border-b">
                                            @php
                                                $xSign = ($detail['A'] < 0) ? '+' : '-';
                                                $ySign = ($detail['B'] < 0) ? '+' : '-';
                                                $xValue = abs($detail['A']);
                                                $yValue = abs($detail['B']);
                                            @endphp
                                            @if ($detail['A'] < 0 && $detail['B'] < 0)
                                                (x {{ $xSign }} {{ $xValue }})² + (y {{ $ySign }} {{ $yValue }})² = ({{ $detail['radius'] }})²
                                            @elseif ($detail['A'] >= 0 && $detail['B'] < 0)
                                                (x - {{ $detail['A'] }})² + (y {{ $ySign }} {{ $yValue }})² = ({{ $detail['radius'] }})²
                                            @elseif ($detail['A'] < 0 && $detail['B'] >= 0)
                                                (x {{ $xSign }} {{ $xValue }})² + (y - {{ $detail['B'] }})² = ({{ $detail['radius'] }})²
                                            @else
                                                (x - {{ $detail['A'] }})² + (y - {{ $detail['B'] }})² = ({{ $detail['radius'] }})²
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{$lang[9]}}</strong></td>
                                        <td class="py-2 border-b">
                                            @php
                                                $xD = ($detail['D'] < 0) ? -1 * $detail['D'] : $detail['D'];
                                                $yE = ($detail['E'] < 0) ? -1 * $detail['E'] : $detail['E'];
                                                $zF = ($detail['F'] < 0) ? -1 * $detail['F'] : $detail['F'];
                
                                                $xSign = ($detail['D'] < 0) ? '-' : '+';
                                                $ySign = ($detail['E'] < 0) ? '-' : '+';
                                                $zSign = ($detail['F'] < 0) ? '-' : '+';
                                            @endphp
                                            @if ($detail['D'] < 0 && $detail['E'] < 0)
                                                @if ($detail['F'] >= 0)
                                                    x² + y² {{ $xSign }} {{ $xD }}x {{ $ySign }} {{ $yE }}y {{ $zSign }} {{ $zF }} = 0
                                                @else
                                                    x² + y² {{ $xSign }} {{ $xD }}x {{ $ySign }} {{ $yE }}y - {{ $zF }} = 0
                                                @endif
                                            @elseif ($detail['D'] >= 0 && $detail['E'] < 0)
                                                @if ($detail['F'] >= 0)
                                                    x² + y² + {{ $xD }}x {{ $ySign }} {{ $yE }}y {{ $zSign }} {{ $zF }} = 0
                                                @else
                                                    x² + y² + {{ $xD }}x {{ $ySign }} {{ $yE }}y - {{ $zF }} = 0
                                                @endif
                                            @elseif ($detail['D'] < 0 && $detail['E'] >= 0)
                                                @if ($detail['F'] >= 0)
                                                    x² + y² {{ $xSign }} {{ $xD }}x + {{ $yE }}y {{ $zSign }} {{ $zF }} = 0
                                                @else
                                                    x² + y² {{ $xSign }} {{ $xD }}x + {{ $yE }}y - {{ $zF }} = 0
                                                @endif
                                            @else
                                                @if ($detail['F'] >= 0)
                                                    x² + y² + {{ $xD }}x + {{ $yE }}y {{ $zSign }} {{ $zF }} = 0
                                                @else
                                                    x² + y² + {{ $xD }}x + {{ $yE }}y - {{ $zF }} = 0
                                                @endif
                                            @endif
                
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">                    
                                    <table class="w-full font-s-16">
                                        <tr>
                                            <td class="py-2 border-b" width="45%">{{ $lang['6'] }}</td>
                                            <td class="py-2 border-b"><strong>{{$detail['radius']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="45%">{{ $lang['10'] }}</td>
                                            <td class="py-2 border-b"><strong>{{$detail['diameter']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="45%">{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b"><strong>[{{$detail['d1']}} , {{$detail['d2']}}]</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="45%">{{ $lang['12'] }}</td>
                                            <td class="py-2 border-b"><strong>{{$detail['eccentricity']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" rowspan="2" width="45%">{{ $lang['13'] }}</td>
                                            <td class="py-2"><strong>x-coordianate {{$detail['A']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>y-coordianate {{$detail['B']}}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{ $lang['14'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['area']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{ $lang['15'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['circumference']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{ $lang['16'] }}</strong></td>
                                        <td class="py-2 border-b">[{{$detail['r1']}} , {{$detail['r2']}}]</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{ $lang['17'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['eccentricity']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" rowspan="2" width="45%"><strong>{{ $lang['18'] }}</strong></td>
                                        <td class="py-2">x = {{$detail['A']}} + {{$detail['radius']}} cos(α)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">y = {{$detail['B']}} + {{$detail['radius']}} sin(α)</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                                 wire:key="graph-circle" 
                                 x-data='{
                                     initGraph() {
                                         if (typeof JXG === "undefined") { setTimeout(() => this.initGraph(), 200); return; }
                                         this.$nextTick(() => {
                                             const el = document.getElementById("box1");
                                             if (!el) return;
                                             el.innerHTML = "";
                                             const board = JXG.JSXGraph.initBoard("box1", {boundingbox: [-15, 15, 15, -15], axis:true, showCopyright: false});
                                             const p1 = board.create("point", [{{$detail["A"] ?? 0}}, {{$detail["B"] ?? 0}}],{name:"Center"});
                                             const ci = board.create("circle",[p1, [0,0]], {strokeColor:"#2845F5",strokeWidth:2});
                                             const li3 = board.create("line",[p1,[0,0]], {straightFirst:false, straightLast:false, strokeWidth:2});
                                         });
                                     }
                                 }' 
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
</form>
@push('calculatorJS')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraph.css" />
    <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
@endpush

</div>
