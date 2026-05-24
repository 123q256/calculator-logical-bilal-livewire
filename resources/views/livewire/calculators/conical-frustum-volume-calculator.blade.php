<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ choose: @entangle('choose') }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="choose" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="choose" class="input" id="choose" aria-label="select">
                            <option value="r_h">{{"$lang[2] s, V, L, A | $lang[3] r1, r2, h"}}</option>
                            <option value="r_sh">{{"$lang[2] h, V, L, A | $lang[3] r1, r2, s"}}</option>
                            <option value="r_v">{{"$lang[2] h, s, L, A | $lang[3] r1, r2, V"}}</option>
                            <option value="r_l">{{"$lang[2] h, s, V, A | $lang[3] r1, r2, L"}}</option>
                            <option value="r_a">{{"$lang[2] h, s, V, L | $lang[3] r1, r2, A"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="first" class="font-s-14 text-blue">{{$lang['4']}} (r<sub class="font-s-14">1</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="first_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('first_unit_dropdown').classList.toggle('hidden')">{{ $first_unit }} ▾</label>
                        <input type="text" wire:model="first_unit"  id="first_unit" class="hidden">
                        <div id="first_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="first_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('first_unit', 'mm'); document.getElementById('first_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('first_unit', 'cm'); document.getElementById('first_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('first_unit', 'm'); document.getElementById('first_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('first_unit', 'km'); document.getElementById('first_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('first_unit', 'in'); document.getElementById('first_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('first_unit', 'ft'); document.getElementById('first_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('first_unit', 'yd'); document.getElementById('first_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('first_unit', 'mi'); document.getElementById('first_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="second" class="font-s-14 text-blue">{{$lang['4']}} (r<sub class="font-s-14">2</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="second_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('second_unit_dropdown').classList.toggle('hidden')">{{ $second_unit }} ▾</label>
                        <input type="text" wire:model="second_unit"  id="second_unit" class="hidden">
                        <div id="second_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="second_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('second_unit', 'mm'); document.getElementById('second_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('second_unit', 'cm'); document.getElementById('second_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('second_unit', 'm'); document.getElementById('second_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('second_unit', 'km'); document.getElementById('second_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('second_unit', 'in'); document.getElementById('second_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('second_unit', 'ft'); document.getElementById('second_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('second_unit', 'yd'); document.getElementById('second_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('second_unit', 'mi'); document.getElementById('second_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="third" class="font-s-14 text-blue" id="f3_text" x-html="choose === 'r_sh' ? `{{$lang[8]}} (s)` : (choose === 'r_v' ? `{{$lang[9]}} (V)` : (choose === 'r_l' ? `{{$lang[14]}} (L)` : (choose === 'r_a' ? `{{$lang[15]}} (A)` : `{{$lang['5']}} (h)`)))"></label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="third_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('third_unit_dropdown').classList.toggle('hidden')">{{ $third_unit }} ▾</label>
                        <input type="text" wire:model="third_unit"  id="third_unit" class="hidden">
                        <div id="third_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="third_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('third_unit', 'mm'); document.getElementById('third_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('third_unit', 'cm'); document.getElementById('third_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('third_unit', 'm'); document.getElementById('third_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('third_unit', 'km'); document.getElementById('third_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('third_unit', 'in'); document.getElementById('third_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('third_unit', 'ft'); document.getElementById('third_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('third_unit', 'yd'); document.getElementById('third_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('third_unit', 'mi'); document.getElementById('third_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="pi_val" class="font-s-14 text-blue">{{$lang[6]}} π</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model="pi_val" id="pi_val" class="input"  aria-label="input"/>
                    </div>
                </div>
            </div>
            <div class="col-span-6">
                    <div class="col-12 text-center mt-3 flex justify-center items-center">
                        <img src="{{asset('images/new_frustum.webp')}}" height="100%" width="56%" alt="Volume of Frustum Cone image" loading="lazy" decoding="async">
                    </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="units" class="font-s-14 text-blue">{{$lang['7']}}:</label>
                    <div class="w-full py-2">
                        <select wire:model="units" class="input" id="units" aria-label="select">
                            <option value="cm">cm</option>
                            <option value="mm">mm</option>
                            <option value="m">m</option>
                            <option value="km">km</option>
                            <option value="in">in</option>
                            <option value="ft">ft</option>
                            <option value="yd">yd</option>
                            <option value="mi">mi</option>
                        </select>
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
                        <div class="w-full lg:w-[80%] overflow-auto mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}} (r<sub class="font-s-14">1</sub>)</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['radius_1'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}} (r<sub class="font-s-14">2</sub>)</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['radius_2'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['5']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['height'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['slant_height'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['volume'])}} {{$units}}³</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['lsa'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['tsa'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['bsa'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['ttsa'])}} {{$units}}</td>
                                </tr>
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
