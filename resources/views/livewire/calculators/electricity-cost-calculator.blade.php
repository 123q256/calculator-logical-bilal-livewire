<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                {{-- Mode Switcher --}}
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type === 'simple' ? 'tagsUnit' : '' }}" 
                                 wire:click="setUnitType('simple')">
                                {{ $lang['35'] ?? 'Simple' }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type === 'advance' ? 'tagsUnit' : '' }}" 
                                 wire:click="setUnitType('advance')">
                                {{ $lang['36'] ?? 'Advance' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Simple Mode Content --}}
                @if ($unit_type === 'simple')
                    <div class="grid grid-cols-12 mt-3 gap-4" id="converter">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="first" class="font-s-14 text-blue">{{ $lang['28'] ?? 'Power' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" step="any" wire:model.live="first" id="first" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units1')">{{ $units1 }} ▾</label>
                                @if ($openDropdown === 'units1')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['mW', 'W', 'kW', 'MW', 'GW', 'BTU/h', 'hp(l)'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units1', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="second" class="font-s-14 text-blue">{{ $lang['29'] ?? 'Cost per kWh' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="second" id="second" class="input" placeholder="50" />
                                <span class="text-blue input_unit">{{ $currancy }}/kWh</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="third" class="font-s-14 text-blue">{{ $lang['30'] ?? 'Time' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" step="any" wire:model.live="third" id="third" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units3')">{{ $units3 }} ▾</label>
                                @if ($openDropdown === 'units3')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['days', 'wks', 'mons', 'yrs'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units3', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Advance Mode Content --}}
                @if ($unit_type === 'advance')
                    <div class="grid grid-cols-12 mt-3 gap-4" id="calculator">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="uc_appliance" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Appliance' }}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="uc_appliance" id="uc_appliance" class="input">
                                    <option value="2000">{{ $lang['2'] ?? 'Air conditioner' }} (2,000W)</option>
                                    <option value="9600">{{ $lang['3'] ?? 'Electric water heater' }} (9,600W)</option>
                                    <option value="1500">{{ $lang['4'] ?? 'Clothes dryer' }} (1,500W)</option>
                                    <option value="1500">{{ $lang['5'] ?? 'Space heater' }} (1,500W)</option>
                                    <option value="5000">{{ $lang['6'] ?? 'Range/Oven' }} (5,000W)</option>
                                    <option value="150">{{ $lang['7'] ?? 'Refrigerator' }} (150W)</option>
                                    <option value="100">{{ $lang['8'] ?? 'Dehumidifier' }} (100W)</option>
                                    <option value="2000">{{ $lang['9'] ?? 'Washing machine' }} (2,000W)</option>
                                    <option value="1000">{{ $lang['10'] ?? 'Microwave oven' }} (1,000W)</option>
                                    <option value="1200">{{ $lang['11'] ?? 'Dishwasher' }} (1,200W)</option>
                                    <option value="500">{{ $lang['12'] ?? 'Vacuum cleaner' }} (500W)</option>
                                    <option value="4000">{{ $lang['13'] ?? 'Clothes iron' }} (4,000W)</option>
                                    <option value="200">{{ $lang['14'] ?? 'Toaster' }} (200W)</option>
                                    <option value="50">{{ $lang['15'] ?? 'Television' }} (50W)</option>
                                    <option value="20">{{ $lang['16'] ?? 'Computer' }} (20W)</option>
                                    <option value="90">{{ $lang['17'] ?? 'Game console' }} (90W)</option>
                                    <option value="260">{{ $lang['18'] ?? 'Desktop PC' }} (260W)</option>
                                    <option value="7">{{ $lang['19'] ?? 'Modem/Router' }} (7W)</option>
                                    <option value="16">{{ $lang['20'] ?? 'Monitor' }} (16W)</option>
                                    <option value="60">{{ $lang['21'] ?? 'Light bulb' }} (60W)</option>
                                    <option value="25">{{ $lang['22'] ?? 'Laptop' }} (25W)</option>
                                    <option value="10">{{ $lang['23'] ?? 'Phone charger' }} (10W)</option>
                                    <option value="other">{{ $lang[24] ?? 'Other' }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="f_first" class="font-s-14 text-blue">{{ $lang['25'] ?? 'Watts' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="f_first" id="f_first" class="input" placeholder="50" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="f_second" class="font-s-14 text-blue">{{ $lang['26'] ?? 'Hours per day' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="f_second" id="f_second" class="input" placeholder="50" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="f_third" class="font-s-14 text-blue">{{ $lang['27'] ?? 'Price per kWh' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="f_third" id="f_third" class="input" placeholder="50" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                    </div>
                @endif
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
                        <div class="grid lg:grid-cols-2 mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[32] ?? 'Energy Usage' }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['answer'], 2) }} (kWh per month)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[33] ?? 'Estimated Cost' }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['cost'], 2) }} ({{ $currancy }} per month)</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
