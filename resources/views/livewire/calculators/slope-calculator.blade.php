<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3" x-data="{ calc_type: @entangle('calc_type').live }">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-2">
                    <label for="calc_type" class="text-blue">{{ $lang['type'] ?? 'Type' }}:</label>
                    <select class="input" wire:model.live="calc_type" id="calc_type" aria-label="input select">
                        <option value="1">{{ $lang['1p'] ?? '1 Point' }}, {{ $lang['slope'] ?? 'Slope' }} & {{ $lang['distance'] ?? 'Distance' }}</option>
                        <option value="2">{{ $lang['2p'] ?? '2 Points' }}</option>
                        <option value="3">{{ $lang['1p'] ?? '1 Point' }}, {{ $lang['slope'] ?? 'Slope' }} & X or Y</option>
                        <option value="4">{{ $lang['1p'] ?? '1 Point' }} & {{ $lang['slope'] ?? 'Slope' }}</option>
                        <option value="line">{{ $lang['line'] ?? 'Line Equation' }}</option>
                    </select>
                </div>
            </div>

            <!-- common (x1, y1) -->
            <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 mt-2 gap-4" x-show="['1', '2', '3', '4'].includes(calc_type)">
                <div class="space-y-2">
                    <label for="x1" class="font-s-14 text-blue">{{ $lang['x1'] ?? 'x1' }}:</label>
                    <input type="number" wire:model.live="x1" id="x1" class="input" aria-label="input" step="any" />
                </div>
                <div class="space-y-2">
                    <label for="y1" class="font-s-14 text-blue">{{ $lang['y1'] ?? 'y1' }}:</label>
                    <input type="number" wire:model.live="y1" id="y1" class="input" aria-label="input" step="any" />
                </div>
            </div>

            <!-- twopoint (x2, y2) -->
            <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 mt-2 gap-4" x-show="['2', '3'].includes(calc_type)">
                <div class="space-y-2">
                    <label for="x2" class="font-s-14 text-blue">{{ $lang['x2'] ?? 'x2' }}:</label>
                    <input type="number" wire:model.live="x2" id="x2" class="input" aria-label="input" step="any" />
                </div>
                <div class="space-y-2">
                    <label for="y2" class="font-s-14 text-blue"><span x-show="calc_type === '3'">or </span>{{ $lang['y2'] ?? 'y2' }}:</label>
                    <input type="number" wire:model.live="y2" id="y2" class="input" aria-label="input" step="any" />
                </div>
            </div>

            <!-- onepoint (m, angle) & distance -->
            <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 mt-2 gap-4" x-show="['1', '3', '4'].includes(calc_type)">
                <div class="space-y-2">
                    <label for="m" class="font-s-14 text-blue">{{ $lang['slope'] ?? 'Slope' }}:</label>
                    <input type="number" wire:model.live="m" id="m" class="input" aria-label="input" step="any" placeholder="00" />
                </div>
                <div class="space-y-2">
                    <i class="col-1 ps-4 pt-3" x-show="calc_type === '3'">or</i>
                    <label for="angle" class="font-s-14 text-blue">{{ $lang['angle'] ?? 'Angle' }}°:</label>
                    <input type="number" wire:model.live="angle" id="angle" class="input" aria-label="input" step="any" />
                </div>
                <div class="space-y-2" x-show="calc_type === '1'">
                    <label for="dis" class="font-s-14 text-blue">{{ $lang['distance'] ?? 'Distance' }}:</label>
                    <input type="number" wire:model.live="dis" id="dis" class="input" aria-label="input" step="any" />
                </div>
            </div>

            <!-- pline (x, y, b) -->
            <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 mt-2 gap-4" x-show="calc_type === 'line'" style="display: none;">
                <div class="space-y-2">
                    <label for="x" class="px-lg-3 font-s-14 text-blue">{{ $lang['enter'] ?? 'Enter' }}: <i class="ps-2">x</i></label>
                    <input type="number" wire:model.live="x" id="x" class="input" aria-label="input" step="any" />
                </div>
                <div class="space-y-2">
                    <label for="y" class="font-s-14 text-blue"><i class="ps-2">y</i></label>
                    <input type="number" wire:model.live="y" id="y" class="input" aria-label="input" step="any" />
                </div>
                <div class="space-y-2">
                    <label for="b" class="font-s-14 text-blue"><span class="ps-2">=0</span></label>
                    <input type="number" wire:model.live="b" id="b" class="input" aria-label="input" step="any" />
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

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full bg-light-blue p-3 radius-10 mt-3">
                    @php
                        $calc_type_res = $detail['calc_type'] ?? '2';
                        $x1_res = $detail['x1_used'] ?? 0;
                        $x2_res = $detail['x2_used'] ?? 0;
                        $y1_res = $detail['y1_used'] ?? 0;
                        $y2_res = $detail['y2_used'] ?? 0;
                    @endphp
                    <div class="row font-s-18">
                        @if($calc_type_res == '2')
                            <p class="mt-2"><strong>{{ $lang['slope'] ?? 'Slope' }}</strong></p>
                            <p class="mt-2"><strong>{{ $detail['slope'] ?? '' }}</strong></p>
                            <p class="mt-2"><strong>{{ $lang['si'] ?? 'Slope-Intercept Form' }}: y = mx + b</strong></p>
                            <p class="mt-2"><strong>y = {{ $detail['slope'] }}x {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</strong></p>
                            
                            <p class="mt-2 font-s-25 text-blue text-center">{{ $lang['ans'] ?? 'Detailed Answer' }}</p>
        
                            <p class="mt-2 font-s-25">Solution:</p>
                            <p class="mt-2"><strong>Your Input: \(P = (x_1,y_1)\) and \(Q = (x_2,y_2)\) , \(P = ({{$x1_res}},{{$y1_res}})\) and \(Q = ({{$x2_res}},{{$y2_res}})\)</strong></p>
                            <p class="mt-2">Formula to find Slope: \[m=\frac{y_2 - y_1}{x_2-x_1}\]</p>
                            <p class="mt-2">We have \(x_1={{$x1_res}} , y_1={{$y1_res}}\) , \(x_2={{$x2_res}} \text{ and } y_2={{$y2_res}}\)</p>
                            <p class="mt-2">Plug the given values into the formula for slope:
                                \[m=\frac{({{$y2_res}})-({{$y1_res}})}{({{$x2_res}})-({{$x1_res}})} = {{$detail['slope'] ?? ''}}\]
                            </p>
                            
                            <table class="w-full md:w-[50%] lg:w-[50%]">
                                <tbody>
                                <tr>
                                    <td class="border-b py-2"><b>Percentage Grade:</b></td>
                                    <td class="border-b py-2">{{ ($detail['slope'] ?? 0) * 100 }} %</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['angle'] ?? 'Angle' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['angle'] ?? '') != '' ? $detail['angle'] : '0.0 deg') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['distance'] ?? 'Distance' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['distance'] ?? '') != '' ? $detail['distance'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>x:</b></td>
                                    <td class="border-b py-2">{{ (($detail['x'] ?? '') != '' ? $detail['x'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>y:</b></td>
                                    <td class="border-b py-2">{{ (($detail['y'] ?? '') != '' ? $detail['y'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>X - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ round((-1)*$detail['b']/$detail['slope'],2) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Y - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ $detail['b'] }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                                 wire:key="graph-main-{{ $renderCount }}" 
                                 x-data='{
                                     initGraph() {
                                         if (typeof JXG === "undefined") { setTimeout(() => this.initGraph(), 200); return; }
                                         const data = {!! isset($detail["chartData"]) ? $detail["chartData"] : "{}" !!};
                                         if (!data.box1) return;
                                         this.$nextTick(() => {
                                             const el = document.getElementById("box-main");
                                             if (!el) return;
                                             el.innerHTML = "";
                                             const board = JXG.JSXGraph.initBoard("box-main", { boundingbox: data.box1.bounds, axis: true, showCopyright: false });
                                             const p1 = board.create("point", data.box1.p1, {size: 4, name: "P1"});
                                             const p2 = board.create("point", data.box1.p2, {size: 4, name: "P2"});
                                             board.create("line", [p1, p2]);
                                         });
                                     }
                                 }' 
                                 x-init="initGraph()"
                                 @chartUpdated.window="initGraph()"
                                 wire:ignore>
                                <div id="box-main" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                            </div>
                        @elseif($calc_type_res == 'line')
                            <p class="mt-2 font-s-25 text-blue text-center">{{ $lang['ans'] ?? 'Detailed Answer' }}</p>
                            <table class="w-full md:w-[50%] lg:w-[50%]">
                                <tbody>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['slope'] ?? 'Slope' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['slope'] ?? '') != '' ? $detail['slope'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Percentage Grade:</b></td>
                                    <td class="border-b py-2">{{ ($detail['slope'] ?? 0) * 100 }} %</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['angle'] ?? 'Angle' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['angle'] ?? '') != '' ? $detail['angle'] : '0.0 deg') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>X - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ round((-1)*$detail['b']/$detail['slope'],2) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Y - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ $detail['b'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['si'] ?? 'Slope-Intercept Form' }}: y = mx + b:</b></td>
                                    <td class="border-b py-2">y = {{ $detail['slope'] }}x {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @elseif($calc_type_res == '3')
                            <table class="w-full md:w-[50%] lg:w-[50%]">
                                <tbody>
                                <tr>
                                    <td class="border-b py-2"><b>X₂:</b></td>
                                    <td class="border-b py-2">{{ $detail['x2'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Y₂:</b></td>
                                    <td class="border-b py-2">{{ $detail['y2'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>x:</b></td>
                                    <td class="border-b py-2">{{ (($detail['x'] ?? '') != '' ? $detail['x'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>y:</b></td>
                                    <td class="border-b py-2">{{ (($detail['y'] ?? '') != '' ? $detail['y'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['slope'] ?? 'Slope' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['slope'] ?? '') != '' ? $detail['slope'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Percentage Grade:</b></td>
                                    <td class="border-b py-2">{{ ($detail['slope'] ?? 0) * 100 }} %</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['angle'] ?? 'Angle' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['angle'] ?? '') != '' ? $detail['angle'] : '0.0 deg') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['distance'] ?? 'Distance' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['distance'] ?? '') != '' ? $detail['distance'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>X - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ round((-1)*$detail['b']/$detail['slope'],2) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Y - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ $detail['b'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['si'] ?? 'Slope-Intercept Form' }}: y = mx + b:</b></td>
                                    <td class="border-b py-2">y = {{ $detail['slope'] }}x {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                                 wire:key="graph-main-{{ $renderCount }}" 
                                 x-data='{
                                     initGraph() {
                                         if (typeof JXG === "undefined") { setTimeout(() => this.initGraph(), 200); return; }
                                         const data = {!! isset($detail["chartData"]) ? $detail["chartData"] : "{}" !!};
                                         if (!data.box1) return;
                                         this.$nextTick(() => {
                                             const el = document.getElementById("box-main");
                                             if (!el) return;
                                             el.innerHTML = "";
                                             const board = JXG.JSXGraph.initBoard("box-main", { boundingbox: data.box1.bounds, axis: true, showCopyright: false });
                                             const p1 = board.create("point", data.box1.p1, {size: 4, name: "P1"});
                                             const p2 = board.create("point", data.box1.p2, {size: 4, name: "P2"});
                                             board.create("line", [p1, p2]);
                                         });
                                     }
                                 }' 
                                 x-init="initGraph()"
                                 @chartUpdated.window="initGraph()"
                                 wire:ignore>
                                <div id="box-main" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                            </div>
                        @elseif($calc_type_res == '4')
                            <table class="w-full md:w-[50%] lg:w-[50%]">
                                <tbody>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['slope'] ?? 'Slope' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['slope'] ?? '') != '' ? $detail['slope'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Percentage Grade:</b></td>
                                    <td class="border-b py-2">{{ ($detail['slope'] ?? 0) * 100 }} %</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['angle'] ?? 'Angle' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['angle'] ?? '') != '' ? $detail['angle'] : '0.0 deg') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>X - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ round((-1)*$detail['b']/$detail['slope'],2) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Y - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ $detail['b'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['si'] ?? 'Slope-Intercept Form' }}: y = mx + b:</b></td>
                                    <td class="border-b py-2">y = {{ $detail['slope'] }}x {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @elseif($calc_type_res == '1')
                            <p class="mt-2 font-s-25 text-blue text-center">Right Side</p>
                            <table class="w-full md:w-[50%] lg:w-[50%]">
                                <tbody>
                                <tr>
                                    <td class="border-b py-2"><b>X₂:</b></td>
                                    <td class="border-b py-2">{{ $detail['x2r'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Y₂:</b></td>
                                    <td class="border-b py-2">{{ $detail['y2r'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>x:</b></td>
                                    <td class="border-b py-2">{{ $detail['xr'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>y:</b></td>
                                    <td class="border-b py-2">{{ $detail['yr'] ?? '' }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                                 wire:key="graph-right-{{ $renderCount }}" 
                                 x-data='{
                                     initGraph() {
                                         if (typeof JXG === "undefined") { setTimeout(() => this.initGraph(), 200); return; }
                                         const data = {!! isset($detail["chartData"]) ? $detail["chartData"] : "{}" !!};
                                         if (!data.box1) return;
                                         this.$nextTick(() => {
                                             const el = document.getElementById("box-right");
                                             if (!el) return;
                                             el.innerHTML = "";
                                             const board = JXG.JSXGraph.initBoard("box-right", { boundingbox: data.box1.bounds, axis: true, showCopyright: false });
                                             const p1 = board.create("point", data.box1.p1, {size: 4, name: "P1"});
                                             const p2 = board.create("point", data.box1.p2, {size: 4, name: "P2"});
                                             board.create("line", [p1, p2]);
                                         });
                                     }
                                 }' 
                                 x-init="initGraph()"
                                 @chartUpdated.window="initGraph()"
                                 wire:ignore>
                                <div id="box-right" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                            </div>
                            
                            <p class="mt-2 font-s-25 text-blue text-center">Left Side</p>
                            <table class="w-full md:w-[50%] lg:w-[50%]">
                                <tbody>
                                <tr>
                                    <td class="border-b py-2"><b>X₂:</b></td>
                                    <td class="border-b py-2">{{ $detail['x2l'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Y₂:</b></td>
                                    <td class="border-b py-2">{{ $detail['y2l'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>x:</b></td>
                                    <td class="border-b py-2">{{ $detail['xl'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>y:</b></td>
                                    <td class="border-b py-2">{{ $detail['yl'] ?? '' }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                                 wire:key="graph-left-{{ $renderCount }}" 
                                 x-data='{
                                     initGraph() {
                                         if (typeof JXG === "undefined") { setTimeout(() => this.initGraph(), 200); return; }
                                         const data = {!! isset($detail["chartData"]) ? $detail["chartData"] : "{}" !!};
                                         if (!data.box) return;
                                         this.$nextTick(() => {
                                             const el = document.getElementById("box-left");
                                             if (!el) return;
                                             el.innerHTML = "";
                                             const board = JXG.JSXGraph.initBoard("box-left", { boundingbox: data.box.bounds, axis: true, showCopyright: false });
                                             const p1 = board.create("point", data.box.p1, {size: 4, name: "Q1"});
                                             const p2 = board.create("point", data.box.p2, {size: 4, name: "Q2"});
                                             board.create("line", [p1, p2]);
                                         });
                                     }
                                 }' 
                                 x-init="initGraph()"
                                 @chartUpdated.window="initGraph()"
                                 wire:ignore>
                                <div id="box-left" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                            </div>

                            
                            <p class="col s12 center color_blue font_s25 center">&nbsp;</p>
                    
                            <table class="w-full md:w-[50%] lg:w-[50%]">
                                <tbody>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['slope'] ?? 'Slope' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['slope'] ?? '') != '' ? $detail['slope'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Percentage Grade:</b></td>
                                    <td class="border-b py-2">{{ ($detail['slope'] ?? 0) * 100 }} %</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['angle'] ?? 'Angle' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['angle'] ?? '') != '' ? $detail['angle'] : '0.0 deg') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['distance'] ?? 'Distance' }}:</b></td>
                                    <td class="border-b py-2">{{ (($detail['distance'] ?? '') != '' ? $detail['distance'] : '0.0') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>X - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ round((-1)*$detail['b']/$detail['slope'],2) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>Y - {{ $lang['in'] ?? 'Intercept' }}:</b></td>
                                    <td class="border-b py-2">{{ $detail['b'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><b>{{ $lang['si'] ?? 'Slope-Intercept Form' }}: y = mx + b:</b></td>
                                    <td class="border-b py-2">y = {{ $detail['slope'] }}x {{ (($detail['b'] < 0) ? $detail['b'] : "+ ".$detail['b']) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    @endisset
</form>

@push('calculatorJS')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraph.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
@endpush
</div>
