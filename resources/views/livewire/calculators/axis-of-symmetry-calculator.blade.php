<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="eq" class="font-s-14 text-blue">{{$lang['1'] ?? 'Equation'}} f(x):</label>
                <div class="w-full py-2">
                    <input type="text" wire:model.live="eq" id="eq" class="input" aria-label="input" />
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result"
         x-init="setTimeout(() => { if (typeof MathJax !== 'undefined' && MathJax.Hub) MathJax.Hub.Queue(['Typeset', MathJax.Hub]); }, 100)">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] ?? 'Axis of Symmetry' }}</strong></td>
                                    <td class="py-2 border-b">\( x = {{$detail['asal_jawab']}} \)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 text-[16px]">
                            <p class="mt-3"><strong>{{$lang['4'] ?? 'Steps:'}}</strong></p>
                            <p class="mt-3">{{$lang[10] ?? 'Given quadratic equation is:'}} \( f(x) = {{$detail['input_eq']}} \).</p>
                            @if($detail['input_eq'] !== $detail['expand_eq'])
                                <p class="mt-3">{{$lang[11] ?? 'First expand the equation:'}} \( f(x) = {{$detail['input_eq']}} \).</p>
                                <p class="mt-3">{{$lang[12] ?? 'The expanded equation is:'}}</p>
                                <p class="mt-3">\( {{$detail['input_eq']}} = {{$detail['expand_eq']}} \).</p>
                            @endif
                            <p class="mt-3">{{$lang[13] ?? 'The axis of symmetry formula is:'}}</p>
                            <p class="mt-3">\( x = - \frac{b}{2a} \)</p>
                            <p class="mt-3">{{$lang[14] ?? 'Extracting the coefficients:'}}</p>
                            <p class="mt-3">\( a = {{$detail['coeff_a']}} \)</p>
                            <p class="mt-3">\( b = {{$detail['coeff_b']}} \)</p>
                            <p class="mt-3">\( c = {{$detail['coeff_c']}} \)</p>
                            <p class="mt-3">{{$lang[15] ?? 'Plug the values into the formula:'}}</p>
                            <p class="mt-3">\( x = - \frac{b}{2a} = - \frac{ {{$detail['coeff_b']}}}{2 \times {{$detail['coeff_a']}}} = {{$detail['asal_jawab']}} \)</p>
                            <p class="mt-3">{{$lang['16'] ?? 'Therefore, the Axis of Symmetry is:'}} \( x = {{$detail['asal_jawab']}} \)</p>
                            <p class="mt-3">{{$lang['17'] ?? 'Axis of Symmetry Graph:'}}</p>
                            <div class="w-full lg:w-[90%] mt-4 mx-auto" 
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
                                             const board = JXG.JSXGraph.initBoard("box-main", { 
                                                 boundingbox: data.box1.bounds, 
                                                 axis: true, 
                                                 showCopyright: false,
                                                 keepaspectratio: false
                                             });
                                             
                                             // Plot the parabola
                                             board.create("functiongraph", [function(x){
                                                 return data.box1.a * x * x + data.box1.b * x + data.box1.c;
                                             }], {strokeColor: "#2845F5", strokeWidth: 3});

                                             // Plot the Vertex point
                                             const p1 = board.create("point", data.box1.p1, {
                                                 size: 4, 
                                                 color: "#10b981", 
                                                 name: "Vertex (" + data.box1.p1[0].toFixed(2) + ", " + data.box1.p1[1].toFixed(2) + ")",
                                                 fixed: true
                                             });

                                             // Plot Axis of Symmetry Line
                                             board.create("line", [[data.box1.p1[0], -10000], [data.box1.p1[0], 10000]], {
                                                 dash: 2,
                                                 strokeColor: "#ef4444",
                                                 strokeWidth: 2,
                                                 name: "x = " + data.box1.p1[0].toFixed(2),
                                                 withLabel: true,
                                                 label: {position: "urt", offset: [10, 10], color: "#ef4444"}
                                             });
                                         });
                                     }
                                 }' 
                                 x-init="initGraph()"
                                 @chartUpdated.window="initGraph()"
                                 wire:ignore>
                                <div id="box-main" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
    </script>
@endpush
</div>
