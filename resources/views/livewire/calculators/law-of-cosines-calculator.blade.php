<div x-on:show-result.window="showResult = true"
    x-data="{
        cal: $wire.entangle('cal'),
        side_a_unit: $wire.entangle('side_a_unit'),
        side_b_unit: $wire.entangle('side_b_unit'),
        side_c_unit: $wire.entangle('side_c_unit'),
        angle_a_unit: $wire.entangle('angle_a_unit'),
        angle_b_unit: $wire.entangle('angle_b_unit'),
        angle_c_unit: $wire.entangle('angle_c_unit'),
        open_a: false, open_b: false, open_c: false,
        open_A: false, open_B: false, open_C: false,
        showResult: {{ isset($detail) && $detail ? 'true' : 'false' }},
        showField(field) {
            const show = {
                a: ['aa','ab','ac','sb','sc'],
                b: ['aa','ab','ac','sa','sc'],
                c: ['aa','ab','ac','sa','sb'],
                A: ['sa'],
                B: ['sb'],
                C: ['sc']
            };
            return (show[field] || []).includes(this.cal);
        },
        onInputChange() { this.showResult = false; }
    }"
>
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

    <form wire:submit.prevent="calculate" @input.capture="onInputChange()">

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

                    <div class="col-span-6">
                        {{-- Calculate select --}}
                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="cal" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                            <div class="w-full py-2">
                                <select x-model="cal" @change="onInputChange()" name="cal" class="input" id="cal" aria-label="select">
                                    <option value="aa">{{$lang['2']." A"}}</option>
                                    <option value="ab">{{$lang['2']." B"}}</option>
                                    <option value="ac">{{$lang['2']." C"}}</option>
                                    <option value="sa">{{$lang['3']." a"}}</option>
                                    <option value="sb">{{$lang['3']." b"}}</option>
                                    <option value="sc">{{$lang['3']." c"}}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Side a: hidden when cal=sa --}}
                        <div class="col-12 mt-0 mt-lg-2"
                             x-show="showField('a')"
                             style="{{ !in_array($cal, ['aa','ab','ac','sb','sc']) ? 'display:none' : '' }}"
                             id="a">
                            <label for="side_a" class="font-s-14 text-blue">{{ $lang['3'] }} a:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="side_a" name="side_a" id="side_a" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $side_a }}" aria-label="input" placeholder="00"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_a = !open_a" x-text="side_a_unit + ' ▾'"></label>
                                <div x-show="open_a" @click.away="open_a = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    <template x-for="u in ['mm','cm','m','km','dm','in','ft','yd','mi','nmi']" :key="u">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="side_a_unit = u; open_a = false" x-text="u"></p>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- Side b: hidden when cal=sb --}}
                        <div class="col-12 mt-0 mt-lg-2"
                             x-show="showField('b')"
                             style="{{ !in_array($cal, ['aa','ab','ac','sa','sc']) ? 'display:none' : '' }}"
                             id="b">
                            <label for="side_b" class="font-s-14 text-blue">{{ $lang['3'] }} b:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="side_b" name="side_b" id="side_b" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $side_b }}" aria-label="input" placeholder="00"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_b = !open_b" x-text="side_b_unit + ' ▾'"></label>
                                <div x-show="open_b" @click.away="open_b = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    <template x-for="u in ['mm','cm','m','km','dm','in','ft','yd','mi','nmi']" :key="u">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="side_b_unit = u; open_b = false" x-text="u"></p>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- Side c: hidden when cal=sc --}}
                        <div class="col-12 mt-0 mt-lg-2"
                             x-show="showField('c')"
                             style="{{ !in_array($cal, ['aa','ab','ac','sa','sb']) ? 'display:none' : '' }}"
                             id="c">
                            <label for="side_c" class="font-s-14 text-blue">{{ $lang['3'] }} c:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="side_c" name="side_c" id="side_c" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $side_c }}" aria-label="input" placeholder="00"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_c = !open_c" x-text="side_c_unit + ' ▾'"></label>
                                <div x-show="open_c" @click.away="open_c = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    <template x-for="u in ['mm','cm','m','km','dm','in','ft','yd','mi','nmi']" :key="u">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="side_c_unit = u; open_c = false" x-text="u"></p>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- Angle A: shown only when cal=sa --}}
                        <div class="col-12 mt-0 mt-lg-2"
                             x-show="showField('A')"
                             style="{{ $cal !== 'sa' ? 'display:none' : '' }}"
                             id="A">
                            <label for="angle_a" class="font-s-14 text-blue">{{ $lang['2'] }} A (α):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="angle_a" name="angle_a" id="angle_a" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $angle_a }}" aria-label="input" placeholder="00"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_A = !open_A" x-text="angle_a_unit + ' ▾'"></label>
                                <div x-show="open_A" @click.away="open_A = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    <template x-for="u in ['deg','rad','gon','tr','arcmin','arcsec','mrad','μrad','pirad']" :key="u">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="angle_a_unit = u; open_A = false" x-text="u"></p>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- Angle B: shown only when cal=sb --}}
                        <div class="col-12 mt-0 mt-lg-2"
                             x-show="showField('B')"
                             style="{{ $cal !== 'sb' ? 'display:none' : '' }}"
                             id="B">
                            <label for="angle_b" class="font-s-14 text-blue">{{ $lang['2'] }} B (β):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="angle_b" name="angle_b" id="angle_b" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $angle_b }}" aria-label="input" placeholder="00"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_B = !open_B" x-text="angle_b_unit + ' ▾'"></label>
                                <div x-show="open_B" @click.away="open_B = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    <template x-for="u in ['deg','rad','gon','tr','arcmin','arcsec','mrad','μrad','pirad']" :key="u">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="angle_b_unit = u; open_B = false" x-text="u"></p>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- Angle C: shown only when cal=sc --}}
                        <div class="col-12 mt-0 mt-lg-2"
                             x-show="showField('C')"
                             style="{{ $cal !== 'sc' ? 'display:none' : '' }}"
                             id="C">
                            <label for="angle_c" class="font-s-14 text-blue">{{ $lang['2'] }} C (γ):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="angle_c" name="angle_c" id="angle_c" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $angle_c }}" aria-label="input" placeholder="00"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_C = !open_C" x-text="angle_c_unit + ' ▾'"></label>
                                <div x-show="open_C" @click.away="open_C = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    <template x-for="u in ['deg','rad','gon','tr','arcmin','arcsec','mrad','μrad','pirad']" :key="u">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="angle_c_unit = u; open_C = false" x-text="u"></p>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Equation + image --}}
                    <div class="col-span-6 flex items-center">
                        <div>
                            <div class="col-12 font-s-20 text-center flex items-center">
                                <p x-show="cal === 'aa'" style="{{ $cal !== 'aa' ? 'display:none' : '' }}">\( A = \cos^{-1} \left[ \dfrac{b^2+c^2-a^2}{2bc} \right] \)</p>
                                <p x-show="cal === 'ab'" style="{{ $cal !== 'ab' ? 'display:none' : '' }}">\( B = \cos^{-1} \left[ \dfrac{a^2+c^2-b^2}{2ac} \right] \)</p>
                                <p x-show="cal === 'ac'" style="{{ $cal !== 'ac' ? 'display:none' : '' }}">\( C = \cos^{-1} \left[ \dfrac{a^2+b^2-c^2}{2ab} \right] \)</p>
                                <p x-show="cal === 'sa'" style="{{ $cal !== 'sa' ? 'display:none' : '' }}">\( a = \sqrt{b^2 + c^2 - 2bc \cos A } \)</p>
                                <p x-show="cal === 'sb'" style="{{ $cal !== 'sb' ? 'display:none' : '' }}">\( b = \sqrt{a^2 + c^2 - 2ac \cos B } \)</p>
                                <p x-show="cal === 'sc'" style="{{ $cal !== 'sc' ? 'display:none' : '' }}">\( c = \sqrt{a^2 + b^2 - 2ab \cos C } \)</p>
                            </div>
                            <div class="col-12 text-center mt-5 flex items-center justify-center">
                                <img src="{{ asset('images/law_of_cosines.webp') }}" width="75%" height="100%" alt="Law of Cosines" loading="lazy" decoding="async">
                            </div>
                        </div>
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
    </form>

    @isset($detail)
    @php
        $A = $detail['angle_a'];
        $B = $detail['angle_b'];
        $C = $detail['angle_c'];
        $a = $detail['side_a'];
        $b = $detail['side_b'];
        $c = $detail['side_c'];
    @endphp
    <div x-show="showResult">
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%">
                                    <strong>
                                        @if($cal === 'aa') {{$lang['2']}} A
                                        @elseif($cal === 'ab') {{$lang['2']}} B
                                        @elseif($cal === 'ac') {{$lang['2']}} C
                                        @elseif($cal === 'sa') {{$lang['3']}} a
                                        @elseif($cal === 'sb') {{$lang['3']}} b
                                        @elseif($cal === 'sc') {{$lang['3']}} c
                                        @endif
                                    </strong>
                                </td>
                                <td class="py-2 border-b">
                                    @if($cal === 'aa') {{ safe_round($A,5) }}°
                                    @elseif($cal === 'ab') {{ safe_round($B,5) }}°
                                    @elseif($cal === 'ac') {{ safe_round($C,5) }}°
                                    @elseif($cal === 'sa') {{ safe_round($a,5) }} cm
                                    @elseif($cal === 'sb') {{ safe_round($b,5) }} cm
                                    @elseif($cal === 'sc') {{ safe_round($c,5) }} cm
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-span-12 text-[16px]">
                        <p class="mt-2"><strong>{{ $lang['4'] }}:</strong></p>
                        @if($cal === 'aa')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} A</p>
                            <p class="mt-2">\( A = \cos^{-1} \left[ \dfrac{b^2+c^2-a^2}{2bc} \right] \)</p>
                            <p class="mt-2">\( A = \cos^{-1} \) \( \left[\frac{ {{safe_round($b,5)}}^2\space+\space{{safe_round($c,5)}}^2\space-\space{{safe_round($a,5)}}^2}{2\space\times\space{{safe_round($b,5)}}\space\times\space{{safe_round($c,5)}}} \right] \)</p>
                            <p class="mt-2">\( A = {{safe_round($A,5)}}^\circ \)</p>
                        @elseif($cal === 'ab')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} B</p>
                            <p class="mt-2">\( B = \cos^{-1} \left[ \dfrac{a^2+c^2-b^2}{2ac} \right] \)</p>
                            <p class="mt-2">\( B = \cos^{-1} \)<span>\( \left[\frac{ {{safe_round($a,5)}}^2\space+\space{{safe_round($c,5)}}^2\space-\space{{safe_round($b,5)}}^2}{2\space\times\space{{safe_round($a,5)}}\space\times\space{{safe_round($c,5)}}} \right] \)</span></p>
                            <p class="mt-2">\( B = {{safe_round($B,5)}}^\circ \)</p>
                        @elseif($cal === 'ac')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} C</p>
                            <p class="mt-2">\( C = \cos^{-1} \left[ \dfrac{a^2+b^2-c^2}{2ab} \right] \)</p>
                            <p class="mt-2">\( C = \cos^{-1} \)<span>\( \left[\frac{ {{safe_round($a,5)}}^2\space+\space{{safe_round($b,5)}}^2\space-\space{{safe_round($c,5)}}^2}{2\space\times\space{{safe_round($a,5)}}\space\times\space{{safe_round($b,5)}}} \right] \)</span></p>
                            <p class="mt-2">\( C = {{safe_round($C,5)}}^\circ \)</p>
                        @elseif($cal === 'sa')
                            <p class="mt-2">{{$lang['5']}} {{$lang['3']}} a</p>
                            <p class="mt-2">\( a = \sqrt{b^2 + c^2 - 2bc \cos A } \)</p>
                            <p class="mt-2">\( a = \sqrt{ {{safe_round($b,5)}}^2 + {{safe_round($c,5)}}^2 - 2\times{{safe_round($b,5)}}\times{{safe_round($c,5)}} \cos ({{safe_round($A,5)}} ^\circ) } \)</p>
                            <p class="mt-2">\( a = {{safe_round($a,5)}} \)</p>
                        @elseif($cal === 'sb')
                            <p class="mt-2">{{$lang['5']}} {{$lang['3']}} b</p>
                            <p class="mt-2">\( b = \sqrt{a^2 + c^2 - 2ac \cos B } \)</p>
                            <p class="mt-2">\( b = \sqrt{ {{safe_round($a,5)}}^2 + {{safe_round($c,5)}}^2 - 2\times{{safe_round($a,5)}}\times{{safe_round($c,5)}} \cos ({{safe_round($B,5)}} ^\circ) } \)</p>
                            <p class="mt-2">\( b = {{safe_round($b,5)}} \)</p>
                        @elseif($cal === 'sc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['3']}} c</p>
                            <p class="mt-2">\( c = \sqrt{a^2 + b^2 - 2ab \cos C } \)</p>
                            <p class="mt-2">\( c = \sqrt{ {{safe_round($a,5)}}^2 + {{safe_round($b,5)}}^2 - 2\times{{safe_round($a,5)}}\times{{safe_round($b,5)}} \cos ({{safe_round($C,5)}} ^\circ) } \)</p>
                            <p class="mt-2">\( c = {{safe_round($c,5)}} \)</p>
                        @endif
                        <p class="mt-2">{{$lang['6']}}</p>
                        <p class="mt-2">\( a = {{safe_round($a,5)}}\space cm \)</p>
                        <p class="mt-2">\( b = {{safe_round($b,5)}}\space cm \)</p>
                        <p class="mt-2">\( c = {{safe_round($c,5)}}\space cm \)</p>
                        <p class="mt-2">{{$lang['7']}}</p>
                        <p class="mt-2">\( A = {{safe_round($A,5)}}^\circ \)</p>
                        <p class="mt-2">\( B = {{safe_round($B,5)}}^\circ \)</p>
                        <p class="mt-2">\( C = {{safe_round($C,5)}}^\circ \)</p>
                        <p class="mt-2">{{$lang['8']}}</p>
                        <p class="mt-2">\( P = {{safe_round($detail['P'],5)}}\space cm \)</p>
                        <p class="mt-2">\( s = {{safe_round($detail['s'],5)}}\space cm \)</p>
                        <p class="mt-2">\( K = {{safe_round($detail['K'],5)}}\space cm^2 \)</p>
                        <p class="mt-2">\( r = {{safe_round($detail['r'],5)}}\space cm \)</p>
                        <p class="mt-2">\( R = {{safe_round($detail['R'],5)}}\space cm \)</p>
                        <p class="mt-2">{{$lang['9']}}</p>
                    </div>

    <div class="col-span-12 mt-4 canvas"
        x-data="{
            canvas: null, ctx: null, xo: 200, yo: 330,
            deg2rad(deg) { return deg * Math.PI / 180; },
            getcc() {
                if (!this.ctx) {
                    this.canvas = document.getElementById('triangle');
                    if (this.canvas && this.canvas.getContext) this.ctx = this.canvas.getContext('2d');
                }
                return this.ctx;
            },
            linedraw(x1,y1,x2,y2) {
                x1+=this.xo; y1+=this.yo; x2+=this.xo; y2+=this.yo;
                if(this.getcc()){ this.ctx.beginPath(); this.ctx.moveTo(x1,y1); this.ctx.lineTo(x2,y2); this.ctx.stroke(); }
            },
            textdraw(text,x1,y1) {
                if(this.getcc()) this.ctx.fillText(text, x1+this.xo, y1+this.yo);
            },
            draw() {
                if(!this.getcc()) return;
                this.ctx.clearRect(0,0,this.canvas.width,this.canvas.height);
                var detail = $wire.detail;
                if (!detail) return;
                var a = Number(detail.side_a), b = Number(detail.side_b), c = Number(detail.side_c);
                var A = Number(detail.angle_a), B = Number(detail.angle_b);
                if (isNaN(a) || isNaN(b) || isNaN(c) || isNaN(A) || isNaN(B)) return;
                var e = -a * this.deg2rad(B); e = -a * Math.sin(this.deg2rad(B));
                var d = Math.sqrt(Math.abs(b*b - e*e));
                if(A > 90) d = -1*d;
                var max = Math.max(Math.abs(c), Math.abs(d), Math.abs(e));
                var scl = 300/max; c*=scl; d*=scl; e*=scl;
                var mX = Math.min(c,d,0);
                this.xo = mX < 0 ? -mX+30 : 30;
                this.yo = -e+30;
                this.linedraw(0,0,c,0);
                this.linedraw(c,0,d,e);
                this.linedraw(d,e,0,0);
                this.ctx.font = '14pt Arial';
                this.textdraw('A',-20,10);
                this.textdraw('B',c+10,10);
                this.textdraw('C',d-5,e-10);
                document.getElementById('triangle').style.display='block';
            }
        }"
        x-init="setTimeout(() => draw(), 100)"
        x-on:show-result.window="setTimeout(() => draw(), 100)"
    >
        <canvas id="triangle" width="600" height="350"></canvas>
        </div>{{-- col-span-12 canvas --}}
                </div>{{-- w-full mt-3 --}}
            </div>{{-- rounded-lg --}}
        </div>{{-- inner div --}}
    </div>{{-- result-section --}}
    </div>{{-- x-show showResult --}}
    @endisset

    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}"
        onload="renderMathInElement(document.body);"></script>
    @script
    <script>
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (typeof renderMathInElement === 'function') renderMathInElement(component.el || document.body);
        });
    </script>
    @endscript
    @endpush
</div>
