<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Dry Bulb Temp --}}
                    <div class="space-y-2">
                        <label for="temp" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
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

                    {{-- Humidity --}}
                    <div class="space-y-2">
                        <label for="hum" class="font-s-14 text-blue">{{ $lang['2'] }}(%):</label>
                        <div class="w-full relative py-2">
                            <input type="text" inputmode="decimal" wire:model.live="hum" id="hum" class="input" placeholder="50" />
                            <span class="input_unit">%</span>
                        </div>
                    </div>

                    {{-- Black Globe Temp (Optional) --}}
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <label for="temp1" class="text-sm text-blue">{{ $lang['3'] }}</label>
                            <span class="text-blue">({{ $lang['4'] }})</span>
                        </div>
                        <div class="relative w-full">
                            <input type="text" inputmode="decimal" wire:model.live="temp1" id="temp1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('temp1_unit')">
                                {{ $temp1_unit }} ▾
                            </label>
                            @if ($openDropdown === 'temp1_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('temp1_unit', '°C')">°C</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('temp1_unit', '°F')">°F</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('temp1_unit', 'K')">K</p>
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue rounded-lg mt-3 p-4">
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b">
                                            <strong>{{ $lang[5] }}</strong>
                                        </td>
                                        <td class="py-2 border-b text-right">
                                            <div class="inline-flex items-center gap-2">
                                                <span class="text-xl font-bold">{{ number_format($this->getConvertedValue($detail['ans'], $ans_unit), 4) }}</span>
                                                <select wire:model.live="ans_unit" class="onetw border border-gray-300 rounded p-1 text-sm outline-none">
                                                    <option value="°C">°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K">K</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    @if (isset($detail['outdoor']))
                                        <tr>
                                            <td class="py-2 border-b">
                                                <strong>{{ $lang[11] }} ({{ $lang[12] }})</strong>
                                            </td>
                                            <td class="py-2 border-b text-right">
                                                <div class="inline-flex items-center gap-2">
                                                    <span class="text-xl font-bold">{{ number_format($this->getConvertedValue($detail['outdoor'], $outdoor_unit), 4) }}</span>
                                                    <select wire:model.live="outdoor_unit" class="onetw border border-gray-300 rounded p-1 text-sm outline-none">
                                                        <option value="°C">°C</option>
                                                        <option value="°F">°F</option>
                                                        <option value="K">K</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="py-2 border-b">
                                            <strong>{{ $lang[11] }} ({{ $lang[13] }})</strong>
                                        </td>
                                        <td class="py-2 border-b text-right">
                                            <div class="inline-flex items-center gap-2">
                                                <span class="text-xl font-bold">{{ number_format($this->getConvertedValue($detail['indoor'], $indoor_unit), 4) }}</span>
                                                <select wire:model.live="indoor_unit" class="onetw border border-gray-300 rounded p-1 text-sm outline-none">
                                                    <option value="°C">°C</option>
                                                    <option value="°F">°F</option>
                                                    <option value="K">K</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <div class="mt-6 p-4 bg-white rounded-lg border-l-4 border-[#2845F5]">
                                    @if ($detail['ans'] < 32)
                                        <p class="text-lg">{{ $lang[6] }}.</p>
                                    @elseif($detail['ans'] >= 32 && $detail['ans'] < 35)
                                        <p class="text-lg">{{ $lang[7] }} 32 °C (90 °F) {{ $lang[8] }}.</p>
                                    @elseif($detail['ans'] >= 35)
                                        <p class="text-lg font-bold text-red-600">{{ $lang[9] }} 35 °C (95 °F) {{ $lang[10] }}.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
