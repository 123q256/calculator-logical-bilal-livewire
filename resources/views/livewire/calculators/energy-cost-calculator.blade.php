<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                {{-- Appliance Select --}}
                <div class="space-y-2">
                    <label for="appliance" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select wire:model.live="appliance" id="appliance" class="input">
                        @php
                            $appliances = [
                                600 => $lang['9'], 3000 => $lang['10'], 2400 => $lang['11'], 1600 => $lang['12'], 
                                2000 => $lang['13'], 70 => $lang['14'], 2000 => $lang['15'], 800 => $lang['16'], 
                                100 => $lang['17'], 50 => $lang['18'], 200 => $lang['19'], 200 => $lang['20'], 
                                70 => $lang['21'], 1000 => $lang['22'], 1600 => $lang['23'], 2000 => $lang['24'], 
                                4000 => $lang['25']
                            ];
                        @endphp
                        @foreach($appliances as $val => $name)
                            <option value="{{ $val }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Power --}}
                <div class="space-y-2">
                    <label for="power" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full">
                        <input type="number" wire:model="power" id="power" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="power_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('power_units')">{{ $power_units }} ▾</label>
                        @if($dropdowns['power_units'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('power_units', 'watts (W)', 'power_units')">watts (W)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('power_units', 'kilowatts (kW)', 'power_units')">kilowatts (kW)</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Hours Per Day --}}
                <div class="space-y-2 relative">
                    <label for="hours_per_day" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <input type="number" step="any" wire:model="hours_per_day" id="hours_per_day" class="input" placeholder="00" />
                    <span class="input_unit">h/day</span>
                </div>

                {{-- Cost --}}
                <div class="space-y-2">
                    <label for="cost" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                    <div class="relative w-full">
                        <input type="number" wire:model="cost" id="cost" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="cost_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('cost_units')">{{ $cost_units }} ▾</label>
                        @if($dropdowns['cost_units'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['cent', 'pence', 'rupee'] as $u)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('cost_units', '{{ $currancy }}/{{ $u }}', 'cost_units')">{{ $currancy }}/{{ $u }}</p>
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
                <div class="w-full bg-light-blue rounded-lg">
                        <div class="w-full md:w-[80%] overflow-auto">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[6] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ $currancy . number_format($detail['energy_cost_per_day'], 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[7] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ $currancy . number_format($detail['energy_cost_per_month'], 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[8] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ $currancy . number_format($detail['energy_cost_per_year'], 4) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
