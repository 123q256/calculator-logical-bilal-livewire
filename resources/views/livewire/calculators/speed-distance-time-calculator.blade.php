<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-6">
                    {{-- Operation Selector (Solve For) --}}
                    <div class="space-y-2">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="operations" id="operations" class="input">
                            <option value="3">{{ $lang['2'] }}</option>
                            <option value="4">{{ $lang['3'] }}</option>
                            <option value="5">{{ $lang['4'] }}</option>
                        </select>
                    </div>

                    {{-- Dynamic Formula Display --}}
                    <div class="text-center py-2 bg-blue-50 rounded-lg">
                        @if ($operations == '3')
                            <p class="text-lg">
                                {{ $lang[5] }} =
                                <span class="inline-flex flex-col align-middle text-center mx-1">
                                    <span class="border-b border-black px-2">{{ $lang[6] }}</span>
                                    <span>{{ $lang[7] }}</span>
                                </span>
                            </p>
                        @elseif($operations == '4')
                            <p class="text-lg">
                                {{ $lang[6] }} = {{ $lang[5] }} × {{ $lang[7] }}
                            </p>
                        @elseif($operations == '5')
                            <p class="text-lg">
                                {{ $lang[7] }} =
                                <span class="inline-flex flex-col align-middle text-center mx-1">
                                    <span class="border-b border-black px-2">{{ $lang[6] }}</span>
                                    <span>{{ $lang[5] }}</span>
                                </span>
                            </p>
                        @endif
                    </div>

                    {{-- Input Fields --}}
                    {{-- Speed Field (First) --}}
                    @if (in_array($operations, ['4', '5']))
                        <div class="space-y-2">
                            <label for="first" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                            <div class="relative w-full">
                                <input type="text" inputmode="decimal" wire:model.live="first" id="first" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('f_unit_dropdown')">{{ $f_unit }} ▾</label>
                                @if ($openDropdown === 'f_unit_dropdown')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 max-h-60 overflow-auto shadow-lg">
                                        @foreach(['inch per second' => 'in/s', 'inch per minute' => 'in/min', 'foot per second' => 'ft/s', 'foot per minute' => 'ft/min', 'foot per hour' => 'ft/hr', 'yard per second' => 'yd/s', 'yard per minute' => 'yd/min', 'yard per hour' => 'yd/hr', 'centimeter per second' => 'cm/s', 'centimeter per minute' => 'cm/min', 'meter per second' => 'm/s', 'meter per minute' => 'm/min', 'meter per hour' => 'm/hr', 'mile per second' => 'mi/s', 'mile per minute' => 'mi/min', 'mile per hour' => 'mi/h (mph)', 'kilometer per second' => 'km/s', 'kilometer per hour' => 'km/h (kph)', 'knot (nautical mi/h)' => 'knots'] as $val => $label)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('f_unit', '{{ $val }}')">{{ $label }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Distance Field (Second) --}}
                    @if (in_array($operations, ['3', '5']))
                        <div class="space-y-2">
                            <label for="second" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                            <div class="relative w-full">
                                <input type="text" inputmode="decimal" wire:model.live="second" id="second" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('s_unit_dropdown')">{{ $s_unit }} ▾</label>
                                @if ($openDropdown === 's_unit_dropdown')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['inch' => 'in', 'foot' => 'ft', 'yard' => 'yd', 'mile' => 'mi', 'centimeter' => 'cm', 'meter' => 'm', 'kilometer' => 'km', 'nautical mile' => 'nmi'] as $val => $label)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('s_unit', '{{ $val }}')">{{ $label }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Time Field (Third) --}}
                    @if (in_array($operations, ['3', '4']))
                        <div class="space-y-2">
                            <label for="third" class="font-s-14 text-blue">{{ $lang['7'] }} {{ $t_unit == 'hhmmss' ? '(hh:mm:ss)' : '' }}</label>
                            <div class="relative w-full">
                                <input type="{{ $t_unit == 'hhmmss' ? 'text' : 'text' }}" inputmode="{{ $t_unit == 'hhmmss' ? 'text' : 'decimal' }}" wire:model.live="third" id="third" placeholder="{{ $t_unit == 'hhmmss' ? '00:00:00' : '00' }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('t_unit_dropdown')">{{ $t_unit }} ▾</label>
                                @if ($openDropdown === 't_unit_dropdown')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['year' => 'yr', 'day' => 'd', 'hour' => 'hr', 'minute' => 'min', 'second' => 's', 'hhmmss' => 'hh:mm:ss'] as $val => $label)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('t_unit', '{{ $val }}')">{{ $label }}</p>
                                        @endforeach
                                    </div>
                                @endif
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3 p-4 bg-light-blue rounded-lg">
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-lg">
                                    @if ($detail['select'] == 3)
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[5] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['answer'], 6) }} m/s</td>
                                        </tr>
                                        <tr><td colspan="2" class="py-2 font-bold text-blue-600">Other Units:</td></tr>
                                        <tr><td class="py-1 border-b">{{ $lang[10] }}</td><td class="py-1 border-b">{{ number_format($detail['answer'] * 39.37, 4) }} in/s</td></tr>
                                        <tr><td class="py-1 border-b">{{ $lang[11] }}</td><td class="py-1 border-b">{{ number_format($detail['answer'] * 3.281, 4) }} ft/s</td></tr>
                                        <tr><td class="py-1 border-b">{{ $lang[12] }}</td><td class="py-1 border-b">{{ number_format($detail['answer'] * 100, 4) }} cm/s</td></tr>
                                        <tr><td class="py-1 border-b">{{ $lang[13] }}</td><td class="py-1 border-b">{{ number_format($detail['answer'] / 1609.344, 6) }} mi/s</td></tr>
                                        <tr><td class="py-1 border-b">{{ $lang[14] }}</td><td class="py-1 border-b">{{ number_format($detail['answer'] / 1000, 6) }} km/s</td></tr>
                                        <tr><td class="py-1 border-b">{{ $lang[15] }}</td><td class="py-1 border-b">{{ number_format($detail['answer'] * 1.0936, 4) }} yd/s</td></tr>
                                    @elseif($detail['select'] == 4)
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[6] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['answer'], 4) }} m</td>
                                        </tr>
                                        <tr><td colspan="2" class="py-2 font-bold text-blue-600">Other Units:</td></tr>
                                        <tr><td class="py-1 border-b">Inches</td><td class="py-1 border-b">{{ number_format($detail['answer'] * 39.37, 4) }} in</td></tr>
                                        <tr><td class="py-1 border-b">Feet</td><td class="py-1 border-b">{{ number_format($detail['answer'] * 3.281, 4) }} ft</td></tr>
                                        <tr><td class="py-1 border-b">Miles</td><td class="py-1 border-b">{{ number_format($detail['answer'] / 1609.344, 6) }} mi</td></tr>
                                        <tr><td class="py-1 border-b">Kilometers</td><td class="py-1 border-b">{{ number_format($detail['answer'] / 1000, 6) }} km</td></tr>
                                    @elseif($detail['select'] == 5)
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }}</strong></td>
                                            <td class="py-2 border-b">{{ $detail['answer'] }} s</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>Formatted Time</strong></td>
                                            <td class="py-2 border-b text-blue-700 font-bold">{{ $detail['time_show'] }} (HH:MM:SS)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>Breakdown</strong></td>
                                            <td class="py-2 border-b">{{ $detail['hours'] }} hr, {{ $detail['min'] }} min, {{ $detail['sec'] }} s</td>
                                        </tr>
                                        <tr><td colspan="2" class="py-2 font-bold text-blue-600">Other Units:</td></tr>
                                        <tr><td class="py-1 border-b">Years</td><td class="py-1 border-b">{{ number_format($detail['answer'] / 31536000, 6) }} yr</td></tr>
                                        <tr><td class="py-1 border-b">Days</td><td class="py-1 border-b">{{ number_format($detail['answer'] / 86400, 4) }} d</td></tr>
                                        <tr><td class="py-1 border-b">Hours</td><td class="py-1 border-b">{{ number_format($detail['answer'] / 3600, 4) }} hr</td></tr>
                                        <tr><td class="py-1 border-b">Minutes</td><td class="py-1 border-b">{{ number_format($detail['answer'] / 60, 4) }} min</td></tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
