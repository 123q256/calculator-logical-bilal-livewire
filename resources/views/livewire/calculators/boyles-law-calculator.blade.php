<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2 relative">
                    <label for="find" class="font-s-14 text-blue">{!! $lang['9'] !!}:</label>
                    <select wire:model.live="find" id="find" class="input">
                        @foreach (['1' => $lang['4'], '2' => $lang['3'], '3' => $lang['2'], '4' => $lang['1'], '5' => $lang['5'], '6' => $lang['6']] as $val => $name)
                            <option value="{{ $val }}">{!! $name !!}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Pressure 1 --}}
                @if (in_array($find, ['1', '2', '3', '5', '6']))
                    <div class="space-y-2">
                        <label for="p1" class="font-s-14 text-blue">{{ $lang['1'] }} (p₁):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="p1" id="p1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $p1_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['Pa', 'Bar', 'Torr', 'psi', 'at', 'atm', 'hPa', 'MPa', 'kPa', 'GPa', 'mmHg', 'in Hg'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('p1_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Volume 1 --}}
                @if (in_array($find, ['1', '2', '4', '5', '6']))
                    <div class="space-y-2">
                        <label for="v1" class="font-s-14 text-blue">{{ $lang['2'] }} (V₁):</label>
                        <div class="relative w-full" x-data="{ open: false }">
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

                {{-- Pressure 2 --}}
                @if (in_array($find, ['1', '3', '4']))
                    <div class="space-y-2">
                        <label for="p2" class="font-s-14 text-blue">{{ $lang['3'] }} (p₂):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="p2" id="p2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $p2_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['Pa', 'Bar', 'Torr', 'psi', 'at', 'atm', 'hPa', 'MPa', 'kPa', 'GPa', 'mmHg', 'in Hg'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('p2_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Volume 2 --}}
                @if (in_array($find, ['2', '3', '4']))
                    <div class="space-y-2">
                        <label for="v2" class="font-s-14 text-blue">{{ $lang['4'] }} (V₂):</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="v2" id="v2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $v2_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['mm³', 'cm³', 'dm³', 'm³', 'in³', 'ft³', 'yd³', 'ml', 'liters'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('v2_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Temperature --}}
                @if ($find == '6')
                    <div class="space-y-2">
                        <label for="temp" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model="temp" id="temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $temp_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                @foreach (['°C', '°F', 'K'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('temp_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Amount (n) --}}
                @if ($find == '5')
                    <div class="space-y-2 relative">
                        <label for="amount" class="font-s-14 text-blue">{!! $lang['6'] !!} (n):</label>
                        <input type="number" step="any" wire:model="amount" id="amount" class="input" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">mol</span>
                    </div>
                @endif

                {{-- Gas Constant (R) --}}
                @if (in_array($find, ['5', '6']))
                    <div class="space-y-2 relative">
                        <label for="R" class="font-s-14 text-blue">{!! $lang['7'] !!} (R):</label>
                        <input type="number" step="any" wire:model="R" id="R" class="input" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">J⋅K⁻¹⋅mol⁻¹</span>
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
                            @if ($detail['method'] == '1' || $detail['method'] == '3')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $detail['content'] !!} =</strong>
                                    <strong class="text-[#119154] font-s-21">{!! round($detail['ans'], 2) !!}<span class="text-[#119154]"> (m³) </span></strong>
                                </div>
                            @endif
                            @if ($detail['method'] == '2' || $detail['method'] == '4')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $detail['content'] !!} =</strong>
                                    <strong class="text-[#119154] font-s-21">{!! round($detail['ans'], 2) !!}<span class="text-[#119154]"> (Pa) </span></strong>
                                </div>
                            @endif
                            @if ($detail['method'] == '5')
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                    <strong>{!! $detail['content'] !!} =</strong>
                                    <strong class="text-[#119154] font-s-21">{!! $detail['pooran'] !!}<span class="text-[#119154]"> (K)</span></strong>
                                </div>
                                <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                               <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['pooran'] - 273.15 !!} (°C)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="py-2 ps-2">{!! ($detail['pooran'] - 273.15) * (9 / 5) + 32 !!} (°F)</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($detail['method'] == '6')
                                <div class="col-12 text-center">
                                    <p><strong>{!! $detail['content'] !!}</strong></p>
                                    <p><strong class="text-[#119154] font-s-25">{!! $detail['final'] !!}</strong></p>
                                </div>
                            @endif
                            @if (in_array($detail['method'], ['1', '2', '3', '4']))
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 mt-2">
                                    <strong>{!! $lang['5'] !!} (t) =</strong>
                                    <strong class="text-[#119154] font-s-21">{!! $detail['temp'] !!} K</strong>
                                </div>
                                <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 mt-2">
                                    <strong>{!! $lang['6'] !!} (n) =</strong>
                                    <strong class="text-[#119154] font-s-21">{!! $detail['n'] !!} mol</strong>
                                </div>
                            @endif
                            @if ($detail['method'] == '1' || $detail['method'] == '3')
                                <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! round($detail['ans'] * 1000000000, 4) !!} (mm³)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! round($detail['ans'] * 1000000, 4) !!} (cm³)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! round($detail['ans'] * 1000, 4) !!} (dm³)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! round($detail['ans'] * 61024, 4) !!} (cu in)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! round($detail['ans'] * 35.315, 4) !!} (cu ft)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! round($detail['ans'] * 1000000, 4) !!} (ml)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="py-2 ps-2">{!! round($detail['ans'] * 1000, 2) !!} (liters)</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($detail['method'] == '2' || $detail['method'] == '4')
                                <p class="mt-3 mb-2"><strong>{!! $lang['8'] !!}:</strong></p>
                            <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.00001 !!} bars (bar)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.00014504 !!} pounds per square inch (psi)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.000010197 !!} technical atmospheres (at)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.00000987 !!} standard atmospheres (atm)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.0075 !!} torrs (Torr)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.01 !!} hectopascals (hPa)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.001 !!} kilopascals (kPa)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.000001 !!} megapascals (MPa)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.000000001 !!} megapascals (GPa)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="border-b py-2 ps-2">{!! $detail['ans'] * 0.0002953 !!} inches of mercury (in Hg)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">{!! $detail['content'] !!}</td>
                                            <td class="py-2 ps-2">{!! $detail['ans'] * 0.0075 !!} millimeters of mercury (mmHg)</td>
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
