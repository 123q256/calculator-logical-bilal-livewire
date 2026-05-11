<div>
    <style>
    [x-cloak] { display: none !important; }
</style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Weight Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="weight" class="label">{!! $lang['1'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="input pr-20" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3">{{ $w_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-32">
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('w_unit', 'kg'); open = false">kilograms (kg)</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('w_unit', 'lbs'); open = false">pounds (lbs)</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('w_unit', 'stone'); open = false">stone</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('w_unit', 'oz'); open = false">ounces (oz)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Height Input Toggle --}}
                    <div class="col-span-12 md:col-span-6" x-data="{ h_unit: @entangle('unit_h') }">
                        <div x-show="h_unit === 'ft/in'" x-cloak class="grid grid-cols-2 gap-2">
                            <div class="w-full">
                                <label for="height_ft" class="label">{!! $lang['3'] !!}:</label>
                                <div class="relative mt-[7px]">
                                    <input type="number" wire:model.live="height_ft" id="height_ft" step="any" class="input pr-10" placeholder="ft">
                                    <span class="absolute right-3 top-3">ft</span>
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="height_in" class="label">&nbsp;</label>
                                <div class="relative mt-[7px]" x-data="{ open: false }">
                                    <input type="number" wire:model.live="height_in" id="height_in" step="any" class="input pr-16" placeholder="in">
                                    <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3">in ▾</span>
                                    <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-40">
                                        <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'ft/in'; open = false">feet / inches (ft/in)</p>
                                        <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'cm'; open = false">centimeters (cm)</p>
                                        <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'm'; open = false">meters (m)</p>
                                        <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'ft'; open = false">feet (ft)</p>
                                        <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'in'; open = false">inch (in)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-show="h_unit !== 'ft/in'" x-cloak class="w-full">
                            <label for="height_cm" class="label">{!! $lang['3'] !!} <span class="text-blue" x-text="'(' + h_unit + ')'"></span>:</label>
                            <div class="relative mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="height_cm" id="height_cm" step="any" class="input pr-16" :placeholder="h_unit">
                                <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3" x-text="h_unit + ' ▾'"></span>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-40">
                                    <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'ft/in'; open = false">feet / inches (ft/in)</p>
                                    <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'cm'; open = false">centimeters (cm)</p>
                                    <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'm'; open = false">meters (m)</p>
                                    <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'ft'; open = false">feet (ft)</p>
                                    <p class="p-2 cursor-pointer text-sm" @click="h_unit = 'in'; open = false">inch (in)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Steps --}}
                    <div class="col-span-12 md:col-span-6 mt-2">
                        <label for="steps" class="label">{!! $lang['4'] !!}:</label>
                        <div class="w-full mt-[7px]">
                            <input type="number" wire:model.live="steps" id="steps" step="any" class="input" placeholder="00">
                        </div>
                    </div>

                    {{-- Speed --}}
                    <div class="col-span-12 md:col-span-6 mt-2">
                        <label for="speed" class="label">{!! $lang['5'] !!}:</label>
                        <div class="w-full mt-[7px]">
                            <select wire:model.live="speed" id="speed" class="input cursor-pointer">
                                <option value="0.9">{{ $lang['6'] ?? 'Slow (2 mph)' }}</option>
                                <option value="1.34">{{ $lang['7'] ?? 'Normal (3 mph)' }}</option>
                                <option value="1.79">{{ $lang['8'] ?? 'Fast (4 mph)' }}</option>
                            </select>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 mt-3">
                            <div class="w-full">
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <strong>{{ $lang[9] }} =</strong>
                                            <strong class="text-green font-s-32">{{ round($detail['cal_burn'], 2) }}</strong>
                                            <span class="text-blue">(kcal)</span>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <strong>{{ $lang[10] }} =</strong>
                                            <strong class="text-green font-s-32">{{ round($detail['cal_per'], 2) }}</strong>
                                            <span class="text-blue">(kcal)</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-2">{!! $detail['text'] !!}</p>
                                <p class="mt-1">{!! $detail['main_text'] !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>


