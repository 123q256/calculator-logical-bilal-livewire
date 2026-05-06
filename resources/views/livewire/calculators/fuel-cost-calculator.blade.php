<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Distance --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="distance" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="distance" id="distance" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['distance'] = !dropdowns['distance']">
                                {{ $d_units }} ▾
                            </label>
                            <div x-show="dropdowns['distance']" @click.away="dropdowns['distance'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('d_units', 'km'); dropdowns['distance'] = false">km</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('d_units', 'mi'); dropdowns['distance'] = false">mi</p>
                            </div>
                        </div>
                    </div>

                    {{-- Fuel Efficiency --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="f_efficiency" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="f_efficiency" id="f_efficiency" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['efficiency'] = !dropdowns['efficiency']">
                                {{ $f_eff_units }} ▾
                            </label>
                            <div x-show="dropdowns['efficiency']" @click.away="dropdowns['efficiency'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('f_eff_units', 'L/100km'); dropdowns['efficiency'] = false">L/100km</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('f_eff_units', 'US mpg'); dropdowns['efficiency'] = false">US mpg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('f_eff_units', 'UK mpg'); dropdowns['efficiency'] = false">UK mpg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('f_eff_units', 'kmpl'); dropdowns['efficiency'] = false">kmpl</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('f_eff_units', 'lpm'); dropdowns['efficiency'] = false">liters per mile</p>
                            </div>
                        </div>
                    </div>

                    {{-- Fuel Price --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mx-auto w-full">
                        <label for="f_price" class="label">{{ $lang['8'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="f_price" id="f_price" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['price'] = !dropdowns['price']">
                                {{ $f_p_units }} ▾
                            </label>
                            <div x-show="dropdowns['price']" @click.away="dropdowns['price'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('f_p_units', '{{ $currancy }}/cl'); dropdowns['price'] = false">{{ $currancy }}/cl</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('f_p_units', '{{ $currancy }}/liter'); dropdowns['price'] = false">{{ $currancy }}/liter</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('f_p_units', '{{ $currancy }}/US gal'); dropdowns['price'] = false">{{ $currancy }}/US gal</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('f_p_units', '{{ $currancy }}/UK gal'); dropdowns['price'] = false">{{ $currancy }}/UK gal</p>
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full lg:w-[80%] lg:text-[18px] md:text-[18px] text-[14px] overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['fuel'], 2) }} {{ $lang['10'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy }} {{ round($detail['trip_cost'], 2) }}</td>
                                        </tr>
                                    </table>
                                    <p class="text-[20px] mb-3 mt-4"><strong>{{ $lang['12'] }}</strong></p>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['9'] }} ({{ $lang['13'] }}) :</td>
                                            <td class="border-b py-2">{{ round($detail['fuel'] * 0.26417, 3) }} {{ $lang['14'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['9'] }} ({{ $lang['15'] }}) :</td>
                                            <td class="border-b py-2">{{ round($detail['fuel'] * 0.21997, 3) }} {{ $lang['14'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full mt-3 lg:text-[18px] md:text-[18px] text-[14px]">
                                    @if ($detail['f_eff_units'] == 'L/100km')
                                        <p class="mt-2">if 40 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (100 / 40), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (100 / 40)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ ($detail['distance'] / (100 / 40)) * $detail['f_price'] }}.</p>
                                        <p class="mt-2">if 30 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (100 / 30), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (100 / 30)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ ($detail['distance'] / (100 / 30)) * $detail['f_price'] }}</p>
                                        <p class="mt-2">if 20 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (100 / 20), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (100 / 20)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ ($detail['distance'] / (100 / 20)) * $detail['f_price'] }}</p>
                                        <p class="mt-2">if 10 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (100 / 10), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (100 / 10)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ ($detail['distance'] / (100 / 10)) * $detail['f_price'] }}</p>
                                        <p class="mt-2">if 5 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (100 / 5), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (100 / 5)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ ($detail['distance'] / (100 / 5)) * $detail['f_price'] }}</p>
                                        <p class="mt-2">if 3 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (100 / 3), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (100 / 3)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ ($detail['distance'] / (100 / 3)) * $detail['f_price'] }}</p>
                                        <p class="mt-2">if 2 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (100 / 2), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (100 / 2)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ ($detail['distance'] / (100 / 2)) * $detail['f_price'] }}</p>
                                    @elseif ($detail['f_eff_units'] == 'US mpg')
                                        <p class="mt-2">if 5 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (5 * 0.425144), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (5 * 0.425144)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (5 * 0.425144)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 10 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (10 * 0.425144), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (10 * 0.425144)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (10 * 0.425144)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 20 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (20 * 0.425144), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (20 * 0.425144)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (20 * 0.425144)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 30 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (30 * 0.425144), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (30 * 0.425144)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (30 * 0.425144)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 40 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (40 * 0.425144), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (40 * 0.425144)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (40 * 0.425144)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 50 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (50 * 0.425144), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (50 * 0.425144)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (50 * 0.425144)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 60 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (60 * 0.425144), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (60 * 0.425144)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (60 * 0.425144)) * $detail['f_price'], 2) }}</p>
                                    @elseif ($detail['f_eff_units'] == 'UK mpg')
                                        <p class="mt-2">if 5 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (5 * 0.354006), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (5 * 0.354006)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 10 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (10 * 0.354006), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (10 * 0.354006)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 20 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (20 * 0.354006), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (20 * 0.354006)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 30 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (30 * 0.354006), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (30 * 0.354006)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 40 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (40 * 0.354006), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (40 * 0.354006)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 50 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (50 * 0.354006), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (50 * 0.354006)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 60 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / (60 * 0.354006), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / (60 * 0.354006)) * $detail['f_price'], 2) }}</p>
                                    @elseif ($detail['f_eff_units'] == 'kmpl')
                                        <p class="mt-2">if 3 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / 3, 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / 3) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / 3) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 5 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / 5, 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / 5) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / 5) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 10 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / 10, 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / 10) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / 10) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 20 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / 20, 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / 20) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / 20) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 30 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / 30, 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / 30) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / 30) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 50 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / 50, 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / 50) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / 50) * $detail['f_price'], 2) }}</p>
                                    @elseif ($detail['f_eff_units'] == 'lpm')
                                        <p class="mt-2">if 1 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / ((1 / 1) * 1.6093), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / ((1 / 1) * 1.6093)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / ((1 / 1) * 1.6093)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 0.5 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / ((1 / 0.5) * 1.6093), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / ((1 / 0.5) * 1.6093)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / ((1 / 0.5) * 1.6093)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 0.2 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / ((1 / 0.2) * 1.6093), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / ((1 / 0.2) * 1.6093)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / ((1 / 0.2) * 1.6093)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 0.1 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / ((1 / 0.1) * 1.6093), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / ((1 / 0.1) * 1.6093)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / ((1 / 0.1) * 1.6093)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 0.08 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / ((1 / 0.08) * 1.6093), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / ((1 / 0.08) * 1.6093)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / ((1 / 0.08) * 1.6093)) * $detail['f_price'], 2) }}</p>
                                        <p class="mt-2">if 0.05 {{ $detail['f_eff_units'] }}, {{ $lang['16'] }} {{ round($detail['distance'] / ((1 / 0.05) * 1.6093), 1) }} {{ $lang['17'] }} / {{ round(($detail['distance'] / ((1 / 0.05) * 1.6093)) * 0.26417, 1) }} {{ $lang['18'] }} <i>{{ $currancy }}</i> {{ round(($detail['distance'] / ((1 / 0.05) * 1.6093)) * $detail['f_price'], 2) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
