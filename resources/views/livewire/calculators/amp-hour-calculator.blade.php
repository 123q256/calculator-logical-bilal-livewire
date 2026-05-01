<div x-data="{ type: @entangle('type'), find: @entangle('find') }">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <!-- Mode Selection -->
                <div class="w-full">
                    <p class="d-inline pe-lg-3 ps-lg-2 text-blue">{{ $lang['1'] }}</p>
                    <input type="radio" wire:model.live="type" value="first" id="first" class="3d cursor-pointer">
                    <label for="first" class="ps-1 pe-3 text-blue 3d cursor-pointer">{{ $lang['2'] }}</label>
                    <input type="radio" wire:model.live="type" value="second" id="second" class="2d cursor-pointer">
                    <label for="second" class="ps-1 pe-3 text-blue 2d cursor-pointer">{{ $lang['3'] }}</label>
                </div>

                <!-- Battery Capacity Mode (First) -->
                <div x-show="type === 'first'" style="{{ $type !== 'first' ? 'display: none;' : '' }}" class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="find" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="find" id="find" class="input">
                                <option value="1">{{ $lang['5'] }}</option>
                                <option value="2">{{ $lang['6'] }}</option>
                                <option value="3">{{ $lang['7'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Voltage Input -->
                    <div x-show="find != 2" style="{{ $find == 2 ? 'display: none;' : '' }}" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="vol" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="vol" id="vol" class="input" aria-label="input" />
                            <span class="text-blue input_unit roy">V</span>
                        </div>
                    </div>

                    <!-- Battery Capacity Input -->
                    <div x-show="find != 1" style="{{ $find == 1 ? 'display: none;' : '' }}" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="bc" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="bc" id="bc" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label @click="$wire.toggleDropdown('bc_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4">
                                {{ $bc_unit }} ▾
                            </label>
                            <div x-show="$wire.openDropdown === 'bc_unit'" x-cloak @click.away="$wire.openDropdown = null" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('bc_unit', 'Ah')">Ah</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('bc_unit', 'mAh')">mAh</p>
                            </div>
                        </div>
                    </div>

                    <!-- Energy/Watt-hour Input -->
                    <div x-show="find != 3" style="{{ $find == 3 ? 'display: none;' : '' }}" class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wt_hour" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="wt_hour" id="wt_hour" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label @click="$wire.toggleDropdown('wt_hour_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4">
                                {{ $wt_hour_unit }} ▾
                            </label>
                            <div x-show="$wire.openDropdown === 'wt_hour_unit'" x-cloak @click.away="$wire.openDropdown = null" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('wt_hour_unit', 'kJ')">kJ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('wt_hour_unit', 'MJ')">MJ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('wt_hour_unit', 'Wh')">Wh</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('wt_hour_unit', 'kWh')">kWh</p>
                            </div>
                        </div>
                    </div>

                    <!-- C-Rate Input -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="c_rate" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="c_rate" id="c_rate" class="input" aria-label="input" />
                            <span class="text-blue input_unit roy">C</span>
                        </div>
                    </div>
                </div>

                <!-- Battery Life Mode (Second) -->
                <div x-show="type === 'second'" style="{{ $type !== 'second' ? 'display: none;' : '' }}" class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="load_size" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model="load_size" id="load_size" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="load_duration" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model="load_duration" id="load_duration" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <span class="text-blue font-s-16 pe-2">{{ $lang['11'] }} :</span>
                        <input type="checkbox" wire:model="temp_chk" id="temp_chk" class="lo cursor-pointer" aria-label="input field">
                        <label for="temp_chk" class="px-2 cursor-pointer">{{ $lang['12'] }} 0-85°F</label>
                        <div class="mt-2">
                            <span class="text-blue font-s-16 pe-2">{{ $lang['13'] }} :</span>
                            <input type="checkbox" wire:model="age_chk" id="age_chk" class="lo cursor-pointer" aria-label="input field">
                            <label for="age_chk" class="px-2 cursor-pointer">{{ $lang['14'] }}</label>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <p class="d-inline pe-lg-3 text-blue">{{ $lang['15'] }}</p>
                        <input type="radio" wire:model="batteries" value="gel" id="g1" class="cursor-pointer">
                        <label for="g1" class="ps-1 pe-3 text-blue 3d cursor-pointer">{{ $lang['16'] }}</label>
                        <input type="radio" wire:model="batteries" value="agm" id="g2" class="cursor-pointer">
                        <label for="g2" class="ps-1 pe-3 text-blue 2d cursor-pointer">{{ $lang['17'] }}</label>
                        <input type="radio" wire:model="batteries" value="flooded" id="g3" class="cursor-pointer">
                        <label for="g3" class="ps-1 pe-3 text-blue 2d cursor-pointer">{{ $lang['18'] }}</label>
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="lg:w-[70%] overflow-auto">
                                    <table class="w-full">
                                        @if ($detail['type'] == "first")
                                            @if ($detail['find'] == "1")
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['5'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ round($detail['ans'], 2) }}<span class="font-s-14"> (Ah)</span></td>
                                                </tr>
                                            @elseif ($detail['find'] == "2")
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['6'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ round($detail['ans'], 3) }}<span class="font-s-14"> (V)</span></td>
                                                </tr>
                                            @elseif ($detail['find'] == "3")
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ round($detail['ans'], 3) }}<span class="font-s-14"> (Wh)</span></td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['19'] }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['dc'], 3) }}<span class="font-s-14"> (A)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['20'] }} :</strong></td>
                                                <td class="border-b py-2">{{ round(1 / $detail['c_rate'], 3) }}<span class="font-s-14"> (hrs)</span></td>
                                            </tr>
                                        @elseif ($detail['type'] == "second")
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['21'] }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['ans'], 2) }}<span class="font-s-14"> (Ah)</span></td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
