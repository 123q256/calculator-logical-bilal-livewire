<div>
    <style>
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
        .hover_tags:hover { background-color: #2845F5 !important; color: white !important; }
        .bg-light-blue { background-color: #F0F7FF; }
        .text-blue { color: #2845F5; }
        .border-blue { border-color: #2845F5; }
        .input_unit { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); font-weight: bold; color: #666; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4 md:gap-6">
                    
                    <!-- Row 1: Age & Gender -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['1'] !!}:</label>
                        <div class="py-2">
                            <input type="number" step="any" wire:model.live="age" class="input" placeholder="00">
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['2'] !!}:</label>
                        <div class="py-2">
                            <select wire:model.live="gender" class="input">
                                <option value="male">{{ $lang['3'] }}</option>
                                <option value="female">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 2: Height & Weight -->
                    <div class="col-span-12 md:col-span-6" x-data="{ h_unit: @entangle('height_unit') }">
                        <label class="label">{!! $lang['5'] !!}:</label>
                        <div class="grid grid-cols-12 gap-2 mt-2">
                            <div :class="h_unit === 'ft/in' ? 'col-span-5' : 'hidden'">
                                <input type="number" step="any" wire:model.live="height_ft" class="input" placeholder="ft">
                            </div>
                            <div :class="h_unit === 'ft/in' ? 'col-span-7' : 'col-span-12'">
                                <div class="relative w-full" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                                    <template x-if="h_unit === 'ft/in'">
                                        <input type="number" step="any" wire:model.live="height_in" class="input pr-20" placeholder="in">
                                    </template>
                                    <template x-if="h_unit !== 'ft/in'">
                                        <input type="number" step="any" wire:model.live="height_cm" class="input pr-20" :placeholder="h_unit">
                                    </template>

                                    <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                        <span x-text="h_unit"></span> ▾
                                    </label>
                                    <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg top-full" x-cloak>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('height_unit', 'ft/in')">feet / inches (ft/in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('height_unit', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('height_unit', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('height_unit', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('height_unit', 'm')">meters (m)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['6'] !!}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="weight" class="input pr-24" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                {{ $weight_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg top-full" x-cloak>
                                @foreach(['kg' => 'kilograms (kg)', 'lbs' => 'pounds (lbs)', 'g' => 'grams (g)', 'stone' => 'stone'] as $val => $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('weight_unit', '{{ $val }}')">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Activity Level & Goal -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['10'] !!}:</label>
                        <div class="py-2">
                            <select wire:model.live="activity_level" class="input">
                                <option value="sedentary">{{ $lang[11] }}</option>
                                <option value="light">{{ $lang[12] }}</option>
                                <option value="moderate">{{ $lang[13] }}</option>
                                <option value="very_active">{{ $lang[14] }}</option>
                                <option value="extra_active">{{ $lang[15] }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['16'] !!}:</label>
                        <div class="py-2">
                            <select wire:model.live="protein_for" class="input">
                                <option value="general">{{ $lang[17] }}</option>
                                <option value="sport">{{ $lang[18] }}</option>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full p-3 mt-3">
                    <div class="w-full ">
                        <div class="w-full border-b pb-2">
                            <p><strong>{{ $lang[31] }}</strong></p>
                            <p class="text-[32px]"><strong class="text-green-700">{{ round($detail['calories']) }}</strong></p>
                        </div>
                        <div class="w-full mt-3">
                            <p class="text-[18px] mb-1"><strong class="text-blue-700">{{ $lang[21] }}</strong></p>
                            @if($protein_for === "general")
                                <p class="mb-1">
                                    {{ $lang[27] }}: <strong>{{ round($detail['calories'] * 0.1 / 4) }} - {{ round($detail['calories'] * 0.30 / 4) }} {{ $lang[32] }} ({{ round( $detail['calories'] * 0.1) }} - {{ round($detail['calories'] * 0.30) }} kcal)</strong>
                                </p>
                                <p>
                                    {{ $lang[28] }}: <strong>{{ round($detail['weight_kg'] * 0.83) }} {{ $lang[32] }} ({{ round($detail['weight_kg'] * 0.83*4) }} kcal)</strong>
                                </p>
                            @else
                                <p>
                                    {{ $lang[22] }}: <strong>{{ round($detail['weight_kg'] * 0.8) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg'] * 0.8 * 4) }}kcal)
                                </p>
                                <p>
                                    {{ $lang[23] }}: <strong>{{ round($detail['weight_kg']) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg'] * 4) }} kcal)
                                </p>
                                <p>
                                    {{ $lang[24] }}: <strong>{{ round($detail['weight_kg']*1.3) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg']*1.3*4) }} kcal)
                                </p>
                                <p>
                                    {{ $lang[25] }}: <strong>{{ round($detail['weight_kg']*1.6) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg']*1.6*4) }} kcal)
                                </p>
                                <p>
                                    {{ $lang[26] }}: <strong>{{ round($detail['weight_kg']*2) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg']*2*4) }} kcal)
                                </p>
                                <p>
                                    <strong>❗ {{ $lang[30] }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
