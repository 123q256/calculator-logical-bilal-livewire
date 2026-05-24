<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12">
                            <label for="choose" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="choose" class="input" id="choose" aria-label="select">
                                    <option value="a_r">{{"$lang[2] V, S, C | $lang[3] r, a"}}</option>
                                    <option value="v_r" >{{"$lang[2] a, S, C | $lang[3] r, V"}}</option>
                                    <option value="s_r" >{{"$lang[2] a, V, C | $lang[3] r, S"}}</option>
                                    <option value="c_a" >{{"$lang[2] r, V, S | $lang[3] a, C"}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="first" class="font-s-14 text-blue" id="f1_text">
                                @if(isset($choose) && $choose === "c_a")
                                    {{$lang[5]}} (a)
                                @else
                                    {{$lang[4]}} (r)
                                @endif
                            </label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $first_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('first_unit', 'mm')" @click="open = false">millimeters (mm)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('first_unit', 'cm')" @click="open = false">centimeters (cm)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('first_unit', 'm')" @click="open = false">meters (m)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('first_unit', 'km')" @click="open = false">kilometers (km)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('first_unit', 'in')" @click="open = false">inches (in)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('first_unit', 'ft')" @click="open = false">feets (ft)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('first_unit', 'yd')" @click="open = false">yards (yd)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('first_unit', 'mi')" @click="open = false">miles (mi)</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12">
                            <label for="second" class="font-s-14 text-blue" id="f2_text">
                                @if(isset($choose) && $choose === "c_a")
                                    {{$lang[10]}} (C)
                                @elseif(isset($choose) && $choose === "v_r")
                                    {{$lang[8]}} (V)
                                @elseif(isset($choose) && $choose === "s_r")
                                    {{$lang[9]}} (S)
                                @else
                                    {{$lang[5]}} (a)
                                @endif
                            </label>
                                                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $second_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('second_unit', 'mm')" @click="open = false">millimeters (mm)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('second_unit', 'cm')" @click="open = false">centimeters (cm)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('second_unit', 'm')" @click="open = false">meters (m)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('second_unit', 'km')" @click="open = false">kilometers (km)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('second_unit', 'in')" @click="open = false">inches (in)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('second_unit', 'ft')" @click="open = false">feets (ft)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('second_unit', 'yd')" @click="open = false">yards (yd)</p>
                                   <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('second_unit', 'mi')" @click="open = false">miles (mi)</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12">
                            <label for="pi_val" class="font-s-14 text-blue">{{$lang[6]}} π</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="pi_val" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12  flex justify-center">
                            <img src="{{asset('images/new_volume-cap.webp')}}" height="100%" width="65%" alt="Volume of Capsule image" loading="lazy" decoding="async">
                        </div>
                    <div class="col-span-12">
                        <label for="units" class="font-s-14 text-blue">{{$lang['7']}}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="units" class="input" id="units" aria-label="select">
                                <option value="cm">cm</option>
                                <option value="mm" >mm</option>
                                <option value="m" >m</option>
                                <option value="km" >km</option>
                                <option value="in" >in</option>
                                <option value="ft" >ft</option>
                                <option value="yd" >yd</option>
                                <option value="mi" >mi</option>
                            </select>
                        </div>
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
                        <div class="w-full lg:w-[80%] overf mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['volume'])}} {{$units}}³</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['surface'])}} {{$units}}²</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['circumference'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['radius'])}} {{$units}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['5']}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['side'])}} {{$units}}</td>
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
