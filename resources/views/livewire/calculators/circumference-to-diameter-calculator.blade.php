<div>
   <style>
    img{
        object-fit: contain;
    }
</style>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ conversionType: @entangle('conversionType') }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 ">
                    <p>
                    <label class="pe-2 cursor-pointer" for="circumferenceToDiameter">
                        <input type="radio" wire:model.live="conversionType" value="circumferenceToDiameter" id="circumferenceToDiameter">
                        <span><?= $lang['1'] ?></span>
                    </label>
                    </p>
                    <p class="my-2">
                    <label class="cursor-pointer" for="diameterToCircumference">
                        <input type="radio" wire:model.live="conversionType" value="diameterToCircumference" id="diameterToCircumference">
                        <span><?= $lang['2'] ?></span>
                    </label>
                    </p>
                </div>

                <div class="col-span-12">
                    <label for="value" class="label" id="textChanged" x-text="conversionType === 'circumferenceToDiameter' ? `{{ $lang['3'] }}:` : `{{ $lang['4'] }}:`"></label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="value" id="value" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('unit_dropdown').classList.toggle('hidden')">{{ $unit }} ▾</label>
                        <input type="text" wire:model="unit"  id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'cm'); document.getElementById('unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'mm'); document.getElementById('unit_dropdown').classList.add('hidden')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'm'); document.getElementById('unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'km'); document.getElementById('unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'in'); document.getElementById('unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'ft'); document.getElementById('unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'yd'); document.getElementById('unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'mi'); document.getElementById('unit_dropdown').classList.add('hidden')">miles (mi)</p>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $conversionType === "circumferenceToDiameter" ? $lang['4'] : $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['result'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 pb-2 mt-3"><strong>{{ $lang['5'] }}</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] ">                    
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang['6'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ safe_round($detail['result'] * 10, 3) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['result'] * 0.01, 3)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['result'] * 0.00001, 5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['9'] }}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['result'] * 0.3937, 2)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['10'] }}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['result'] * 0.0328084, 3)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['11'] }}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['result'] * 0.0109361, 5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['12'] }}</td>
                                        <td class="py-2 border-b"><strong>{{safe_round($detail['result'] * 0.0000062137, 6)}}</strong></td>
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
