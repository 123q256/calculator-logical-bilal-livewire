<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Mode Selector --}}
                    <div class="col-span-12 mb-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <input type="radio" wire:model.live="calc_type" id="simple" value="first" class="w-4 h-4 text-blue-600">
                            <label for="simple" class="font-s-14 text-blue ms-2 cursor-pointer">{{ $lang['14'] ?? 'Simple' }}:</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" wire:model.live="calc_type" id="advance" value="second" class="w-4 h-4 text-blue-600">
                            <label for="advance" class="font-s-14 text-blue ms-2 cursor-pointer">{{ $lang['15'] ?? 'Advanced' }}:</label>
                        </div>
                    </div>

                    @if ($calc_type == 'first')
                        {{-- Simple Inputs --}}
                        <div class="col-span-12 md:col-span-6">
                            <label for="v" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="v" id="v" step="any" class="input pr-16" placeholder="00">
                                <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 text-gray-500">{{ $v_unit }} ▾</span>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-24">
                                    @foreach(['mm³', 'cm³', 'dm³', 'ml', 'cl', 'l'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('v_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label for="t" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="t" id="t" step="any" class="input pr-20" placeholder="00">
                                <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 text-gray-500">{{ $t_unit }} ▾</span>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-32">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('t_unit', 'sec'); open = false">seconds (sec)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('t_unit', 'min'); open = false">minutes (min)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('t_unit', 'hrs'); open = false">hours (hrs)</p>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Advanced Inputs --}}
                        <div class="col-span-12 md:col-span-6">
                            <label for="d" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="d" id="d" step="any" class="input pr-24" placeholder="00">
                                <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 text-gray-500">{{ $d_unit }} ▾</span>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-40">
                                    @foreach(['mg/kg/min', 'mg/oz/min', 'mg/lb/min', 'mg/stone/min'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('d_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label for="bw" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="bw" id="bw" step="any" class="input pr-16" placeholder="00">
                                <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 text-gray-500">{{ $bw_unit }} ▾</span>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-32">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('bw_unit', 'kg'); open = false">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('bw_unit', 'oz'); open = false">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('bw_unit', 'lbs'); open = false">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('bw_unit', 'stone'); open = false">stone</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label for="bv" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="bv" id="bv" step="any" class="input pr-16" placeholder="00">
                                <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 text-gray-500">{{ $bv_unit }} ▾</span>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-auto">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('bv_unit', 'ml'); open = false">milliliters (ml)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('bv_unit', 'cl'); open = false">centiliters (cl)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('bv_unit', 'l'); open = false">liters (l)</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label for="drug" class="font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="drug" id="drug" step="any" class="input pr-16" placeholder="00">
                                <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 text-gray-500">{{ $drug_unit }} ▾</span>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-auto">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('drug_unit', 'µg'); open = false">micrograms (µg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('drug_unit', 'mg'); open = false">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('drug_unit', 'g'); open = false">grams (g)</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Common Drop Factor --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="dp" class="font-s-14 text-blue">{!! $lang['7'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="dp" id="dp" step="any" class="input pr-24" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 text-gray-500">{{ $dp_unit }} ▾</span>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-auto">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('dp_unit', 'gtts/mm³'); open = false">drops (gtts) per mm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('dp_unit', 'gtts/cm³'); open = false">drops (gtts) per cm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('dp_unit', 'gtts/ml'); open = false">drops (gtts) per ml</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @if($detail['type'] == "first")
                                <p class="text-center"><strong>{{ $lang['10'] }}</strong></p>
                                <p class="text-center"><strong class="text-[#119154] font-s-32">{{ round($detail['dr']) }}<span class="text-green-500 font-s-22"> (ml/h)</span></strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%] mx-auto">
                                    <div class="flex flex-wrap justify-between">
                                        <div class="text-center px-3 mt-3">
                                            <p><strong>{{ $lang['8'] }}</strong></p>
                                            <p class="text-[28px]"><strong class="text-[#119154]">{{ round($detail['dpm']) }}</strong></p>
                                        </div>
                                        <div class="border-r hidden md:block lg:block mt-3">&nbsp;</div>
                                        <div class="text-center px-3 mt-3">
                                            <p><strong>{{ $lang['9'] }}</strong></p>
                                            <p class="text-[28px]"><strong class="text-[#119154]">{{ round($detail['dph']) }}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            @elseif($detail['type'] == "second")
                                <p class="text-center"><strong>{{ $lang['10'] }}</strong></p>
                                <p class="text-center"><strong class="text-[#119154] font-s-32">{{ round($detail['dr']) }} <span class="text-green-500 font-s-22">(ml/h)</span></strong></p>
                                <div class="w-full md:w-[80%] lg:w-[80%] mx-auto">
                                    <div class="flex flex-wrap justify-between">
                                        <div class="text-center px-3 mt-3">
                                            <p><strong>{{ $lang['11'] }}</strong></p>
                                            <p class="text-[25px]"><strong class="text-[#119154]">{{ round($detail['concentration'], 3) }} <span class="text-green-500 text-[18px]">(mg/L)</span></strong></p>
                                        </div>
                                        <div class="border-r hidden md:block lg:block mt-3">&nbsp;</div>
                                        <div class="text-center px-3 mt-3">
                                            <p><strong>{{ $lang['12'] }}</strong></p>
                                            <p class="text-[25px]"><strong class="text-[#119154]">{{ round($detail['flow_rate'], 3) }} <span class="text-green-500 text-[18px]">(gtts/per h)</span></strong></p>
                                        </div>
                                        <div class="border-r hidden md:block lg:block mt-3">&nbsp;</div>
                                        <div class="text-center px-3 mt-3">
                                            <p><strong>{{ $lang['13'] }}</strong></p>
                                            <p class="text-[25px]"><strong class="text-[#119154]">{{ round($detail['time_to_bag'], 2) }} <span class="text-green-500 text-[18px]">(hrs)</span></strong></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
