<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Battery Capacity --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="battery_capacity" class="label py-2">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="battery_capacity" id="battery_capacity" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.battery_units"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[120px] py-1 overflow-y-auto scrollbar-thin" x-cloak>
                                @foreach (["Ah", "mAh"] as $name)
                                    <p @click="$wire.set('battery_units', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $battery_units == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Discharge Safety --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="discharge_safety" class="label py-2">({{ $lang['2'] }}):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live.debounce.500ms="discharge_safety" id="discharge_safety" class="input pr-10" placeholder="00" />
                            <span class="absolute right-4 top-5 text-blue font-bold">%</span>
                        </div>
                    </div>

                    {{-- Device Consumption 1 --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="device_con1" class="label py-2 cat">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="device_con1" id="device_con1" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.device_con1_units"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[120px] py-1 overflow-y-auto scrollbar-thin" x-cloak>
                                @foreach (["A", "mA", "µA"] as $name)
                                    <p @click="$wire.set('device_con1_units', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $device_con1_units == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Awake Time --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="awake_time" class="label py-2">({{ $lang['4'] }}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="awake_time" id="awake_time" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.awake_time_units"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[120px] py-1 overflow-y-auto scrollbar-thin" x-cloak>
                                @foreach (["sec", "min", "hrs", "days", "wks", "mos", "yrs"] as $name)
                                    <p @click="$wire.set('awake_time_units', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $awake_time_units == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <p class="col-span-12 text-blue-800 font-black uppercase tracking-wider text-sm border-b border-blue-100 pb-2">{{ $lang['5'] }}</p>

                    {{-- Device Consumption 2 (Sleep) --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="device_con2" class="label py-2 cat">{{ $lang['6'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="device_con2" id="device_con2" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.device_con2_units"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[120px] py-1 overflow-y-auto scrollbar-thin" x-cloak>
                                @foreach (["A", "mA", "µA"] as $name)
                                    <p @click="$wire.set('device_con2_units', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $device_con2_units == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Sleep Time --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sleep_time" class="label py-2">({{ $lang['7'] }}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="sleep_time" id="sleep_time" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.sleep_time_units"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[120px] py-1 overflow-y-auto scrollbar-thin" x-cloak>
                                @foreach (["sec", "min", "hrs", "days", "wks", "mos", "yrs"] as $name)
                                    <p @click="$wire.set('sleep_time_units', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $sleep_time_units == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2" width="60%">{{ $lang[6] }} :</td>
                                            <td class="border-b py-2">{{ $detail['Average_consumption'] }} mA</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang[7] }} :</td>
                                            <td class="border-b py-2">{{ round($detail['Battery_life'], 1) }} hrs</td>
                                        </tr>
                                    </table>
                                    <p class="py-2"><strong>{{ $lang['8'] }}</strong></p>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b" width="60%">{{ $lang['9'] }} :</td>
                                            <td class="border-b">{{ round($detail['Average_consumption'], 2) * 0.001 }}</td>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td class="border-b">{{ $lang['10'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['Average_consumption'], 2) * 1000 }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="pt-2"><strong>{{ $lang['11'] }}</strong></p>
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b ">{{ $lang['12'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 3600 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b ">{{ $lang['13'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 60 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b ">{{ $lang['14'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 0.04167 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b ">{{ $lang['15'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 0.005952 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b ">{{ $lang['16'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 0.001369 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b ">{{ $lang['17'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 0.00011408 }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="font-s-18">
                                    <p class="mt-4 text-[20px]"><strong>Solution</strong></p>
                                    
                                    {{-- Battery Life Formula --}}
                                    <div class="overflow-x-auto whitespace-nowrap scrollbar-thin pb-2 my-4">
                                        <div class="flex items-center space-x-2 min-w-max">
                                            <span>Battery life = </span>
                                            <div class="flex flex-col items-center">
                                                <span class="border-b border-gray-800 px-4">Capacity</span>
                                                <span>Consumption</span>
                                            </div>
                                            <span><i>x </i> (1 - Discharge safety)</span>
                                        </div>
                                    </div>

                                    <div class="overflow-x-auto whitespace-nowrap scrollbar-thin pb-2 my-4">
                                        <div class="flex items-center space-x-2 min-w-max">
                                            <span>Battery life = </span>
                                            <div class="flex flex-col items-center">
                                                <span class="border-b border-gray-800 px-4">{{ $battery_capacity }}</span>
                                                <span>{{ round($detail['Average_consumption'], 2) }}</span>
                                            </div>
                                            <span><i>x </i> (1 - {{ $discharge_safety }}%)</span>
                                        </div>
                                    </div>

                                    <div class="my-4">
                                        Battery life = {{ round($detail['Battery_life'], 2) }}
                                    </div>

                                    <p class="mt-6 text-[18px]"><strong>Formula to calculate Average consumption</strong></p>
                                    
                                    {{-- Average Consumption Formula --}}
                                    <div class="overflow-x-auto whitespace-nowrap scrollbar-thin pb-2 my-4">
                                        <div class="flex items-center space-x-2 min-w-max">
                                            <span>Average consumption = </span>
                                            <div class="flex flex-col items-center">
                                                <span class="border-b border-gray-800 px-4">( Consumption1 x Time1 + Consumption2 x Time2)</span>
                                                <span>(Time1 + Time2)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="overflow-x-auto whitespace-nowrap scrollbar-thin pb-2 my-4">
                                        <div class="flex items-center space-x-2 min-w-max">
                                            <span>Average consumption = </span>
                                            <div class="flex flex-col items-center">
                                                <span class="border-b border-gray-800 px-4">( {{ $device_con1 . ' x ' . $awake_time . ' + ' . $device_con2 . ' x ' . $sleep_time }})</span>
                                                <span>({{ $awake_time . ' + ' . $sleep_time }})</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-4">
                                        Average consumption = {{ round($detail['Average_consumption'], 2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
