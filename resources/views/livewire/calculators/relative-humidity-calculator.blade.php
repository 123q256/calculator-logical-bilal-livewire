<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4">
                {{-- Temperature --}}
                <div class="col-span-12">
                    <label for="temperature" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="temperature" id="temperature" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="temperature_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('temperature_unit')">{{ $temperature_unit }} ▾</label>
                        @if($dropdowns['temperature_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['°C', '°F', 'K'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('temperature_unit', '{{ $unit }}', 'temperature_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Dew Point --}}
                <div class="col-span-12">
                    <label for="point" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="point" id="point" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="point_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('point_unit')">{{ $point_unit }} ▾</label>
                        @if($dropdowns['point_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['°C', '°F', 'K'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('point_unit', '{{ $unit }}', 'point_unit')">{{ $unit }}</p>
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
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang['3'] }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded d-inline-block my-3">
                                    <strong class="text-white">{{ round($detail['answer'], 2) }}%</strong>
                                </p>
                            </div>
                        </div>
                        <div class="w-full mt-3 space-y-2 text-center lg:text-left">
                            <p class="text-[18px]"><strong>{{ $lang['4'] ?? 'Calculation Details' }}</strong></p>
                            <p>Temperature: {{ $temperature }}{{ $temperature_unit }}</p>
                            <p>Dew Point: {{ $point }}{{ $point_unit }}</p>
                            <p class="mt-2 italic">Using Tetens equation for saturation vapor pressure.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
