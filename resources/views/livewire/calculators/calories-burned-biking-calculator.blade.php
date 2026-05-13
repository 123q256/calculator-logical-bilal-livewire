<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-x-5 gap-y-6">
                    
                    {{-- Row 1: Age | Operations --}}
                    {{-- Age --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">Age:</label>
                        <input type="number" wire:model.live="age" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="25">
                    </div>

                    {{-- Operations (Do you know your wattage?) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">Do you know your wattage?:</label>
                        <div class="relative">
                            <select wire:model.live="operations" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer appearance-none">
                                <option value="No">{{ $lang['3'] }}</option>
                                <option value="Yes">{{ $lang['2'] }}</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Row 2: Activity/Power | Weight --}}
                    {{-- Activity or Power --}}
                    <div class="col-span-12 md:col-span-6">
                        @if($operations === 'No')
                            <label class="text-[15px] font-medium text-gray-700 mb-2 block">Activity:</label>
                            <div class="relative">
                                <select wire:model.live="activity" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer appearance-none">
                                    <option value="8.5">{{ $lang['5'] }}</option>
                                    <option value="4">{{ $lang['6'] }}</option>
                                    <option value="6">{{ $lang['7'] }}</option>
                                    <option value="8">{{ $lang['8'] }}</option>
                                    <option value="10">{{ $lang['9'] }}</option>
                                    <option value="12">{{ $lang['10'] }}</option>
                                    <option value="16">{{ $lang['11'] }}</option>
                                    <option value="5">{{ $lang['12'] }}</option>
                                    <option value="5">{{ $lang['13'] }}</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        @else
                            <div x-data="{ open: false }">
                                <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['14'] }}:</label>
                                <div class="relative">
                                    <input type="number" wire:model.live="first" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-24" placeholder="13">
                                    <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $units1 }} ▾</label>
                                    <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('units1', 'mW')" @click="open = false">megawatt (mW)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('units1', 'W')" @click="open = false">watt (W)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('units1', 'kW')" @click="open = false">kilowatt (kW)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('units1', 'BTU/h')" @click="open = false">british thermal units per hour (BTU/h)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('units1', 'hp(l)')" @click="open = false">horsepower hp(l)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('units1', 'kcal/min')" @click="open = false">kilocalories per minute (kcal/min)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('units1', 'kcal/h')" @click="open = false">kilocalories per hour (kcal/h)</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Weight (Your Weight) --}}
                    <div class="col-span-12 md:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">Your Weight:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="second" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="160">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $units2 }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('units2', 'lbs')" @click="open = false">pounds (lbs)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('units2', 'kg')" @click="open = false">kilograms (kg)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('units2', 'stone')" @click="open = false">stone</p>
                            </div>
                        </div>
                    </div>

                    {{-- Row 3: Height | Gender --}}
                    {{-- Height --}}
                    <div class="col-span-12 md:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">Height:</label>
                        <div class="flex items-center gap-3">
                            @if($unit_ft_in === 'ft/in')
                                <div class="w-[80px]">
                                    <input type="number" wire:model.live="height_ft" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="ft">
                                </div>
                                <div class="flex-1 relative">
                                    <input type="number" wire:model.live="height_in" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="in">
                                    <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $unit_ft_in }} ▾</label>
                                    <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'ft/in')" @click="open = false">feet / inches (ft/in)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'ft')" @click="open = false">feet (ft)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'in')" @click="open = false">inch (in)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'cm')" @click="open = false">centimeters (cm)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'm')" @click="open = false">meters (m)</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex-1 relative">
                                    <input type="number" wire:model.live="height_cm" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="{{ $unit_ft_in }}">
                                    <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $unit_ft_in }} ▾</label>
                                    <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'ft/in')" @click="open = false">feet / inches (ft/in)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'ft')" @click="open = false">feet (ft)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'in')" @click="open = false">inch (in)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'cm')" @click="open = false">centimeters (cm)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_ft_in', 'm')" @click="open = false">meters (m)</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">Gender:</label>
                        <div class="relative">
                            <select wire:model.live="gender" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer appearance-none">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Row 4: MET | Duration --}}
                    {{-- MET --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">MET:</label>
                        <input type="number" wire:model.live="met" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="4">
                    </div>

                    {{-- Duration (Time of Activity) --}}
                    <div class="col-span-12 md:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">Time of Activity:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="third" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-20" placeholder="00">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $units3 }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('units3', 'sec')" @click="open = false">seconds (sec)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('units3', 'min')" @click="open = false">minutes (min)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('units3', 'hrs')" @click="open = false">hours (hrs)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('units3', 'days')" @click="open = false">days</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex flex-wrap gap-x-2 gap-y-1 text-[13px] text-gray-500 pt-2 border-t border-gray-100 mt-6">
                    <span class="font-medium text-gray-700">{{ $lang[19] }}:</span>
                    <a href="{{ url('weightloss-calculator') }}/" class="text-blue-500 hover:underline">{{ $lang[20] }}</a>,
                    <a href="{{ url('calorie-deficit-calculator') }}/" class="text-blue-500 hover:underline">{{ $lang[21] }}</a>,
                    <a href="{{ url('bmr-calculator') }}/" class="text-blue-500 hover:underline">{{ $lang[22] }}</a>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <strong>{{ $lang[17] }} = <span class="text-[#119154] text-[28px]">{{ round($detail['calories'], 2) }}</span> kcal</strong>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <strong>{{ $lang[18] }} = <span class="text-[#119154] text-[28px]">{{ round($detail['w_loss'], 2) }}</span> kg</strong>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <strong>BMR = <span class="text-[#119154] text-[28px]">{{ $detail['bmr_ans'] }}</span> kcal/day</strong>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <strong>{{ $lang[28] }} = <span class="text-[#119154] text-[28px]">{{ round($detail['exercise'], 2) }}</span> Mets</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
