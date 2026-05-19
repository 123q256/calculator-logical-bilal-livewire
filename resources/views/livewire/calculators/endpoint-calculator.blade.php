 <div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <p class="col-span-12 text[16px] my-2"><strong>{{$lang['start']}}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="x1" class="label">x₁:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="x1" name="x1" id="x1" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="y1" class="label">y₁:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="y1" name="y1" id="y1" class="input" aria-label="input" />
                </div>
            </div>
            <p class="col-span-12 text[16px] my-2"><strong>{{$lang['mid']}}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="x" class="label">x:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="x" name="x" id="x" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="y" class="label">y:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="y" name="y" id="y" class="input" aria-label="input" />
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
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['end'] }}</strong></td>
                                        <td class="py-2 border-b">( x₂ , y₂ ) = ({{safe_round($detail['x2'])}} , {{safe_round($detail['y2'])}})</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['dis'] }}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['dis'])}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full">
                                <p class="mt-2"><strong>{{$lang['exp']}}</strong></p>
                                <p class="mt-2">You entered the following points:</p>
                                <p class="mt-2">(x₁ , y₁) = ({{safe_round($x1)}} , {{safe_round($y1)}})</p>
                                <p class="mt-2">(x , y) = ({{safe_round($x)}} , {{safe_round($y)}})</p>
                                <p class="mt-2">
                                    (x₂ , y₂) = (2 × x - x₁, 2 × y - y₁)
                                </p>
                                <p class="mt-2">
                                    (x₂ , y₂) = (2 × {{safe_round($x)}} - {{safe_round($x1)}}, 2 × {{safe_round($y)}} - {{safe_round($y1)}})
                                </p>
                                <p class="mt-2">
                                    (x₂ , y₂) = ({{safe_round(2 * $x - $x1)}} , {{safe_round(2 * $y - $y1)}})
                                </p>
                                <p class="mt-2">
                                    (x₂ , y₂) = ({{safe_round($detail['x2'])}} , {{safe_round($detail['y2'])}})
                                </p>
                                <p class="mt-2">Distance Equation Solution:</p>
                                <p class="mt-2">
                                    d = 
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">(x₂ - x₁)² + (y₂ - y₁)²</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    d = 
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">({{safe_round($detail['x2'])}} - {{safe_round($x1)}})² + ({{safe_round($detail['y2'])}} - {{safe_round($y1)}})²</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    d = 
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">({{safe_round($detail['x2'] - $x1)}})² + ({{safe_round($detail['y2'] - $y1)}})²</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    d = 
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">({{safe_round(pow(($detail['x2']-$x1),2))}}) + ({{safe_round(pow(($detail['y2']-$y1),2))}})</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    d = 
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">{{safe_round(pow(($detail['x2']-$x1),2) + pow(($detail['y2']-$y1),2))}}</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    d = {{safe_round($detail['dis'])}}
                                </p>
                            </div>
                        </div>
                        <div wire:key="graph-{{ $renderCount }}" x-data="{
                            initGraph() {
                                if (typeof JXG === 'undefined') return;
                                var board = JXG.JSXGraph.initBoard('box2', {boundingbox: [-15, 15, 15, -15], axis:true});
                                var p1 = board.create('point', [{{ $x1 }}, {{ $y1 }}], {name:'({{ $x1 }}, {{ $y1 }})'});
                                var p2 = board.create('point', [{{ $x }}, {{ $y }}], {name:'({{ $x }}, {{ $y }})'});
                                var p3 = board.create('point', [{{ $detail['x2'] }}, {{ $detail['y2'] }}], {name:'({{ $detail['x2'] }}, {{ $detail['y2'] }})'});
                                var l1 = board.create('line', [p1, p2], {straightFirst:false, straightLast:false});
                                var l2 = board.create('line', [p2, p3], {straightFirst:false, straightLast:false});
                                var l3 = board.create('line', [p3, p1], {straightFirst:false, straightLast:false});
                            }
                        }" x-init="initGraph()" id="box2" class="w-full md:w-[80%] lg:w-[80%]  mt-4 mx-auto bg-white" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
@endpush
</div>
