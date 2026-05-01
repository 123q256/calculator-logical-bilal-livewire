
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <!-- Tabs -->
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                    <div class="flex flex-wrap items-center bg-blue-50 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div wire:click="setUnitType('wire_size')" class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300 hover:bg-blue-600 hover:text-white {{ $unit_type == 'wire_size' ? 'tagsUnit' : '' }}">
                                {{ $lang['1'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div wire:click="setUnitType('wire_diameter')" class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300 hover:bg-blue-600 hover:text-white {{ $unit_type == 'wire_diameter' ? 'tagsUnit' : '' }}">
                                {{ $lang['2'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div wire:click="setUnitType('wire_gauge')" class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300 hover:bg-blue-600 hover:text-white {{ $unit_type == 'wire_gauge' ? 'tagsUnit' : '' }}">
                                {{ $lang['3'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 mt-4 gap-4">
                    <!-- Wire Size Section -->
                    @if($unit_type == 'wire_size')
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 md:col-span-6">
                                <label for="type" class="font-s-14 text-blue">{{ $lang['36'] }}/{{ $lang['37'] }}:</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="type" class="input">
                                        <option value="single_phase">{{ $lang['36'] }}</option>
                                        <option value="three_phase">{{ $lang['37'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Source Voltage -->
                            <div class="col-span-12 md:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" step="any" wire:model="s_voltage" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label wire:click="toggleDropdown('sv_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">
                                        {{ $sv_units }} ▾
                                    </label>
                                    @if($openDropdown === 'sv_units')
                                    <div wire:click.away="toggleDropdown(null)" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach(['mV', 'V', 'kV', 'MV'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sv_units', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Voltage Drop -->
                            <div class="col-span-12 md:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model="voltage_drop" class="input" placeholder="3" />
                                    <span class="text-blue input_unit">%</span>
                                </div>
                            </div>
                            <!-- Material -->
                            <div class="col-span-12 md:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="c_units" class="input">
                                        <option value="copper">{{ $lang['38'] }}</option>
                                        <option value="aluminum">{{ $lang['39'] }}</option>
                                        <option value="gold">{{ $lang['40'] }}</option>
                                        <option value="silver">{{ $lang['41'] }}</option>
                                        <option value="nickel">{{ $lang['42'] }}</option>
                                        <option value="steel">{{ $lang['43'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Current -->
                            <div class="col-span-12 md:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" step="any" wire:model="current" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label wire:click="toggleDropdown('current_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4">
                                        {{ $current_unit }} ▾
                                    </label>
                                    @if($openDropdown === 'current_unit')
                                    <div wire:click.away="toggleDropdown(null)" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach(['A', 'mA', 'µA'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('current_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Wire Length -->
                            <div class="col-span-12 md:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" step="any" wire:model="wire_length" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label wire:click="toggleDropdown('wl_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">
                                        {{ $wl_units }} ▾
                                    </label>
                                    @if($openDropdown === 'wl_units')
                                    <div wire:click.away="toggleDropdown(null)" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach(['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wl_units', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Temperature -->
                            <div class="col-span-12 md:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" step="any" wire:model="w_temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label wire:click="toggleDropdown('wt_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">
                                        {{ $wt_units }} ▾
                                    </label>
                                    @if($openDropdown === 'wt_units')
                                    <div wire:click.away="toggleDropdown(null)" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach(['°C', '°F', 'K'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wt_units', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                <!-- Wire Diameter Section -->
                @if($unit_type == 'wire_diameter')
                <div class="col-span-12">
                    <label class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="wire_gauge" class="input">
                            @php
                                $name = ["2000 kcmil", "1750 kcmil", "1500 kcmil", "1250 kcmil", "1000 kcmil", "900 kcmil", "800 kcmil", "750 kcmil", "700 kcmil", "600 kcmil", "500 kcmil", "400 kcmil", "350 kcmil", "300 kcmil", "250 kcmil", "0000 (4/0) AWG", "000 (3/0) AWG", "00 (2/0) AWG", "0 (1/0) AWG", "1 AWG", "2 AWG", "3 AWG", "4 AWG", "5 AWG", "6 AWG", "7 AWG", "8 AWG", "9 AWG", "10 AWG", "11 AWG", "12 AWG", "13 AWG", "14 AWG", "15 AWG", "16 AWG", "17 AWG", "18 AWG", "19 AWG", "20 AWG", "21 AWG", "22 AWG", "23 AWG", "24 AWG", "25 AWG", "26 AWG", "27 AWG", "28 AWG", "29 AWG", "30 AWG", "31 AWG", "32 AWG", "33 AWG", "34 AWG", "35 AWG", "36 AWG", "37 AWG", "38 AWG", "39 AWG", "40 AWG"];
                                $val = ["2000-kcmil", "1750-kcmil", "1500-kcmil", "1250-kcmil", "1000-kcmil", "900-kcmil", "800-kcmil", "750-kcmil", "700-kcmil", "600-kcmil", "500-kcmil", "400-kcmil", "350-kcmil", "300-kcmil", "250-kcmil", "0000 (4/0)", "000 (3/0)", "00 (2/0)", "0 (1/0)", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40"];
                            @endphp
                            @foreach($name as $index => $text)
                                <option value="{{ $val[$index] }}">{{ $text }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                <!-- Wire Gauge Section -->
                @if($unit_type == 'wire_gauge')
                <div class="col-span-12">
                    <label class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" step="any" wire:model="wire_diameter" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                        <label wire:click="toggleDropdown('wd_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">
                            {{ $wd_units }} ▾
                        </label>
                        @if($openDropdown === 'wd_units')
                        <div wire:click.away="toggleDropdown(null)" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['in', 'mm', 'cm'] as $u)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wd_units', '{{ $u }}')">{{ $u }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endif
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
                <script>
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement(document.getElementById('result-section'));
                    }
                </script>
                <div class="">
                    @if ($type_calc == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-[18px] overflow-auto">
                                @if ($detail['submit'] == 'wire_size')
                                    @if ($detail['type'] == 'single_phase')
                                        @php $res = round($detail['single_phase'], 2) @endphp
                                        <div class="w-full mt-2 overflow-auto">
                                            <table class="w-full text-[18px]">
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} </strong></td><td class="py-2 border-b"> {{ $detail['s_data'][1] }} {{ $lang[14] }}</td></tr>
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[15] }} </strong></td><td class="py-2 border-b"> {{ $res }} mm<sup>2</sup></td></tr>
                                            </table>
                                            <p class="w-full mt-3">{{ $lang['16'] }}</p>
                                            <table class="w-full text-[18px]">
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[17] }} </strong></td><td class="py-2 border-b"> {{ $res * 0.000001 }} m²</td></tr>
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[18] }} </strong></td><td class="py-2 border-b"> {{ round($res * 0.00155, 5) }} in²</td></tr>
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[19] }} </strong></td><td class="py-2 border-b"> {{ round($res * 1973.6, 4) }} cmil</td></tr>
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[20] }} </strong></td><td class="py-2 border-b"> {{ round($res * 1.9736, 2) }} kcmil</td></tr>
                                            </table>
                                        </div>
                                        <!-- Calculation Steps -->
                                        <div class="mt-6 text-[20px]  overflow-auto p-4 rounded-lg">
                                            <p class="font-bold  underline mb-3">{{ $lang[21] }}</p>
                                            <p class="mt-2 text-base">\(A(m^2)= \dfrac{I(A) \times ρ(Ω·m) \times L(m) }{V_V}\)</p>
                                            <p class="mt-2"><strong>Where:</strong> A = {{ $lang[22] }}, ρ = {{ $lang[23] }}, L = {{ $lang[24] }}, I = {{ $lang[25] }}, v = {{ $lang[26] }}, V = Source voltage</p>
                                            <div class="mt-4 space-y-1">
                                                <p>{{ $lang[28] }} (ρ) = {{ $detail['c_units'] }} ({{ $detail['metalunit'] }}) Ω⋅m</p>
                                                <p>{{ $lang[29] }} (L) = {{ $detail['wire_length'] }} m</p>
                                                <p>{{ $lang[30] }} (I) = {{ $detail['current'] }} A</p>
                                                <p>Source voltage (V) = {{ $detail['s_voltage'] }} V</p>
                                                <p>{{ $lang[31] }} (v) = {{ $detail['voltage_drop'] }} %</p>
                                            </div>
                                            <p class="mt-4 font-bold">{{ $lang[32] }}</p>
                                            <p class="mt-2">\(A(m^2)= \dfrac{I(A) \times ρ(Ω·m) \times L(m) }{V_V}\)</p>
                                            <p class="mt-2 text-base">\(= \dfrac{ {{ $detail['current'] }} \times {{ round($detail['metalunit'], 2) }} \times 10^{-8} \times (2 \times {{ $detail['wire_length'] }}) }{ {{ $detail['voltage_drop']/100 }} \times {{ $detail['s_voltage'] }} }\)</p>
                                            <p class="mt-2">\(= \dfrac{ {{ $detail['res'] }} }{ {{ $detail['v'] }} }\)</p>
                                            <p class="mt-2">\(= {{ $detail['am'] }} m^2 \)</p>
                                            <p class="mt-2 font-bold">{{ $lang[33] }} {{ $detail['s_data'][1] }}AWG {{ $lang[34] }} {{ round($detail['single_phase'], 2) }} mm² {{ $lang[35] }}.</p>
                                        </div>
                                    @elseif($detail['type'] == 'three_phase')
                                        @php $res1 = round($detail['three_phase'], 2) @endphp
                                        <div class="w-full mt-2">
                                            <table class="w-full text-[18px]">
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} </strong></td><td class="py-2 border-b"> {{ $detail['t_data'][1] }} AWG</td></tr>
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[15] }} </strong></td><td class="py-2 border-b"> {{ $res1 }} mm<sup>2</sup></td></tr>
                                            </table>
                                            <p class="w-full mt-3">{{ $lang['16'] }}</p>
                                            <table class="w-full text-[18px]">
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[17] }} </strong></td><td class="py-2 border-b"> {{ $res1 * 0.000001 }} m²</td></tr>
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[18] }} </strong></td><td class="py-2 border-b"> {{ round($res1 * 0.00155, 5) }} in²</td></tr>
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[19] }} </strong></td><td class="py-2 border-b"> {{ round($res1 * 1973.6, 4) }} cmil</td></tr>
                                                <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[20] }} </strong></td><td class="py-2 border-b"> {{ round($res1 * 1.9736, 2) }} kcmil</td></tr>
                                            </table>
                                        </div>
                                        <!-- Calculation Steps -->
                                        <div class="mt-6 text-[20px]  p-4 rounded-lg overflow-auto">
                                            <p class="font-bold underline mb-3">{{ $lang['21'] }}</p>
                                            <p class="mt-2 text-base">\(A(m^2)= \dfrac{\sqrt{3} \times ρ(Ω·m) \times L(m) \times I(A)}{V_V}\)</p>
                                            <p class="mt-4 font-bold">{{ $lang['32'] }}</p>
                                            <p class="mt-2 text-base">\(= \dfrac{ {{ round($detail['sqrt'], 4) }} \times {{ $detail['metalunit'] }}\times 10^{-8} \times {{ $detail['wire_length'] }} \times {{ $detail['current'] }}}{ {{ $detail['voltage_drop']/100 }} \times {{ $detail['s_voltage'] }} }\)</p>
                                            <p class="mt-2">\(= \dfrac{ {{ $detail['res'] }} }{ {{ $detail['v'] }} }\)</p>
                                            <p class="mt-2 font-bold">{{ $lang['33'] }} {{ $detail['t_data'][1] }}AWG {{ $lang['34'] }} {{ $detail['three_phase'] }} mm² {{ $lang['35'] }}.</p>
                                        </div>
                                    @endif
                                @elseif($detail['submit'] == 'wire_diameter')
                                    <div class="w-full mt-2">
                                        <p class="w-full font-bold mb-2">{{ $lang['12'] }}</p>
                                        <table class="w-full text-[18px]">
                                            <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[44] }}</strong></td><td class="py-2 border-b"> {{ round($detail['inches'], 4) }} in</td></tr>
                                            <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[45] }}</strong></td><td class="py-2 border-b"> {{ round($detail['mm'], 4) }} mm</td></tr>
                                        </table>
                                        <p class="w-full font-bold mt-4 mb-2">{{ $lang['15'] }}</p>
                                        <table class="w-full text-[18px]">
                                            <tr><td class="py-2 border-b" width="70%"><strong>kcmil</strong></td><td class="py-2 border-b"> {{ round($detail['kcmil'], 4) }} kcmil</td></tr>
                                            <tr><td class="py-2 border-b" width="70%"><strong>Square Inches</strong></td><td class="py-2 border-b"> {{ round($detail['sqinches'], 4) }} in<sup>2</sup></td></tr>
                                            <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[47] }}</strong></td><td class="py-2 border-b"> {{ round($detail['mm2'], 4) }} mm<sup>2</sup></td></tr>
                                        </table>
                                    </div>
                                @elseif ($detail['submit'] == 'wire_gauge')
                                    <div class="w-full mt-2">
                                        <p class="w-full font-bold mb-2">{{ $lang['13'] }}</p>
                                        <table class="w-full text-[18px]">
                                            <tr><td class="py-2 border-b" width="70%"><strong>AWG</strong></td><td class="py-2 border-b"> {{ $detail['d_data'][1] }} AWG</td></tr>
                                            <tr><td class="py-2 border-b" width="70%"><strong>Diameter inches</strong></td><td class="py-2 border-b"> {{ $detail['d_data'][0] }} in</td></tr>
                                            <tr><td class="py-2 border-b" width="70%"><strong>Diameter millimeters</strong></td><td class="py-2 border-b"> {{ $detail['d_data'][2]['mm'] }} mm</td></tr>
                                        </table>
                                        <p class="w-full font-bold mt-4 mb-2">{{ $lang['15'] }}</p>
                                        <table class="w-full text-[18px]">
                                            <tr><td class="py-2 border-b" width="70%"><strong>kcmil</strong></td><td class="py-2 border-b"> {{ $detail['d_data'][2]['kcmil'] }} kcmil</td></tr>
                                            <tr><td class="py-2 border-b" width="70%"><strong>Square Inches</strong></td><td class="py-2 border-b"> {{ round($detail['square_in'], 2) }} in<sup>2</sup></td></tr>
                                            <tr><td class="py-2 border-b" width="70%"><strong>{{ $lang[47] }}</strong></td><td class="py-2 border-b"> {{ $detail['d_data'][2]['mm²'] }} mm<sup>2</sup></td></tr>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script src="{{ url('katex/katex.min.js') }}"></script>
        <script src="{{ url('katex/auto-render.min.js') }}"></script>
    @endpush
