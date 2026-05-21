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
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-7">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12">
                            <label for="sides" class="label">{{ $lang['2'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="sides" class="input" id="sides" aria-label="select">
                                    <option value="a">{{$lang[2]}}</option>
                                    <option value="b">{{$lang[3]}}</option>
                                    <option value="c">{{$lang[4]}}</option>
                                    <option value="area">{{$lang[5]}}</option>
                                    <option value="perimeter">{{$lang[6]}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="input" class="font-s-14 text-blue" id="changeText">
                                @if ($sides === "perimeter")
                                    {{$lang[6]}}
                                @elseif($sides === "b")
                                    {{$lang[11]}}
                                @elseif($sides === "c")
                                    {{$lang[12]}}
                                @elseif($sides === "area")
                                    {{$lang[5]}}
                                @else
                                    {{$lang[7]}}
                                @endif
                            </label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="input" id="input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                              
                                <div class="{{ $sides === 'area' ? 'hidden':'' }}" id="linearUnit" x-data="{ open: false }">
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
                            <div class="{{ $sides === 'area' ? '':'hidden' }}" id="squareUnit" x-data="{ open: false }">
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
                </div>
                <div class="col-span-5 mt-3 text-center flex justify-center items-center">
                    <img src="{{asset('images/new_fourty_five.webp')}}" height="100%" width="150px" alt="trianle details image" loading="lazy" decoding="async">
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[2]}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['a_ans'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[3]}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['b_ans'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[4]}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['c_ans'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[8]}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['height'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[5]}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['area_ans'], 2)}} cm²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[9]}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['radius'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[10]}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['height'], 2)}} cm</td>
                                    </tr>
                                </table>
                            </div>
                            @if(isset($detail['a']) && isset($detail['b']))
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang[13]}}</strong></p>
                                <p class="mt-2">
                                    {{$lang[14]}}<br/>
                                    <strong>a = b = {{safe_round($detail['a'])}} {{safe_round($detail['c_unit'])}}</strong><br/>
                                    <strong>c = {{safe_round($detail['a'])}}√2 {{safe_round($detail['c_unit'])}}</strong><br/><br/>
                                    
                                    {{$lang[15]}}<br/>
                                    <strong>{{$lang[5]}} = a² / 2</strong><br/>
                                    <strong>{{$lang[6]}} = a(2 + √2)</strong><br/>
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    @endisset
</form>
</div>
