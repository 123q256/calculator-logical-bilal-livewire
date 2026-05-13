<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[75%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-3 md:gap-4">
                    {{-- Age --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="age" class="label">{!! $lang['1'] !!}:</label>
                        <div class="w-full mt-[7px]">
                            <input type="number" wire:model.live="age" id="age" step="any" class="input" placeholder="00">
                        </div>
                    </div>

                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="gender" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-full mt-[7px]">
                            <select wire:model.live="gender" id="gender" class="input cursor-pointer">
                                <option value="1">{{ $lang['3'] }}</option>
                                <option value="2">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Height --}}
                    <div class="col-span-12 md:col-span-6" x-data="{ unit: @entangle('unit_h') }">
                        <label class="label">{!! $lang['5'] !!}:</label>
                        <div class="grid grid-cols-12 gap-2 mt-[7px]">
                            {{-- Feet/Inches Mode --}}
                            <div class="col-span-12 grid grid-cols-2 gap-2" x-show="unit === 'ft/in'" x-cloak>
                                <div class="w-full">
                                    <input type="number" wire:model.live="height_ft" class="input" placeholder="ft">
                                </div>
                                <div class="relative w-full" x-data="{ open: false }">
                                    <input type="number" wire:model.live="height_in" class="input pr-16" placeholder="in">
                                    <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 ">{{ $unit_h }} ▾</span>
                                    <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-24">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'ft/in'; open = false">ft/in</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'cm'; open = false">cm</p>
                                    </div>
                                </div>
                            </div>
                            {{-- CM Mode --}}
                            <div class="col-span-12" x-show="unit === 'cm'" x-cloak>
                                <div class="relative w-full" x-data="{ open: false }">
                                    <input type="number" wire:model.live="height_cm" class="input pr-16" placeholder="cm">
                                    <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 ">{{ $unit_h }} ▾</span>
                                    <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-24">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'ft/in'; open = false">ft/in</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'cm'; open = false">cm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Jumping Rate --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="operations" class="label">{{ $lang['6'] }}:</label>
                        <div class="w-full mt-[7px]">
                            <select wire:model.live="operations" id="operations" class="input cursor-pointer">
                                <option value="8.8">&lt; 100 {{ $lang['7'] }}</option>
                                <option value="11.8">100-120 {{ $lang['7'] }}</option>
                                <option value="12.3">{{ $lang['8'] }}</option>
                                <option value="12.3">120-160 {{ $lang['7'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="first" class="label">{{ $lang['9'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="first" id="first" step="any" class="input pr-20" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 ">{{ $units1 }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-24">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('units1', 'kg'); open = false">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('units1', 'lbs'); open = false">lbs</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('units1', 'stone'); open = false">stone</p>
                            </div>
                        </div>
                    </div>

                    {{-- Jumping Time --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="second" class="label">{{ $lang['10'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="second" id="second" step="any" class="input pr-20" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 ">{{ $units2 }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-24">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('units2', 'sec'); open = false">sec</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('units2', 'min'); open = false">min</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('units2', 'hrs'); open = false">hrs</p>
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
                                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            {{ $lang[11] }} = <span class="text-green font-s-25">{{ round($detail['cbr_ans'], 2) }}</span> (kcal/min)
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            {{ $lang[12] }} = <span class="text-green font-s-25">{{ round($detail['cb_ans'], 2) }}</span> (kcal)
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            BMR = <span class="text-green font-s-25">{{ round($detail['BMR'], 2) }}</span> (kcal/day)
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            MET = <span class="text-green font-s-25">{{ $detail['met'] }}</span> (Mets/h)
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
