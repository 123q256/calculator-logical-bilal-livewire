<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
         <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[80%] md:w-[90%] w-full mx-auto ">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Voltage & Charge Mode --}}
                <div class="space-y-4">
                    <p class="text-lg font-bold text-blue border-b pb-2">{{ $lang[1] }}</p>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="volt" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="volt" id="volt" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                                <label for="volt_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('volt_unit')">{{ $volt_unit }} ▾</label>
                                @if($dropdowns['volt_unit'] ?? false)
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['nv', 'μV', 'mV', 'V', 'kV', 'MV'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('volt_unit', '{{ $unit }}', 'volt_unit')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label for="charge" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="charge" id="charge" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                                <label for="charge_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('charge_unit')">{{ $charge_unit }} ▾</label>
                                @if($dropdowns['charge_unit'] ?? false)
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['C', 'Ah', 'mAh'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('charge_unit', '{{ $unit }}', 'charge_unit')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Power & Time Mode --}}
                <div class="space-y-4">
                    <p class="text-lg font-bold text-blue border-b pb-2">{{ $lang[4] }}</p>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="power" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="power" id="power" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                                <label for="power_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('power_unit')">{{ $power_unit }} ▾</label>
                                @if($dropdowns['power_unit'] ?? false)
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0  overflow-y-auto">
                                    @foreach(['mW', 'W', 'kW', 'MW', 'BTU/h', 'hp(I)', 'hp(E)'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('power_unit', '{{ $unit }}', 'power_unit')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label for="hour" class="font-s-14 text-blue">{{ $lang[6] }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="hour" id="hour" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                                <label for="hour_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('hour_unit')">{{ $hour_unit }} ▾</label>
                                @if($dropdowns['hour_unit'] ?? false)
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0  overflow-y-auto">
                                    @foreach(['ms', 'sec', 'min', 'hrs', 'dys', 'wks', 'm', 'yrs'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('hour_unit', '{{ $unit }}', 'hour_unit')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                                @endif
                            </div>
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

<hr>
    @if(isset($detail))
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg">
                <div class="w-full mt-3">
                    <div class="w-full">
                        {{-- Energy from Voltage/Charge Result --}}
                        @if (isset($detail['energy']))
                        <div class="w-full lg:w-[80%] overflow-auto mb-8">
                            <p class="text-lg font-bold text-blue mb-2">{{ $lang[1] }} Results:</p>
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['energy'], 5) }} Wh</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['energy_k'], 5) }} kWh</strong></td>
                                </tr>
                            </table>
                        </div>
                        @endif

                        {{-- Energy from Power/Time Result --}}
                        @if (isset($detail['watt_h']))
                        <div class="w-full lg:w-[80%] overflow-auto">
                            <p class="text-lg font-bold text-blue mb-2">{{ $lang[4] }} Results:</p>
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['9'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['watt_h'], 5) }} Wh</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['10'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['watt_hk'], 5) }} kWh</strong></td>
                                </tr>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
