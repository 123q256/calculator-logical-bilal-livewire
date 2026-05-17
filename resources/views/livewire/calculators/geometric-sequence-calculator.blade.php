<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 flex justify-center">
            <p class="my-1 text-center"><img src="{{asset('images/geom_seq.svg')}}" width="150px" class="px-3" alt="geometric"></p>
            </div>
            <div class="col-span-12">
                <label for="find" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select wire:model.live="find" class="input" id="find" aria-label="select">
                        <option value="gs">{{$lang['2']}}</option>
                        <option value="a1">{{$lang['3']." (a₁)"}}</option>
                        <option value="r">{{$lang['4']." (r)"}}</option>
                        <option value="n">{{$lang['5']." (n)"}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 mb-1 items-center justify-evenly {{ $find === 'n' ? 'flex' : 'hidden' }}" id="cwInput">
                <p class="label"><strong>Calculate by:</strong></p>
                <p id="nthInput">
                    <input type="radio" wire:model.live="cw" id="nth" value="nth">
                    <label for="nth" class="font-s-14">{{$lang['10']}}</label>
                </p>
                <p id="s_nInput">
                    <input type="radio" wire:model.live="cw" id="s_n" value="s_n">
                    <label for="s_n" class="font-s-14">{{$lang['7']}}</label>
                </p>
            </div>
            <div class="col-span-12 {{ $find === 'a1' ? 'hidden' : '' }}" id="a1Input">
                <label for="a1" class="label">{{$lang['3']}} (a₁)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="a1" id="a1" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ $find === 'r' ? 'hidden' : '' }}" id="rInput">
                <label for="r" class="label">{{$lang['4']}} (r)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="r" id="r" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ ($find === 'a1' || $find === 'r' || $find === 'n') ? 'hidden' : '' }}" id="nInput">
                <label for="n" class="label">{{$lang['5']}} (n)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="n" id="n" min="1" max="20" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ ($find === 'n' && $cw === 'nth') ? '' : 'hidden' }}" id="anInput">
                <label for="an" class="label">{{$lang['6']}} a(n)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="an" id="an" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ ($find === 'n' && $cw === 's_n') ? '' : 'hidden' }}" id="snInput">
                <label for="sn" class="label">{{$lang['7']}} S(n)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="sn" id="sn" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 mb-1 {{ ($find === 'a1' || $find === 'r') ? 'flex' : 'hidden' }} items-center justify-evenly" id="a_nInput">
                <p class="label">a</p>
                <div class="flex items-center px-2">
                    (&nbsp;<input type="number" step="any" wire:model.live="n1" id="n1" class="input flex " aria-label="input"/>&nbsp;)
                </div>
                <p class="text-[18px] pe-2">=</p>
                <div>
                    <input type="number" step="any" wire:model.live="a_n" id="a_n" class="input flex " aria-label="input"/>
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
                        {{-- Variables come directly from Livewire properties --}}
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
            
                            <table class="w-full text-[18px]">
                                @if($find==='gs')
                                <div class="row-12 bg-white border p-3 overflow-auto">
                                    <div class="w-full text-center text-[16px]">
                                        <p>n-th term (a<sub class="font-s-14">{{$n}}</sub>)</p>
                                        <p class="my-2"><strong class="px-3 font-s-20 radius-10 text-blue">{{round($detail['an_val'],4)}}</strong></p>
                                    </div>
                                    <div class="w-full text-center text-[16px]">
                                        <p>Geometric Sum (S<sub class="font-s-14">{{$n}}</sub>) </p>
                                        <p class="my-2"><strong class=" px-3 font-s-20 radius-10 text-blue">{{round($detail['sn_val'],4)}}</strong></p>
                                    </div>
                                    <div class="w-full text-center text-[16px]">
                                        <p>{{$lang['11']}}</p>
                                        <p class="my-2"><strong class="px-3 font-s-20 radius-10 text-blue"> \( {{$detail['seq']}} \)</strong></p>
                                    </div>
                                </div>
                                @elseif($find==='a1')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>a<sub class="font-s-14">1</sub></strong></td>
                                        <td class="py-2 border-b">{{round($detail['a1_val'],4)}}</td>
                                    </tr>
                                @elseif($find==='r')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>r</strong></td>
                                        <td class="py-2 border-b">{{round($detail['r_val'],4)}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n</strong></td>
                                        <td class="py-2 border-b">{{round($detail['n_val'],4)}}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['8']}}:</strong></p>
                            @if($find==='gs')
                                <p class="mt-2"><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-2">\( a_1 = {{$a1}}, r = {{$r}}, n = {{$n}} \)</p>
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">\( a_n = a_1 * r^{n-1} \)</p>
                                <p class="mt-2">\( a_{\text{{{$n}}}} = ({{$a1}})*({{$r}})^{ {{$n}} - 1} \)</p>
                                <p class="mt-2">\( a_{\text{{{$n}}}} = ({{$a1}})*({{$r}})^{{{$n-1}}} \)</p>
                                <p class="mt-2">\( a_{\text{{{$n}}}} = ({{$a1}})*({{pow($r,($n-1))}}) \)</p>
                                <p class="mt-2">\( a_{\text{{{$n}}}} = {{$detail['an_val']}} \)</p>
                                <p class="mt-2"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-2">\( S_n = \dfrac{a_1*(1 - r^n)}{1 - r} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = \dfrac{ {{$a1}}*(1 - {{$r}}^{ {{$n}}})}{1 - {{$r}}} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = \dfrac{ {{$a1}}*(1 - {{pow($r,$n)}})}{ {{1-$r}}} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = \dfrac{ {{$a1}}*({{1-pow($r,$n)}})}{ {{1-$r}}} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = \dfrac{ {{$a1*(1-pow($r,$n))}} }{ {{1-$r}}} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = {{$detail['sn_val']}} \)</p>
                                
                                @php
                                    $gsPoints = [];
                                    for ($gi = 1; $gi <= 10; $gi++) {
                                        $gsPoints[] = [$gi, round($a1 * pow($r, $gi - 1), 6)];
                                    }
                                    $gsYVals = array_column($gsPoints, 1);
                                    $gsYMin  = min($gsYVals);
                                    $gsYMax  = max($gsYVals);
                                    $gsRange = max(abs($gsYMax - $gsYMin), 1);
                                    $gsChartData = json_encode([
                                        'points' => $gsPoints,
                                        'bounds' => [0, $gsYMax + $gsRange * 0.15, 11, $gsYMin - $gsRange * 0.15],
                                    ]);
                                @endphp
                                <div class="w-full mt-4"
                                     data-chart="{{ $gsChartData }}"
                                     x-data="{
                                         initGraph() {
                                             if (typeof JXG === 'undefined') { setTimeout(() => this.initGraph(), 200); return; }
                                             const data = JSON.parse(this.$el.getAttribute('data-chart'));
                                             this.$nextTick(() => {
                                                 const el = document.getElementById('gs-seq-chart');
                                                 if (!el) return;
                                                 el.innerHTML = '';
                                                 const board = JXG.JSXGraph.initBoard('gs-seq-chart', {
                                                     boundingbox: data.bounds, axis: true, showCopyright: false,
                                                     defaultAxes: {
                                                         x: { name: 'n', withLabel: true, label: { position: 'rt', offset: [-5, 20] } },
                                                         y: { name: 'aₙ', withLabel: true, label: { offset: [-30, 0] } }
                                                     }
                                                 });
                                                 const pts = data.points.map(p =>
                                                     board.create('point', p, { size: 5, color: '#3B82F6', name: 'n='+p[0], label: { fontSize: 11 } })
                                                 );
                                                 for (let i = 0; i < pts.length - 1; i++) {
                                                     board.create('segment', [pts[i], pts[i+1]], { strokeColor: '#3B82F6', strokeWidth: 2 });
                                                 }
                                             });
                                         }
                                     }"
                                     x-init="initGraph()"
                                     wire:key="gs-chart-{{ md5($gsChartData) }}">
                                    <div id="gs-seq-chart" wire:ignore class="w-full rounded-lg" style="height: 350px; background-color: #f7f7f7; border: 1px solid #ddd;"></div>
                                </div>
                            @elseif($find==='a1')
                                <p class="mt-2">\( a₁ = \dfrac{a_n}{r^{n-1}} \)</p>
                                <p class="mt-2">\( a₁ = \dfrac{ {{$a_n}} }{({{$r}})^{ {{$n1}} - 1}} \)</p>
                                <p class="mt-2">\( a₁ = \dfrac{ {{$a_n}} }{({{$r}})^{ {{$n1-1}} }} \)</p>
                                <p class="mt-2">\( a₁ = \dfrac{ {{$a_n}} }{ {{pow($r,($n1-1))}} } \)</p>
                                <p class="mt-2">\( a₁ = {{$detail['a1_val']}} \)</p>
                            @elseif($find==='r')
                                <p class="mt-2">\( r = \sqrt[\large{n-1}]{\dfrac{a_n}{a_1}} \)</p>
                                <p class="mt-2">\( r = \sqrt[\large{ {{$n1}} }-1]{\dfrac{ {{$a_n}} }{ {{$a1}} }} \)</p>
                                <p class="mt-2">\( r = \sqrt[\large{ {{$n1-1}} }]{ {{$a_n/$a1}} } \)</p>
                                <p class="mt-2">\( r = {{$detail['r_val']}} \)</p>
                            @else
                                @if($cw==='nth')
                                    <p class="mt-2">\( n = \dfrac{log \left(\dfrac{a_n}{a_1} \right)}{log(r)}+1 \)</p>
                                    <p class="mt-2">\( n = \dfrac{log \left(\dfrac{ {{$an}} }{ {{$a1}} } \right)}{log({{$r}})}+1 \)</p>
                                    <p class="mt-2">\( n = \dfrac{log({{$an/$a1}})}{log({{$r}})}+1 \)</p>
                                    <p class="mt-2">\( n = {{log(($an/$a1))/log($r)}}+1 \)</p>
                                    <p class="mt-2">\( n = {{$detail['n_val']}} \)</p>
                                @else
                                    <p class="mt-2">\( n = \dfrac{log \left (\left(\left( \dfrac{S_n}{a_1} \right)*(1-r)-1 \right) * (-1) \right)}{log(r)} \)</p>
                                    <p class="mt-2">\( n = \dfrac{log \left (\left(\left( \dfrac{ {{$sn}} }{ {{$a1}} } \right)*(1-{{$r}})-1 \right) * (-1) \right)}{log({{$r}})} \)</p>
                                    <p class="mt-2">\( n = \dfrac{log((({{$sn/$a1}})*({{1-$r}})-1)*(-1))}{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\( n = \dfrac{log(({{($sn/$a1)*(1-$r)}}-1)*(-1))}{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\( n = \dfrac{log(({{($sn/$a1)*(1-$r)-1}})*(-1))}{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\(
                                    n = \dfrac{log({{((($sn/$a1)*(1-$r))-1)*(-1)}})}{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\( n = \dfrac{ {{log(((($sn/$a1)*(1-$r))-1)*(-1))}} }{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\( n = {{$detail['n_val']}} \)</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
        @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="if (typeof renderMathInElement === 'function') { renderMathInElement(document.body); }"></script>
        <script src="https://jsxgraph.org/distrib/jsxgraphcore.js"></script>
        <link rel="stylesheet" href="https://jsxgraph.org/distrib/jsxgraph.css">
    @endpush
</form>
</div>
