<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="Cardiac" class="label">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="Cardiac" id="Cardiac" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $Cardiac_unit }} ▾</label>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-y-auto">
                            @foreach(['/min mm³', '/min cm³', '/min dm³', '/min in³', '/min ft³', '/min yd³', '/min ml', '/min cl', '/min l', '/min US gal', '/min UK gal', '/min US fl oz', '/min UK fl oz', '/min cups', '/min tbsp', '/min tsp', '/min US qt', '/min UK qt', '/min US pt', '/min UK pt'] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('Cardiac_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="heart" class="label">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" wire:model.live="heart" id="heart" class="input" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">bpm</span>
                    </div>
                </div>

                @if($unit_h_cm === 'ft/in' || $unit_h_cm === 'm/cm')
                    <div class="col-span-12 grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-6 md:col-span-6 lg:col-span-6">
                            <label for="height_ft" class="label">{{ explode('/', $unit_h_cm)[0] }}</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="height_ft" id="height_ft" class="input" aria-label="input" />
                            </div>
                        </div>
                        <div class="col-span-6 md:col-span-6 lg:col-span-6">
                            <label for="height_in" class="label">{{ explode('/', $unit_h_cm)[1] }}</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="height_in" id="height_in" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_h_cm }} ▾</label>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'nmi', 'ft/in', 'm/cm'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit_h_cm', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="height_cm" class="label">{{ $lang['5'] }} <span class="text-blue">({{ $unit_h_cm }})</span>:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="height_cm" id="height_cm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_h_cm }} ▾</label>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                @foreach(['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'nmi', 'ft/in', 'm/cm'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit_h_cm', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="label">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $weight_unit }} ▾</label>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-y-auto">
                            @foreach(['µg', 'mg', 'g', 'dag', 'kg', 't', 'gr', 'dr', 'oz', 'lbs', 'st', 'US ton', 'long ton', 'Earths', 'me', 'u', 'oz t'] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                            @endforeach
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
        <div id="result-section" wire:key="result-{{ rand() }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full mt-2">
                            <div class="bg-sky border rounded">
                                <div class="w-full px-3 py-2">
                                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                        <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                            <p><strong>{{ $lang['1'] }}</strong></p>
                                            <p>
                                                <strong class="text-green-500 text-[30px]">{{ round($detail['stroke_volume'], 4) }}</strong>
                                                <span class="text-green-500 text-[18px]">l</span>
                                            </p>
                                        </div>
                                        <div class="col-span-12 md:col-span-2 lg:col-span-2 hidden md:block lg:block justify-center">
                                            <div class="border" style="width: 1px"></div>
                                        </div>
                                        <div class="col-span-12 md:col-span-5 lg:col-span-5 ps-md-4">
                                            <p><strong>{{ $lang['4'] }}</strong></p>
                                            <p>
                                                <strong class="text-green-500 text-[30px]">{{ round($detail['bsa'], 4) }}</strong>
                                                <span class="text-green-500 text-[18px]">m²</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full px-3 py-2">
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <p><strong>{{ $lang['7'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['stroke_val_index'], 4) }}</strong>
                                            <span class="text-green-500 text-[18px]">l/(min·m²)</span>
                                        </p>
                                    </div>
                                    <div class="col-span-12 md:col-span-2 lg:col-span-2 hidden md:block lg:block justify-center">
                                        <div class="border" style="width: 1px"></div>
                                    </div>
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5 ps-md-4">
                                        <p><strong>{{ $lang['8'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['stroke_index'], 4) }}</strong>
                                            <span class="text-green-500 text-[18px]">l/m²</span>
                                        </p>
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
