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
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" id="operations" wire:model.live="operations">
                        <option value="1"><?=$lang[2]?> (c)</option>
                        <option value="2"><?=$lang[3]?> (A)</option>
                        <option value="3"><?=$lang[4]?> (d)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 {{ $operations == '2' ? 'hidden':'block' }}" id="f_input">
                <label for="first" class="font-s-14 text-blue" id="txt">
                    {{ $operations == '3' ? "$lang[4] (d):" : "$lang[5] (c):" }}
                </label>
                <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                    <input type="number" wire:model.live="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit1 }} ▾</label>
                    <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'cm'); open = false">centimeters (cm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'mm'); open = false">milimeters (mm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'm'); open = false">meters (m)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'km'); open = false">kilometers (km)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'dm'); open = false">decimetre (dm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'in'); open = false">inches (in)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'yd'); open = false">yards (yd)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'mi'); open = false">miles (mi)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'nmi'); open = false">nautical mile (nmi)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 {{ $operations == '2' ? 'block':'hidden' }}" id="areaInput">
                <label for="second" class="font-s-14 text-blue">{{$lang[3]}} (A)</label>
                <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                    <input type="number" wire:model.live="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit2 }} ▾</label>
                    <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'mm²'); open = false">square millimeter (mm²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'cm²'); open = false">square centimeter (cm²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'dm²'); open = false">square decimeter (dm²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'm²'); open = false">square metre (m²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'km²'); open = false">square kilometre (km²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'in²'); open = false">square inch (in²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'ft²'); open = false">square feet (ft²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'yd²'); open = false">square yards (yd²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'mi²'); open = false">square miles (mi²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'a'); open = false">atto (a)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'da'); open = false">dekameters (da)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'ha'); open = false">hectares (ha)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'ac'); open = false">acres (ac)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'sf'); open = false">soccer fields</p>
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
                            <div class="w-full lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    @isset($detail['radius'])
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['radius'], 2)}} cm</td>
                                        </tr>
                                    @endisset
                                    @isset($detail['circum'])
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['circum'], 2)}} cm</td>
                                        </tr>
                                    @endisset
                                    @isset($detail['area'])
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['area'], 2)}} cm²</td>
                                        </tr>
                                    @endisset
                                    @isset($detail['diameter'])
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['diameter'], 2)}} cm</td>
                                        </tr>
                                    @endisset
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
