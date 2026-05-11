<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="w" class="label">{{ $lang['1'] ?? 'Weight' }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="w" id="w" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2.5 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none">
                                    {{ $w1 }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('w1', 'kg'); open = false">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('w1', 'lbs'); open = false">pounds (lbs)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dosage --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="d" class="label">{{ $lang['2'] ?? 'Dosage' }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="d" id="d" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2.5 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none">
                                    {{ $d1 }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-48 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('d1', 'µg/kg'); open = false">micrograms/kg (µg/kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('d1', 'mg/kg'); open = false">milligrams/kg (mg/kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('d1', 'g/kg'); open = false">grams/kg (g/kg)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Frequency --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="f" class="label">{!! $lang['3'] ?? 'Frequency' !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="f" id="f" class="input">
                                <option value="1">{{ $lang['4'] ?? 'Daily' }}</option>
                                <option value="2">{{ $lang['5'] ?? '2 x Daily' }}</option>
                                <option value="3">{{ $lang['6'] ?? '3 x Daily' }}</option>
                                <option value="4">{{ $lang['7'] ?? '4 x Daily' }}</option>
                                <option value="4h">{{ $lang['8'] ?? 'every 4 hr' }}</option>
                                <option value="3h">{{ $lang['9'] ?? 'every 6 hr' }}</option>
                                <option value="2h">{{ $lang['10'] ?? 'every 8 hr' }}</option>
                                <option value="h">{{ $lang['11'] ?? 'every 12 hr' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Medication Concentration --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="mc" class="label">{{ $lang['12'] ?? 'Medication concentration' }} <span class="text-sm opacity-70">({{ $lang['17'] ?? 'liquid' }})</span></label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="mc" id="mc" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2.5 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none">
                                    {{ $mc1 }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-56 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mc1', 'g/L'); open = false">grams per liter (g/L)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mc1', 'mg/mL'); open = false">milligrams per milliliter (mg/mL)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mc1', 'µg/L'); open = false">micrograms per liter (µg/L)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mc1', 'µg/mL'); open = false">micrograms per milliliter (µg/mL)</p>
                                </div>
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
        <hr class="my-6">
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full space-y-4">
                            {{-- Total Daily Dosage --}}
                            <div class="bg-[#F6FAFC] border rounded-lg px-4 py-4" style="border: 1px solid #c1b8b899;">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <strong class="text-blue-900">{{ $lang['13'] ?? 'Total daily dosage' }}</strong>
                                    <div class="flex items-baseline space-x-2 mt-2 md:mt-0">
                                        <strong class="text-green-700 text-[28px]">{{ $detail['tdose'] }} mg</strong>
                                        <span class="text-sm opacity-70">({{ $detail['ug'] }} µg, {{ $detail['gr'] }} g)</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Individual Dosage --}}
                            @if(isset($detail['dose']))
                                <div class="bg-[#F6FAFC] border rounded-lg px-4 py-4 flex items-center justify-between" style="border: 1px solid #c1b8b899;">
                                    <strong class="text-blue-900">{{ $lang['14'] ?? 'Individual dosage' }}</strong>
                                    <strong class="text-green-700 text-[28px]">{{ $detail['dose'] }} mg</strong>
                                </div>
                            @endif

                            {{-- Total Liquid Dosage --}}
                            @if(!empty($detail['lq_dose']))
                                <div class="bg-[#F6FAFC] border rounded-lg px-4 py-4 mt-3" style="border: 1px solid #c1b8b899;">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                        <strong class="text-blue-900">{{ $lang['15'] ?? 'Total liquid dosage' }}</strong>
                                        <div class="flex items-baseline space-x-2 mt-2 md:mt-0">
                                            <strong class="text-green-700 text-[28px]">{{ $detail['lq_dose'] }} ml</strong>
                                            <span class="text-sm opacity-70">({{ $detail['g'] }} L)</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Individual Liquid Dosage --}}
                                @if(!empty($detail['lq_dose1']))
                                    <div class="bg-[#F6FAFC] border rounded-lg px-4 py-4 flex items-center justify-between" style="border: 1px solid #c1b8b899;">
                                        <strong class="text-blue-900">{{ $lang['16'] ?? 'Individual liquid dosage' }}</strong>
                                        <strong class="text-green-700 text-[28px]">{{ $detail['lq_dose1'] }} ml</strong>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
