<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4"> 
                {{-- Speed of Sound in Air --}}
                <div class="col-span-12">
                    <p class="text-lg font-bold text-blue border-b pb-2 mb-4">{{ $lang[1] }}</p>
                    <label for="temperature_air" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" wire:model="temperature_air" id="temperature_air" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                       <label for="temperature_air_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('temperature_air_unit')">{{ $temperature_air_unit }} ▾</label>
                       @if($dropdowns['temperature_air_unit'] ?? false)
                       <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                           @foreach(['°C', '°F', 'K'] as $unit)
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('temperature_air_unit', '{{ $unit }}', 'temperature_air_unit')">{{ $unit }}</p>
                           @endforeach
                       </div>
                       @endif
                    </div>
                </div>

                {{-- Speed of Sound in Water (Lookup) --}}
                <div class="col-span-12 mt-6">
                    <p class="text-lg font-bold text-blue border-b pb-2 mb-4">{{ $lang[3] }}</p>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 lg:col-span-6">
                            <label for="select_unit" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="select_unit" id="select_unit" class="input">
                                    <option value="C">°C</option>
                                    <option value="F">°F</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <label for="water_speed" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <div class="w-100 py-2">
                                @if($select_unit === 'C')
                                <select wire:model="water_speed" id="water_speed" class="input">
                                    <option value="1403">0 °C</option>
                                    <option value="1427">5 °C</option>
                                    <option value="1447">10 °C</option>
                                    <option value="1481">20 °C</option>
                                    <option value="1507">30 °C</option>
                                    <option value="1526">40 °C</option>
                                    <option value="1541">50 °C</option>
                                    <option value="1552">60 °C</option>
                                    <option value="1555">70 °C</option>
                                    <option value="1555">80 °C</option>
                                    <option value="1550">90 °C</option>
                                    <option value="1543">100 °C</option>
                                </select>
                                @else
                                <select wire:model="water_speed" id="water_speed" class="input">
                                    <option value="1403">32 °F</option>
                                    <option value="1424">40 °F</option>
                                    <option value="1447.2">50 °F</option>
                                    <option value="1467.3">60 °F</option>
                                    <option value="1484.7">70 °F</option>
                                    <option value="1499.3">80 °F</option>
                                    <option value="1511.8">90 °F</option>
                                    <option value="1522.5">100 °F</option>
                                    <option value="1539">120 °F</option>
                                    <option value="1551.7">140 °F</option>
                                    <option value="1554.8">160 °F</option>
                                    <option value="1553">180 °F</option>
                                    <option value="1551">200 °F</option>
                                    <option value="1543">212 °F</option>
                                </select>
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
            <div class="rounded-lg ">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full lg:w-[80%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['1'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['speedOfSound'] }} m/s</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['3'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($water_speed, 2) }} m/s</strong></td>
                                </tr>
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
