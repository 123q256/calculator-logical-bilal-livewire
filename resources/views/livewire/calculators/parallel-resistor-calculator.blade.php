<div x-data="{ mode: @entangle('mode') }">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Mode Selection -->
                    <div class="col-span-12">
                        <label for="mode" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="mode" id="mode" class="input">
                                <option value="1">{{ $lang[2] }}</option>
                                <option value="2">{{ $lang[3] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Desired Total Resistance (Mode 2 only) -->
                    <div x-show="mode == 2" x-cloak class="col-span-12">
                        <label for="missing" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="missing" id="missing" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label @click="$wire.toggleDropdown('mis_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4">
                                {{ $mis_unit }} ▾
                            </label>
                            <div x-show="$wire.openDropdown === 'mis_unit'" @click.away="$wire.openDropdown = null" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('mis_unit', 'mΩ')">mΩ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('mis_unit', 'Ω')">Ω</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('mis_unit', 'kΩ')">kΩ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('mis_unit', 'MΩ')">MΩ</p>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Resistors -->
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            @foreach ($resistors as $index => $resistor)
                                <div class="col-span-6 relative group">
                                    <label class="font-s-14 text-blue">{{ $lang['4'] }} {{ $index + 1 }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model="resistors.{{ $index }}.val" class="input" aria-label="input" placeholder="50" />
                                    </div>
                                    @if (count($resistors) > 2)
                                        <button type="button" wire:click="removeResistor({{ $index }})" class="absolute -left-6 top-10 text-red-500" title="Remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                                <div class="col-span-6">
                                    <label class="font-s-14 text-blue">&nbsp;</label>
                                    <div class="w-100 py-2">
                                        <select wire:model="resistors.{{ $index }}.unit" class="input">
                                            <option value="0.001">mΩ</option>
                                            <option value="1">vΩ</option>
                                            <option value="1000">kΩ</option>
                                            <option value="1000000">MΩ</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Add More Button -->
                    <div class="col-span-12 text-end mt-3">
                        <button type="button" wire:click="addResistor" class="px-4 py-2 bg-[#2845F5] text-white rounded-lg hover:bg-blue-600 transition-colors flex items-center justify-center float-right">
                            <span class="mr-1 text-xl">+</span> {{ $lang[6] }}
                        </button>
                    </div>
                </div>
            </div>

            @if ($type_calc == 'calculator')
                @include('inc.button')
            @endif
            @if ($type_calc == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        <!-- Result Section -->
        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type_calc == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[70%] lg:w-[70%] overflow-auto mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['answer'], 2) }} ({{ $detail['unit'] }})</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full  mt-4">
                                @if ($detail['mode'] == 1)
                                    <p class="text-lg">{{ $lang[8] }} <strong>{{ round($detail['answer'], 2) . ' ' . $detail['unit'] }}</strong></p>
                                @elseif($detail['mode'] == 2)
                                    @if ($detail['answer'] > 0)
                                        <p class="text-lg">{{ $lang[9] }} <strong>{{ round($detail['answer'], 2) . ' ' . $detail['unit'] }}</strong></p>
                                    @elseif ($detail['answer'] == 0)
                                        <p class="text-lg text-yellow-600">{{ $lang[10] }}</p>
                                    @else
                                        <p class="text-lg text-red-600">{{ $lang[11] }}</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
