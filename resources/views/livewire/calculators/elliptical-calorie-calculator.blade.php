<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium mb-2 block">{{ $lang['1'] }}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="weight" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-20" placeholder="75">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $weight_unit }} ▾</label>
                            
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border rounded-md w-auto mt-1 right-0 top-[45px] overflow-hidden">
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('weight_unit', 'kg')" @click="open = false">kilograms (kg)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('weight_unit', 'lbs')" @click="open = false">pounds (lbs)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('weight_unit', 'stone')" @click="open = false">stone</p>
                            </div>
                        </div>
                    </div>

                    {{-- Time/Duration --}}
                    @if($unit_hrs_min === 'hrs/min')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="text-[15px] font-medium mb-2 block">{{ $lang['2'] }}:</label>
                            <div class="flex gap-2">
                                <div class="relative w-1/2">
                                    <input type="number" wire:model.live="hour" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="0">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2  text-[10px] font-bold">hrs</span>
                                </div>
                                <div class="relative w-1/2" x-data="{ open: false }">
                                    <input type="number" wire:model.live="min" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-20" placeholder="30">
                                    <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">min ▾</label>
                                    
                                    <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-[45px] overflow-hidden">
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_hrs_min', 'sec')" @click="open = false">seconds (sec)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_hrs_min', 'min')" @click="open = false">minutes (min)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_hrs_min', 'hrs')" @click="open = false">hours (hrs)</p>
                                        <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_hrs_min', 'hrs/min')" @click="open = false">hours / minute (hrs/min)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                            <label class="text-[15px] font-medium mb-2 block">{{ $lang['2'] }}:</label>
                            <div class="relative">
                                <input type="number" wire:model.live="time" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-24" placeholder="30">
                                <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $unit_hrs_min }} ▾</label>
                                
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-[45px] overflow-hidden">
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_hrs_min', 'sec')" @click="open = false">seconds (sec)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_hrs_min', 'min')" @click="open = false">minutes (min)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_hrs_min', 'hrs')" @click="open = false">hours (hrs)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_hrs_min', 'hrs/min')" @click="open = false">hours / minute (hrs/min)</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Effort Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium mb-2 block">{!! $lang['3'] !!}:</label>
                        <select wire:model.live="effort_unit" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer">
                            <option value="Light (MET = 4.6)">Light (MET = 4.6)</option>
                            <option value="Moderate (MET = 4.9)">Moderate (MET = 4.9)</option>
                            <option value="Vigorous (MET = 5.7)">Vigorous (MET = 5.7)</option>
                            <option value="Custom (enter MET value)">Custom (enter MET value)</option>
                        </select>
                    </div>

                    {{-- Custom MET Input --}}
                    @if($effort_unit === 'Custom (enter MET value)')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="text-[15px] font-medium mb-2 block">{!! $lang['4'] !!}:</label>
                            <div class="relative">
                                <input type="number" wire:model.live="effort" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="4.9">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2">MET</span>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[80%] lg:w-[80%] flex flex-col md:flex-row justify-between mb-4">
                                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 w-full">
                                        <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                            <p><strong>{{ $lang['5'] }}</strong></p>
                                            <p>
                                                <strong class="text-green-700 text-[32px]">{{ round($detail['answer']) }}</strong>
                                                <span class="text-blue-700">kcal</span>
                                            </p>
                                        </div>
                                        <div class="col-span-1 border-r-2 me-3 hidden lg:block md:block">&nbsp;</div>
                                        <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                            <p><strong>{{ $lang['6'] }}</strong></p>
                                            <p>
                                                <strong class="text-green-700 text-[32px]">{{ round($detail['sub_answer']) }}</strong>
                                                <span class="text-blue-700">kcal</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <p><strong>{{ $lang['7'] }}</strong></p>
                                    <p>{{ $lang['8'] }}.</p>
                                    <p>{{ $lang['9'] }} = {{ $lang['12'] }} (in sec) * {{ $lang['3'] }} * 3.5 * {{ $lang['1'] }} (in kg) / (200 * 60)</p>
                                    <p>{{ $lang['9'] }} = {{ $detail['time'] }} * {{ $effort }} * 3.5 * {{ round($detail['weight'], 2) }} / (200 * 60)</p>
                                    <p>{{ $lang['9'] }} = <strong class="text-green-700">{{ round($detail['answer']) }}kcal</strong></p>
                                    <p class="mt-4"><strong>{{ $lang['10'] }}</strong></p>
                                    <p>{{ $lang['11'] }} = 60 * {{ $lang['3'] }} * 3.5 * {{ $lang['1'] }} (in kg) / 200</p>
                                    <p>{{ $lang['11'] }} = 60 * {{ $effort }} * 3.5 * {{ round($detail['weight'], 2) }} / 200</p>
                                    <p>{{ $lang['11'] }} = <strong class="text-green-700">{{ round($detail['sub_answer']) }}kcal</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>

