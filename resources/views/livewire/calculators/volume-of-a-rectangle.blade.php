<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ choose: @entangle('choose') }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12">
                            <label for="choose" class="label">{{$lang['1']}}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="choose" class="input" id="choose" aria-label="select">
                                    <option value="hlw">{{"$lang[2] V, S, d | $lang[3] h, l, w"}}</option>
                                    <option value="slw">{{"$lang[2] h, V, d | $lang[3] S, l, w"}}</option>
                                    <option value="vlw">{{"$lang[2] h, S, d | $lang[3] V, l, w"}}</option>
                                    <option value="dlw">{{"$lang[2] h, V, S | $lang[3] d, l, w"}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="first" class="label">{{$lang['4']}} (l)</label>
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
                        <div class="col-span-12">
                            <label for="second" class="label">{{$lang['5']}} (w)</label>
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
                        <div class="col-span-12">
                            <label for="third" class="label" id="f3_text" x-html="choose === 'slw' ? `{{$lang[14]}} S<sub class='font-s-12 text-blue'>tot</sub>` : (choose === 'vlw' ? `{{$lang[8]}} (V)` : (choose === 'dlw' ? `{{$lang[9]}} (d)` : `{{$lang['6']}} (h)`))"></label>
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
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class=" col-span-12 text-center mt-3 flex items-center justify-center">
                            <img src="{{asset('images/new_volume_rec.webp')}}" height="100%" width="80%" alt="Volume of a Rectangular Prism Image" loading="lazy" decoding="async">
                        </div>
                    <div class="col-span-12">
                        <label for="units" class="label">{{$lang['7']}}:</label>
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
                            <div class="col-lg-6 mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['volume_ans'])}} {{$units}}</td>
                                    </tr>
                                </table>
                                <table class="w-full font-s-16 mt-2">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['5']}}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['width'])}} {{$units}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['6']}}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['height'])}} {{$units}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['9']}}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['diagonal'])}} {{$units}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['10']}}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['s_tot'])}} {{$units}}²</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['11']}}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['s_lat'])}} {{$units}}²</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['12']}}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['s_top'])}} {{$units}}²</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['13']}}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['s_btm'])}} {{$units}}²</strong></td>
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
