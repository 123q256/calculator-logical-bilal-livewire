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
 <form wire:submit.prevent="calculate">    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="col-span-12">
                    <label for="sides" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="sides" class="input" id="sides" aria-label="select">
                            <option value="a">{{$lang[3]." (a)"}}</option>
                            <option value="b">{{$lang[3]." (b)"}}</option>
                            <option value="c">{{$lang[17]." (c)"}}</option>
                            <option value="h">{{$lang[4]." (h)"}}</option>
                            <option value="A">{{$lang[5]." (A)"}}</option>
                            <option value="p">{{$lang[6]." (p)"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                     <label for="input" class="font-s-14 text-blue" id="changeText">
                            @if($sides === "b")
                                Enter leg (b)
                            @elseif($sides === "c")
                                Enter Hypotenuse (c)
                            @elseif($sides === "h")
                                Enter Height (h)
                            @elseif($sides === "A")
                                Enter Area (A)
                            @elseif($sides === "p")
                                Enter Perimeter (p)
                            @else
                                Enter leg (a)
                            @endif
                     </label>
                     <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="input" id="input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <div class="{{ $sides === 'A' ? 'hidden' : '' }}" id="linearUnit" x-data="{ open: false }">

                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $linear_unit }} ▾</label>
                            <input type="text" wire:model.live="linear_unit" id="linear_unit" class="hidden">
                            <div x-show="open" @click.outside="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'mm')">millimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'km')">kilometers (km)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'ft')">feets (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'yd')">yards (yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'mi')">miles (mi)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('linear_unit', 'nmi')">nautical miles (nmi)</p>
                            </div>
                        </div>
                        <div class="{{ $sides === 'A' ? '' : 'hidden' }}" id="squareUnit" x-data="{ open: false }">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $square_unit }} ▾</label>
                            <input type="text" wire:model.live="square_unit" id="square_unit" class="hidden">
                            <div x-show="open" @click.outside="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'mm²')">square millimeters (mm²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'cm²')">square centimeters (cm²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'm²')">square meters (m²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'km²')">square kilometers (km²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'in²')">square inches (in²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'ft²')">square feets (ft²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'yd²')">square yards (yd²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'mi²')">square miles (mi²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; @this.set('square_unit', 'nmi²')">square nautical miles (nmi²)</p>

                        </div>
                     </div>
                </div>
            </div>
            </div>
            <div class="col-span-6 my-auto">
                <div class="col-12 text-center mt-3">
                    <img src="{{asset('images/qsqs.png')}}" height="100%" width="80%" alt="30 60 90 Triangle Image" loading="lazy" decoding="async">
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
                            <div class="w-full lg:w-[80%] overflow-auo mt-2">
                                <table class="w-full text-[18px]">
                                    @if($detail['method'] != "1")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }} (a)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['a'])}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "2")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}} (b)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['b'])}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "3")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['17']}} (c)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['c'])}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "4")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}} (h)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['height'])}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "5")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['5']}} (A)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['aa'])}} cm²</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "6")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}} (p)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['peri'])}} cm</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}} (r)</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['in_radius'])}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}} (R)</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['radius'])}} cm</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] overflow-auto">
                                <p class="mt-2"><strong>{{ $lang['10'] }}:</strong></p>
                                @if($detail['method'] == "1")
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=a*\sqrt(3) \)</p>
                                    <p class="mt-2">\( b={{ safe_round($detail['a']) }}*{{safe_round(sqrt(3)) }} \)</p>
                                    <p class="mt-2">\( b={{ safe_round($detail['b']) }} \)</p>
                                @elseif($detail['method'] == "2")
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\dfrac{b}{\sqrt{3}} \)</p>
                                    <p class="mt-2">\( a=\dfrac{{{safe_round($detail['b']) }}}{{{safe_round(sqrt(3)) }}} \)</p>
                                    <p class="mt-2">\( a={{ safe_round($detail['a']) }} \)</p>
                                @elseif($detail['method'] == "3")
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\dfrac{c}{2} \)</p>
                                    <p class="mt-2">\( a=\dfrac{{{safe_round($detail['c']) }}}{2} \)</p>
                                    <p class="mt-2">\( a={{safe_round($detail['a']) }} \)</p>
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=a*\sqrt(3) \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['a']) }}*{{safe_round(sqrt(3)) }} \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['b']) }} \)</p>
                                @elseif($detail['method'] == "4")
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=h*2 \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['height']) }}*2 \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['b']) }} \)</p>
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\dfrac{b}{\sqrt{3}} \)</p>
                                    <p class="mt-2">\( a=\dfrac{{{safe_round($detail['b']) }}}{{{safe_round(sqrt(3)) }}} \)</p>
                                    <p class="mt-2">\( a={{safe_round($detail['a']) }} \)</p>
                                @elseif($detail['method'] == "5")
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\sqrt{2*area/\sqrt{3}} \)</p>
                                    <p class="mt-2">\( a=\sqrt{2*{{safe_round($detail['aa']) }}/{{safe_round(sqrt(3)) }}} \)</p>
                                    <p class="mt-2">\( a={{safe_round($detail['a']) }} \)</p>
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=a*\sqrt(3) \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['a']) }}*{{safe_round(sqrt(3)) }} \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['b']) }} \)</p>
                                @elseif($detail['method'] == "6")
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\dfrac{perimeter}{3+\sqrt(3)} \)</p>
                                    <p class="mt-2">\( a=\dfrac{{{safe_round($detail['peri']) }}}{3+{{safe_round(sqrt(3)) }}} \)</p>
                                    <p class="mt-2">\( a={{safe_round($detail['a']) }} \)</p>
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=a*\sqrt(3) \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['a']) }}*{{safe_round(sqrt(3)) }} \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['b']) }} \)</p>
                                @endif
                                <p class="mt-2">{{ $lang['11'] }} c:</p>
                                <p class="mt-2">\( c=2a \)</p>
                                <p class="mt-2">\( c=2*{{ safe_round($detail['a']) }} \)</p>
                                <p class="mt-2">\( c={{ safe_round($detail['c']) }} \)</p>
                                <p class="mt-2">{{ $lang['12'] }} (h):</p>
                                <p class="mt-2">\( h=\dfrac{a*b}{c} \)</p>
                                <p class="mt-2">\( h=\dfrac{ {{ safe_round($detail['a']) }}*{{ safe_round($detail['b']) }}}{{{ safe_round($detail['c']) }}} \)</p>
                                <p class="mt-2">\( h=\dfrac{{{ safe_round($detail['a'] * $detail['b']) }}}{{{ safe_round($detail['c']) }}} \)</p>
                                <p class="mt-2">\( h={{ safe_round($detail['height']) }} \)</p>
                                <p class="mt-2">{{ $lang['13'] }} (A):</p>
                                <p class="mt-2">\( A=\dfrac{a^2*\sqrt(3)}{2} \)</p>
                                <p class="mt-2">\( A=\dfrac{ {{safe_round($detail['a']) }}^2*\sqrt(3)}{2} \)</p>
                                <p class="mt-2">\( A=\dfrac{ {{safe_round($detail['a'] * $detail['a']) }}*{{safe_round(sqrt(3)) }}}{2} \)</p>
                                <p class="mt-2">\( A={{safe_round($detail['aa']) }} \)</p>
                                <p class="mt-2">{{ $lang['14'] }} (p):</p>
                                <p class="mt-2">\( p=a+b+c \)</p>
                                <p class="mt-2">\( p={{safe_round($detail['a']) }}+{{safe_round($detail['b']) }}+{{safe_round($detail['c']) }} \)</p>
                                <p class="mt-2">\( p={{safe_round($detail['peri']) }} \)</p>
                                <p class="mt-2">{{ $lang['15'] }} (r):</p>
                                <p class="mt-2">\( r=\dfrac{a*b}{perimeter} \)</p>
                                <p class="mt-2">\( r=\dfrac{ {{safe_round($detail['a']) }}*{{safe_round($detail['b']) }}}{{{safe_round($detail['peri']) }}} \)</p>
                                <p class="mt-2">\( r={{safe_round($detail['in_radius']) }} \)</p>
                                <p class="mt-2">{{ $lang['16'] }} (R):</p>
                                <p class="mt-2">\( R=\dfrac{c}{2} \)</p>
                                <p class="mt-2">\( R=\dfrac{{{safe_round($detail['c']) }}}{2} \)</p>
                                <p class="mt-2">\( R={{safe_round($detail['radius']) }} \)</p>
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
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>
</div>
