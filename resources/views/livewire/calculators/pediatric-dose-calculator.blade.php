<div>
    <style>
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
        .hover_tags:hover { background-color: #2845F5 !important; color: white !important; }
        .bg-light-blue { background-color: #F0F7FF; }
        .text-blue { color: #2845F5; }
        .border-blue { border-color: #2845F5; }
        .input_unit { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); font-weight: bold; color: #666; }
    </style>

    <form wire:submit.prevent="calculate" x-data="{ calc_type: @entangle('calc_type') }">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <!-- Calculation Mode Selection -->
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto mt-2">
                <div class="flex flex-wrap items-center bg-blue-50 border border-blue-200 text-center rounded-xl p-1 shadow-sm">
                    <div class="lg:w-1/4 w-full px-1 py-1">
                        <div class="px-3 py-2 cursor-pointer rounded-lg transition-all duration-300 font-medium text-sm" 
                             :class="calc_type === 'first' ? 'tagsUnit shadow-md' : 'bg-white text-gray-600 hover_tags'"
                             @click="calc_type = 'first'; $wire.setType('first')">
                            {{ $lang['1'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/4 w-full px-1 py-1">
                        <div class="px-3 py-2 cursor-pointer rounded-lg transition-all duration-300 font-medium text-sm" 
                             :class="calc_type === 'second' ? 'tagsUnit shadow-md' : 'bg-white text-gray-600 hover_tags'"
                             @click="calc_type = 'second'; $wire.setType('second')">
                            {{ $lang['2'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/4 w-full px-1 py-1">
                        <div class="px-3 py-2 cursor-pointer rounded-lg transition-all duration-300 font-medium text-sm" 
                             :class="calc_type === 'third' ? 'tagsUnit shadow-md' : 'bg-white text-gray-600 hover_tags'"
                             @click="calc_type = 'third'; $wire.setType('third')">
                            {{ $lang['3'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/4 w-full px-1 py-1">
                        <div class="px-3 py-2 cursor-pointer rounded-lg transition-all duration-300 font-medium text-sm" 
                             :class="calc_type === 'fourth' ? 'tagsUnit shadow-md' : 'bg-white text-gray-600 hover_tags'"
                             @click="calc_type = 'fourth'; $wire.setType('fourth')">
                            {{ $lang['4'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4 md:gap-6">
                    
                    <!-- Dose Input (Varies by Mode) -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['5'] }}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="dose" class="input pr-24" placeholder="00">
                            
                            <!-- Dose Unit Dropdown 1 (Weight-based) -->
                            <div class="absolute right-2 top-1/2 -translate-y-1/2" x-show="calc_type === 'first'" style="{{ $calc_type === 'first' ? '' : 'display: none;' }}">
                                <button type="button" @click="open = !open" class="text-sm underline font-bold text-gray-600 hover:text-blue-600">
                                    {{ $dose_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    @foreach(['mg/kg', 'mg/kg/day', 'mg/kg/dose', 'mcg/kg', 'mcg/kg/day', 'mcg/kg/dose'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm {{ $loop->last ? '' : 'border-b' }}" @click="open = false; $wire.setUnit('dose_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Dose Unit Dropdown 2 (BSA-based) -->
                            <div class="absolute right-2 top-1/2 -translate-y-1/2" x-show="calc_type === 'second'" style="{{ $calc_type === 'second' ? '' : 'display: none;' }}">
                                <button type="button" @click="open = !open" class="text-sm underline font-bold text-gray-600 hover:text-blue-600">
                                    {{ $dose_unit2 }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    @foreach(['mg/m²', 'mg/day', 'mg/dose', 'mcg/m²', 'mcg/day', 'mcg/dose'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm {{ $loop->last ? '' : 'border-b' }}" @click="open = false; $wire.setUnit('dose_unit2', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Dose Unit Dropdown 3 (Age/Clark's Rule) -->
                            <div class="absolute right-2 top-1/2 -translate-y-1/2" x-show="calc_type === 'third' || calc_type === 'fourth'" style="{{ $calc_type === 'third' || $calc_type === 'fourth' ? '' : 'display: none;' }}">
                                <button type="button" @click="open = !open" class="text-sm underline font-bold text-gray-600 hover:text-blue-600">
                                    {{ $dose_unit3 }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    @foreach(['mg/day', 'mg/dose', 'mcg/day', 'mcg/dose'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm {{ $loop->last ? '' : 'border-b' }}" @click="open = false; $wire.setUnit('dose_unit3', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Weight Input (Mode 1 and 4) -->
                    <div class="col-span-12 md:col-span-6" x-show="calc_type === 'first' || calc_type === 'fourth'" style="{{ $calc_type === 'first' || $calc_type === 'fourth' ? '' : 'display: none;' }}">
                        <label class="label">{{ $lang['6'] }}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="weight" class="input pr-24" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                {{ $weight_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg top-full" x-cloak>
                                @foreach(['kg' => 'kilograms (kg)', 'lbs' => 'pounds (lbs)', 'g' => 'grams (g)', 'dag' => 'decagrams (dag)', 'oz' => 'ounces (oz)'] as $val => $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('weight_unit', '{{ $val }}')">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- BSA Input (Mode 2) -->
                    <div class="col-span-12 md:col-span-6" x-show="calc_type === 'second'" style="{{ $calc_type === 'second' ? '' : 'display: none;' }}">
                        <label class="label">{!! $lang['7'] !!}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="bsa" class="input" placeholder="00">
                            <span class="input_unit">m<sup>2</sup></span>
                        </div>
                    </div>

                    <!-- Child Age Input (Mode 3) -->
                    <div class="col-span-12 md:col-span-6" x-show="calc_type === 'third'" style="{{ $calc_type === 'third' ? '' : 'display: none;' }}">
                        <label class="label">{!! $lang['8'] !!}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="child_age" class="input" placeholder="00">
                            <span class="input_unit">years</span>
                        </div>
                    </div>
                    <!-- Drug Concentration Header -->
                    <div class="col-span-12">
                        <h3 class="text-blue font-bold flex items-center gap-2">8                            {{ $lang['12'] }}
                        </h3>
                    </div>

                    <!-- Drug Mass -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['9'] }}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="mass" class="input pr-24" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                {{ $mass_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                @foreach(['mg' => 'millgrams (mg)', 'µg' => 'micrograms (µg)', 'g' => 'grams (g)'] as $val => $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('mass_unit', '{{ $val }}')">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Drug Volume -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['10'] }}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="per" class="input pr-24" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                {{ $per_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg top-full" x-cloak>
                                @foreach(['ml' => 'milliliters (ml)', 'mm³' => 'cubic milliliters (mm³)', 'cm³' => 'cubic centimeters (cm³)', 'cu in' => 'cubic inches (cu in)', 'cl' => 'centiliters (cl)', 'cc' => 'cubic centimeters (cc)'] as $val => $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('per_unit', '{{ $val }}')">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Frequency -->
                    <div class="col-span-12">
                        <label class="label">{!! $lang['11'] !!}:</label>
                        <div class="py-2">
                            <select wire:model.live="dose_frequency" class="input">
                                @foreach(["qD", "BID", "TID", "QID", "q8 hr", "q6 hr", "q4 hr", "q3 hr", "q2 hr", "q1 hr"] as $f)
                                    <option value="{{ $f }}">{{ $f }}</option>
                                @endforeach
                            </select>
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
        </div>
    </form>

    <!-- Result Section -->
    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 rounded-lg space-y-6">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="col-12">
                            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <p class="">{{ $lang['13'] }} =<strong><span class="text-[#119154] text-[28px]"> {{ round($detail['main_answer1'],2) }}</span><span class="text-[#119154]"> (mg/day) </span></strong></p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <p class="">{{ $lang['14'] }} ({{ $detail['dose_frequency'] }}) =<strong><span class="text-[#119154] text-[28px]"> {{ round($detail['ans1'],2) }}</span><span class="text-[#119154]"> (mg/dose) </span></strong></p>
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <strong> {{ $lang['15'] }} {{ $detail['mass'] }} ({{ $detail['mass_unit'] }}) / {{ $detail['per'] }} ({{ $detail['per_unit'] }}) :</strong>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <p class="">{{ $lang['13'] }} =<strong><span class="text-[#119154] text-[28px]"> {{ round($detail['main_answer1']/$detail['main_answer3'],2) }}</span><span class="text-[#119154]"> (mL/day) </span></strong></p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <p class="">{{ $lang['14'] }} ({{ $detail['dose_frequency'] }}) =<strong><span class="text-[#119154] text-[28px]"> {{ round($detail['main_answer4'],2) }}</span><span class="text-[#119154]"> (mL/dose) </span></strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
