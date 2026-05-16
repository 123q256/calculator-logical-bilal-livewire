<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-6 lg:grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-6">
                        <label for="x1" class="label">{{ $lang['x1'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="x1" id="x1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6 d2">
                        <label for="y1" class="label">{{ $lang['y1'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="y1" id="y1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="x2" class="label">{{ $lang['x2'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="x2" id="x2" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6 d2">
                        <label for="y2" class="label">{{ $lang['y2'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="y2" id="y2" class="input" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @if(isset($detail))
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['mid'] }}</strong></td>
                                            <td class="py-2 border-b">(x , y) =
                                                @php
                                                    if (isset($detail['x']) && isset($detail['y'])) {
                                                        echo "(".$detail['x']." , ".$detail['y'].")";
                                                    } else {
                                                        echo "(0 , 0)";
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['dis'] }}</strong></td>
                                            <td class="py-2 border-b">
                                                @php
                                                    if (isset($detail['dis'])) {
                                                        echo "(".$detail['dis'].")";
                                                    } else {
                                                        echo "(0.0)";
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2"><strong>{{$lang['exp']}}</strong></p>
                                    <p class="mt-2">{{$lang['to_find']}} X(x₁,x₂) and Y(y₁,y₂) {{$lang['use']}}:</p>
                                    <p class="mt-2">
                                        M = 
                                        (<span class="inline-flex flex-col items-center justify-center align-middle mx-1 text-[16px]">
                                            <span class="border-b border-black px-1 leading-tight w-full text-center">x₁ + x₂</span>
                                            <span class="px-1 leading-tight">2</span>
                                        </span> , 
                                        <span class="inline-flex flex-col items-center justify-center align-middle mx-1 text-[16px]">
                                            <span class="border-b border-black px-1 leading-tight w-full text-center">y₁ + y₂</span>
                                            <span class="px-1 leading-tight">2</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        M = 
                                        (<span class="inline-flex flex-col items-center justify-center align-middle mx-1 text-[16px]">
                                            <span class="border-b border-black px-1 leading-tight w-full text-center">{{ $detail['x1_used'] ?? 0 }} + {{ $detail['x2_used'] ?? 0 }}</span>
                                            <span class="px-1 leading-tight">2</span>
                                        </span> , 
                                        <span class="inline-flex flex-col items-center justify-center align-middle mx-1 text-[16px]">
                                            <span class="border-b border-black px-1 leading-tight w-full text-center">{{ $detail['y1_used'] ?? 0 }} + {{ $detail['y2_used'] ?? 0 }}</span>
                                            <span class="px-1 leading-tight">2</span>
                                        </span>
                                        )
                                    </p>
                                    <p class="mt-2">
                                        M = 
                                        (<span class="inline-flex flex-col items-center justify-center align-middle mx-1 text-[16px]">
                                            <span class="border-b border-black px-1 leading-tight w-full text-center">{{ (float)($detail['x1_used'] ?? 0) + (float)($detail['x2_used'] ?? 0) }}</span>
                                            <span class="px-1 leading-tight">2</span>
                                        </span> , 
                                        <span class="inline-flex flex-col items-center justify-center align-middle mx-1 text-[16px]">
                                            <span class="border-b border-black px-1 leading-tight w-full text-center">{{ (float)($detail['y1_used'] ?? 0) + (float)($detail['y2_used'] ?? 0) }}</span>
                                            <span class="px-1 leading-tight">2</span>
                                        </span>
                                        )
                                    </p>
                                    <p class="mt-2">
                                        M = ({{ $detail['x'] ?? 0 }} , {{ $detail['y'] ?? 0 }})
                                    </p>
                                   
                                </div>
                                <!-- Chart Container (Persistent) -->
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" wire:ignore>
                                    <div id="box1" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                                </div>
                                
                                <!-- Initial Page Load Rendering -->
                                @php
                                    $x2=(($detail['x2_used']<0)?$detail['x2_used']-10:"-".$detail['x2_used']+10);
                                    $x1=(($detail['x1_used']<0)?($detail['x1_used']-10)*(-1):$detail['x1_used']+10);
                                    $y2=(($detail['y2_used']<0)?$detail['y2_used']-10:"-".$detail['y2_used']+10);
                                    $y1=(($detail['y1_used']<0)?($detail['y1_used']-10)*(-1):$detail['y1_used']+10);
                                @endphp
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        setTimeout(function() {
                                            if (typeof JXG !== 'undefined' && document.getElementById('box1')) {
                                                if (JXG.JSXGraph.boards['box1']) {
                                                    JXG.JSXGraph.freeBoard(JXG.JSXGraph.boards['box1']);
                                                }
                                                document.getElementById('box1').innerHTML = '';
                                                var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [{{$x2}}, {{$y1}}, {{$x1}}, {{$y2}}], axis:true});
                                                var p1 = board.create('point', [{{$detail['x1_used']}}, {{$detail['y1_used']}}], {name:'X',size:4});
                                                var p2 = board.create('point', [{{$detail['x2_used']}}, {{$detail['y2_used']}}], {name:'Y',size:4});
                                                var p3 = board.create('point', [{{$detail['x']}}, {{$detail['y']}}], {name:'Midpoint',size:4});
                                                board.create('line', [p1, p2]);
                                            }
                                        }, 300);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>

    <style>
        .quadratic_fraction {
            display: inline-block;
            vertical-align: middle;
            text-align: center;
            font-size: 0.9em;
        }
        .quadratic_fraction .num {
            display: block;
            border-bottom: 1px solid #000;
            padding: 0 3px;
        }
        .quadratic_fraction .den {
            display: block;
            padding: 0 3px;
        }
    </style>

    @push('calculatorJS')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraph.css" />
        <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
    @endpush
</div>
