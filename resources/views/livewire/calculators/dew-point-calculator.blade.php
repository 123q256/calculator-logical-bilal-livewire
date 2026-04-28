<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            @if ($errors->any())
                <div class="text-red-500 text-sm font-semibold w-full">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $validation_error)
                            <li>{{ $validation_error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Solve For --}}
                    <div class="space-y-2">
                        <label for="to_cal" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="to_cal" class="input" id="to_cal">
                            <option value="1">{{ $lang['2'] }}</option>
                            <option value="2">{{ $lang['3'] }}</option>
                            <option value="3">{{ $lang['4'] }}</option>
                        </select>
                    </div>

                    {{-- Temperature Input --}}
                    @if ($to_cal == '1' || $to_cal == '2')
                        <div class="space-y-2">
                            <label for="temp" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                            <div class="relative w-full">
                                <input type="text" inputmode="decimal" wire:model.live="temp" id="temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('temp_unit')">
                                    {{ $temp_unit }} ▾
                                </label>
                                @if ($openDropdown === 'temp_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('temp_unit', '°C')">°C</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('temp_unit', '°F')">°F</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('temp_unit', 'K')">K</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Humidity Input --}}
                    @if ($to_cal == '1' || $to_cal == '3')
                        <div class="space-y-2">
                            <label for="hum" class="font-s-14 text-blue">{{ $lang['3'] }}(%):</label>
                            <div class="w-full relative py-2">
                                <input type="text" inputmode="decimal" wire:model.live="hum" id="hum" class="input" placeholder="50" />
                                <span class="input_unit">%</span>
                            </div>
                        </div>
                    @endif

                    {{-- Dew Point Input --}}
                    @if ($to_cal == '2' || $to_cal == '3')
                        <div class="space-y-2">
                            <label for="dew" class="font-s-14 text-blue">Dew Point</label>
                            <div class="relative w-full">
                                <input type="text" inputmode="decimal" wire:model.live="dew" id="dew" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('dew_unit')">
                                    {{ $dew_unit }} ▾
                                </label>
                                @if ($openDropdown === 'dew_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('dew_unit', '°C')">°C</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('dew_unit', '°F')">°F</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('dew_unit', 'K')">K</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg ">
                        <div class="w-full bg-light-blue rounded-lg mt-3 p-4 overflow-auto">
                            @if ($to_cal == '1')
                                <div class="w-full lg:[80%] md:[80%] text-lg">
                                    <p class="mt-2 py-2 border-b">{{ $lang['5'] }}</p>
                                    <p class="mt-2 py-2 border-b"><strong>{{ number_format($detail['dew'], 4) }} °C</strong></p>
                                    <p class="mt-2 py-2 border-b">{{ number_format($detail['dew'] * (9 / 5) + 32, 4) }} °F</p>
                                    <p class="mt-2 py-2 border-b">{{ number_format($detail['dew'] + 273.15, 4) }} K</p>
                                </div>
                            @elseif ($to_cal == '2')
                                <div class="w-full text-center text-lg">
                                    <p>{{ $lang[3] }}</p>
                                    <p class="my-3">
                                        <strong class="px-5 py-3 text-2xl rounded-lg shadow-lg bg-[#2845F5] text-white inline-block">{{ number_format($detail['hum'], 2) }} %</strong>
                                    </p>
                                </div>
                            @elseif ($to_cal == '3')
                                <div class="w-full lg:[80%] md:[80%] text-lg">
                                    <p class="mt-2 py-2 border-b">{{ $lang['6'] }}</p>
                                    <p class="mt-2 py-2 border-b"><strong>{{ number_format($detail['temp'], 4) }} °C</strong></p>
                                    <p class="mt-2 py-2 border-b">{{ number_format($detail['temp'] * (9 / 5) + 32, 4) }} °F</p>
                                    <p class="mt-2 py-2 border-b">{{ number_format($detail['temp'] + 273.15, 4) }} K</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
