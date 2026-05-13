<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                    {{-- Height Input --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['1'] }} @if($unit_ft_in !== 'ft/in') ({{ $unit_ft_in }}) @endif:</label>
                        <div class="relative flex gap-2">
                            @if($unit_ft_in === 'ft/in')
                                <input type="number" wire:model.live="height_ft" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-1/2 text-xs h-10 px-3" placeholder="ft">
                                <div class="relative w-1/2">
                                    <input type="number" wire:model.live="height_in" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-12" placeholder="in">
                                    <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20 font-medium text-xs" @click="open = !open">{{ $unit_ft_in }} ▾</label>
                                </div>
                            @else
                                <div class="relative w-full">
                                    <input type="number" wire:model.live="height_cm" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-12" placeholder="{{ $unit_ft_in }}">
                                    <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20 font-medium text-xs" @click="open = !open">{{ $unit_ft_in }} ▾</label>
                                </div>
                            @endif

                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-[45px] overflow-hidden">
                                @foreach (['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('unit_ft_in', '{{ $u }}')" @click="open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Weight Input --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['2'] !!}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="weight" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-12" placeholder="150">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20 font-medium text-xs" @click="open = !open">{{ $w_unit }} ▾</label>
                            
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-[45px] overflow-hidden">
                                @foreach (['lbs', 'oz', 'kg', 'stone'] as $u)
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('w_unit', '{{ $u }}')" @click="open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Pregnancy Week --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['3'] !!}:</label>
                        <input type="number" wire:model.live="week" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="25">
                    </div>

                    {{-- Single/Twins --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['4'] !!}:</label>
                        <div class="relative">
                            <select wire:model.live="activity" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer appearance-none">
                                <option value="0">{{ $lang['5'] }}</option>
                                <option value="1">{{ $lang['6'] }}</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 mt-3">
                            <div class="w-full">
                                <p><strong>BMI</strong></p>
                                <p class="text-[32px]"><strong class="text-green-700">{{ $detail['BMI'] }}</strong></p>
                                <p>
                                    <strong>{{ $lang[7] }}</strong>
                                    <strong class="text-green-700 text-[20px] ms-2">{{ $detail['you_are'] }}</strong>
                                </p>
                                <div class="flex flex-wrap justify-between mb-4">
                                    <div class="px-3 px-md-0 mt-3">
                                        <p><strong class="text-blue-700">{{ $lang[8] }}</strong></p>
                                        <p>{{ $detail['min_weight_ans'] }} kg</p>
                                    </div>
                                    <div class="border-r-2 hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3 px-md-0 mt-3">
                                        <p><strong class="text-blue-700">{{ $lang[9] }}</strong></p>
                                        <p>{{ $detail['max_weight_ans'] }} kg</p>
                                    </div>
                                    <div class="border-r-2 hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3 px-md-0 mt-3">
                                        <p><strong class="text-blue-700">{{ $lang[10] }}</strong></p>
                                        <p>{{ $detail['min_weight_gain'] }} kg</p>
                                    </div>
                                    <div class="border-r-2 hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3 px-md-0 mt-3">
                                        <p><strong class="text-blue-700">{{ $lang[11] }}</strong></p>
                                        <p>{{ $detail['max_weight_gain'] }} kg</p>
                                    </div>
                                </div>
                                <div class="w-full overflow-auto">
                                    <table class="w-full md:w-[80%] lg:w-[80%]" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-blue-700 text-start border-b p-2">{{ $lang[3] }}</th>
                                                <th class="text-blue-700 text-start border-b p-2">{{ $lang[2] }} (Gain)</th>
                                                <th class="text-blue-700 text-start border-b p-2">{{ $lang[2] }} (Total)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($i=0; $i < 40; $i++)
                                                <tr class="{{ ($i+1 == $week) ? 'bg-blue-50 font-bold' : '' }}">
                                                    <td class="{{ ($i == 39) ? '' : 'border-b' }} p-2">{{ ($i+1) }}</td>
                                                    <td class="{{ ($i == 39) ? '' : 'border-b' }} p-2">{{ $detail['gain'][$i] }}</td>
                                                    <td class="{{ ($i == 39) ? '' : 'border-b' }} p-2">{{ $detail['all'][$i] }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
