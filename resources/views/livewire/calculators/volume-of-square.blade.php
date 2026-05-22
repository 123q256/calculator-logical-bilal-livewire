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
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12">
                    <label for="length" class="font-s-14 text-blue"><?= $lang['1'] ?></label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $length_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'mm'); open = false">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'm'); open = false">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'km'); open = false">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'in'); open = false">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'ft'); open = false">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'yd'); open = false">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'mi'); open = false">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', 'nmi'); open = false">nautical mile (nmi)</p>
                        </div>
                     </div>
                </div>

                <div class="col-span-12">
                    <label for="height" class="font-s-14 text-blue"><?= $lang['2'] ?></label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $height_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'mm'); open = false">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'm'); open = false">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'km'); open = false">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'in'); open = false">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'ft'); open = false">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'yd'); open = false">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'mi'); open = false">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'nmi'); open = false">nautical mile (nmi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12">
                    <label for="width" class="font-s-14 text-blue"><?= $lang['3'] ?></label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $width_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'mm'); open = false">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'm'); open = false">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'km'); open = false">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'in'); open = false">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'ft'); open = false">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'yd'); open = false">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'mi'); open = false">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('width_unit', 'nmi'); open = false">nautical mile (nmi)</p>
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
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['answer'], 4)}} in³</td>
                                </tr>
                            </table>
                        </div>
                        <p class="col-12 mt-3"><strong>{{ $lang['5'] }}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%]">                    
                            <table class="w-full text-[16px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%">mm³</td>
                                    <td class="py-2 border-b"><strong>{{ safe_round($detail['answer'] * 16390 , 4)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">m³</td>
                                    <td class="py-2 border-b"><strong>{{safe_round($detail['answer'] / 61020, 4)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">ft³</td>
                                    <td class="py-2 border-b"><strong>{{safe_round($detail['answer'] / 1728, 4)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">cm³</td>
                                    <td class="py-2 border-b"><strong>{{safe_round($detail['answer'] * 16.387, 4)}}</strong></td>
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
