<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 mt-3">
                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="gender" class="label">{{ $lang['gen'] ?? 'Gender' }}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="1">{{ $lang['male'] ?? 'Male' }}</option>
                                <option value="0">{{ $lang['female'] ?? 'Female' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Age --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="age" class="label">{{ $lang['age'] ?? 'Age' }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="age" id="age" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                    {{ $age_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', 'days'); open = false">days</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', 'weeks'); open = false">weeks</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', 'months'); open = false">months</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', 'years'); open = false">years</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Height --}}
                    <div class="col-span-12 mt-2">
                        <div class="grid grid-cols-12 gap-2" x-data="{ unit: @entangle('unit_h'), open: false }">
                            <div class="col-span-12">
                                <label class="label">{!! $lang['height'] ?? 'Height' !!}:</label>
                            </div>

                            {{-- Feet/Inches Mode --}}
                            <template x-if="unit === 'ft/in'">
                                <div class="col-span-12 grid grid-cols-12 gap-2">
                                    <div class="col-span-6 relative">
                                        <input type="number" wire:model.live="height_ft" step="any" class="input w-full" placeholder="ft" required />
                                        <span class="absolute right-2 top-3 text-gray-400 text-sm">ft</span>
                                    </div>
                                    <div class="col-span-6 relative">
                                        <input type="number" wire:model.live="height_in" step="any" class="input w-full" placeholder="in" required />
                                        <div class="absolute right-2 top-2 flex items-center">
                                            <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                                ft/in ▾
                                            </button>
                                            <div x-show="open" @click.away="open = false" class="absolute z-20 bg-white border border-gray-300 rounded-md w-48 mt-1 right-0 top-full shadow-lg" x-cloak>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'ft/in'; $wire.set('unit_h', 'ft/in'); open = false">feet / inches (ft/in)</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'ft'; $wire.set('unit_h', 'ft'); open = false">feet (ft)</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'in'; $wire.set('unit_h', 'in'); open = false">inch (in)</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'cm'; $wire.set('unit_h', 'cm'); open = false">centimeters (cm)</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'm'; $wire.set('unit_h', 'm'); open = false">meters (m)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            {{-- Single Unit Mode --}}
                            <template x-if="unit !== 'ft/in'">
                                <div class="col-span-12 relative">
                                    <input type="number" wire:model.live="height_cm" step="any" class="input w-full" :placeholder="unit" required />
                                    <div class="absolute right-3 top-2 flex items-center">
                                        <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                            <span x-text="unit"></span> ▾
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="absolute z-20 bg-white border border-gray-300 rounded-md w-48 mt-1 right-0 top-full shadow-lg" x-cloak>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'ft/in'; $wire.set('unit_h', 'ft/in'); open = false">feet / inches (ft/in)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'ft'; $wire.set('unit_h', 'ft'); open = false">feet (ft)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'in'; $wire.set('unit_h', 'in'); open = false">inch (in)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'cm'; $wire.set('unit_h', 'cm'); open = false">centimeters (cm)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="unit = 'm'; $wire.set('unit_h', 'm'); open = false">meters (m)</p>
                                        </div>
                                    </div>
                                </div>
                            </template>
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
                    <div class="w-full mt-5">
                        <div class="w-full">
                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                {{ $lang[2] }} = <span class="text-green-700 text-[25px]">{{ $detail['first_ans'] }}</span> {{ $lang[3] }}
                            </div>
                            <p class="text-[18px] mt-2" id="line">{!! $detail['line'] !!}</p>
                            <div class="mt-3">
                                <img src="{{ url('images/'.$detail['image'].'.png') }}" alt="Growth Chart" width="100%" height="100px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
