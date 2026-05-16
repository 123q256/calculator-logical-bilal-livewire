 <div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="formType" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" wire:model.live="formType" name="formType" id="formType">
                            <option value="2">{{$lang[2]}}</option>
                            <option value="1">{{$lang[3]}} & {{$lang[4]}} (m)</option>
                            <option value="3">{{$lang[3]}} (c) & {{$lang[4]}} (m)</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="x1" class="label f1_text">
                        @if($formType =='3')
                            {{$lang[5]}} (c):
                        @else 
                            X₁:
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="x1" name="x1" id="x1" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="y1" class="label f2_text">
                        @if($formType =='3')
                            {{$lang[4]}} (m):
                        @else 
                            Y₁:
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="y1" name="y1" id="y1" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6 @if($formType === '3') hidden @endif x2Input">
                    <label for="x2" class="label f3_text">
                        @if($formType =='1')
                            {{$lang[4]}} (m):
                        @else
                            X₂: 
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="x2" name="x2" id="x2" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6 @if($formType === '1' || $formType === '3') hidden @endif x3Input">
                    <label for="y2" class="label f4_text">Y₂:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="y2" name="y2" id="y2" class="input" aria-label="input" />
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
                            <div class="w-full">
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="55%"><strong>{{$lang[4]}}-{{$lang[6]}}</strong></td>
                                            <td class="py-2 border-b">y = {{$detail['slope']}}x {{ (($detail['b']<0)?$detail['b']:"+ ".$detail['b']) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-16">
                                    <tr>
                                        <td class="py-2 border-b" width="55%">{{$lang[4]}} (m)</td>
                                        <td class="py-2 border-b"><strong>{{ isset($detail['slope']) ? $detail['slope'] : "0" }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="55%">Y - {{$lang[5]}} (c)</td>
                                        <td class="py-2 border-b"><strong>{{$detail['b']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="55%">X - {{$lang[5]}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['slope'] != 0 ? round((-1)*$detail['b']/$detail['slope'], 2) : "N/A"}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="55%">{{$lang[7]}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['slope']*100}}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="55%">{{$lang[8]}} (θ)</td>
                                        <td class="py-2 border-b"><strong>{{ isset($detail['angle']) ? $detail['angle'] : "0 deg" }}</strong></td>
                                    </tr>
                                    @if($formType === "2")
                                        <tr>
                                            <td class="py-2 border-b" width="55%">Δx</td>
                                            <td class="py-2 border-b"><strong>{{ isset($detail['x']) ? $detail['x'] : "0" }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="55%">Δy</td>
                                            <td class="py-2 border-b"><strong>{{ isset($detail['y']) ? $detail['y'] : "0" }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="55%">{{$lang[9]}}</td>
                                            <td class="py-2 border-b"><strong>{{ isset($detail['distance']) ? $detail['distance'] : "0" }}</strong></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            @if($formType === "2")
                                <div wire:key="graph-{{ $renderCount }}" x-data="{
                                    initGraph() {
                                        if (typeof JXG === 'undefined') return;
                                        var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [{{$x2 - 5}}, {{$y1 + 5}}, {{$x1 + 5}}, {{$y2 - 5}}], axis:true});
                                        var p1 = board.create('point', [{{$x1}}, {{$y1}}], {name: 'P1'});
                                        var p2 = board.create('point', [{{$x2}}, {{$y2}}], {name: 'P2'});
                                        var l1 = board.create('line', [p1, p2]);
                                    }
                                }" x-init="initGraph()" id="box1" class="col-lg-10 mt-4 mx-auto" style="height: 350px;"></div>
                            @endif
                        </div>
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
