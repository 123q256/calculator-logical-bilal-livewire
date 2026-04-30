<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4">
                {{-- Central Body --}}
                <p class="col-span-12 text-[18px]"><strong>{{ $lang[1] }}</strong></p>
                <div class="col-span-12 lg:col-span-6">
                    <label for="density" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="density" id="density" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('density_unit')">{{ $density_unit }} ▾</label>
                        @if($dropdowns['density_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['kg/m³', 'lb/ft³', 'lb/yd³', 'g/cm³', 'kg/cm³', 'mg/cm³', 'g/m³'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('density_unit', '{{ $unit }}', 'density_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Keplerian Orbit --}}
                <p class="col-span-12 text-[18px] mt-4"><strong>{{ $lang[3] }}</strong></p>
                <div class="col-span-12 lg:col-span-6">
                    <label for="Semi" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="Semi" id="Semi" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="Semi_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('Semi_unit')">{{ $Semi_unit }} ▾</label>
                        @if($dropdowns['Semi_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0  overflow-y-auto">
                            @foreach(['m', 'km', 'yd', 'mi', 'nmi', 'Ro', 'ly', 'au', 'pcs'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('Semi_unit', '{{ $unit }}', 'Semi_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <label for="first" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="first" id="first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="first_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('first_unit')">{{ $first_unit }} ▾</label>
                        @if($dropdowns['first_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0  overflow-y-auto">
                            @foreach(['kg', 't', 'lb', 'st', 'US ton', 'long ton', 'earth', 'sun'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('first_unit', '{{ $unit }}', 'first_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <label for="second" class="font-s-14 text-blue">{{ $lang[6] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="second" id="second" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="second_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('second_unit')">{{ $second_unit }} ▾</label>
                        @if($dropdowns['second_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0  overflow-y-auto">
                            @foreach(['kg', 't', 'lb', 'st', 'US ton', 'long ton', 'earth', 'sun'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('second_unit', '{{ $unit }}', 'second_unit')">{{ $unit }}</p>
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
                        {{-- Keplerian Result --}}
                        <div class="w-full lg:w-[80%] overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[7] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'], 4) }} {{ $lang['9'] }}</strong></td>
                                </tr>
                            </table>
                        </div>

                        <p class="w-full lg:w-[80%] my-4"><strong>{{ $lang[8] }}</strong></p>
                        
                        <div class="w-full lg:w-[80%] overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['10'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] * 3600, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['11'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] * 60, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['12'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 24, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['13'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 168, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['14'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 730, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['15'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 8760, 4) }}</strong></td>
                                </tr>
                            </table>
                        </div>

                        {{-- Binary Result --}}
                        <div class="w-full lg:w-[80%] overflow-auto mt-8">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[16] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['sub_answer'], 4) }} {{ $lang['9'] }}</strong></td>
                                </tr>
                            </table>
                        </div>

                        <p class="w-full lg:w-[80%] my-4"><strong>{{ $lang[8] }}</strong></p>
                        
                        <div class="w-full lg:w-[80%] overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['10'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['sub_answer'] * 3600, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['11'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['sub_answer'] * 60, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['12'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['sub_answer'] / 24, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['13'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['sub_answer'] / 168, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['14'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['sub_answer'] / 730, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['15'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['sub_answer'] / 8760, 4) }}</strong></td>
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
