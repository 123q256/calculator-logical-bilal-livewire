<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="cal_from" class="font-s-14 text-blue">{{$lang['calculate']}} {{$lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" wire:model.live="cal_from" name="cal_from" id="cal_from">
                        <option value="two_sides">{{$lang['2']." ∟"}}</option>
                        <option value="angle_side">{{$lang['3']." ∡ ".$lang['4']}}</option>
                        <option value="area_side">{{$lang['5']." ⊿ ".$lang['4']}}</option>
                    </select>
                </div>
            </div>
            
            @if($this->showCalInput())
            <div class="col-span-12" id="calInput">
                <label for="cal" class="font-s-14 text-blue">{{ $lang['calculate'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" wire:model.live="cal" name="cal" id="cal">
                        <option value="hypo">{{$lang['8']}}</option>
                        <option value="area">{{$lang['5']}}</option>
                        <option value="side_a">{{$lang['7']}} a</option>
                        <option value="side_b">{{$lang['7']}} b</option>
                    </select>
                </div>
            </div>
            @endif

            @if($this->showCalWith())
            <div class="col-span-12 mb-1 flex items-center justify-evenly" id="cal_with">
                <p class="font-s-14 text-blue"><strong>{{$lang['calculate']}} {{$lang['6']}}:</strong></p>
                <p id="cal_with_a">
                    <input type="radio" wire:model.live="cal_with" name="cal_with" id="a_angle" value="a_angle" class="cursor-pointer">
                    <label for="a_angle" class="font-s-14 cursor-pointer">a & {{$lang['3']}} α</label>
                </p>
                <p id="cal_with_b">
                    <input type="radio" wire:model.live="cal_with" name="cal_with" id="b_angle" value="b_angle" class="cursor-pointer">
                    <label for="b_angle" class="font-s-14 cursor-pointer">b & {{$lang['3']}} β</label>
                </p>
            </div>
            @endif

            @if($this->showCalWith1())
            <div class="col-span-12 mb-1 flex items-center justify-evenly" id="cal_with1">
                <p class="font-s-14 text-blue"><strong>{{$lang['calculate']}} {{$lang['6']}}:</strong></p>
                <p id="cal_with1_a">
                    <input type="radio" wire:model.live="cal_with1" name="cal_with1" id="bnry_cal" value="area_a" class="cursor-pointer">
                    <label for="bnry_cal" class="font-s-14 cursor-pointer">{{$lang['5']}} & a</label>
                </p>
                <p id="cal_with1_b">
                    <input type="radio" wire:model.live="cal_with1" name="cal_with1" id="dec_cal" value="area_b" class="cursor-pointer">
                    <label for="dec_cal" class="font-s-14 cursor-pointer">{{$lang['5']}} & b</label>
                </p>
            </div>
            @endif

            @if($this->showAreaInput())
            <div class="col-span-12" id="areaInput">
                <label for="area" class="font-s-14 text-blue">{{$lang['5']}}</label>
                <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                    <input type="number" wire:model.live="area" name="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $area_unit }} ▾</label>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'mm²'); open = false">square millimeter (mm²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'cm²'); open = false">square centimeter (cm²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'dm²'); open = false">square decimeter (dm²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'm²'); open = false">square metre (m²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'km²'); open = false">square kilometre (km²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'in²'); open = false">square inch (in²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'ft²'); open = false">square feet (ft²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'yd²'); open = false">square yards (yd²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'mi²'); open = false">square miles (mi²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'a'); open = false">ares (a)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'da'); open = false">dekameters (da)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'ha'); open = false">hectares (ha)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'ac'); open = false">acres (ac)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'sf'); open = false">soccer fields</p>
                    </div>
                 </div>
            </div>
            @endif

            @if($this->showAInput())
            <div class="col-span-12" id="aInput">
                <label for="a" class="font-s-14 text-blue">a</label>
                <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                    <input type="number" wire:model.live="a" name="a" id="a" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $a_unit }} ▾</label>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'mm'); open = false">milimeters (mm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'cm'); open = false">centimeters (cm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'm'); open = false">meters (m)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'km'); open = false">kilometers (km)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'dm'); open = false">decimetre (dm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'in'); open = false">inches (in)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'yd'); open = false">yards (yd)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'mi'); open = false">miles (mi)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'nmi'); open = false">nautical mile (nmi)</p>
                    </div>
                 </div>
            </div>
            @endif
            @if($this->showAngleAInput())
            <div class="col-span-12" id="angleaInput">
                <label for="angle_a" class="font-s-14 text-blue">{{$lang['3']}} α</label>
                <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                    <input type="number" wire:model.live="angle_a" name="angle_a" id="angle_a" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_a_unit }} ▾</label>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'deg'); open = false">degrees (deg)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'rad'); open = false">radians (rad)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'gon'); open = false">gradians (gon)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'tr'); open = false">(tr)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'arcmin'); open = false">arcminute (arcmin)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'arcsec'); open = false">Arc Second (arcsec)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'mrad'); open = false">milliradians (mrad)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'μrad'); open = false">microradians (μrad)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_a_unit', 'pirad'); open = false">* π rad (pirad)</p>
                    </div>
                 </div>
            </div>
            @endif
            @if($this->showBInput())
            <div class="col-span-12" id="bInput">
                <label for="b" class="font-s-14 text-blue">b</label>
                <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                    <input type="number" wire:model.live="b" name="b" id="b" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $b_unit }} ▾</label>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'mm'); open = false">milimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'cm'); open = false">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'm'); open = false">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'km'); open = false">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'dm'); open = false">decimetre (dm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'in'); open = false">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'yd'); open = false">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'mi'); open = false">miles (mi)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('b_unit', 'nmi'); open = false">nautical mile (nmi)</p>
                    </div>
                 </div>
            </div>
            @endif
            @if($this->showAngleBInput())
            <div class="col-span-12" id="anglebInput">
                <label for="angle_b" class="font-s-14 text-blue">{{$lang['3']}} β</label>
                <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                    <input type="number" wire:model.live="angle_b" name="angle_b" id="angle_b" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_b_unit }} ▾</label>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'deg'); open = false">degrees (deg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'rad'); open = false">radians (rad)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'gon'); open = false">gradians (gon)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'tr'); open = false">(tr)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'arcmin'); open = false">arcminute (arcmin)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'arcsec'); open = false">Arc Second (arcsec)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'mrad'); open = false">milliradians (mrad)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'μrad'); open = false">microradians (μrad)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_b_unit', 'pirad'); open = false">* π rad (pirad)</p>
                    </div>
                 </div>
            </div>
            @endif
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%">
                                        <strong>
                                            @php
                                                if(isset($detail['area_cal'])){
                                                    echo $lang['5'];
                                                }elseif(isset($detail['side_a'])){
                                                    echo $lang['7'].' a';
                                                }elseif(isset($detail['side_b'])){
                                                    echo $lang['7'].' b';
                                                }else{
                                                    echo $lang['8'];
                                                } 
                                            @endphp
                                        </strong>
                                    </td>
                                    <td class="py-2 border-b">
                                        @php
                                            if(isset($detail['area_cal'])){
                                                echo $detail['area'].' cm²';
                                            }elseif(isset($detail['side_a'])){
                                                echo $detail['a'].' cm';
                                            }elseif(isset($detail['side_b'])){
                                                echo $detail['b'].' cm';
                                            }else{
                                                echo $detail['c'].' cm';
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['9']}}</strong></p>
                            @if(isset($detail['two_sides']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = √<span class="b_t">(a² + b²)</span></p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}, b = {{$detail['b']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = √<span class="border-top-black">(a² + b²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">(({{$detail['a']}})² + ({{$detail['b']}})²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s1']}} + {{$detail['s2']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">{{$detail['s3']}}</span></p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['a_angle']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = a / sin(α)</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}, α = {{$detail['angle_a']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = a / sin(α)</p>
                                <p class="mt-2">c = {{$detail['a']}} / sin({{$detail['angle_a']}})</p>
                                <p class="mt-2">c = {{$detail['a']}} / {{$detail['s1']}}</p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['b_angle']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = b / sin(β)</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">b = {{$detail['b']}}, β = {{$detail['angle_b']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = b / sin(β)</p>
                                <p class="mt-2">c = {{$detail['b']}} / sin({{$detail['angle_b']}})</p>
                                <p class="mt-2">c = {{$detail['b']}} / {{$detail['s1']}}</p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['hypo_a']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = √<span class="border-top-black">(a² + (area * 2 / a)²)</span></p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}, area = {{$detail['area']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = √<span class="border-top-black">(a² + (area * 2 / a)²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['a']}}² + ({{$detail['area']}} * 2 / {{$detail['a']}})²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s1']}} + ({{$detail['s2']}} / {{$detail['a']}})²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s1']}} + ({{$detail['s3']}})²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s1']}} + {{$detail['s4']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">{{$detail['s5']}}</span></p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['hypo_b']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = √<span class="border-top-black">((area * 2 / b)² + b²)</span></p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">b = {{$detail['b']}}, area = {{$detail['area']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = √<span class="border-top-black">((area * 2 / b)² + b²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">(({{$detail['area']}} * 2 / {{$detail['b']}})² + {{$detail['b']}}²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">(({{$detail['s2']}} / {{$detail['b']}})² + {{$detail['s1']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">(({{$detail['s3']}})² + {{$detail['s1']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s4']}} + {{$detail['s1']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">{{$detail['s5']}}</span></p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['area_cal']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">area = (a * b) / 2</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}, b = {{$detail['b']}}, area = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">area = (a * b) / 2</p>
                                <p class="mt-2">area = ({{$detail['a']}} * {{$detail['b']}}) / 2</p>
                                <p class="mt-2">area = {{$detail['s1']}} / 2</p>
                                <p class="mt-2">area = {{$detail['area']}}</p>
                            @elseif(isset($detail['side_a']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">a = (area * 2) / b</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">area = {{$detail['area']}}, b = {{$detail['b']}}, a = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">a = (area * 2) / b</p>
                                <p class="mt-2">a = ({{$detail['area']}} * 2) / {{$detail['b']}}</p>
                                <p class="mt-2">a = {{$detail['s1']}} / {{$detail['b']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}</p>
                            @else
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">b = (area * 2) / a</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">area = {{$detail['area']}}, a = {{$detail['a']}}, b = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">b = (area * 2) / a</p>
                                <p class="mt-2">b = ({{$detail['area']}} * 2) / {{$detail['a']}}</p>
                                <p class="mt-2">b = {{$detail['s1']}} / {{$detail['a']}}</p>
                                <p class="mt-2">b = {{$detail['b']}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
</div>
