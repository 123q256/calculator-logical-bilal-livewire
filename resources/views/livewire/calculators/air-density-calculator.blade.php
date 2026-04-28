<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Pressure --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="first" class="label">{{ $lang['1'] ?? 'Pressure' }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" step="any" wire:model.live="first" id="first" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit1')">{{ $unit1 }} ▾</label>
                            @if ($openDropdown === 'unit1')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                    @foreach (['Pa', 'mb', 'bar', 'psi', 'atm', 'torr', 'hPa', 'kPa', 'inHg', 'mmHg'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit1', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Temperature --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="second" class="label">{{ $lang['2'] ?? 'Temperature' }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" step="any" wire:model.live="second" id="second" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit2')">{{ $unit2 }} ▾</label>
                            @if ($openDropdown === 'unit2')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['°C', '°F', 'K'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit2', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Calculation Type --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="operations1" class="label">{{ $lang['3'] ?? 'Air Type' }}:</label>
                        <div class="w-full py-2 relative">
                            <select class="input" wire:model.live="operations1" id="operations1">
                                <option value="2">{{ $lang['5'] ?? 'Humid Air' }}</option>
                                <option value="1">{{ $lang['4'] ?? 'Dry Air' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Relative Humidity (Visible only for Humid Air) --}}
                    @if ($operations1 == '2')
                        <div class="col-span-12 md:col-span-6 on_change">
                            <label for="third" class="label">{{ $lang['6'] ?? 'Relative Humidity' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="third" id="third" class="input" placeholder="413" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
        </div>
    </form>

    <hr>

    @isset($detail)
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 mt-5">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        @if ($detail['operations1'] == "1")
                            <div class="col-12 text-center text-[20px]">
                                <p>{{ $lang[4] ?? 'Dry Air Density' }}</p>
                                <p class="my-3">
                                    <strong class="bg-sky px-3 py-2 text-[32px] radius-10 text-blue">
                                        {{ round($detail['air_density'], 5) }}
                                    </strong> (kg/m³)
                                </p>
                            </div>
                        @elseif ($detail['operations1'] == "2")
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[8] ?? 'Dew Point' }}</strong></td>
                                        <td class="py-2 border-b">{{ round($detail['dp'], 2) }} (°C)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[9] ?? 'Saturation Pressure' }}</strong></td>
                                        <td class="py-2 border-b">{{ round($detail['pd']) }} (Pa)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[10] ?? 'Vapor Pressure' }}</strong></td>
                                        <td class="py-2 border-b">{{ round($detail['pv']) }} (Pa)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] ?? 'Air Density' }}</strong></td>
                                        <td class="py-2 border-b">{{ round($detail['air_density'], 5) }} (kg/m³)</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
