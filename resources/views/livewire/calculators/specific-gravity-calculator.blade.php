<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4">
                {{-- Fluid Type --}}
                <div class="col-span-12">
                    <label for="t_fluid" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="t_fluid" id="t_fluid" class="input">
                            <option value="ls">{{ $lang['2'] }}</option>
                            <option value="gas">{{ $lang['3'] }}</option>
                        </select>
                    </div>
                </div>

                {{-- Density --}}
                <div class="col-span-12">
                    <label for="density" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="density" id="density" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('density_unit')">{{ $density_unit }} ▾</label>
                        @if($dropdowns['density_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0  overflow-y-auto">
                            @foreach(['kg/m³', 'lb/ft³', 'lb/yd³', 'g/cm³', 'kg/cm³', 'mg/cm³', 'g/m³', 'g/dm³'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('density_unit', '{{ $unit }}', 'density_unit')">{{ $unit }}</p>
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
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang['5'] }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] px-4 py-2 rounded-lg inline-block my-3">
                                    <strong class="text-white">{{ $t_fluid == 'ls' ? number_format($detail['gravity'], 5) : number_format($detail['gs_gravity'], 5) }}</strong>
                                </p>
                            </div>
                        </div>

                        <p class="w-full mt-8 text-[20px] text-blue text-center font-bold">{{ $lang[6] }}</p>
                        
                        <div class="w-full lg:w-[60%] overflow-auto mt-4">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-[#F6FAFC]">
                                        <th class="p-3 border text-center text-blue">{{ $lang['8'] }}</th>
                                        <th class="p-3 border text-center text-blue">{{ $lang['9'] }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['10'] }}</td>
                                        <td class="p-3 border text-center font-semibold">0.12</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['11'] }}</td>
                                        <td class="p-3 border text-center font-semibold">0.6 - 0.9</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['12'] }}</td>
                                        <td class="p-3 border text-center font-semibold">0.789</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['13'] }}</td>
                                        <td class="p-3 border text-center font-semibold">0.91</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['14'] }}</td>
                                        <td class="p-3 border text-center font-semibold">0.92</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center text-blue font-bold">{{ $lang['15'] }}</td>
                                        <td class="p-3 border text-center font-bold text-blue">1.0</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['16'] }}</td>
                                        <td class="p-3 border text-center font-semibold">1.06</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['17'] }}</td>
                                        <td class="p-3 border text-center font-semibold">2.17</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['18'] }}</td>
                                        <td class="p-3 border text-center font-semibold">2.7</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['19'] }}</td>
                                        <td class="p-3 border text-center font-semibold">3.15</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['20'] }}</td>
                                        <td class="p-3 border text-center font-semibold">11.34</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['21'] }}</td>
                                        <td class="p-3 border text-center font-semibold">13.6</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['22'] }}</td>
                                        <td class="p-3 border text-center font-semibold">19.05</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['23'] }}</td>
                                        <td class="p-3 border text-center font-semibold">19.32</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['24'] }}</td>
                                        <td class="p-3 border text-center font-semibold">22.59</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="p-3 border text-center">{{ $lang['25'] }}</td>
                                        <td class="p-3 border text-center font-semibold">8.96</td>
                                    </tr>
                                </tbody>
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
