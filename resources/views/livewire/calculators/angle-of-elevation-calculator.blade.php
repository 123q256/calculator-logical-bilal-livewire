<div x-data="{ toCal: @entangle('to_cal').live }">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

                    <div class="col-span-12">
                        <label for="to_cal" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" wire:model.live="to_cal" id="to_cal">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                                <option value="3">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Vertical Rise --}}
                    <div class="col-span-12" x-show="toCal == '1' || toCal == '3'" style="{{ ($to_cal == '1' || $to_cal == '3') ? '' : 'display: none;' }}" x-data="{ openUnit: false, unit: @entangle('vertical_unit').live }">
                        <label for="vertical" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="vertical" id="vertical" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 select-none" @click="openUnit = !openUnit">
                                <span x-text="unit"></span> ▾
                            </label>
                            <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg text-left">
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'cm'; openUnit = false">centimeters (cm)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'm'; openUnit = false">meters (m)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'km'; openUnit = false">kilometers (km)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'in'; openUnit = false">inches (in)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'ft'; openUnit = false">feets (ft)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'yd'; openUnit = false">yards (yd)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'mi'; openUnit = false">miles (mi)</p>
                            </div>
                         </div>
                    </div>

                    {{-- Horizontal Distance --}}
                    <div class="col-span-12" x-show="toCal == '1' || toCal == '2'" style="{{ ($to_cal == '1' || $to_cal == '2') ? '' : 'display: none;' }}" x-data="{ openUnit: false, unit: @entangle('hori_unit').live }">
                        <label for="hori" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="hori" id="hori" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 select-none" @click="openUnit = !openUnit">
                                <span x-text="unit"></span> ▾
                            </label>
                            <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg text-left">
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'mm'; openUnit = false">millimeters (mm)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'cm'; openUnit = false">centimeters (cm)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'm'; openUnit = false">meters (m)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'km'; openUnit = false">kilometers (km)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'in'; openUnit = false">inches (in)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'ft'; openUnit = false">feets (ft)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'yd'; openUnit = false">yards (yd)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'mi'; openUnit = false">miles (mi)</p>
                                 <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'nmi'; openUnit = false">nautical miles (nmi)</p>
                            </div>
                         </div>
                    </div>

                    {{-- Angle of Elevation --}}
                    <div class="col-span-12" x-show="toCal == '2' || toCal == '3'" style="{{ ($to_cal == '2' || $to_cal == '3') ? '' : 'display: none;' }}" x-data="{ openUnit: false, unit: @entangle('angle_unit').live }">
                        <label for="angle" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" step="any" wire:model.live="angle" id="angle" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
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
                                        @if($to_cal === '1')
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['ang_deg'], 4) }} deg</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['angle'], 5) }} rad</td>
                                            </tr>
                                        @elseif($to_cal === '2')
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                                <td class="py-2 border-b">{{ $detail['vertical'] }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                                <td class="py-2 border-b">{{ $detail['hori'] }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                            <td class="py-2 border-b">{{ round($detail['grade'], 4) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                            <td class="py-2 border-b">{{ round($detail['gradep'], 4) }} %</td>
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
