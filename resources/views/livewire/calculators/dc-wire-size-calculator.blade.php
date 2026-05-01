<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="w-full mx-auto mt-2 lg:w-[90%] md:w-[90%]">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="setUnitType('wire_size')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $wire == 'wire_size' ? 'tagsUnit' : '' }}">
                            {{ $lang['1'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="setUnitType('wire_diameter')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $wire == 'wire_diameter' ? 'tagsUnit' : '' }}">
                            {{ $lang['2'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="setUnitType('wire_gauge')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $wire == 'wire_gauge' ? 'tagsUnit' : '' }}">
                            {{ $lang['3'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    @if($wire == 'wire_size')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="calc_type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                                    <div class="w-full py-2">
                                        <select wire:model.live="calc_type" id="calc_type" class="input">
                                            <option value="single_phase">{{ $lang['36'] }}</option>
                                            <option value="three_phase">{{ $lang['37'] }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="s_voltage" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="s_voltage" id="s_voltage" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label wire:click="toggleDropdown('sv_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $sv_units }} ▾</label>
                                        @if($openDropdown == 'sv_units')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sv_units', 'mV')">mV</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sv_units', 'V')">V</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sv_units', 'kV')">kV</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sv_units', 'MV')">MV</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="voltage_drop" class="font-s-14 text-blue">{{ $lang[6] }}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model="voltage_drop" id="voltage_drop" class="input" />
                                        <span class="text-blue input_unit">%</span>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="c_units" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                                    <div class="w-full py-2">
                                        <select wire:model="c_units" id="c_units" class="input">
                                            <option value="copper">{{ $lang['38'] }}</option>
                                            <option value="aluminum">{{ $lang['39'] }}</option>
                                            <option value="gold">{{ $lang['40'] }}</option>
                                            <option value="silver">{{ $lang['41'] }}</option>
                                            <option value="nickel">{{ $lang['42'] }}</option>
                                            <option value="steel">{{ $lang['43'] }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="current" class="font-s-14 text-blue">{{ $lang[8] }}:</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="current" id="current" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label wire:click="toggleDropdown('current_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $current_unit }} ▾</label>
                                        @if($openDropdown == 'current_unit')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('current_unit', 'A')">A</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('current_unit', 'mA')">mA</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('current_unit', 'µA')">µA</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="wire_length" class="font-s-14 text-blue">{{ $lang[9] }}:</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="wire_length" id="wire_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label wire:click="toggleDropdown('wl_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $wl_units }} ▾</label>
                                        @if($openDropdown == 'wl_units')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-40 overflow-y-auto">
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wl_units', 'cm')">cm</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wl_units', 'm')">m</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wl_units', 'km')">km</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wl_units', 'in')">in</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wl_units', 'ft')">ft</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wl_units', 'yd')">yd</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wl_units', 'mi')">mi</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="w_temp" class="font-s-14 text-blue">{{ $lang[10] }}:</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="w_temp" id="w_temp" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label wire:click="toggleDropdown('wt_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $wt_units }} ▾</label>
                                        @if($openDropdown == 'wt_units')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wt_units', '°C')">°C</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wt_units', '°F')">°F</p>
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wt_units', 'K')">K</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($wire == 'wire_diameter')
                        <div class="col-span-12">
                            <label for="wire_gauge" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="wire_gauge" id="wire_gauge" class="input">
                                    @php
                                        $val = ["2000-kcmil", "1750-kcmil", "1500-kcmil","1250-kcmil", "1000-kcmil", "900-kcmil","800-kcmil", "750-kcmil", "700-kcmil", "600-kcmil","500-kcmil", "400-kcmil", "350-kcmil","300-kcmil", "250-kcmil", "0000 (4/0)","000 (3/0)","00 (2/0)","0 (1/0)","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40"];
                                        $name = ["2000 kcmil", "1750 kcmil", "1500 kcmil","1250 kcmil","1000 kcmil","900 kcmil","800 kcmil","750 kcmil","700 kcmil","600 kcmil","500 kcmil","400 kcmil","350 kcmil","300 kcmil","250 kcmil","0000 (4/0) AWG","000 (3/0) AWG","00 (2/0) AWG","0 (1/0) AWG","1 AWG","2 AWG","3 AWG","4 AWG","5 AWG","6 AWG","7 AWG","8 AWG","9 AWG","10 AWG","11 AWG","12 AWG","13 AWG","14 AWG","15 AWG","16 AWG","17 AWG","18 AWG","19 AWG","20 AWG","21 AWG","22 AWG","23 AWG","24 AWG","25 AWG","26 AWG","27 AWG","28 AWG","29 AWG","30 AWG","31 AWG","32 AWG","33 AWG","34 AWG","35 AWG","36 AWG","37 AWG","38 AWG","39 AWG","40 AWG"];
                                    @endphp
                                    @foreach($val as $index => $v)
                                        <option value="{{ $v }}">{{ $name[$index] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if($wire == 'wire_gauge')
                        <div class="col-span-12">
                            <label for="wire_diameter" class="font-s-14 text-blue">{{ $lang[12] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="wire_diameter" id="wire_diameter" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label wire:click="toggleDropdown('wd_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $wd_units }} ▾</label>
                                @if($openDropdown == 'wd_units')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wd_units', 'in')">in</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wd_units', 'mm')">mm</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wd_units', 'cm')">cm</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <script>
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement(document.getElementById('result-section'));
                    }
                </script>
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            @if ($detail['submit'] == 'wire_size')
                                @if ($detail['type'] == 'single_phase')
                                    @php $res = round($detail['single_phase'], 2) @endphp
                                    <div class="lg:w-1/2 mt-2">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['13'] }}</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ $detail['s_data'][1] }} {{ $lang[14] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['15'] }}</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['single_phase'], 2) }} mm<sup class="text-blue">2</sup></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full my-3 text-[18px]">{{ $lang[16] }}</p>
                                    <div class="w-full overflow-auto">
                                        <table class="w-full border-collapse">
                                            <thead>
                                                <tr class="bg-[#2845F5]">
                                                    <td class="p-2 border text-center"><strong class="text-white">{{ $lang[17] }}</strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-white">{{ $lang['18'] }}</strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-white">{{ $lang['19'] }}</strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-white">{{ $lang['20'] }}</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-[#F6FAFC]">
                                                    <td class="text-center p-2 border">{{ $res * 0.000001 }}m²</td>
                                                    <td class="text-center p-2 border">{{ round($res * 0.00155, 5) }}in²</td>
                                                    <td class="text-center p-2 border">{{ round($res * 1973.6, 4) }}cmil</td>
                                                    <td class="text-center p-2 border">{{ round($res * 1.9736, 2) }}kcmil</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-6 space-y-2">
                                        <p class="font-bold text-[18px]">{{ $lang[21] }}</p>
                                        <p>\(A(m^2)= \dfrac{I(A) \times ρ(Ω·m) \times L(m) }{V_V}\)</p>
                                        <p><strong>Where:</strong> A = {{ $lang[22] }}, ρ = {{ $lang[23] }}, L = {{ $lang[24] }}, I = {{ $lang[25] }}, v = {{ $lang[26] }}, V = Source voltage</p>
                                        <p class="font-bold pt-2">{{ $lang['27'] }}</p>
                                        <p>ρ = {{ $detail['c_units'] }} ({{ $detail['metalunit'] }}) Ω⋅m</p>
                                        <p>L = {{ $detail['wire_length'] }} m</p>
                                        <p>I = {{ $detail['current'] }} A</p>
                                        <p>V = {{ $detail['s_voltage'] }} V</p>
                                        <p>v = {{ $detail['voltage_drop'] }} %</p>
                                        <p class="font-bold pt-2">{{ $lang[32] }}</p>
                                        <p>\(A(m^2)= \dfrac{ {{ $detail['current'] }} \times {{ round($detail['metalunit'], 2) }} \times 10^{-8} \times (2 \times {{ $detail['wire_length'] }}) }{ {{ $detail['voltage_drop'] / 100 }} \times {{ $detail['s_voltage'] }} }\)</p>
                                        <p>\(= \dfrac{ {{ $detail['res'] }} }{ {{ $detail['v'] }} }\)</p>
                                        <p>\(= {{ $detail['am'] }} mm \times 1,000,000\)</p>
                                        <p>\(= {{ round($detail['single_phase'], 2) }} mm^2\)</p>
                                        <p class="font-bold text-blue-700">{{ $lang[33] }} {{ $detail['s_data'][1] }}AWG {{ $lang[34] }} {{ round($detail['single_phase'], 2) }} mm² {{ $lang[35] }}.</p>
                                    </div>
                                @endif

                                @if ($detail['type'] == 'three_phase')
                                    @php $res1 = round($detail['three_phase'], 2) @endphp
                                    <div class="lg:w-1/2 mt-2">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['13'] }}</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t_data'][1] }} AWG</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['15'] }}</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['three_phase'], 2) }} mm<sup class="text-blue">2</sup></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full my-3 text-[18px]">{{ $lang[16] }}</p>
                                    <div class="w-full overflow-auto">
                                        <table class="w-full border-collapse">
                                            <thead>
                                                <tr class="bg-[#2845F5]">
                                                    <td class="p-2 border text-center"><strong class="text-white">{{ $lang['17'] }}</strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-white">{{ $lang['18'] }}</strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-white">{{ $lang['19'] }}</strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-white">{{ $lang['20'] }}</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-[#F6FAFC]">
                                                    <td class="p-2 border text-center">{{ $res1 * 0.000001 }}m²</td>
                                                    <td class="p-2 border text-center">{{ round($res1 * 0.00155, 5) }}in²</td>
                                                    <td class="p-2 border text-center">{{ round($res1 * 1973.6, 4) }}cmil</td>
                                                    <td class="p-2 border text-center">{{ round($res1 * 1.9736, 2) }}kcmil</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-6 space-y-2">
                                        <p class="font-bold text-[18px]">{{ $lang['21'] }}</p>
                                        <p>\(A(m^2)= \dfrac{\sqrt{3} \times ρ(Ω·m) \times L(m) \times I(A)}{V_V}\)</p>
                                        <p><strong>Where:</strong> A = {{ $lang['22'] }}, ρ = {{ $lang['23'] }}, L = {{ $lang['24'] }}, I = {{ $lang['25'] }}, v = {{ $lang['26'] }}, V = Source voltage</p>
                                        <p class="font-bold pt-2">{{ $lang['27'] }}</p>
                                        <p>ρ = {{ $detail['c_units'] }} ({{ $detail['metalunit'] }}) Ω⋅m</p>
                                        <p>L = {{ $detail['wire_length'] }} m</p>
                                        <p>I = {{ $detail['current'] }} A</p>
                                        <p>V = {{ $detail['s_voltage'] }} V</p>
                                        <p>v = {{ $detail['voltage_drop'] }} %</p>
                                        <p class="font-bold pt-2">{{ $lang['32'] }}</p>
                                        <p>\(A(m^2)= \dfrac{\sqrt{3} \times ρ(Ω·m) \times L(m) \times I(A)}{V_V}\)</p>
                                        <p>\(= \dfrac{ {{ round($detail['sqrt'], 4) }} \times {{ $detail['metalunit'] }}\times 10^{-8} \times {{ $detail['wire_length'] }} \times {{ $detail['current'] }} }{ {{ $detail['voltage_drop'] / 100 }} \times {{ $detail['s_voltage'] }} }\)</p>
                                        <p>\(= \dfrac{ {{ $detail['res'] }} }{ {{ $detail['v'] }} }\)</p>
                                        <p>\(= {{ $detail['am'] }} \times 1,000,000\)</p>
                                        <p>\(= {{ $detail['three_phase'] }} mm^2\)</p>
                                        <p class="font-bold text-blue-700">{{ $lang['33'] }} {{ $detail['t_data'][1] }}AWG {{ $lang['34'] }} {{ $detail['three_phase'] }} mm² {{ $lang['35'] }}.</p>
                                    </div>
                                @endif
                            @endif

                            @if ($detail['submit'] == 'wire_diameter')
                                <p class="w-full my-3 text-[18px]">{{ $lang[12] }}</p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full border-collapse">
                                        <thead>
                                            <tr class="bg-[#2845F5]">
                                                <td class="p-2 border text-center"><strong class="text-white">{{ $lang['44'] }}</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-white">{{ $lang['45'] }}</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center">{{ round($detail['inches'], 4) }} in</td>
                                                <td class="p-2 border text-center">{{ round($detail['mm'], 4) }} mm</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="w-full my-3 text-[18px]">{{ $lang[15] }}</p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full border-collapse">
                                        <thead>
                                            <tr class="bg-[#2845F5]">
                                                <td class="p-2 border text-center"><strong class="text-white">kcmil</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-white">{{ $lang['46'] }}</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-white">{{ $lang['47'] }}</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center">{{ round($detail['kcmil'], 4) }} kcmil</td>
                                                <td class="p-2 border text-center">{{ round($detail['sqinches'], 4) }} in<sup class="text-blue">2</sup></td>
                                                <td class="p-2 border text-center">{{ round($detail['mm2'], 2) }} mm<sup class="text-blue">2</sup></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if ($detail['submit'] == 'wire_gauge')
                                <p class="w-full my-3 text-[18px]">{{ $lang[13] }}</p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full border-collapse">
                                        <thead>
                                            <tr class="bg-[#2845F5]">
                                                <td class="p-2 border text-center"><strong class="text-white">AWG</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-white">{{ $lang['48'] }}</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-white">{{ $lang['49'] }}</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center">{{ $detail['d_data'][1] }} AWG</td>
                                                <td class="p-2 border text-center">{{ $detail['d_data'][0] }} in</td>
                                                <td class="p-2 border text-center">{{ $detail['d_data'][2]['mm'] }} mm</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="w-full my-3 text-[18px]">{{ $lang[15] }}</p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full border-collapse">
                                        <thead>
                                            <tr class="bg-[#2845F5]">
                                                <td class="p-2 border text-center"><strong class="text-white">kcmil</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-white">{{ $lang['46'] }}</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-white">{{ $lang['47'] }}</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center">{{ $detail['d_data'][2]['kcmil'] }} kcmil</td>
                                                <td class="p-2 border text-center">{{ round($detail['square_in'], 2) }} in<sup>2</sup></td>
                                                <td class="p-2 border text-center">{{ $detail['d_data'][2]['mm²'] }} mm<sup>2</sup></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script src="{{ url('katex/katex.min.js') }}"></script>
        <script src="{{ url('katex/auto-render.min.js') }}"></script>
    @endpush
</div>
