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
                <div class="col-span-6">
                    <div class="col-span-12">
                        <label for="find" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" wire:model.live="find" id="find">
                                <option value="0">{{$lang['2']}}</option>
                                <option value="1">{{$lang['3']}}</option>
                                <option value="2">{{$lang['4']}}</option>
                                <option value="3">{{$lang['5']}}</option>
                                <option value="4">{{$lang['6']}}</option>
                                <option value="5">{{$lang['7']}}</option>
                                <option value="6">{{$lang['8']}}</option>
                                <option value="7">{{$lang['9']}}</option>
                            </select>
                        </div>
                    </div>

                    @if(in_array($find, ['0', '4', '5', '6']))
                    <div class="col-span-12" id="angleInput">
                        <label for="angle" class="font-s-14 text-blue">{{$lang['10']}} {{$lang['21']}} (θ)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="angle" id="angle" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                            <div x-data="{ open: false }" class="absolute right-6 top-3" :class="open ? 'z-50' : 'z-10'">
                                <div @click="open = !open" class="cursor-pointer text-sm underline select-none text-black">
                                    {{ $angle_unit }} ▾
                                </div>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-max mt-1 right-0 shadow-lg z-50">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'deg'); open = false">degrees (deg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'rad'); open = false">radians (rad)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'gon'); open = false">gradians (gon)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'tr'); open = false">(tr)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'arcmin'); open = false">arcminute (arcmin)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'arcsec'); open = false">Arc Second (arcsec)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'mrad'); open = false">milliradians (mrad)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'μrad'); open = false">microradians (μrad)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', 'pirad'); open = false">* π rad (pirad)</p>
                                </div>
                            </div>
                         </div>
                    </div>
                    @endif

                    @if(in_array($find, ['0', '1', '2', '3']))
                    <div class="col-span-12" id="radianInput">
                        <label for="rad" class="font-s-14 text-blue">{{$lang['11']}} (r)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="rad" id="rad" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                            <div x-data="{ open: false }" class="absolute right-6 top-3" :class="open ? 'z-50' : 'z-10'">
                                <div @click="open = !open" class="cursor-pointer text-sm underline select-none text-black">
                                    {{ $rad_unit }} ▾
                                </div>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-max mt-1 right-0 shadow-lg z-50">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'mm'); open = false">millimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'ft'); open = false">feets (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'yd'); open = false">yards (yd)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'mi'); open = false">miles (mi)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('rad_unit', 'nmi'); open = false">nautical miles (nmi)</p>
                                </div>
                            </div>
                         </div>
                    </div>
                    @endif

                    @if($find == '4')
                    <div class="col-span-12" id="diameterInput">
                        <label for="diameter" class="font-s-14 text-blue">{{$lang['12']}}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="diameter" id="diameter" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                            <div x-data="{ open: false }" class="absolute right-6 top-3" :class="open ? 'z-50' : 'z-10'">
                                <div @click="open = !open" class="cursor-pointer text-sm underline select-none text-black">
                                    {{ $diameter_unit }} ▾
                                </div>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-max mt-1 right-0 shadow-lg z-50">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'mm'); open = false">millimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'ft'); open = false">feets (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'yd'); open = false">yards (yd)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'mi'); open = false">miles (mi)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('diameter_unit', 'nmi'); open = false">nautical miles (nmi)</p>
                                </div>
                            </div>
                         </div>
                    </div>
                    @endif

                    @if(in_array($find, ['2', '5']))
                    <div class="col-span-12" id="areaInput">
                        <label for="area" class="font-s-14 text-blue">{{$lang['13']}} {{$lang['20']}} (A)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="area" id="area" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                            <div x-data="{ open: false }" class="absolute right-6 top-3" :class="open ? 'z-50' : 'z-10'">
                                <div @click="open = !open" class="cursor-pointer text-sm underline select-none text-black">
                                    {{ $area_unit }} ▾
                                </div>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-max mt-1 right-0 shadow-lg z-50">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'mm²'); open = false">square millimeters (mm²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'cm²'); open = false">square centimeters (cm²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'dm²'); open = false">square decimeters (dm²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'm²'); open = false">square meters (m²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'km²'); open = false">square kilometers (km²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'in²'); open = false">square inchs (in²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'ft²'); open = false">square feets (ft²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'yd²'); open = false">square yards (yd²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'mi²'); open = false">square miles (mi²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'a'); open = false">are (a)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'da'); open = false">dalton (da)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'ha'); open = false">hectare (ha)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 'ac'); open = false">(ac)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('area_unit', 's_f'); open = false">soccer fields (s_f)</p>
                                </div>
                            </div>
                         </div>
                    </div>
                    @endif

                    @if(in_array($find, ['3', '6', '7']))
                    <div class="col-span-12" id="chrd_lenInput">
                        <label for="chrd_len" class="font-s-14 text-blue">{{$lang['14']}} {{$lang['22']}} (c)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="chrd_len" id="chrd_len" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                            <div x-data="{ open: false }" class="absolute right-6 top-3" :class="open ? 'z-50' : 'z-10'">
                                <div @click="open = !open" class="cursor-pointer text-sm underline select-none text-black">
                                    {{ $chrd_len_unit }} ▾
                                </div>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-max mt-1 right-0 shadow-lg z-50">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'mm'); open = false">millimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'ft'); open = false">feets (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'yd'); open = false">yards (yd)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'mi'); open = false">miles (mi)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('chrd_len_unit', 'nmi'); open = false">nautical miles (nmi)</p>
                                </div>
                            </div>
                         </div>
                    </div>
                    @endif

                    @if(in_array($find, ['1', '7']))
                    <div class="col-span-12" id="seg_heightInput">
                        <label for="seg_height" class="font-s-14 text-blue">{{$lang['15']}} (h)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="seg_height" id="seg_height" min="1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                            <div x-data="{ open: false }" class="absolute right-6 top-3" :class="open ? 'z-50' : 'z-10'">
                                <div @click="open = !open" class="cursor-pointer text-sm underline select-none text-black">
                                    {{ $seg_height_unit }} ▾
                                </div>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-max mt-1 right-0 shadow-lg z-50">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'mm'); open = false">millimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'ft'); open = false">feets (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'yd'); open = false">yards (yd)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'mi'); open = false">miles (mi)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('seg_height_unit', 'nmi'); open = false">nautical miles (nmi)</p>
                                </div>
                            </div>
                         </div>
                    </div>
                    @endif
</div>

                <div class="col-span-6 flex items-center">
                    <div class="col-12 text-center ">
                        <img src="{{ asset('images/arc_length.png') }}" width="75%" height="100%" alt="arc length img" loading="lazy" decoding="async">
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
                            <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                                <table class="w-full text-[18px]">
                                    @if($find == '0')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['14']}} {{$lang['18']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['chrd_len']}} m</td>
                                        </tr>
                                    @elseif($find == '1')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}} {{$lang['19']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle']}} rad / {{is_numeric($detail['angle']) ? round(rad2deg((float)$detail['angle']),5) : $detail['angle']}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['14']}} {{$lang['18']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['chrd_len']}} m</td>
                                        </tr>
                                    @elseif($find == '2')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['19']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle']}} rad / {{is_numeric($detail['angle']) ? round(rad2deg((float)$detail['angle']),5) : $detail['angle']}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['14']}} {{$lang['18']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['chrd_len']}} m</td>
                                        </tr>
                                    @elseif($find == '3')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['19']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle']}} rad / {{is_numeric($detail['angle']) ? round(rad2deg((float)$detail['angle']),5) : $detail['angle']}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                    @elseif($find == '4')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                    @elseif($find == '5')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['14']}} {{$lang['18']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['chrd_len']}} m</td>
                                        </tr>
                                    @elseif($find == '6')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}} {{$lang['19']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle']}} rad / {{is_numeric($detail['angle']) ? round(rad2deg((float)$detail['angle']),5) : $detail['angle']}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    
</form>
</div>
