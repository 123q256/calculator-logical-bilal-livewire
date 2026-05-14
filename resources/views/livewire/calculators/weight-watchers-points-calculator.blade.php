<div>
    <style>
        .text-green { color: #10B981; }
        .bg-light-blue { background-color: #F0F7FF; }
        .radius-10 { border-radius: 10px; }
        .font-s-25 { font-size: 25px; }
        .font-s-32 { font-size: 32px; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3" x-data="{ selection: '{{ $selection }}' }">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    
                    <!-- Method Selection -->
                    <div class="col-span-12">
                        <label class="label">{!! $lang['20'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="selection" @change="selection = $event.target.value" class="input">
                                <option value="1">{{ $lang['21'] }}</option>
                                <option value="2">{{ $lang['22'] }}</option>
                                <option value="3">{{ $lang['23'] }}</option>
                                <option value="4">{{ $lang['24'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sec 1: PointsPlus -->
                    <div class="col-span-12 grid grid-cols-12 gap-2 md:gap-4 lg:gap-4" x-show="selection == '1'" style="{{ $selection == '1' ? '' : 'display: none;' }}">
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['1'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="fe" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                    {{ $fe_unit }} ▾
                                </label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fe_unit', 'cal')">calories (cal)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fe_unit', 'kJ')">kilojoules (kJ)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('fe_unit', 'J')">joules (J)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['2'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="sf" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                    {{ $sf_unit }} ▾
                                </label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sf_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sf_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sf_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sf_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sf_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sf_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('sf_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['3'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="sgr" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                    {{ $sgr_unit }} ▾
                                </label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sgr_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sgr_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sgr_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sgr_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sgr_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('sgr_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('sgr_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['4'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="ptn" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                                    {{ $ptn_unit }} ▾
                                </label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('ptn_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sec 2: SmartPoints -->
                    <div class="col-span-12 grid grid-cols-12 gap-2 md:gap-4 lg:gap-4" x-show="selection == '2'" style="{{ $selection == '2' ? '' : 'display: none;' }}">
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['4'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="ptn2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $ptn2_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn2_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn2_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn2_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn2_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn2_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('ptn2_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('ptn2_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['5'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="carbo" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $carbo_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('carbo_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('carbo_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('carbo_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('carbo_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('carbo_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('carbo_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('carbo_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['6'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="fat" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $fat_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('fat_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['19'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="fiber" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $fiber_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('fiber_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sec 3: Original -->
                    <div class="col-span-12 grid grid-cols-12 gap-2 md:gap-4 lg:gap-4" x-show="selection == '3'" style="{{ $selection == '3' ? '' : 'display: none;' }}">
                        <div class="col-span-12 md:col-span-4">
                            <label class="label">{!! $lang['1'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="call2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $call2_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('call2_unit', 'cal')">calories (cal)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('call2_unit', 'kJ')">kilojoules (kJ)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('call2_unit', 'J')">joules (J)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="label">{!! $lang['6'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="fat2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $fat2_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat2_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat2_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat2_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat2_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat2_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fat2_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('fat2_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="label">{!! $lang['19'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="fiber2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $fiber2_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber2_unit', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber2_unit', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber2_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber2_unit', 'oz')">ounces (oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber2_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('fiber2_unit', 'dr')">dr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('fiber2_unit', 'gr')">gr</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sec 4: Daily Target -->
                    <div class="col-span-12 grid grid-cols-12 gap-2 md:gap-4 lg:gap-4" x-show="selection == '4'" style="{{ $selection == '4' ? '' : 'display: none;' }}">
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['7'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="weight" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $weight_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{!! $lang['8'] !!}:</label>
                            <div class="relative w-full mt-2" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="height" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">{{ $height_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('height_unit', 'cm')">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('height_unit', 'in')">inches (in)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="label">{!! $lang['9'] !!} ({!! $lang['10'] !!}):</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="age" class="input" placeholder="00">
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="label">{!! $lang['13'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <select wire:model.live="gender" class="input">
                                    <option value="female">{{ $lang['11']}}</option>
                                    <option value="male">{{ $lang['12']}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="label">{!! $lang['14'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <select wire:model.live="activity" class="input">
                                    <option value="1">{{ $lang['15']}}</option>
                                    <option value="2">{{ $lang['16']}}</option>
                                    <option value="3">{{ $lang['17']}}</option>
                                    <option value="4">{{ $lang['18']}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
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
                    <div class="w-full text-center">
                        <p class="font-bold mt-3">
                            {{ ($selection == "4") ? 'Your daily target is' : 'Total Points' }}
                        </p>
                        <div class="flex justify-center mt-4">
                            <div class="bg-[#2845F5] text-white px-8 py-4 rounded-lg">
                                <span class="font-s-32 font-bold">{{ round($detail['ans'], 2) }}</span>
                                <span class="font-s-25 ml-2">
                                    {{ ($selection == '3') ? 'Older Points' : 'Points' }}
                                    {{ ($selection == '4') ? 'per day' : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
