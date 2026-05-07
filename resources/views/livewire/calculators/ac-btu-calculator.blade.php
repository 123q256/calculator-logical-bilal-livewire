<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 mt-3 gap-6">
                    {{-- Calculation Type --}}
                    <div class="col-span-1 md:col-span-2">
                        <label for="calculate" class="label">{!! $lang['1'] !!}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="calc_type" id="calc_type" class="input">
                                <option value="ac">AC BTU</option>
                                <option value="heating">{{ $lang['2'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Length --}}
                    <div>
                        <label for="length" class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="length" id="length" class="input pr-20" />
                            <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                    {{ $length_unit }} ▾
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false" 
                                     class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[80px] overflow-hidden">
                                    @foreach (["m","ft"] as $u)
                                        <div @click="$wire.set('length_unit', '{{ $u }}'); open = false" 
                                             class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                            {{ $u }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Width --}}
                    <div>
                        <label for="width" class="label">{{ $lang['8'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="width" id="width" class="input pr-20" />
                            <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                    {{ $width_unit }} ▾
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false" 
                                     class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[80px] overflow-hidden">
                                    @foreach (["m","ft"] as $u)
                                        <div @click="$wire.set('width_unit', '{{ $u }}'); open = false" 
                                             class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                            {{ $u }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Height --}}
                    <div>
                        <label for="height" class="label">{{ $lang['9'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-40' : 'z-0'">
                            <input type="number" step="any" wire:model.live="height" id="height" class="input pr-20" />
                            <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                    {{ $height_unit }} ▾
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false" 
                                     class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[80px] overflow-hidden">
                                    @foreach (["m","ft"] as $u)
                                        <div @click="$wire.set('height_unit', '{{ $u }}'); open = false" 
                                             class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                            {{ $u }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Room Type --}}
                    <div>
                        <label for="room_type" class="label">{!! $lang['10'] !!}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="room_type" id="room_type" class="input">
                                <option value="bedroom">{{ $lang[7] }}</option>
                                <option value="living-room">{{ $lang[8] }}</option>
                                <option value="kitchen">{{ $lang[9] }}</option>
                                <option value="house">{{ $lang[10] }}</option>
                                <option value="first-floor">{{ $lang[11] }}</option>
                                <option value="above-floor">{{ $lang[12] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Insulation --}}
                    <div>
                        <label for="insulation_condition" class="label">{!! $lang['14'] !!}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="insulation_condition" id="insulation_condition" class="input">
                                <option value="good">{{ $lang[15] }}</option>
                                <option value="average">{{ $lang[16] }}</option>
                                <option value="poor">{{ $lang[17] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- AC Specific Fields --}}
                    @if($calc_type === 'ac')
                        <div>
                            <label for="peoples" class="label">{!! $lang['13'] !!}:</label>
                            <div class="w-100 py-2">
                                <input type="number" wire:model.live="peoples" id="peoples" class="input" placeholder="{{ $lang['3'] }}" />
                            </div>
                        </div>
                        <div>
                            <label for="sun_exposure" class="label">{!! $lang['18'] !!}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="sun_exposure" id="sun_exposure" class="input">
                                    <option value="shaded">{{ $lang[19] }}</option>
                                    <option value="average">{{ $lang[20] }}</option>
                                    <option value="sunny">{{ $lang[21] }}</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="climate" class="label">{!! $lang['22'] !!}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="climate" id="climate" class="input">
                                    <option value="cold">{{ $lang[23] }} (e.g. Boston)</option>
                                    <option value="average">{{ $lang[24] }}</option>
                                    <option value="hot">{{ $lang[25] }} (e.g. Houston)</option>
                                </select>
                            </div>
                        </div>
                    @else
                        {{-- Heating Specific Fields --}}
                        <div>
                            <label for="temperature" class="label">{!! $lang['26'] !!}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-40' : 'z-0'">
                                <input type="number" step="any" wire:model.live="temperature" id="temperature" class="input pr-20" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                        @if($temperature_unit == 'cel') °C @else °F @endif ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" 
                                         class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[100px] overflow-hidden">
                                        <div @click="$wire.set('temperature_unit', 'cel'); open = false" class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">Celsius (°C)</div>
                                        <div @click="$wire.set('temperature_unit', 'fah'); open = false" class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">Fahrenheit (°F)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
                <div class="space-y-6">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                    <p>
                                        <strong> {{ ($calc_type == 'ac') ? $lang[27] : $lang[28] }} </strong>
                                    </p>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2">BTU :</td>
                                            <td class="border-b py-2">{{ $detail['total_btu'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">ton :</td>
                                            <td class="border-b py-2">{{ $detail['ton'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">watts :</td>
                                            <td class="border-b py-2">{{ $detail['watts'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">kilowatt :</td>
                                            <td class="border-b py-2">{{ $detail['kilowatts'] }}</td>
                                        </tr> 
                                        <tr>
                                            <td class="border-b py-2">hp(I) :</td>
                                            <td class="border-b py-2">{{ $detail['hp_i'] }}</td>
                                        </tr> 
                                        <tr>
                                            <td class="border-b py-2">hp(E) :</td>
                                            <td class="border-b py-2">{{ $detail['hp_e'] }}</td>
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
