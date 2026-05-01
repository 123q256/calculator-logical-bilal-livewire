<div>
   
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="mx-auto mt-2 w-full">
                    <div class="col-lg-3 font-s-14 d-lg-block">{{ isset($lang['to_calc']) ? $lang['to_calc'] : "To Calculate" }}:</div>
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tagsUnit">
                                <strong>{{ $lang['1'] }}</strong>
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white">
                                <a href="{{ url('watts-to-amps-calculator') }}/" class="cursor-pointer text-decoration-none">
                                    <strong>{{ isset($lang['2']) ? $lang['2'] : 'Watts to Amps' }}</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2">
                    <div class="col-span-12 lg:col-span-1 px-2">
                        <label for="current_type" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="current_type" id="current_type" class="input">
                                <option value="DC">{{ $lang[4] }} (DC)</option>
                                <option value="AC">{{ $lang[5] }} (AC) - {{ $lang[6] }}</option>
                                <option value="ACT">{{ $lang[7] }} (AC) - {{ $lang[8] }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-1 px-2">
                        <label for="current" class="font-s-14 text-blue">{{ $lang[9] }} (amps):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="current" id="current" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label wire:click="toggleDropdown('current_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $current_unit }} ▾</label>
                            @if($openDropdown == 'current_unit')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('current_unit', 'mA')">mA</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('current_unit', 'A')">A</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('current_unit', 'kA')">kA</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($current_type == 'ACT')
                        <div class="col-span-12 lg:col-span-1 px-2">
                            <label for="voltage_type" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model="voltage_type" id="voltage_type" class="input">
                                    <option value="ltl">{{ $lang[11] }}</option>
                                    <option value="ltn">{{ $lang[12] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12 lg:col-span-1 px-2">
                        <label for="voltage" class="font-s-14 text-blue">{{ $lang[13] }} ({{ $lang[14] }}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="voltage" id="voltage" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label wire:click="toggleDropdown('voltage_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $voltage_unit }} ▾</label>
                            @if($openDropdown == 'voltage_unit')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('voltage_unit', 'mV')">mV</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('voltage_unit', 'V')">V</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('voltage_unit', 'kV')">kV</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($current_type != 'DC')
                        <div class="col-span-12 lg:col-span-1 px-2">
                            <label for="power" class="font-s-14 text-blue">{{ $lang[15] }} (≤1):</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" max="1" wire:model="power" id="power" class="input" />
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2 overflow-auto">
                                    <table class="w-full font-s-18">
                                        <thead>
                                            <tr class="bg-[#2845F5]">
                                                <th class="p-2 border-b text-left text-white">{{ $lang['16'] }}</th>
                                                <th class="p-2 border-b text-left text-white">{{ $lang['17'] }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-2 border-b p-2">{{ $lang['16'] }} ({{ $lang['17'] }})</td>
                                                <td class="py-2 border-b p-2"><strong class="text-blue">{{ round($detail['power_ans'], 2) }} W</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b p-2">{{ $lang['16'] }} ({{ $lang['18'] }})</td>
                                                <td class="py-2 border-b p-2"><strong class="text-blue">{{ ($detail['power_ans'] / 1000) }} kW</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b p-2">{{ $lang['16'] }} ({{ $lang['19'] }})</td>
                                                <td class="py-2 border-b p-2"><strong class="text-blue">{{ number_format($detail['power_ans'] * 1000) }} mW</strong></td>
                                            </tr>
                                        </tbody>
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
