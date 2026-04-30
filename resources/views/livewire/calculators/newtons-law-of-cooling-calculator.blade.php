<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4">
                {{-- Ambient Temperature --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="ambient" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="ambient" id="ambient" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="ambient_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('ambient_units')">{{ $ambient_units }} ▾</label>
                        @if($dropdowns['ambient_units'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['°C', '°F', 'K'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ambient_units', '{{ $unit }}', 'ambient_units')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Initial Temperature --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="initial_temperature" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="initial_temperature" id="initial_temperature" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="initial_temp_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('initial_temp_units')">{{ $initial_temp_units }} ▾</label>
                        @if($dropdowns['initial_temp_units'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['°C', '°F', 'K'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('initial_temp_units', '{{ $unit }}', 'initial_temp_units')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Area --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="area" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="area_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('area_units')">{{ $area_units }} ▾</label>
                        @if($dropdowns['area_units'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0  overflow-y-auto">
                            @foreach(['mm²', 'cm²', 'm²', 'km²', 'in²', 'ft²', 'yd²'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_units', '{{ $unit }}', 'area_units')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Heat Capacity --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="heat_capacity" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="heat_capacity" id="heat_capacity" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="heat_capacity_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('heat_capacity_units')">{{ $heat_capacity_units }} ▾</label>
                        @if($dropdowns['heat_capacity_units'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['J/K', 'J/°C', 'BTU/°F'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('heat_capacity_units', '{{ $unit }}', 'heat_capacity_units')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Heat Transfer Coefficient --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="heat_transfer_co" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="heat_transfer_co" id="heat_transfer_co" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="heat_transfer_co_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('heat_transfer_co_units')">{{ $heat_transfer_co_units }} ▾</label>
                        @if($dropdowns['heat_transfer_co_units'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('heat_transfer_co_units', 'W/(m²·K)', 'heat_transfer_co_units')">W/(m²·K)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('heat_transfer_co_units', 'BTU/(h·ft²·°F)', 'heat_transfer_co_units')">BTU/(h·ft²·°F)</p>
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Time Elapsed --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="temp_after" class="font-s-14 text-blue">Time After:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="temp_after" id="temp_after" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="temp_after_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('temp_after_units')">{{ $temp_after_units }} ▾</label>
                        @if($dropdowns['temp_after_units'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['sec', 'min', 'hrs'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('temp_after_units', '{{ $unit }}', 'temp_after_units')">{{ $unit }}</p>
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
                        <div class="w-full lg:w-[80%] mt-2">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['temperature'], 3) }} °C</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['k'], 5) }} sec⁻¹</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <p class="col-12 mt-6 font-s-18 text-blue text-center"><strong>{{ $lang[9] }}</strong></p>
                    
                    <div class="w-full lg:w-[80%] overflow-auto mt-3">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-[#f5f5f5]">
                                    <th class="p-3 border text-center font-bold text-blue">°F</th>
                                    <th class="p-3 border text-center font-bold text-blue">K</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-[#F6FAFC]">
                                    <td class="text-center p-3 border font-semibold">{{ number_format(($detail['temperature'] * 9 / 5) + 32, 3) }}</td>
                                    <td class="text-center p-3 border font-semibold">{{ number_format($detail['temperature'] + 273.15, 3) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
