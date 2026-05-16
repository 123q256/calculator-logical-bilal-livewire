 <div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 mt-0 mt-lg-2">
                <label for="point_unit" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" wire:model.live="point_unit" name="point_unit" id="point_unit">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2">{{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            
            <div class="col-span-12 {{ $point_unit == '2' ? 'hidden' : '' }}" id="firstInput">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="x1" class="label">X<sub class="text-[14px]">1</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="x1" name="x1" id="x1" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="y1" class="label">Y<sub class="text-[14px]">1</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="y1" name="y1" id="y1" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="m" class="label">{{$lang['m']}}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="m" name="m" id="m" class="input" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 {{ $point_unit == '1' ? 'hidden' : '' }}" id="secondInput">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sec_x1" class="label">X<sub class="text-[14px]">1</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="sec_x1" name="sec_x1" id="sec_x1" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sec_y1" class="label">Y<sub class="text-[14px]">1</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="sec_y1" name="sec_y1" id="sec_y1" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sec_x2" class="label">X<sub class="text-[14px]">2</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="sec_x2" name="sec_x2" id="sec_x2" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sec_y2" class="label">Y<sub class="text-[14px]">2</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="sec_y2" name="sec_y2" id="sec_y2" class="input" aria-label="input"/>
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
                        @if($point_unit =='1')
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['ans']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['s']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['s3']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[18px] mt-3">
                                <p><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-3">{{$lang['7']}}</p>
                                <p class="mt-3">y - y<sub class="text-[14px]">1</sub> = m(x - x<sub class="text-[14px]">1</sub>)</p>
                                <p class="mt-3">{{$lang['8']}}:</p>
                                <p class="mt-3">{{$detail['s']}}</p>
                                <p class="mt-3">{{$detail['s1']}}</p>
                                <p class="mt-3">{{$detail['s2']}}</p>
                                <p class="mt-3">{{$detail['s3']}}</p>
                                <p class="mt-3">{{$detail['s4']}}</p>
                                <p class="mt-3">{{$lang['graph']}}:</p>
                            </div>
                            <div id="box1" class="w-full md:w-[60%] lg:w-[60%]  mt-4 text-center" style="height: 350px;"
                                wire:key="graph-1-{{ $renderCount }}"
                                x-data="{
                                    renderGraph() {
                                        if (typeof JXG === 'undefined') {
                                            setTimeout(() => this.renderGraph(), 200);
                                            return;
                                        }
                                        const board = JXG.JSXGraph.initBoard('box1', {
                                            boundingbox: [-15, 15, 15, -15],
                                            axis: true
                                        });
                                        const p1 = board.create('point', [{{ $x1 }}, {{ $y1 }}]);
                                        // For point-slope, we need another point. We can use slope.
                                        // y - y1 = m(x - x1) => y = m(x - x1) + y1
                                        // Let x = x1 + 1 => y = m + y1
                                        const p2 = board.create('point', [{{ $x1 }} + 1, {{ $y1 }} + {{ $m }}], {visible: false});
                                        board.create('line', [p1, p2]);
                                    }
                                }" x-init="renderGraph()"></div>
                        @else
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['ans']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['s']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-3">
                                <p><strong>{{$lang['5']}}:</strong></p>
                                <p class="mt-3">{{$lang['9']}}:</p>
                                <p class="mt-3">{{$lang['m']}} = (y<sub class="text-[14px]">2</sub> - y<sub class="text-[14px]">1</sub>)/(x<sub class="text-[14px]">2</sub> - x<sub class="text-[14px]">1</sub>)</p>
                                <p class="mt-3">{{$lang['8']}}:</p>
                                <p class="mt-3">{{$lang['m']}} = {{$sec_y2}} - {{$sec_y1}} / ({{$sec_x2}} - {{$sec_x1}})</p>
                                <p class="mt-3">{{$lang['m']}} = {{$detail['slope']}}</p>
                                <p class="mt-3">{{$lang['12']}}:</p>
                                <p class="mt-3">y - y<sub class="text-[14px]">1</sub> = m(x - x<sub class="text-[14px]">1</sub>)</p>
                                <p class="mt-3">{{$lang['11']}}:</p>
                                <p class="mt-3">{{$detail['s']}}</p>
                                <p class="mt-3">{{$detail['s1']}}</p>
                                <p class="mt-3">{{$detail['s2']}}</p>
                                <p class="mt-3">{{$detail['s3']}}</p>
                                <p class="mt-3">{{$detail['s4']}}</p>
                                <p class="mt-3">{{$lang['graph']}}:</p>
                            </div>
                            <div id="box1" class="w-full md:w-[60%] lg:w-[60%]  mt-4 text-center" style="height: 350px;"
                                wire:key="graph-2-{{ $renderCount }}"
                                x-data="{
                                    renderGraph() {
                                        if (typeof JXG === 'undefined') {
                                            setTimeout(() => this.renderGraph(), 200);
                                            return;
                                        }
                                        const board = JXG.JSXGraph.initBoard('box1', {
                                            boundingbox: [-15, 15, 15, -15],
                                            axis: true
                                        });
                                        const p1 = board.create('point', [{{ $sec_x1 }}, {{ $sec_y1 }}]);
                                        const p2 = board.create('point', [{{ $sec_x2 }}, {{ $sec_y2 }}]);
                                        board.create('line', [p1, p2]);
                                    }
                                }" x-init="renderGraph()"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
    @endpush
</form>
</div>
