<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Hoop Type --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="hoopType" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="hoopType" id="hoopType" class="input">
                                <option value="7">2ⁿᵈ{{ $lang['2'] }}</option>
                                <option value="8">3ʳᵈ to 4ᵗʰ{{ $lang['3'] }}</option>
                                <option value="9">5ᵗʰ to 6ᵗʰ{{ $lang['3'] }}</option>
                                <option value="10">7ᵗʰ{{ $lang['4'] }}</option>
                                <option value="custom">{{ $lang['5'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Height --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="height" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="height" id="height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.height_unit) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('height_unit', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Mass --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="mass" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="mass" id="mass" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.mass_unit) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["g", "kg", "t", "lb", "st", "US ton", "long ton","Earths"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mass_unit', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Acceleration --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="acceleration" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="acceleration" id="acceleration" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.acceleration_unit) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["m/s²","g", "ft/s²"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('acceleration_unit', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Palm Size --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="palm_size" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="palm_size" id="palm_size" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.palm_size_unit) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["mm","cm", "m","in","ft"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('palm_size_unit', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Standing --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="standing" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="standing" id="standing" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.standing_unit) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["mm","cm", "m","km","in","ft","yd","mi","nmi"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('standing_unit', '{{ $name }}')" @click="open = false">{{ $name }}</p>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full py-2">
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['minimum_vertical_leap'] }} (cm)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['hang_time'] }} (sec)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['13'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['jumping_energy'] }} (J)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['14'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['initial_jumping_speed'] }} (m/s)</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
