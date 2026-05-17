<div>
<style>
    @media (max-width: 380px) {
        .calculator-box{
            padding-left: 0.5rem; 
            padding-right: 0.5rem; 
        }
    }
    .velocitytab .tagsUnit{
        border-bottom: 3px solid var(--light-blue);
        color: white;
    }
    .velocitytab p{
        position: relative;
        top: 2px;
        font-weight: 600;
    }
    .velocitytab p:hover{
        background: gainsboro;
    }
    .active{
        background-color: var(--light-blue);
        color: white;
    }
</style>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class=" mx-auto mt-2  w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 velocitytab">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <button type="button" wire:click="setVertexType('standard')" class="w-full bg-white px-3 py-2 cursor-pointer rounded-md transition-colors veloTabs duration-300 hover_tags hover:text-white {{ $vertex_type === 'standard' ? 'tagsUnit' : '' }}">
                                {{ $lang['12'] }}
                        </button>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <button type="button" wire:click="setVertexType('vertex')" class="w-full bg-white px-3 py-2 cursor-pointer rounded-md transition-colors veloTabs duration-300 hover_tags hover:text-white {{ $vertex_type === 'vertex' ? 'tagsUnit' : '' }}">
                                {{ $lang['11'] }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
            
            <div id="simpleInput" class="col-span-12 {{ $vertex_type === 'standard' ? '' : 'hidden' }}">
                <p class="text-center my-2 text-[14px]"><strong>Standard Form :</strong> y = ax<sup class="font-s-12">2</sup> + bx + c</p>
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-4">
                        <label for="a1" class="label">Enter a:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="a1" id="a1" class="input" wire:model.live="a1" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="b1" class="label">Enter b:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="b1" id="b1" class="input" wire:model.live="b1" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="c1" class="label">Enter c:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="c1" id="c1" class="input" wire:model.live="c1" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>

            <div id="advancedInput" class="col-span-12 {{ $vertex_type === 'vertex' ? '' : 'hidden' }}">
                <p class="text-center my-2 text-[14px]"><strong>Vertex Form : </strong>f(x) = A (x - H)<sup class="font-s-12">2</sup> + K</p>
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-4">
                        <label for="a" class="label">Enter A:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="a" id="a" class="input" wire:model.live="a" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="b" class="label">Enter H:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="b" id="b" class="input" wire:model.live="b" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="c" class="label">Enter K:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="c" id="c" class="input" wire:model.live="c" aria-label="input"/>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result overflow-auto">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @php
                        $a_val = $detail['A'];
                        $b_val = $detail['B'];
                        $c_val = $detail['C'];
                    @endphp
                    <div class="w-full">
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                            <table class="w-full text-[18px]">
                                @if($detail['submit'] === "standard")
                                    <tr>
                                        <td class="py-2 border-b" width="35%"><strong>{{ $lang['6'] }}</strong></td>
                                        <td class="py-2 border-b">
                                            \( f({{$detail['variable_ans']}}) = {{$detail['vertex']}} \)
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="35%"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">
                                            \( f({{$detail['variable_ans']}}) = {{$detail['A']}} {{$detail['variable_ans']}}^2 {{(($detail['B'] < 0) ? $detail['B'] : ' + ' . $detail['B'])}} {{$detail['variable_ans']}} {{ (($detail['C'] < 0) ? $detail['C'] : ' + ' . $detail['C']) }} \)
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <p class="mt-2 text-[16px]"><strong>{{$lang['7']}}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[16px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%">{{ $lang['8'] }}</td>
                                    <td class="py-2 border-b">
                                        \( P({{$detail['firstx']}}, {{round($detail['yaxis'],3)}}) \)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%">{{ $lang['9'] }}</td>
                                    <td class="py-2 border-b">
                                        \( P(0, {{$detail['C']}}) \)
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['15']}}</strong></p>
                            <p class="mt-2">{{$lang[16]}}:</p>
                            <p class="mt-2 overflow-auto">\(f({{ $detail['variable_ans'] }}) = {{ $detail['A'] }}{{ $detail['variable_ans'] }}^2 {{ (($detail['B'] < 0) ? $detail['B'] : ' + ' . $detail['B']) }}{{ $detail['variable_ans'] }} {{ (($detail['C'] < 0) ? $detail['C'] : ' + ' . $detail['C']) }}\)</p>
                            <p class="mt-2">({{$lang[17]}})</p>
                            <p class="col s12 overflow-auto">\(f({{ $detail['variable_ans'] }}) = {{ $a_val }} \left({{ $detail['variable_ans'] }}^2 {{ (($b_val / $a_val < 0) ? $b_val / $a_val : ' + ' . $b_val / $a_val) }}{{ $detail['variable_ans'] }} {{ (($c_val < 0) ? $c_val : ' + ' . $c_val) }}\right)\)</p>
                            <p class="mt-2">({{$lang[18]}})</p>
                            <p class="col s12 overflow-auto">\(f({{ $detail['variable_ans'] }}) = {{ $a_val }} \left({{ $detail['variable_ans'] }}^2 {{ (($b_val / $a_val < 0) ? $b_val / $a_val : ' + ' . $b_val / $a_val) }}{{ $detail['variable_ans'] }} + \left( \dfrac{ {{ $b_val }} }{ {{ $a_val * 2 }} } \right)^2 - \left( \dfrac{ {{ $b_val }} }{ {{ $a_val * 2 }} } \right)^2 + \dfrac{ {{ $c_val }} }{ {{ $a_val }} }\right)\)</p>
                            <p class="mt-2">({{$lang[19]}})</p>
                            <p class="col s12 overflow-auto">\(f({{ $detail['variable_ans'] }}) = {{ $a_val }} \left(\left({{ $detail['variable_ans'] }} + \frac{ {{ $b_val }} }{ {{ $a_val * 2 }} }\right)^2 - \left(\dfrac{ {{ $b_val }} }{ {{ $a_val * 2 }} }\right)^2 + \dfrac{ {{ $c_val }} }{ {{ $a_val }} }\right) \)</p>
                            <p class="mt-2">({{$lang[20]}})</p>
                            <p class="col s12 overflow-auto" style="height: 50px;">\(f({{ $detail['variable_ans'] }}) = {{ $a_val }} \left(\left({{ $detail['variable_ans'] }} + \frac{ {{ $b_val }} }{ {{ $a_val * 2 }} }\right)^2 + \dfrac{ {{ $detail['yaxis'] * (pow($a_val * $detail['round1'], 2) / $a_val) }} }{ {{ pow($a_val * $detail['round1'], 2) }} }\right) \)</p>
                            <p class="mt-2">({{$lang[21]}})</p>
                            <p class="col s12 overflow-auto"  style="height: 53px;">\(f({{ $detail['variable_ans'] }}) = {{ $a_val }}\left({{ $detail['variable_ans'] }} + \frac{ {{ $b_val }} }{ {{ $a_val * 2 }} }\right)^2 + \dfrac{ {{ $detail['yaxis'] * (pow($a_val * $detail['round1'], 2) / $a_val) }} }{ {{ pow($a_val * $detail['round1'], 2) / $a_val }} } \)</p>
                            <p class="mt-4"><strong>{{$lang[22]}}:</strong></p>
                            
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" 
                                 wire:key="graph-main-{{ $renderCount }}" 
                                 x-data='{
                                     initGraph() {
                                         if (typeof JXG === "undefined") { setTimeout(() => this.initGraph(), 200); return; }
                                         const detail = @json($detail ?? null);
                                         if (!detail) return;
                                         this.$nextTick(() => {
                                             const el = document.getElementById("box-main");
                                             if (!el) return;
                                             el.innerHTML = "";
                                             
                                             const a = parseFloat(detail.A);
                                             const b = parseFloat(detail.B);
                                             const c = parseFloat(detail.C);
                                             const h = parseFloat(detail.firstx);
                                             const k = parseFloat(detail.yaxis);
                                             
                                             const xDiff = Math.max(10, Math.abs(h));
                                             const yDiff = Math.max(15, Math.abs(k - c));
                                             const bounds = [
                                                 h - xDiff - 2,
                                                 a > 0 ? k + yDiff * 2 : k + 5,
                                                 h + xDiff + 2,
                                                 a > 0 ? k - 5 : k - yDiff * 2
                                             ];
                                             
                                             const board = JXG.JSXGraph.initBoard("box-main", { boundingbox: bounds, axis: true, showCopyright: false });
                                             
                                             // Draw parabola function curve
                                             board.create("functiongraph", [x => a * x * x + b * x + c], { strokeWidth: 2, strokeColor: "#13699E" });
                                             
                                             // Draw vertex point
                                             board.create("point", [h, k], { size: 5, name: "Vertex", color: "#a52714", fixed: true });
                                             
                                             // Draw Y-Intercept point
                                             board.create("point", [0, c], { size: 5, name: "Y-Intercept", color: "#33a1e3", fixed: true });
                                         });
                                     }
                                 }' 
                                 x-init="initGraph()"
                                 @chartUpdated.window="initGraph()"
                                 wire:ignore>
                                <div id="box-main" class="jxgbox w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                            </div>
                            
                            <div class="flex justify-center item-center text-[18px] mt-4">
                                <p class="flex items-center mr-4"><span style="display:inline-block; width:12px; height:12px; background-color:#a52714; border-radius:50%; margin-right:6px;"></span>Vertex </p>
                                <p class="flex items-center"><span style="display:inline-block; width:12px; height:12px; background-color:#33a1e3; border-radius:50%; margin-right:6px;"></span>Y-Intercept</p>
                            </div>
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
        
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="if (typeof renderMathInElement === 'function') renderMathInElement(document.body);"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });

            document.addEventListener('livewire:initialized', () => {
                @this.on('chartUpdated', () => {
                    window.dispatchEvent(new Event('chartUpdated'));
                });
            });
        </script>
    @endpush
</form>
</div>
