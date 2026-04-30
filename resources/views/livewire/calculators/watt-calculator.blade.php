<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <p class="w-full my-2 px-2 text-blue font-semibold">{{ $lang[5] }}</p>
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                {{-- Resistance --}}
                <div class="space-y-2">
                    <label for="resistance" class="font-s-14 text-blue">{{ $lang[1] }} (R):</label>
                    <div class="relative w-full">
                        <input type="number" wire:model="resistance" id="resistance" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="resistance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('resistance_unit')">{{ $resistance_unit }} ▾</label>
                        @if($dropdowns['resistance_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['Ω', 'kΩ', 'MΩ'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('resistance_unit', '{{ $unit }}', 'resistance_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Current --}}
                <div class="space-y-2">
                    <label for="current" class="font-s-14 text-blue">{{ $lang[2] }} (I):</label>
                    <div class="relative w-full">
                        <input type="number" wire:model="current" id="current" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="current_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('current_unit')">{{ $current_unit }} ▾</label>
                        @if($dropdowns['current_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['A', 'μA', 'mA', 'kA', 'MA'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('current_unit', '{{ $unit }}', 'current_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Voltage --}}
                <div class="space-y-2">
                    <label for="voltage" class="font-s-14 text-blue">{{ $lang[3] }} (V):</label>
                    <div class="relative w-full">
                        <input type="number" wire:model="voltage" id="voltage" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="voltage_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('voltage_unit')">{{ $voltage_unit }} ▾</label>
                        @if($dropdowns['voltage_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['V', 'μV', 'mV', 'kV', 'MV'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('voltage_unit', '{{ $unit }}', 'voltage_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Power --}}
                <div class="space-y-2">
                    <label for="power" class="font-s-14 text-blue">{{ $lang[4] }} (P):</label>
                    <div class="relative w-full">
                        <input type="number" wire:model="power" id="power" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="power_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('power_unit')">{{ $power_unit }} ▾</label>
                        @if($dropdowns['power_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['W', 'μW', 'mW', 'kW', 'MW'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('power_unit', '{{ $unit }}', 'power_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
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

<hr>
    @if(isset($detail))
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue rounded-lg mt-3 ">
                    <div class="flex justify-center">
                        <div class="w-full overflow-auto mt-2 px-2">
                            <table class="w-full text-lg">
                                @if (isset($detail['resistance']))
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['1'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['resistance'], 4) }} (Ω)</strong></td>
                                    </tr>
                                @endif
                                @if (isset($detail['current']))
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['2'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['current'], 4) }} (A)</strong></td>
                                    </tr>
                                @endif
                                @if (isset($detail['power']))
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['4'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['power'], 4) }} (W)</strong></td>
                                    </tr>
                                @endif
                                @if (isset($detail['voltage']))
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['3'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['voltage'], 4) }} (V)</strong></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
