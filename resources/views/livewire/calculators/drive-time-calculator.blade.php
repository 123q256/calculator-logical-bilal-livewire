<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- Distance --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="distance" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="distance" id="distance" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.distance_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[100px] py-1 overflow-y-auto" x-cloak>
                                @foreach (["km", "m", "mi", "nmi"] as $name)
                                    <p @click="$wire.set('distance_unit', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $distance_unit == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Average Speed --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="average_speed" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="average_speed" id="average_speed" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.average_speed_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[100px] py-1 overflow-y-auto" x-cloak>
                                @foreach (["km/h", "m/s", "mph"] as $name)
                                    <p @click="$wire.set('average_speed_unit', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $average_speed_unit == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Breaks --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="breaks" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="breaks" id="breaks" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.breaks_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[120px] py-1 overflow-y-auto" x-cloak>
                                @foreach (["sec", "min", "hrs", "days", "wks"] as $name)
                                    <p @click="$wire.set('breaks_unit', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $breaks_unit == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Departure Time --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="departure_time" class="label">{{ $lang['7'] }}:</label>
                        <div class="w-full py-2">
                            <input type="datetime-local" wire:model.live.debounce.500ms="departure_time" id="departure_time" class="input" />
                        </div>
                    </div>

                    {{-- Fuel Efficiency --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="fuel_e" class="label">{{ $lang['8'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="fuel_e" id="fuel_e" step="any" class="input pr-20" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.fuel_e_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[120px] py-1 overflow-y-auto" x-cloak>
                                @foreach (["L/100km", "us mpg", "uk mpg", "km/L"] as $name)
                                    <p @click="$wire.set('fuel_e_unit', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $fuel_e_unit == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Fuel Price --}}
                    <div x-data="{ open: false }" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="fuel_p" class="label">{{ $lang['9'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="fuel_p" id="fuel_p" step="any" class="input pr-24" placeholder="0.00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                    <span x-text="$wire.fuel_p_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[140px] py-1 overflow-y-auto" x-cloak>
                                @foreach ([$currancy.'/L', $currancy.'/us gal', $currancy.'/uk gal'] as $name)
                                    <p @click="$wire.set('fuel_p_unit', '{{ $name }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $fuel_p_unit == $name ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Passengers --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="passengers" class="label">{{ $lang['10'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="passengers" step="any" id="passengers" class="input" placeholder="1" />
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
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="border-b py-2">
                                                @php
                                                    $wholeHours = floor($detail['total_drive_hours']);
                                                    $remainingMinutes = round(($detail['total_drive_hours'] - $wholeHours) * 60);
                                                    if ($remainingMinutes >= 60) {
                                                        $wholeHours += 1;
                                                        $remainingMinutes = 0;
                                                    }
                                                @endphp
                                                {{ sprintf("%02d", $wholeHours) . $lang['5'] }}
                                                {{ sprintf("%02d", $remainingMinutes) . $lang['6'] }}
                                            </td>
                                        </tr>
                                        @if (isset($detail['arrival_time']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                                <td class="border-b py-2">{{ $detail['arrival_time'] }}</td>
                                        @endif
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['13'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy . number_format($detail['total_drive_cost'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['14'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy . number_format($detail['drive_cost_per_person'], 2) }}</td>
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
