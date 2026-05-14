<div>
    <style>
        .text-green { color: #10B981; }
        .bg-light-blue { background-color: #F0F7FF; }
        .radius-10 { border-radius: 10px; }
        .font-s-20 { font-size: 20px; }
        .font-s-32 { font-size: 32px; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

                    <!-- Methods Selection -->
                    <div class="col-span-12">
                        <label class="label">{!! $lang['1'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="methods" class="input">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                                <option value="3">{{ $lang['4'] }}</option>
                                <option value="4">{{ $lang['5'] }}</option>
                                <option value="5">{{ $lang['6'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sex Selection (Method 2, 3, 5) -->
                    @if(in_array($methods, ['2', '3', '5']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['7'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="operations1" class="input">
                                <option value="1">{{ $lang['8'] }}</option>
                                <option value="0">{{ $lang['9'] }}</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    <!-- Age Input (Method 1, 2) -->
                    @if(in_array($methods, ['1', '2']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['10'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="first" class="input" placeholder="00">
                            <span class="input_unit">{{ $lang['11'] }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Weight Input (Method 2, 5) -->
                    @if(in_array($methods, ['2', '5']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['12'] !!}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="second" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" 
                                   @click="open = !open">
                                {{ $units2 }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('units2', 'kg')">kilograms (kg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('units2', 'lbs')">pounds (lbs)</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Time/Seconds Input (Method 2, 4, 5) -->
                    @if(in_array($methods, ['2', '4', '5']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">
                            @if($methods == '2') {!! $lang['13'] !!}:
                            @elseif($methods == '4') {!! $lang['20'] !!}:
                            @elseif($methods == '5') {!! $lang['21'] !!}:
                            @endif
                        </label>
                        <div class="relative w-full mt-2" x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="third" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" 
                                   @click="open = !open">
                                {{ $units3 }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('units3', 'sec')">seconds (sec)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('units3', 'min')">minutes (min)</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Heart Rate / Beats Input (Method 1, 2, 3) -->
                    @if(in_array($methods, ['1', '2', '3']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">
                            @if($methods == '1') {{ $lang[2] }}:
                            @else {{ $lang[17] }}:
                            @endif
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="four" class="input" placeholder="00">
                            <span class="input_unit">
                                {{ $lang[18] }} / 
                                @if($methods == '1') 20 sec
                                @elseif($methods == '2') 10 sec
                                @elseif($methods == '3') 15 sec
                                @endif
                            </span>
                        </div>
                    </div>
                    @endif

                    <!-- Specific Sex Selection (Method 5) -->
                    @if($methods == '5')
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['14'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="operations2" class="input">
                                <option value="2">{{ $lang['15'] }}</option>
                                <option value="1">{{ $lang['16'] }}</option>
                            </select>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            <div class="mt-8 flex justify-center">
                @if ($type == 'calculator')
                    @include('inc.button')
                @endif
                @if ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>
    </form>

    <!-- Result Section -->
    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full max-w-2xl p-5 mt-3">
                        <div class="text-center">
                            <p class="font-bold text-gray-600 uppercase tracking-wider">{{ $lang[19] }}</p>
                            <p class="mt-4 font-s-32"><strong class="text-green">{{ round($detail['answer'], 2) }}</strong> <span class="text-green font-s-20">ml/kg/min</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
