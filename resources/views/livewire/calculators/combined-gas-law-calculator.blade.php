<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2 relative">
                    <label for="calculation" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select wire:model.live="calculation" id="calculation" class="input">
                        @foreach (['1' => $lang['7']."(Tf)", '2' => $lang['3']."(Vi)", '3' => $lang['2']."(Pi)", '4' => $lang['4']."(Ti)", '5' => $lang['6']."(Vf)", '6' => $lang['5']."(Pf)"] as $val => $name)
                            <option value="{{ $val }}">{!! $name !!}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Pressure 1 --}}
                @if (in_array($calculation, ['1', '2', '4', '5', '6']))
                    <div class="space-y-2">
                        <label for="pressure_one" class="font-s-14 text-blue">{{ $lang['2'] }} (Pᵢ):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="pressure_one" id="pressure_one" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $pressure_one_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['Pa', 'kPa', 'Bar', 'atm', 'mmHg', 'mbar'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('pressure_one_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Volume 1 --}}
                @if (in_array($calculation, ['1', '3', '4', '5', '6']))
                    <div class="space-y-2">
                        <label for="volume_one" class="font-s-14 text-blue">{{ $lang['3'] }} (Vᵢ):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="volume_one" id="volume_one" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $volume_one_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['m³', 'l', 'ml', 'ft³', 'in³'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('volume_one_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Temperature 1 --}}
                @if (in_array($calculation, ['1', '2', '3', '5', '6']))
                    <div class="space-y-2">
                        <label for="temp_one" class="font-s-14 text-blue">{{ $lang['4'] }} (Tᵢ):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="temp_one" id="temp_one" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $temp_one_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['°C', '°F', 'K'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('temp_one_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Pressure 2 --}}
                @if (in_array($calculation, ['1', '2', '3', '4', '5']))
                    <div class="space-y-2">
                        <label for="pressure_two" class="font-s-14 text-blue">{{ $lang['5'] }} (P𝒻):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="pressure_two" id="pressure_two" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $pressure_two_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['Pa', 'kPa', 'Bar', 'atm', 'mmHg', 'mbar'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('pressure_two_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Volume 2 --}}
                @if (in_array($calculation, ['1', '2', '3', '4', '6']))
                    <div class="space-y-2">
                        <label for="volume_two" class="font-s-14 text-blue">{{ $lang['6'] }} (V𝒻):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="volume_two" id="volume_two" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $volume_two_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['m³', 'l', 'ml', 'ft³', 'in³'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('volume_two_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Temperature 2 --}}
                @if (in_array($calculation, ['2', '3', '4', '5', '6']))
                    <div class="space-y-2">
                        <label for="temp_two" class="font-s-14 text-blue">{{ $lang['7'] }} (T𝒻):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="temp_two" id="temp_two" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $temp_two_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['°C', '°F', 'K'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('temp_two_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @elseif ($type == 'widget')
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
                    <div class="w-full rounded-lg mt-3">
                        <div class="w-full">
                            @if ($detail['method'] == '1')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $lang['7'] !!} (T𝒻) =</strong>
                                    <strong class="text-[#119154] text-[28px]">{!! round($detail['temperature'], 2) !!} (K)</strong>
                                </div>
                            @endif
                            @if ($detail['method'] == '2')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $lang['3'] !!} (Vᵢ) =</strong>
                                    <strong class="text-[#119154] text-[28px]">{!! round($detail['volume'], 2) !!} (m³)</strong>
                                </div>
                            @endif
                            @if ($detail['method'] == '3')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $lang['2'] !!} (Pᵢ) =</strong>
                                    <strong class="text-[#119154] text-[28px]">{!! round($detail['pressure'], 2) !!} (Pa)</strong>
                                </div>
                            @endif
                            @if ($detail['method'] == '6')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $lang['5'] !!} (P𝒻) =</strong>
                                    <strong class="text-[#119154] text-[28px]">{!! round($detail['pressure'], 2) !!} (Pa)</strong>
                                </div>
                            @endif
                            @if ($detail['method'] == '4')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $lang['4'] !!} (Tᵢ) =</strong>
                                    <strong class="text-[#119154] text-[28px]">{!! round($detail['temperature'], 2) !!} (K)</strong>
                                </div>
                            @endif
                            @if ($detail['method'] == '5')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $lang['6'] !!} (V𝒻) =</strong>
                                    <strong class="text-[#119154] text-[28px]">{!! round($detail['volume'], 2) !!} (m³)</strong>
                                </div>
                            @endif

                            @if (in_array($detail['method'], ['1', '4']))
                                <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">
                                                <strong>{{ $detail['method'] == '1' ? $lang['7'] : $lang['4'] }}</strong>
                                            </td>
                                            <td class="border-b py-2 ps-2">{!! round($detail['temperature'] - 273.15, 4) !!} (°C)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">
                                                <strong>{{ $detail['method'] == '1' ? $lang['7'] : $lang['4'] }}</strong>
                                            </td>
                                            <td class="py-2 ps-2">{!! round(($detail['temperature'] - 273.15) * (9 / 5) + 32, 4) !!} (°F)</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif

                            @if (in_array($detail['method'], ['2', '5']))
                                <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        @php
                                            $label = $detail['method'] == '5' ? $lang['6'] : $lang['3'];
                                            $vol = $detail['volume'];
                                        @endphp
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="border-b py-2 ps-2">{!! round($vol / 0.001, 4) !!} liters (l)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="border-b py-2 ps-2">{!! round($vol / 0.000001, 4) !!} milliliters (ml)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="border-b py-2 ps-2">{!! round($vol / 0.0283168, 4) !!} cubic feet (ft³)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="py-2 ps-2">{!! round($vol / 1.63871e-5, 4) !!} cubic inch (in³)</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif

                            @if (in_array($detail['method'], ['3', '6']))
                                <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        @php
                                            $label = $detail['method'] == '6' ? $lang['5'] : $lang['2'];
                                            $press = $detail['pressure'];
                                        @endphp
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="border-b py-2 ps-2">{!! round($press / 1000, 4) !!} kilopascals (kPa)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="border-b py-2 ps-2">{!! round($press / 100000, 4) !!} bars (bar)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="border-b py-2 ps-2">{!! round($press / 101325, 4) !!} standard atmospheres (atm)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="border-b py-2 ps-2">{!! round($press / 100, 4) !!} hectopascals (hPa)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2"><strong>{!! $label !!}</strong></td>
                                            <td class="py-2 ps-2">{!! round($press / 133.32, 4) !!} millimeters of mercury (mmHg)</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
