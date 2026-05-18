@php
if (!function_exists('safe_round')) {
    function safe_round($val, $precision = 5) {
        if (is_null($val)) {
            return '';
        }
        if ($val === 'NAN' || $val === 'NaN' || is_nan((float)$val)) {
            return 'NAN';
        }
        if (is_infinite((float)$val)) {
            return 'INF';
        }
        return is_numeric($val) ? round((float)$val, $precision) : $val;
    }
}
@endphp

<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 mb-2"><strong>{{ $lang['8'] }}:</strong> {{ $lang['9'] }}.</p>

                    {{-- Angle --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="angle" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="relative w-full mt-[7px]" x-data="{ openUnit: false, unit: @entangle('angle_unit').live }">
                            <input type="number" step="any" min="1" wire:model.live="angle" id="angle" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 select-none" @click="openUnit = !openUnit">
                                <span x-text="unit"></span> ▾
                            </label>
                            <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg text-left">
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'deg'; openUnit = false">degrees (deg)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'rad'; openUnit = false">radians (rad)</p>
                            </div>
                         </div>
                    </div>

                    {{-- Radius --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="rad" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                        <div class="relative w-full mt-[7px]" x-data="{ openUnit: false, unit: @entangle('rad_unit').live }">
                            <input type="number" step="any" min="1" wire:model.live="rad" id="rad" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 select-none" @click="openUnit = !openUnit">
                                <span x-text="unit"></span> ▾
                            </label>
                            <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg text-left">
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'cm'; openUnit = false">centimeters (cm)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'm'; openUnit = false">meters (m)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'in'; openUnit = false">inches (in)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'ft'; openUnit = false">feet (ft)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'yd'; openUnit = false">yards (yd)</p>
                            </div>
                         </div>
                    </div>

                    {{-- Diameter --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="diameter" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                        <div class="relative w-full mt-[7px]" x-data="{ openUnit: false, unit: @entangle('diameter_unit').live }">
                            <input type="number" step="any" min="1" wire:model.live="diameter" id="diameter" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 select-none" @click="openUnit = !openUnit">
                                <span x-text="unit"></span> ▾
                            </label>
                            <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg text-left">
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'cm'; openUnit = false">centimeters (cm)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'm'; openUnit = false">meters (m)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'in'; openUnit = false">inches (in)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'ft'; openUnit = false">feet (ft)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'yd'; openUnit = false">yards (yd)</p>
                            </div>
                         </div>
                    </div>

                    {{-- Area --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="area" class="font-s-14 text-blue">{{ $lang['4'] }} (A)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ openUnit: false, unit: @entangle('area_unit').live }">
                            <input type="number" step="any" min="1" wire:model.live="area" id="area" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 select-none" @click="openUnit = !openUnit">
                                <span x-text="unit"></span> ▾
                            </label>
                            <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg text-left">
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'cm²'; openUnit = false">square centimeters (cm²)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'm²'; openUnit = false">square meters (m²)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'in²'; openUnit = false">square inches (in²)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'ft²'; openUnit = false">square feet (ft²)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'yd²'; openUnit = false">square yards (yd²)</p>
                            </div>
                         </div>
                    </div>

                    {{-- Arc --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="arc" class="font-s-14 text-blue">{{ $lang['5'] }} (L)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ openUnit: false, unit: @entangle('arc_unit').live }">
                            <input type="number" step="any" min="1" wire:model.live="arc" id="arc" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 select-none" @click="openUnit = !openUnit">
                                <span x-text="unit"></span> ▾
                            </label>
                            <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg text-left">
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'cm'; openUnit = false">centimeters (cm)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'm'; openUnit = false">meters (m)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'in'; openUnit = false">inches (in)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'ft'; openUnit = false">feet (ft)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'yd'; openUnit = false">yards (yd)</p>
                            </div>
                         </div>
                    </div>

                    {{-- Chord --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="c" class="font-s-14 text-blue">{{ $lang['6'] }} (c)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ openUnit: false, unit: @entangle('c_unit').live }">
                            <input type="number" step="any" min="1" wire:model.live="c" id="c" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 select-none" @click="openUnit = !openUnit">
                                <span x-text="unit"></span> ▾
                            </label>
                            <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg text-left">
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'cm'; openUnit = false">centimeters (cm)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'm'; openUnit = false">meters (m)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'in'; openUnit = false">inches (in)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'ft'; openUnit = false">feet (ft)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'yd'; openUnit = false">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div>
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full text-[18px]">
                                        @if ($detail['mode'] === 1)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['area'], 5) }} {{ $detail['unit'] }}²</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['arc'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['dia'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 2)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['area'], 5) }} {{ $detail['unit'] }}²</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['arc'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['rad'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 3)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                                <td class="py-2 border-b">
                                                    @if(is_numeric($detail['angle']) && !is_nan((float)$detail['angle']))
                                                        {{ safe_round($detail['angle'], 5) }} rad / {{ safe_round(rad2deg($detail['angle']), 5) }} deg
                                                    @else
                                                        NAN
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['arc'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['dia'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 4)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['rad'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['arc'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['dia'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 5)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['area'], 5) }} {{ $detail['unit'] }}²</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['2'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['rad'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['dia'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 6)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['area'], 5) }} {{ $detail['unit'] }}²</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['2'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['rad'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['dia'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 7)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['area'], 5) }} {{ $detail['unit'] }}²</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                                <td class="py-2 border-b">
                                                    @if(is_numeric($detail['angle']) && !is_nan((float)$detail['angle']))
                                                        {{ safe_round($detail['angle'], 5) }} rad / {{ safe_round(rad2deg($detail['angle']), 5) }} deg
                                                    @else
                                                        NAN
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['dia'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 8)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['area'], 5) }} {{ $detail['unit'] }}²</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                                <td class="py-2 border-b">
                                                    @if(is_numeric($detail['angle']) && !is_nan((float)$detail['angle']))
                                                        {{ safe_round($detail['angle'], 5) }} rad / {{ safe_round(rad2deg($detail['angle']), 5) }} deg
                                                    @else
                                                        NAN
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['arc'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['dia'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 9)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                                <td class="py-2 border-b">
                                                    @if(is_numeric($detail['angle']) && !is_nan((float)$detail['angle']))
                                                        {{ safe_round($detail['angle'], 5) }} rad / {{ safe_round(rad2deg($detail['angle']), 5) }} deg
                                                    @else
                                                        NAN
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['arc'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['rad'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 10)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['area'], 5) }} {{ $detail['unit'] }}²</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                                <td class="py-2 border-b">
                                                    @if(is_numeric($detail['angle']) && !is_nan((float)$detail['angle']))
                                                        {{ safe_round($detail['angle'], 5) }} rad / {{ safe_round(rad2deg($detail['angle']), 5) }} deg
                                                    @else
                                                        NAN
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['rad'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @elseif ($detail['mode'] === 11)
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['area'], 5) }} {{ $detail['unit'] }}²</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                                <td class="py-2 border-b">
                                                    @if(is_numeric($detail['angle']) && !is_nan((float)$detail['angle']))
                                                        {{ safe_round($detail['angle'], 5) }} rad / {{ safe_round(rad2deg($detail['angle']), 5) }} deg
                                                    @else
                                                        NAN
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['arc'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['rad'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['c'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['rad'], 5) }} {{ $detail['unit'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ safe_round($detail['dia'], 5) }} {{ $detail['unit'] }}</td>
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
