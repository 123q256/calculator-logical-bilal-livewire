<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">

                    {{-- What to Find --}}
                    <div class="col-span-12 px-2">
                        <label for="find" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select wire:model.live="find" id="find" class="input">
                                <option value="energy">{{ $lang['2'] }}</option>
                                <option value="specific_heat">{{ $lang['3'] }}</option>
                                <option value="mass">{{ $lang['4'] }}</option>
                                <option value="itemp">{{ $lang['5'] . ' ' . $lang['23'] }}</option>
                                <option value="ftemp">{{ $lang['6'] . ' ' . $lang['23'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Temperature Calculation Method --}}
                    @if (in_array($find, ['energy', 'specific_heat', 'mass']))
                        <div id="by" class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <strong class="col-span-12 mt-2 px-2">{{ $lang[7] }}:</strong>
                                <div class="col-span-12 px-2 mb-3 mt-3 flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <input wire:model.live="by" id="change" class="mx-1" value="change"
                                            type="radio" />
                                        <label for="change" class="font-s-14 text-blue px-1">{{ $lang['8'] }}
                                            {{ $lang['10'] }} {{ $lang['19'] }} (ΔT)</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input wire:model.live="by" id="i_f_t" class="ms-2" value="i_f_t"
                                            type="radio" />
                                        <label for="i_f_t" class="font-s-14 text-blue px-1">{{ $lang['9'] }}
                                            {{ $lang['19'] }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Energy (Q) --}}
                    @if ($find !== 'energy')
                        <div class="col-span-6 px-2" id="q">
                            <label for="q_" class="font-s-14 text-blue">{{ $lang['2'] }} (Q):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="q" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('q_unit')">{{ $q_unit }} ▾</label>
                                @if ($openDropdown === 'q_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['J', 'kJ', 'mJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('q_unit', '{{ $val }}')">
                                                {{ $val }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Temperature Inputs --}}
                    @php
                        $showIT = ($find === 'ftemp' || ($by === 'i_f_t' && in_array($find, ['energy', 'specific_heat', 'mass'])));
                        $showFT = ($find === 'itemp' || ($by === 'i_f_t' && in_array($find, ['energy', 'specific_heat', 'mass'])));
                        $showDT = ($by === 'change' && in_array($find, ['energy', 'specific_heat', 'mass']));
                    @endphp

                    @if ($showIT)
                        <div class="col-span-6 px-2" id="it">
                            <label for="it_" class="font-s-14 text-blue">{{ $lang[5] . ' ' . $lang['19'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="it" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('it_unit')">{{ $it_unit }} ▾</label>
                                @if ($openDropdown === 'it_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['°C', '°F', 'K'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('it_unit', '{{ $val }}')">
                                                {{ $val }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($showFT)
                        <div class="col-span-6 px-2" id="ft">
                            <label for="ft_" class="font-s-14 text-blue">{{ $lang[6] . ' ' . $lang['19'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="ft" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('ft_unit')">{{ $ft_unit }} ▾</label>
                                @if ($openDropdown === 'ft_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['°C', '°F', 'K'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('ft_unit', '{{ $val }}')">
                                                {{ $val }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($showDT)
                        <div class="col-span-6 px-2" id="dt">
                            <label for="dt_"
                                class="font-s-14 text-blue">{{ $lang['8'] }} {{ $lang['10'] }} {{ $lang['19'] }} (ΔT):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="dt" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('dt_unit')">{{ $dt_unit }} ▾</label>
                                @if ($openDropdown === 'dt_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['°C', '°F', 'K'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('dt_unit', '{{ $val }}')">
                                                {{ $val }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mass (m) --}}
                    @if ($find !== 'mass')
                        <div class="col-span-6 px-2" id="m">
                            <label for="m_" class="font-s-14 text-blue">{{ $lang['4'] }} (m):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="m" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('m_unit')">{{ $m_unit }} ▾</label>
                                @if ($openDropdown === 'm_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['µg', 'mg', 'g', 'kg', 't', 'oz', 'lb', 'stone', 'US ton', 'Long ton', 'Earths', 'me', 'u', 'oz t'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('m_unit', '{{ $val }}')">
                                                {{ $val }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Specific Heat (c) --}}
                    @if ($find !== 'specific_heat')
                        <div class="col-span-6 px-2" id="c">
                            <label for="c_"
                                class="font-s-14 text-blue">{{ $lang['11'] }} {{ $lang['22'] }} (c):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="c" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('c_unit')">{{ $c_unit }} ▾</label>
                                @if ($openDropdown === 'c_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['J/(kg·K)', 'J/(g·K)', 'cal/(kg·K)', 'cal/(g·K)', 'kcal/(kg·K)', 'J/(kg·°C)', 'J/(g·°C)', 'cal/(kg·°C)', 'cal/(g·°C)', 'kcal/(kg·°C)'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('c_unit', '{{ $val }}')">
                                                {{ $val }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Substance Select --}}
                        <div class="col-span-6 px-2" id="sub">
                            <label for="subs" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="sub" id="subs" class="input">
                                    @php
                                        $substances = [
                                            'select' => 'Custom',
                                            '1460@Acetals (solid)' => 'Acetals (solid)',
                                            '1012@Air (gas, room cond.)' => 'Air (gas, room cond.)',
                                            '1003.5@Air (sea level, dry, 0°C' => 'Air (sea level, dry, 0°C',
                                            '897@Aluminum (solid)' => 'Aluminum (solid)',
                                            '4700@Ammonia (liquid)' => 'Ammonia (liquid)',
                                            '3500@Animal tissue (mixed)' => 'Animal tissue (mixed)',
                                            '207@Antimony (solid)' => 'Antimony (solid)',
                                            '520.3@Argon (gas)' => 'Argon (gas)',
                                            '328@Arsenic (solid)' => 'Arsenic (solid)',
                                            '920@Asphalt (solid)' => 'Asphalt (solid)',
                                            '1820@Beryllium (solid)' => 'Beryllium (solid)',
                                            '123@Bismuth (solid)' => 'Bismuth (solid)',
                                            '840@Brick (solid)' => 'Brick (solid)',
                                            '231@Cadmium (solid)' => 'Cadmium (solid)',
                                            '839@Carbon Dioxide (gas)' => 'Carbon Dioxide (gas)',
                                            '449@Chromium (solid)' => 'Chromium (solid)',
                                            '880@Concrete (solid)' => 'Concrete (solid)',
                                            '385@Copper (solid)' => 'Copper (solid)',
                                            '509.1@Diamond (solid)' => 'Diamond (solid)',
                                            '2440@Ethanol (liquid)' => 'Ethanol (liquid)',
                                            '2220@Gasoline (octane, liquid)' => 'Gasoline (octane, liquid)',
                                            '840@Glass (solid)' => 'Glass (solid)',
                                            '670@Glass, crown (solid)' => 'Glass, crown (solid)',
                                            '503@Glass, flint (solid)' => 'Glass, flint (solid)',
                                            '753@Glass, pyrex (solid)' => 'Glass, pyrex (solid)',
                                            '129@Gold (solid)' => 'Gold (solid)',
                                            '790@Granite (solid)' => 'Granite (solid)',
                                            '710@Graphite (solid)' => 'Graphite (solid)',
                                            '1090@Gypsum (solid)' => 'Gypsum (solid)',
                                            '5193.2@Helium (gas)' => 'Helium (gas)',
                                            '14300@Hydrogen (gas)' => 'Hydrogen (gas)',
                                            '1015@Hydrogen sulfide (gas)' => 'Hydrogen sulfide (gas)',
                                            '412@Iron (solid)' => 'Iron (solid)',
                                            '129@Lead (solid)' => 'Lead (solid)',
                                            '3580@Lithium (solid)' => 'Lithium (solid)',
                                            '4379@Lithium at 181°C (liquid)' => 'Lithium at 181°C (liquid)',
                                            '1020@Magnesium (solid)' => 'Magnesium (solid)',
                                            '880@Marble, mica (solid)' => 'Marble, mica (solid)',
                                            '139.5@Mercury (liquid)' => 'Mercury (liquid)',
                                            '2191@Methane at 2°C (gas)' => 'Methane at 2°C (gas)',
                                            '2140@Methanol (liquid)' => 'Methanol (liquid)',
                                            '1560@Molten salt (liquid)' => 'Molten salt (liquid)',
                                            '1030.1@Neon (gas)' => 'Neon (gas)',
                                            '1040@Nitrogen (gas)' => 'Nitrogen (gas)',
                                            '918@Oxygen (gas)' => 'Oxygen (gas)',
                                            '2500@Paraffin wax (solid)' => 'Paraffin wax (solid)',
                                            '2302.7@Polyethylene (solid)' => 'Polyethylene (solid)',
                                            '835@Sand (solid)' => 'Sand (solid)',
                                            '703@Silica (fused) (solid)' => 'Silica (fused) (solid)',
                                            '233@Silver[31] (solid)' => 'Silver[31] (solid)',
                                            '1230@Sodium (solid)' => 'Sodium (solid)',
                                            '800@Soil (solid)' => 'Soil (solid)',
                                            '466@Steel (solid)' => 'Steel (solid)',
                                            '227@Tin (solid)' => 'Tin (solid)',
                                            '523@Titanium (solid)' => 'Titanium (solid)',
                                            '134@Tungsten (solid)' => 'Tungsten (solid)',
                                            '116@Uranium (solid)' => 'Uranium (solid)',
                                            '2050@Water at -10 °C (ice) (solid)' => 'Water at -10 °C (ice) (solid)',
                                            '4181.3@Water at 25 °C (liquid)' => 'Water at 25 °C (liquid)',
                                            '2080@Water at 100 °C (gas)' => 'Water at 100 °C (gas)',
                                            '1700@Wood (1200 to 2900) (solid)' => 'Wood (1200 to 2900) (solid)',
                                            '387@Zinc (solid)' => 'Zinc (solid)',
                                        ];
                                    @endphp
                                    @foreach ($substances as $v => $n)
                                        <option value="{{ $v }}">{{ $n }}</option>
                                    @endforeach
                                </select>
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
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="col s12 padding_20 padding_10_mbl form-bg">
                                    @if (isset($detail['q']))
                                        <div class="text-center">
                                            <p class="text-[18px]"><strong>{{ $lang[2] }}</strong></p>
                                            <p class="text-[21px] bg-white px-3 py-2 radius-10 inline-block my-3 shadow-sm border border-gray-100">
                                                <strong class="text-blue">{{ $detail['q'] }} J</strong>
                                            </p>
                                        </div>
                                    @elseif(isset($detail['c']))
                                        <div class="col-lg-8 mt-2 overflow-auto">
                                            <table class="w-full text-[18px]">
                                                <tr>
                                                    <td class="text-blue py-2 border-b">{{ $lang['11'] }} {{ $lang['13'] }}
                                                    </td>
                                                    <td class="py-2 border-b"><strong>{{ $detail['c'] }}</strong>
                                                        J/(kg·K)</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <p class="mt-4 mb-2"><strong>Result in other units:</strong></p>
                                        <div class="col-lg-8 mt-2 overflow-auto">
                                            <table class="w-full text-[18px]">
                                                <tr>
                                                    <td class="text-blue py-2 border-b">{{ $lang['11'] }} {{ $lang['13'] }}
                                                    </td>
                                                    <td class="py-2 border-b"><strong>{{ $detail['c'] * 0.001 }}</strong>
                                                        J/(g·K)</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-blue py-2 border-b">{{ $lang['11'] }} {{ $lang['13'] }}
                                                    </td>
                                                    <td class="py-2 border-b">
                                                        <strong>{{ $detail['c'] * 0.2388915 }}</strong> cal/(kg·K)</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-blue py-2 border-b">{{ $lang['11'] }} {{ $lang['13'] }}
                                                    </td>
                                                    <td class="py-2 border-b">
                                                        <strong>{{ $detail['c'] * 0.0002388915 }}</strong> kcal/(kg·K)</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-blue py-2 border-b">{{ $lang['11'] }} {{ $lang['13'] }}
                                                    </td>
                                                    <td class="py-2 border-b"><strong>{{ $detail['c'] * 0.001 }}</strong>
                                                        J/(g·°C)</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @elseif(isset($detail['m']))
                                        <div class="text-center">
                                            <p class="text-[18px]"><strong>{{ $lang[4] }}</strong></p>
                                            <p class="text-[21px] bg-sky-50 px-3 py-2 my-3 inline-block shadow-sm border border-sky-100">
                                                <strong class="text-blue">{{ $detail['m'] }} kg</strong>
                                            </p>
                                        </div>
                                    @elseif(isset($detail['it']))
                                        <div class="text-center">
                                            <p class="text-[18px]"><strong>{{ $lang[5] }}</strong></p>
                                            <p class="text-[21px] bg-sky-50 px-3 py-2 my-3 inline-block shadow-sm border border-sky-100">
                                                <strong class="text-blue">{{ $detail['it'] }} K</strong>
                                            </p>
                                        </div>
                                    @elseif(isset($detail['ft']))
                                        <div class="text-center">
                                            <p class="text-[18px]"><strong>{{ $lang[6] }}</strong></p>
                                            <p class="text-[21px] bg-sky-50 px-3 py-2 my-3 inline-block shadow-sm border border-sky-100">
                                                <strong class="text-blue">{{ $detail['ft'] }} K</strong>
                                            </p>
                                        </div>
                                    @endif

                                    @if (isset($detail['sub']))
                                        <p class="col-12 mt-3"><strong>{{ $lang['14'] }} {{ $detail['sub1'] }}
                                                {{ $lang['15'] }} {{ $detail['sub'] }}</strong></p>
                                    @endif
                                </div>

                                {{-- Steps --}}
                                <div wire:ignore wire:key="steps-{{ md5(json_encode($detail)) }}">
                                    <p class="col-12 mt-3 text-[18px]"><strong class="text-blue">{{ $lang['16'] }}</strong>
                                    </p>
                                    @if (isset($detail['q']))
                                        <p class="col-12 mt-3"><strong>{{ $lang['2'] }} {{ $lang['17'] }}</strong></p>
                                        <p class="col-12 mt-3">\( Q = { m c \Delta T} \)</p>
                                        <p class="col-12 mt-3"><strong>{{ $lang['18'] }}</strong></p>
                                        <p class="col-12 mt-3">\( m = \text{ {{ $lang['4'] }} } \)</p>
                                        <p class="col-12 mt-3">\( c = \text{ {{ $lang['11'] }} {{ $lang['13'] }} } \)</p>
                                        @if (isset($detail['check']) && $detail['check'] === 'q_i_f')
                                            <p class="col-12 mt-3">\( T_i = \text{ {{ $lang['5'] }} {{ $lang['19'] }} } \)
                                            </p>
                                            <p class="col-12 mt-3">\( T_f = \text{ {{ $lang['6'] }} {{ $lang['19'] }} } \)
                                            </p>
                                            <p class="col-12 mt-3">\( Q = {{ $detail['q1'] }},\space c =
                                                {{ $detail['c1'] }},\space T_i = {{ $detail['it1'] }},\space T_f =
                                                {{ $detail['ft1'] }} \)</p>
                                            <p class="col-12 mt-3"><strong>{{ $lang['1'] }} {{ $lang['8'] }}
                                                    {{ $lang['20'] }} {{ $lang['23'] }}</strong></p>
                                            <p class="col-12 mt-3">\( \Delta T = T_f - T_i \)</p>
                                            <p class="col-12 mt-3">\( \Delta T = {{ $detail['ft1'] }} - {{ $detail['it1'] }}
                                                \)</p>
                                            <p class="col-12 mt-3">\( \Delta T = {{ $detail['ft1'] - $detail['it1'] }} \)</p>
                                        @else
                                            <p class="col-12 mt-3">\( \Delta T = \text{ {{ $lang['8'] }}
                                                {{ $lang['20'] }} {{ $lang['19'] }} } \)</p>
                                            <p class="col-12 mt-3">\( Q = {{ $detail['q1'] }},\space c =
                                                {{ $detail['c1'] }},\space \Delta T = {{ $detail['dt1'] }} \)</p>
                                        @endif
                                        <p class="col-12 mt-3"><strong>{{ $lang['21'] }}</strong></p>
                                        <p class="col-12 mt-3">\( Q = {m c \Delta T} \)</p>
                                        <p class="col-12 mt-3">\( Q = {( {{ $detail['m1'] }} ) ( {{ $detail['c1'] }} ) (
                                            {{ $detail['dt1'] }} )} \)</p>
                                        <p class="col-12 mt-3">\( Q = {( {{ $detail['s'] }} ) ( {{ $detail['dt1'] }} )} \)</p>
                                        <p class="col-12 mt-3">\( Q = {{ $detail['q'] }} \)</p>
                                    @elseif(isset($detail['c']))
                                        <p class="col-12 mt-3"><strong>{{ $lang['3'] }} {{ $lang['17'] }}</strong></p>
                                        <p class="col-12 mt-3">\( c = \dfrac{Q}{m \Delta T} \)</p>
                                        <p class="col-12 mt-3"><strong>{{ $lang['18'] }}</strong></p>
                                        <p class="col-12 mt-3">\( Q = \text{ {{ $lang['2'] }} } \)</p>
                                        <p class="col-12 mt-3">\( m = \text{ {{ $lang['4'] }} } \)</p>
                                        @if (isset($detail['check']) && $detail['check'] === 'c_i_f')
                                            <p class="col-12 mt-3">\( T_i = \text{ {{ $lang['5'] }} {{ $lang['19'] }} } \)
                                            </p>
                                            <p class="col-12 mt-3">\( T_f = \text{ {{ $lang['6'] }} {{ $lang['19'] }} } \)
                                            </p>
                                            <p class="col-12 mt-3">\( Q = {{ $detail['q1'] }},\space m =
                                                {{ $detail['m1'] }},\space T_i = {{ $detail['it1'] }},\space T_f =
                                                {{ $detail['ft1'] }} \)</p>
                                            <p class="col-12 mt-3"><strong>{{ $lang['1'] }} {{ $lang['8'] }}
                                                    {{ $lang['20'] }} {{ $lang['23'] }}</strong></p>
                                            <p class="col-12 mt-3">\( \Delta T = T_f - T_i \)</p>
                                            <p class="col-12 mt-3">\( \Delta T = {{ $detail['ft1'] }} - {{ $detail['it1'] }}
                                                \)</p>
                                            <p class="col-12 mt-3">\( \Delta T = {{ $detail['ft1'] - $detail['it1'] }} \)</p>
                                        @else
                                            <p class="col-12 mt-3">\( \Delta T = \text{ {{ $lang['8'] }}
                                                {{ $lang['20'] }} {{ $lang['19'] }} } \)</p>
                                            <p class="col-12 mt-3">\( Q = {{ $detail['q1'] }},\space m =
                                                {{ $detail['m1'] }},\space \Delta T = {{ $detail['dt1'] }} \)</p>
                                        @endif
                                        <p class="col-12 mt-3"><strong>{{ $lang['21'] }}</strong></p>
                                        <p class="col-12 mt-3">\( c = \dfrac{Q}{m \Delta T} \)</p>
                                        <p class="col-12 mt-3">\( c = \dfrac{ {{ $detail['q1'] }} }{ ( {{ $detail['m1'] }}
                                            )( {{ $detail['dt1'] }} ) } \)</p>
                                        <p class="col-12 mt-3">\( c = \dfrac{ {{ $detail['q1'] }} }{ {{ $detail['s'] }} } \)</p>
                                        <p class="col-12 mt-3">\( c = {{ $detail['c'] }} \)</p>
                                    @elseif(isset($detail['m']))
                                        <p class="col-12 mt-3"><strong>{{ $lang['4'] }} {{ $lang['17'] }}</strong></p>
                                        <p class="col-12 mt-3">\( m = \dfrac{Q}{c \Delta T} \)</p>
                                        <p class="col-12 mt-3"><strong>{{ $lang['18'] }}</strong></p>
                                        <p class="col-12 mt-3">\( Q = \text{ {{ $lang['2'] }} } \)</p>
                                        <p class="col-12 mt-3">\( c = \text{ {{ $lang['11'] }} {{ $lang['13'] }} } \)</p>
                                        @if (isset($detail['check']) && $detail['check'] === 'm_i_f')
                                            <p class="col-12 mt-3">\( T_i = \text{ {{ $lang['5'] }} {{ $lang['19'] }} } \)
                                            </p>
                                            <p class="col-12 mt-3">\( T_f = \text{ {{ $lang['6'] }} {{ $lang['19'] }} } \)
                                            </p>
                                            <p class="col-12 mt-3">\( Q = {{ $detail['q1'] }},\space c =
                                                {{ $detail['c1'] }},\space T_i = {{ $detail['it1'] }},\space T_f =
                                                {{ $detail['ft1'] }} \)</p>
                                            <p class="col-12 mt-3"><strong>{{ $lang['1'] }} {{ $lang['8'] }}
                                                    {{ $lang['20'] }} {{ $lang['23'] }}</strong></p>
                                            <p class="col-12 mt-3">\( \Delta T = T_f - T_i \)</p>
                                            <p class="col-12 mt-3">\( \Delta T = {{ $detail['ft1'] }} - {{ $detail['it1'] }}
                                                \)</p>
                                            <p class="col-12 mt-3">\( \Delta T = {{ $detail['ft1'] - $detail['it1'] }} \)</p>
                                        @else
                                            <p class="col-12 mt-3">\( \Delta T = \text{ {{ $lang['8'] }}
                                                {{ $lang['20'] }} {{ $lang['19'] }} } \)</p>
                                            <p class="col-12 mt-3">\( Q = {{ $detail['q1'] }},\space c =
                                                {{ $detail['c1'] }},\space \Delta T = {{ $detail['dt1'] }} \)</p>
                                        @endif
                                        <p class="col-12 mt-3"><strong>{{ $lang['21'] }}</strong></p>
                                        <p class="col-12 mt-3">\( m = \dfrac{Q}{c \Delta T} \)</p>
                                        <p class="col-12 mt-3">\( m = \dfrac{ {{ $detail['q1'] }} }{ ( {{ $detail['c1'] }}
                                            )( {{ $detail['dt1'] }} ) } \)</p>
                                        <p class="col-12 mt-3">\( m = \dfrac{ {{ $detail['q1'] }} }{ {{ $detail['s'] }} } \)</p>
                                        <p class="col-12 mt-3">\( m = {{ $detail['m'] }} \)</p>
                                    @elseif(isset($detail['it']))
                                        <p class="col-12 mt-3"><strong>{{ $lang['5'] }} {{ $lang['23'] }}
                                                {{ $lang['17'] }}</strong></p>
                                        <p class="col-12 mt-3">\( T_i = \dfrac{Q}{m c} - T_f \)</p>
                                        <p class="col-12 mt-3"><strong>{{ $lang['18'] }}</strong></p>
                                        <p class="col-12 mt-3">\( Q = \text{ {{ $lang['2'] }} } \)</p>
                                        <p class="col-12 mt-3">\( m = \text{ {{ $lang['4'] }} } \)</p>
                                        <p class="col-12 mt-3">\( c = \text{ {{ $lang['11'] }} {{ $lang['13'] }} } \)</p>
                                        <p class="col-12 mt-3">\( T_f = \text{ {{ $lang['6'] }} {{ $lang['19'] }} } \)</p>
                                        <p class="col-12 mt-3">\( Q = {{ $detail['q1'] }},\space m =
                                            {{ $detail['m1'] }},\space c = {{ $detail['c1'] }},\space T_f =
                                            {{ $detail['ft1'] }} \)</p>
                                        <p class="col-12 mt-3"><strong>{{ $lang['21'] }}</strong></p>
                                        <p class="col-12 mt-3">\( T_i = \dfrac{Q}{m c} - T_f \)</p>
                                        <p class="col-12 mt-3">\( T_i = \dfrac{ {{ $detail['q1'] }} }{ (
                                            {{ $detail['m1'] }} ) ( {{ $detail['c1'] }} ) } - {{ $detail['ft1'] }} \)</p>
                                        <p class="col-12 mt-3">\( T_i = \dfrac{ {{ $detail['q1'] }} }{ {{ $detail['s'] }} } -
                                            {{ $detail['ft1'] }} \)</p>
                                        <p class="col-12 mt-3">\( T_i = {{ $detail['s1'] }} - {{ $detail['ft1'] }} \)</p>
                                        <p class="col-12 mt-3">\( T_i = {{ $detail['it'] }} \)</p>
                                    @elseif(isset($detail['ft']))
                                        <p class="col-12 mt-3"><strong>{{ $lang['6'] }} {{ $lang['19'] }}
                                                {{ $lang['17'] }}</strong></p>
                                        <p class="col-12 mt-3">\( T_f = \dfrac{Q}{m c} + T_i \)</p>
                                        <p class="col-12 mt-3"><strong>{{ $lang['18'] }}</strong></p>
                                        <p class="col-12 mt-3">\( Q = \text{ {{ $lang['2'] }} } \)</p>
                                        <p class="col-12 mt-3">\( m = \text{ {{ $lang['4'] }} } \)</p>
                                        <p class="col-12 mt-3">\( c = \text{ {{ $lang['11'] }} {{ $lang['13'] }} } \)</p>
                                        <p class="col-12 mt-3">\( T_i = \text{ {{ $lang['5'] }} {{ $lang['19'] }} } \)</p>
                                        <p class="col-12 mt-3">\( Q = {{ $detail['q1'] }},\space m =
                                            {{ $detail['m1'] }},\space c = {{ $detail['c1'] }},\space T_i =
                                            {{ $detail['it1'] }} \)</p>
                                        <p class="col-12 mt-3"><strong>{{ $lang['21'] }}</strong></p>
                                        <p class="col-12 mt-3">\( T_f = \dfrac{Q}{m c} + T_i \)</p>
                                        <p class="col-12 mt-3">\( T_f = \dfrac{ {{ $detail['q1'] }} }{ (
                                            {{ $detail['m1'] }} ) ( {{ $detail['c1'] }} ) } + {{ $detail['it1'] }} \)</p>
                                        <p class="col-12 mt-3">\( T_f = \dfrac{ {{ $detail['q1'] }} }{ {{ $detail['s'] }} } +
                                            {{ $detail['it1'] }} \)</p>
                                        <p class="col-12 mt-3">\( T_f = {{ $detail['s1'] }} + {{ $detail['it1'] }} \)</p>
                                        <p class="col-12 mt-3">\( T_f = {{ $detail['ft'] }} \)</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @if (isset($detail))
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morph.updated', () => {
                    setTimeout(() => {
                        if (window.MathJax) {
                            MathJax.typesetPromise();
                        }
                    }, 50);
                });
            });
        </script>
    @endif
</div>
