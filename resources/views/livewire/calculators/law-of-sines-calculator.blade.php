<div>
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
<form wire:submit.prevent="calculate"
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
        showField(field) {
            const m = {
                a: ['abb','acc','aba','aca','cac','bab','cac','aab','aac'],
                b: ['abb','aba','bcc','bcb','bab','cbc','bbc'],
                c: ['acc','bcc','bcb','aca','cbc','cac','bbc'],
                A: ['aba','aca','bab','cac','aab','aac'],
                B: ['abb','bcb','bab','aab','cbc','bbc'],
                C: ['acc','bcc','cac','cbc','aac','bbc']
            };
            return (m[field] || []).includes(this.cal);
        }
    }"
>
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="cal" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <select x-model="cal" name="cal" class="input" id="cal" aria-label="select">
                            <option value="abb">{{$lang['2']." A ".$lang['3']." a, b, B"}}</option>
                            <option value="acc">{{$lang['2']." A ".$lang['3']." a, c, C"}}</option>
                            <option value="aba">{{$lang['2']." B ".$lang['3']." a, b, A"}}</option>
                            <option value="bcc">{{$lang['2']." B ".$lang['3']." b, c, C"}}</option>
                            <option value="aca">{{$lang['2']." C ".$lang['3']." a, c, A"}}</option>
                            <option value="bcb">{{$lang['2']." C ".$lang['3']." b, c, B"}}</option>
                            <option value="bab">{{$lang['4']." a ".$lang['3']." b, A, B"}}</option>
                            <option value="cac">{{$lang['4']." a ".$lang['3']." c, A, C"}}</option>
                            <option value="aab">{{$lang['4']." b ".$lang['3']." a, A, B"}}</option>
                            <option value="cbc">{{$lang['4']." b ".$lang['3']." c, B, C"}}</option>
                            <option value="aac">{{$lang['4']." c ".$lang['3']." a, A, C"}}</option>
                            <option value="bbc">{{$lang['4']." c ".$lang['3']." b, B, C"}}</option>
                        </select>
                    </div>
                </div>

                {{-- Side a: hidden when bcc,bcb,bab,cac,cbc,bbc --}}
                <div class="col-12 mt-0 mt-lg-2" x-show="showField('a')" style="{{ in_array($cal, ['bcc','bcb','bab','cac','cbc','bbc']) ? 'display:none' : '' }}" id="a">
                    <label for="side_a" class="font-s-14 text-blue">{{ $lang['4'] }} a:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="side_a" name="side_a" id="side_a" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $side_a }}" aria-label="input" placeholder="00"/>
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_a = !open_a" x-text="side_a_unit + ' ▾'"></label>
                        <div x-show="open_a" @click.away="open_a = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <template x-for="u in ['mm','cm','m','km','dm','in','ft','yd','mi','nmi']" :key="u">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="side_a_unit = u; open_a = false" x-text="u"></p>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Side b: hidden when acc,aca,cac,aab,cbc,aac --}}
                <div class="col-12 mt-0 mt-lg-2" x-show="showField('b')" style="{{ in_array($cal, ['acc','aca','cac','aab','cbc','aac']) ? 'display:none' : '' }}" id="b">
                    <label for="side_b" class="font-s-14 text-blue">{{ $lang['4'] }} b:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="side_b" name="side_b" id="side_b" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $side_b }}" aria-label="input" placeholder="00"/>
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_b = !open_b" x-text="side_b_unit + ' ▾'"></label>
                        <div x-show="open_b" @click.away="open_b = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <template x-for="u in ['mm','cm','m','km','dm','in','ft','yd','mi','nmi']" :key="u">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="side_b_unit = u; open_b = false" x-text="u"></p>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Side c: hidden when abb,aba,bab,aab,aac,bbc --}}
                <div class="col-12 mt-0 mt-lg-2" x-show="showField('c')" style="{{ in_array($cal, ['abb','aba','bab','aab','aac','bbc']) ? 'display:none' : '' }}" id="c">
                    <label for="side_c" class="font-s-14 text-blue">{{ $lang['4'] }} c:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="side_c" name="side_c" id="side_c" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $side_c }}" aria-label="input" placeholder="00"/>
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_c = !open_c" x-text="side_c_unit + ' ▾'"></label>
                        <div x-show="open_c" @click.away="open_c = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <template x-for="u in ['mm','cm','m','km','dm','in','ft','yd','mi','nmi']" :key="u">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="side_c_unit = u; open_c = false" x-text="u"></p>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Angle A: shown when aba,aca,bab,cac,aab,aac --}}
                <div class="col-12 mt-0 mt-lg-2" x-show="showField('A')" style="{{ !in_array($cal, ['aba','aca','bab','cac','aab','aac']) ? 'display:none' : '' }}" id="A">
                    <label for="angle_a" class="font-s-14 text-blue">{{ $lang['2'] }} A (α):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="angle_a" name="angle_a" id="angle_a" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $angle_a }}" aria-label="input" placeholder="00"/>
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_A = !open_A" x-text="angle_a_unit + ' ▾'"></label>
                        <div x-show="open_A" @click.away="open_A = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <template x-for="u in ['deg','rad','gon','tr','arcmin','arcsec','mrad','μrad','pirad']" :key="u">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="angle_a_unit = u; open_A = false" x-text="u"></p>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Angle B: shown when abb,bcb,bab,aab,cbc,bbc --}}
                <div class="col-12 mt-0 mt-lg-2" x-show="showField('B')" style="{{ !in_array($cal, ['abb','bcb','bab','aab','cbc','bbc']) ? 'display:none' : '' }}" id="B">
                    <label for="angle_b" class="font-s-14 text-blue">{{ $lang['2'] }} B (β):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="angle_b" name="angle_b" id="angle_b" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $angle_b }}" aria-label="input" placeholder="00"/>
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_B = !open_B" x-text="angle_b_unit + ' ▾'"></label>
                        <div x-show="open_B" @click.away="open_B = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <template x-for="u in ['deg','rad','gon','tr','arcmin','arcsec','mrad','μrad','pirad']" :key="u">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="angle_b_unit = u; open_B = false" x-text="u"></p>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Angle C: shown when acc,bcc,cac,cbc,aac,bbc --}}
                <div class="col-12 mt-0 mt-lg-2" x-show="showField('C')" style="{{ !in_array($cal, ['acc','bcc','cac','cbc','aac','bbc']) ? 'display:none' : '' }}" id="C">
                    <label for="angle_c" class="font-s-14 text-blue">{{ $lang['2'] }} C (γ):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="angle_c" name="angle_c" id="angle_c" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ $angle_c }}" aria-label="input" placeholder="00"/>
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open_C = !open_C" x-text="angle_c_unit + ' ▾'"></label>
                        <div x-show="open_C" @click.away="open_C = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <template x-for="u in ['deg','rad','gon','tr','arcmin','arcsec','mrad','μrad','pirad']" :key="u">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="angle_c_unit = u; open_C = false" x-text="u"></p>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 my-auto">
                <div class="col-12 text-[20px] text-center">
                    @foreach(['abb'=>'\( A = \sin^{-1} \left[ \dfrac{a \sin B}{b} \right] \)','acc'=>'\( A = \sin^{-1} \left[ \dfrac{a \sin C}{c} \right] \)','aba'=>'\( B = \sin^{-1} \left[ \dfrac{b \sin A}{a} \right] \)','bcc'=>'\( B = \sin^{-1} \left[ \dfrac{b \sin C}{c} \right] \)','aca'=>'\( C = \sin^{-1} \left[ \dfrac{c \sin A}{a} \right] \)','bcb'=>'\( C = \sin^{-1} \left[ \dfrac{c \sin B}{b} \right] \)','bab'=>'\( a = \dfrac{b \sin A}{\sin B} \)','cac'=>'\( a = \dfrac{c \sin A}{\sin C} \)','aab'=>'\( b = \dfrac{a \sin B}{\sin A} \)','cbc'=>'\( b = \dfrac{c \sin B}{\sin C} \)','aac'=>'\( c = \dfrac{a \sin C}{\sin A} \)','bbc'=>'\( c = \dfrac{b \sin C}{\sin B} \)'] as $key => $eq)
                    <p x-show="cal === '{{ $key }}'" style="{{ $cal !== $key ? 'display:none' : '' }}">{{ $eq }}</p>
                    @endforeach
                </div>
                <div class="col-12 text-center mt-5 flex items-center">
                    <img src="{{ asset('images/law_of_sine.webp') }}" width="100%" height="100%" alt="Law of Sines" loading="lazy" decoding="async">
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        @php
                            $A=$detail['angle_a'];
                            $B=$detail['angle_b'];
                            $C=$detail['angle_c'];
                            $a=$detail['side_a'];
                            $b=$detail['side_b'];
                            $c=$detail['side_c'];
                        @endphp
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%">
                                    <strong>
                                        @if($cal==='abb')
                                            {{$lang['2']}} A
                                        @elseif($cal==='acc')
                                            {{$lang['2']}} A
                                        @elseif($cal==='aba')
                                            {{$lang['2']}} B
                                        @elseif($cal==='bcc')
                                            {{$lang['2']}} B
                                        @elseif($cal==='aca')
                                            {{$lang['2']}} C
                                        @elseif($cal==='bcb')
                                            {{$lang['2']}} C
                                        @elseif($cal==='bab')
                                            {{$lang['4']}} a
                                        @elseif($cal==='cac')
                                            {{$lang['4']}} a
                                        @elseif($cal==='aab')
                                            {{$lang['4']}} b
                                        @elseif($cal==='cbc')
                                            {{$lang['4']}} b
                                        @elseif($cal==='aac')
                                            {{$lang['4']}} c
                                        @elseif($cal==='bbc')
                                            {{$lang['4']}} c
                                        @endif
                                    </strong>
                                </td>
                                <td class="py-2 border-b">
                                    @if($cal==='abb')
                                        {{safe_round($A,5)}}°
                                    @elseif($cal==='acc')
                                        {{safe_round($A,5)}}°
                                    @elseif($cal==='aba')
                                        {{safe_round($B,5)}}°
                                    @elseif($cal==='bcc')
                                        {{safe_round($B,5)}}°
                                    @elseif($cal==='aca')
                                        {{safe_round($C,5)}}°
                                    @elseif($cal==='bcb')
                                        {{safe_round($C,5)}}°
                                    @elseif($cal==='bab')
                                        {{safe_round($a,5)}} cm
                                    @elseif($cal==='cac')
                                        {{safe_round($a,5)}} cm
                                    @elseif($cal==='aab')
                                        {{safe_round($b,5)}} cm
                                    @elseif($cal==='cbc')
                                        {{safe_round($b,5)}} cm
                                    @elseif($cal==='aac')
                                        {{safe_round($c,5)}} cm
                                    @elseif($cal==='bbc')
                                        {{safe_round($c,5)}} cm
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-2"><strong><?=$lang['10']?>:</strong></p>
                        @if($cal==='abb')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} A</p>
                            <p class="mt-2">\( A = \sin^{-1} \left[ \dfrac{a \sin B}{b} \right] \)</p>
                            <p class="mt-2">\( A = \sin^{-1} \) \( \left [\frac { {{{$a}}}\space{\sin}\space({{$B}}^\circ)} {{{$b}}}\right] \)</p>
                            <p class="mt-2">\( A = {{$A}}^\circ \)</p>
                        @elseif($cal==='acc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} A</p>
                            <p class="mt-2">\( A = \sin^{-1} \left[ \dfrac{a \sin C}{c} \right] \)</p>
                            <p class="mt-2">\( A = \sin^{-1} \) \( \left [\frac { {{{$a}}}\space{\sin}\space({{$C}}^\circ)} {{{$c}}}\right] \)</p>
                            <p class="mt-2">\( A = {{$A}}^\circ \)</p>
                        @elseif($cal==='aba')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} B</p>
                            <p class="mt-2">\( B = \sin^{-1} \left[ \dfrac{b \sin A}{a} \right] \)</p>
                            <p class="mt-2">\( B = \sin^{-1} \) \( \left [\frac { {{{$b}}}\space{\sin}\space({{$A}}^\circ)} {{{$a}}}\right] \)</p>
                            <p class="mt-2">\( B = {{$B}}^\circ \)</p>
                        @elseif($cal==='bcc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} B</p>
                            <p class="mt-2">\( B = \sin^{-1} \left[ \dfrac{b \sin C}{c} \right] \)</p>
                            <p class="mt-2">\( B = \sin^{-1} \) \( \left [\frac { {{{$b}}}\space{\sin}\space({{$C}}^\circ)} {{{$c}}}\right] \)</p>
                            <p class="mt-2">\( B = {{$B}}^\circ \)</p>
                        @elseif($cal==='aca')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} C</p>
                            <p class="mt-2">\( C = \sin^{-1} \left[ \dfrac{c \sin A}{a} \right] \)</p>
                            <p class="mt-2">\( C = \sin^{-1} \) \( \left [\frac { {{{$c}}}\space{\sin}\space({{$A}}^\circ)} {{{$a}}}\right] \)</p>
                            <p class="mt-2">\( C = {{$C}}^\circ \)</p>
                        @elseif($cal==='bcb')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} C</p>
                            <p class="mt-2">\( C = \sin^{-1} \left[ \dfrac{c \sin B}{b} \right] \)</p>
                            <p class="mt-2">\( C = \sin^{-1} \) \( \left [\frac { {{{$c}}}\space{\sin}\space({{$B}}^\circ)} {{{$b}}}\right] \)</p>
                            <p class="mt-2">\( C = {{$C}}^\circ \)</p>
                        @elseif($cal==='bab')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} a</p>
                            <p class="mt-2">\( a = \dfrac{b \sin A}{\sin B} \)</p>
                            <p class="mt-2">\( a = \) \( \frac { {{{$b}}}\space{\sin}\space({{$A}} ^\circ)} { {\sin}\space({{$B}} ^\circ)} \)</p>
                            <p class="mt-2">\( a = {{$a}}^\circ \)</p>
                        @elseif($cal==='cac')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} a</p>
                            <p class="mt-2">\( a = \dfrac{c \sin A}{\sin C} \)</p>
                            <p class="mt-2">\( a = \) \( \frac { {{{$c}}}\space{\sin}\space({{$A}} ^\circ)} { {\sin}\space({{$C}} ^\circ)} \)</p>
                            <p class="mt-2">\( a = {{$a}}^\circ \)</p>
                        @elseif($cal==='aab')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} b</p>
                            <p class="mt-2">\( b = \dfrac{a \sin B}{\sin A} \)</p>
                            <p class="mt-2">\( b = \) \( \frac { {{{$a}}}\space{\sin}\space({{$B}} ^\circ)} { {\sin}\space({{$A}} ^\circ)} \)</p>
                            <p class="mt-2">\( b = {{$b}}^\circ \)</p>
                        @elseif($cal==='cbc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} b</p>
                            <p class="mt-2">\( b = \dfrac{c \sin B}{\sin C} \)</p>
                            <p class="mt-2">\( b = \) \( \frac { {{{$c}}}\space{\sin}\space({{$B}} ^\circ)} { {\sin}\space({{$C}} ^\circ)} \)</p>
                            <p class="mt-2">\( b = {{$b}}^\circ \)</p>
                        @elseif($cal==='aac')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} c</p>
                            <p class="mt-2">\( c = \dfrac{a \sin C}{\sin A} \)</p>
                            <p class="mt-2">\( c = \) \( \frac { {{{$a}}}\space{\sin}\space({{$C}} ^\circ)} { {\sin}\space({{$A}} ^\circ)} \)</p>
                            <p class="mt-2">\( c = {{$c}}^\circ \)</p>
                        @elseif($cal==='bbc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} c</p>
                            <p class="mt-2">\( c = \dfrac{b \sin C}{\sin B} \)</p>
                            <p class="mt-2">\( c = \) \( \frac { {{{$b}}}\space{\sin}\space({{$C}} ^\circ)} { {\sin}\space({{$B}} ^\circ)} \)</p>
                            <p class="mt-2">\( c = {{$c}}^\circ \)</p>
                        @endif
                        <p class="mt-2">{{$lang['6']}}</p>
                        <p class="mt-2">\( a = {{$a}}\space cm \)</p>
                        <p class="mt-2">\( b = {{$b}}\space cm \)</p>
                        <p class="mt-2">\( c = {{$c}}\space cm \)</p>
                        <p class="mt-2">{{$lang['7']}}</p>
                        <p class="mt-2">\( A = {{$A}}^\circ \)</p>
                        <p class="mt-2">\( B = {{$B}}^\circ \)</p>
                        <p class="mt-2">\( C = {{$C}}^\circ \)</p>
                        <p class="mt-2">{{$lang['8']}}</p>
                        <p class="mt-2">\( P = {{$detail['P']}}\space cm \)</p>
                        <p class="mt-2">\( s = {{$detail['s']}}\space cm \)</p>
                        <p class="mt-2">\( K = {{$detail['K']}}\space cm^2 \)</p>
                        <p class="mt-2">\( r = {{$detail['r']}}\space cm \)</p>
                        <p class="mt-2">\( R = {{$detail['R']}}\space cm \)</p>
                        <p class="mt-2">{{$lang['9']}}</p>
                    </div>
                    <div class="col-12 mt-4 canvas" 
                        x-data="{
                            xo: 200,
                            yo: 330,
                            canvas: null,
                            ctx: null,
                            deg2rad(deg) { return deg * Math.PI / 180; },
                            getcc() {
                                if (this.ctx == null) {
                                    if (this.canvas == null) {
                                        this.canvas = document.getElementById('triangle');
                                    }
                                    if (this.canvas.getContext) {
                                        this.ctx = this.canvas.getContext('2d');
                                    }
                                }
                                return this.ctx;
                            },
                            canvasclear() {
                                if (this.getcc() != null) {
                                    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                                }
                            },
                            linedraw(x1, y1, x2, y2) {
                                x1 += this.xo;
                                y1 += this.yo;
                                x2 += this.xo;
                                y2 += this.yo;
                                if (this.getcc() != null) {
                                    this.ctx.fillStyle = 'rgb(200,0,0)';
                                    this.ctx.beginPath();
                                    this.ctx.moveTo(x1, y1);
                                    this.ctx.lineTo(x2, y2);
                                    this.ctx.closePath();
                                    this.ctx.stroke();
                                }
                            },
                            textdraw(text, x1, y1) {
                                if (this.getcc() != null) {
                                    x1 += this.xo;
                                    y1 += this.yo;
                                    this.ctx.fillText(text, x1, y1);
                                }
                            },
                            draw() {
                                this.canvasclear();
                                var detail = $wire.detail;
                                if (!detail) return;
                                var a = Number(detail.side_a);
                                var b = Number(detail.side_b);
                                var c = Number(detail.side_c);
                                var A = Number(detail.angle_a);
                                var B = Number(detail.angle_b);
                                if (isNaN(a) || isNaN(b) || isNaN(c) || isNaN(A) || isNaN(B)) return;
                                var e = -a * Math.sin(this.deg2rad(B));
                                var d = Math.sqrt(Math.abs(b * b - e * e));
                                if (A > 90) {
                                    d = -1 * d;
                                }
                                var max = Math.max(Math.max(Math.abs(c), Math.abs(d)), Math.abs(e));
                                var dMax = 300;
                                var scl = dMax / max;
                                c = c * scl;
                                d = d * scl;
                                e = e * scl;
                                var mX = Math.min(Math.min(c, d), 0);
                                this.xo = mX;
                                if (this.xo < 0) {
                                    this.xo = -this.xo;
                                }
                                this.xo += 30;
                                this.yo = -e + 30;
                                this.linedraw(0, 0, c, 0);
                                this.linedraw(c, 0, d, e);
                                this.linedraw(d, e, 0, 0);
                                this.ctx.font = '14pt Arial';
                                this.textdraw('A', -20, 10);
                                this.textdraw('B', c + 10, 10);
                                this.textdraw('C', d - 5, e - 10);
                                document.getElementById('triangle').style.display = 'block';
                            }
                        }"
                        x-init="setTimeout(() => draw(), 100)"
                        x-on:show-result.window="setTimeout(() => draw(), 100)"
                    >
                        <canvas id="triangle" width="600" height="350"></canvas>
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
       onload="renderMathInElement(document.body);"></script>
       @script
       <script>
           Livewire.hook('morph.updated', ({ el, component }) => {
               if (typeof renderMathInElement === 'function') {
                   renderMathInElement(component.el || document.body);
               }
           });
       </script>
       @endscript
    @endpush
</form>
</div>
