<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="selection" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select wire:model.live="selection" id="selection" class="input">
                            @foreach (['1' => $lang['2']." (T₂) ", '2' => $lang['3']." (p₂) ", '3' => $lang['4']." (p₁) ", '4' => $lang['5']." (T₁) ", '5' => $lang['6']." (V) ", '6' => $lang['7']." (n) "] as $val => $name)
                                <option value="{{ $val }}">{!! $name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Pressure 1 --}}
                @if (in_array($selection, ['1', '2', '4', '5', '6']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="p1" class="label">{{ $lang['4'] }} (p₁):</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="p1" id="p1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $p1_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['Pa', 'Bar', 'psi', 'at', 'atm', 'Torr', 'hPa', 'kPa', 'MPa', 'GPa', 'inHg', 'mmHg'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('p1_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Temperature 1 --}}
                @if (in_array($selection, ['1', '2', '3', '5', '6']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="t1" class="label">{{ $lang['5'] }} (T₁):</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="t1" id="t1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $t1_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['°C', '°F', 'K'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('t1_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Pressure 2 --}}
                @if (in_array($selection, ['1', '3', '4']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="p2" class="label">{{ $lang['3'] }} (p₂):</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="p2" id="p2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $p2_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['Pa', 'Bar', 'psi', 'at', 'atm', 'Torr', 'hPa', 'kPa', 'MPa', 'GPa', 'inHg', 'mmHg'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('p2_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Temperature 2 --}}
                @if (in_array($selection, ['2', '3', '4']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="t2" class="label">{{ $lang['2'] }} (T₂):</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="t2" id="t2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $t2_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['°C', '°F', 'K'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('t2_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Volume --}}
                @if ($selection == '6')
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="v1" class="label">{{ $lang['6'] }} (V):</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="v1" id="v1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $v1_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['mm³', 'cm³', 'dm³', 'm³', 'in³', 'ft³', 'yd³', 'ml', 'liters'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('v1_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Amount of gas --}}
                @if ($selection == '5')
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="amount" class="label">{!! $lang['7'] !!} (n):</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="amount" id="amount" class="input" />
                            <span class="text-blue input_unit">mol</span>
                        </div>
                    </div>
                @endif

                {{-- Gas Constant --}}
                @if (in_array($selection, ['5', '6']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="R" class="label">{!! $lang['8'] !!} (R):</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="R" id="R" class="input" />
                            <span class="text-blue input_unit">J⋅K⁻¹⋅mol⁻¹</span>
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
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @php
                                $assign = '';
                                if ($detail['method'] == '1') $assign = $lang['2'] . ' (T₂)';
                                elseif ($detail['method'] == '4') $assign = $lang['5'] . ' (T₁)';
                                elseif ($detail['method'] == '2') $assign = $lang['3'] . ' (p₂)';
                                elseif ($detail['method'] == '3') $assign = $lang['4'] . ' (p₁)';
                                elseif ($detail['method'] == '6') $assign = $lang['7'] . ' (n)';
                                elseif ($detail['method'] == '5') $assign = $lang['6'] . ' (V)';
                            @endphp

                            @if (in_array($detail['method'], ['1', '4']))
                                <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2">
                                    <strong>{!! $assign !!} =</strong>
                                    <strong class="text-green-500 text-[21px]">{!! round($detail['temp'], 4) !!} <span class="text-green-500 text-[18px]">(K)</span></strong>
                                </div>
                            @endif

                            @if (in_array($detail['method'], ['2', '3']))
                                <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2">
                                    <strong>{!! $assign !!} =</strong>
                                    <strong class="text-green-500 text-[21px]">{!! round($detail['temp'], 4) !!} <span class="text-green-500 text-[18px]">(Pa)</span></strong>
                                </div>
                            @endif

                            @if ($detail['method'] == '5')
                                <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2">
                                    <strong>{!! $assign !!} =</strong>
                                    <strong class="text-green-500 text-[21px]">{!! round($detail['calculate_volume'], 4) !!} <span class="text-green-500 text-[18px]">(m³)</span></strong>
                                </div>
                                <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                                <div class="w-full overflow-auto lg:w-[80%] md:w-[80%]">
                                    <table class="w-full" cellspacing="0">
                                        @php $vol = $detail['calculate_volume']; @endphp
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($vol * 1e9, 4) !!} (mm³)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($vol * 1e6, 4) !!} (cm³)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($vol * 1000, 4) !!} (dm³)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($vol * 61023.7, 4) !!} (cu in)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($vol * 35.3147, 4) !!} (cu ft)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($vol * 1e6, 4) !!} (ml)</td></tr>
                                        <tr><td class="py-2 pe-2">{!! $assign !!}</td><td class="py-2 ps-2">{!! round($vol * 1000, 4) !!} (liters)</td></tr>
                                    </table>
                                </div>
                            @endif

                            @if ($detail['method'] == '6')
                                <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2">
                                    <strong>{!! $assign !!} =</strong>
                                    <strong class="text-green-500 text-[21px]">{!! round($detail['n'], 4) !!} <span class="text-green-500 text-[18px]">(mol)</span></strong>
                                </div>
                            @endif

                            @if (in_array($detail['method'], ['1', '4', '2', '3']))
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 mt-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2">
                                            <strong>Volume (V) =</strong>
                                            <strong class="text-green-500 text-[21px]">{!! round($detail['volume'] ?? 0, 4) !!} m³</strong>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2">
                                            <strong>Amount of gas (n) =</strong>
                                            <strong class="text-green-500 text-[21px]">{!! round($detail['amount_of_gas'] ?? 0, 4) !!} mol</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (in_array($detail['method'], ['1', '4']))
                                <p class="mt-3 mb-2"><strong>{!! $lang['9'] !!}:</strong></p>
                                <div class="w-full overflow-auto lg:w-[80%] md:w-[80%]">
                                    <table class="w-full" cellspacing="0">
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($detail['temp'] - 273.15, 4) !!} (°C)</td></tr>
                                        <tr><td class="py-2 pe-2">{!! $assign !!}</td><td class="py-2 ps-2">{!! round(($detail['temp'] - 273.15) * (9 / 5) + 32, 4) !!} (°F)</td></tr>
                                    </table>
                                </div>
                            @endif

                            @if (in_array($detail['method'], ['2', '3']))
                                <p class="mt-3 mb-2"><strong>{!! $lang['9'] !!}:</strong></p>
                                <div class="w-full overflow-auto lg:w-[80%] md:w-[80%]">
                                    <table class="w-full" cellspacing="0">
                                        @php $p = $detail['temp']; @endphp
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 1e-5, 6) !!} bars (bar)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 0.000145038, 6) !!} psi</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 1.0197e-5, 6) !!} technical atmospheres (at)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 9.8692e-6, 6) !!} standard atmospheres (atm)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 0.00750062, 6) !!} torrs (Torr)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 0.01, 6) !!} hectopascals (hPa)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 0.001, 6) !!} kilopascals (kPa)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 1e-6, 6) !!} megapascals (MPa)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 1e-9, 9) !!} gigapascals (GPa)</td></tr>
                                        <tr><td class="border-b py-2 pe-2">{!! $assign !!}</td><td class="border-b py-2 ps-2">{!! round($p * 0.0002953, 6) !!} in Hg</td></tr>
                                        <tr><td class="py-2 pe-2">{!! $assign !!}</td><td class="py-2 ps-2">{!! round($p * 0.00750062, 6) !!} mmHg</td></tr>
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
