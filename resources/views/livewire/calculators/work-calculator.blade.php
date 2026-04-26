<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Method Selection --}}
                    <div class="space-y-2">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['calculate'] }}:</label>
                        <select wire:model.live="method" id="method" class="input">
                            <option value="work">Work</option>
                            <option value="power">Power</option>
                        </select>
                    </div>

                    {{-- Work Sub-Method --}}
                    @if ($method === 'work')
                        <div class="space-y-2">
                            <label for="method1" class="font-s-14 text-blue">{{ $lang['calculate'] }}
                                {{ $lang['1'] }}:</label>
                            <select wire:model.live="method1" id="method1" class="input">
                                <option value="fnd">{{ $lang['2'] }} & {{ $lang['3'] }}</option>
                                <option value="velocity">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    @endif
                </div>

                {{-- Find Options (Radios) --}}
                <div class="grid grid-cols-1 gap-4 mt-4">
                    <div class="col-12 px-2 py-2 border-t border-gray-100">
                        <p class="mb-2"><strong class="text-black">{{ $lang['5'] }}: </strong></p>
                        <div class="flex flex-wrap gap-4">
                            @if ($method === 'work' && $method1 === 'fnd')
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find" type="radio" value="work" class="mr-2">
                                    <span class="text-black">{{ $lang['6'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find" type="radio" value="force" class="mr-2">
                                    <span class="text-black">{{ $lang['2'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find" type="radio" value="dsplcmnt" class="mr-2">
                                    <span class="text-black">{{ $lang['3'] }}</span>
                                </label>
                            @elseif ($method === 'work' && $method1 === 'velocity')
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find2" type="radio" value="work2" class="mr-2">
                                    <span class="text-black">{{ $lang['6'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find2" type="radio" value="v0" class="mr-2">
                                    <span class="text-black">{{ $lang['9'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find2" type="radio" value="v1" class="mr-2">
                                    <span class="text-black">{{ $lang['11'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find2" type="radio" value="mass" class="mr-2">
                                    <span class="text-black">{{ $lang['10'] }}</span>
                                </label>
                            @elseif ($method === 'power')
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find1" type="radio" value="power" class="mr-2">
                                    <span class="text-black">{{ $lang['7'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find1" type="radio" value="work1" class="mr-2">
                                    <span class="text-black">{{ $lang['6'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input wire:model.live="find1" type="radio" value="time" class="mr-2">
                                    <span class="text-black">{{ $lang['8'] }}</span>
                                </label>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Inputs Grid --}}
                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4 mt-4">
                    {{-- Force (F) --}}
                    @php
                        $showF = ($method === 'work' && $method1 === 'fnd' && in_array($find, ['work', 'dsplcmnt']));
                    @endphp
                    @if ($showF)
                        <div class="space-y-2">
                            <label for="f" class="font-s-14 text-blue">{{ $lang['2'] }} (F)</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="f" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('f_unit')">{{ strtoupper($f_unit) }} ▾</label>
                                @if ($openDropdown === 'f_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-32 mt-1 right-0">
                                        @foreach (['n' => 'N', 'kn' => 'KN', 'mn' => 'MN', 'gn' => 'GN', 'tn' => 'TN'] as $v => $n)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('f_unit', '{{ $v }}')">
                                                {{ $n }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Displacement (d) --}}
                    @php
                        $showD = ($method === 'work' && $method1 === 'fnd' && in_array($find, ['work', 'force']));
                    @endphp
                    @if ($showD)
                        <div class="space-y-2">
                            <label for="d" class="font-s-14 text-blue">{{ $lang['3'] }} (d)</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="d" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('d_unit')">{{ $d_unit }} ▾</label>
                                @if ($openDropdown === 'd_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-32 mt-1 right-0">
                                        @foreach (['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'nmi'] as $v)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('d_unit', '{{ $v }}')">
                                                {{ $v }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mass (m) --}}
                    @php
                        $showM = ($method === 'work' && $method1 === 'velocity' && in_array($find2, ['work2', 'v0', 'v1']));
                    @endphp
                    @if ($showM)
                        <div class="space-y-2">
                            <label for="m" class="font-s-14 text-blue">{{ $lang['10'] }} (m)</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="m" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('m_unit')">{{ $m_unit }} ▾</label>
                                @if ($openDropdown === 'm_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-32 mt-1 right-0">
                                        @foreach (['mg', 'g', 'kg', 't', 'oz', 'lb', 'stone', 'us_ton', 'long_ton'] as $v)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('m_unit', '{{ $v }}')">
                                                {{ str_replace('_', ' ', $v) }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Initial Velocity (v0) --}}
                    @php
                        $showV0 = ($method === 'work' && $method1 === 'velocity' && in_array($find2, ['work2', 'v1', 'mass']));
                    @endphp
                    @if ($showV0)
                        <div class="space-y-2">
                            <label for="v0" class="font-s-14 text-blue">{{ $lang['9'] }} (v₀)</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="v0" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('v0_unit')">{{ $v0_unit === 'ms' ? 'm/s' : $v0_unit }} ▾</label>
                                @if ($openDropdown === 'v0_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-32 mt-1 right-0">
                                        @foreach (['ms' => 'm/s', 'kmh' => 'km/h', 'fts' => 'ft/s', 'mph' => 'mph', 'knots' => 'knots', 'ftmin' => 'ft/min'] as $v => $n)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('v0_unit', '{{ $v }}')">
                                                {{ $n }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Final Velocity (v1) --}}
                    @php
                        $showV1 = ($method === 'work' && $method1 === 'velocity' && in_array($find2, ['work2', 'v0', 'mass']));
                    @endphp
                    @if ($showV1)
                        <div class="space-y-2">
                            <label for="v1" class="font-s-14 text-blue">{{ $lang['11'] }} (v₁)</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="v1" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('v1_unit')">{{ $v1_unit === 'ms' ? 'm/s' : $v1_unit }} ▾</label>
                                @if ($openDropdown === 'v1_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-32 mt-1 right-0">
                                        @foreach (['ms' => 'm/s', 'kmh' => 'km/h', 'fts' => 'ft/s', 'mph' => 'mph', 'knots' => 'knots', 'ftmin' => 'ft/min'] as $v => $n)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('v1_unit', '{{ $v }}')">
                                                {{ $n }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Work (W) as Input --}}
                    @php
                        $showW = ($method === 'power' && in_array($find1, ['power', 'time'])) ||
                                 ($method === 'work' && $method1 === 'fnd' && in_array($find, ['force', 'dsplcmnt'])) ||
                                 ($method === 'work' && $method1 === 'velocity' && in_array($find2, ['v0', 'v1', 'mass']));
                    @endphp
                    @if ($showW)
                        <div class="space-y-2">
                            <label for="w" class="font-s-14 text-blue">{{ $lang['6'] }} (W)</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="w" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('w_unit')">{{ $w_unit }} ▾</label>
                                @if ($openDropdown === 'w_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-32 mt-1 right-0">
                                        @foreach (['J', 'kJ', 'mJ', 'Wh', 'kWh', 'ft_lbs', 'kcal', 'eV'] as $v)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('w_unit', '{{ $v }}')">
                                                {{ str_replace('_', '-', $v) }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Power (P) --}}
                    @php
                        $showP = ($method === 'power' && in_array($find1, ['work1', 'time']));
                    @endphp
                    @if ($showP)
                        <div class="space-y-2">
                            <label for="p" class="font-s-14 text-blue">{{ $lang['7'] }} (P)</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="p" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('p_unit')">{{ $p_unit }} ▾</label>
                                @if ($openDropdown === 'p_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-32 mt-1 right-0">
                                        @foreach (['mW', 'W', 'kW', 'MW', 'gw', 'btu_h', 'hp_l'] as $v)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('p_unit', '{{ $v }}')">
                                                {{ strtoupper(str_replace('_', '/', $v)) }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Time (t) --}}
                    @php
                        $showT = ($method === 'power' && in_array($find1, ['power', 'work1']));
                    @endphp
                    @if ($showT)
                        <div class="space-y-2">
                            <label for="t" class="font-s-14 text-blue">{{ $lang['8'] }} (t)</label>
                            <div class="relative w-full ">
                                <input type="number" wire:model.live="t" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('t_unit')">{{ $t_unit }} ▾</label>
                                @if ($openDropdown === 't_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-32 mt-1 right-0">
                                        @foreach (['sec', 'min', 'hrs', 'days', 'wks', 'mos', 'yrs'] as $v)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('t_unit', '{{ $v }}')">
                                                {{ $v }}</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full radius-10 mt-3">
                            <div class="w-full  mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>
                                                @if (isset($detail['work']) || isset($detail['work1']) || isset($detail['work2']))
                                                    {{ $lang['6'] }}
                                                @elseif(isset($detail['force']))
                                                    {{ $lang['2'] }}
                                                @elseif(isset($detail['dsplcmnt']))
                                                    {{ $lang['3'] }}
                                                @elseif(isset($detail['i_v']))
                                                    {{ $lang['9'] }}
                                                @elseif(isset($detail['f_v']))
                                                    {{ $lang['11'] }}
                                                @elseif(isset($detail['mass']))
                                                    {{ $lang['10'] }}
                                                @elseif(isset($detail['power']))
                                                    {{ $lang['7'] }}
                                                @elseif(isset($detail['time']))
                                                    {{ $lang['8'] }}
                                                @endif
                                            </strong></td>
                                        <td class="py-2 border-b">
                                            @if (isset($detail['work']) || isset($detail['work1']) || isset($detail['work2']))
                                                {{ $detail['w'] }} J
                                            @elseif(isset($detail['force']))
                                                {{ $detail['f'] }} N
                                            @elseif(isset($detail['dsplcmnt']))
                                                {{ $detail['d'] }} m
                                            @elseif(isset($detail['i_v']))
                                                {{ $detail['v0'] }} m/s
                                            @elseif(isset($detail['f_v']))
                                                {{ $detail['v1'] }} m/s
                                            @elseif(isset($detail['mass']))
                                                {{ $detail['m'] }} kg
                                            @elseif(isset($detail['power']))
                                                {{ $detail['p'] }} W
                                            @elseif(isset($detail['time']))
                                                {{ $detail['t'] }} sec
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full">
                                <div class="mt-2" wire:ignore wire:key="steps-{{ md5(json_encode($detail)) }}">
                                    <p class="mt-2">{{ $lang['12'] }}:</p>
                                    @if (isset($detail['work']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">W = F * D</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">F = {{ $detail['f'] }}, D = {{ $detail['d'] }}, W = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">W = F * D</p>
                                        <p class="mt-2">W = {{ $detail['f'] }} * {{ $detail['d'] }}</p>
                                        <p class="mt-2">W = <strong>{{ $detail['w'] }}</strong></p>
                                    @elseif(isset($detail['force']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">F = W / D</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">W = {{ $detail['w'] }}, D = {{ $detail['d'] }}, F = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">F = W / D</p>
                                        <p class="mt-2">F = {{ $detail['w'] }} / {{ $detail['d'] }}</p>
                                        <p class="mt-2">F = <strong>{{ $detail['f'] }}</strong></p>
                                    @elseif(isset($detail['dsplcmnt']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">D = W / F</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">W = {{ $detail['w'] }}, F = {{ $detail['f'] }}, D = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">D = W / F</p>
                                        <p class="mt-2">D = {{ $detail['w'] }} / {{ $detail['f'] }}</p>
                                        <p class="mt-2">D = <strong>{{ $detail['d'] }}</strong></p>
                                    @elseif(isset($detail['work1']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">W = (m/2) * (v₁² - v₀²)</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">m = {{ $detail['f'] }}, v₀ = {{ $detail['v0'] }}, v₁ =
                                            {{ $detail['v1'] }}, W = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">W = (m/2) * (v₁² - v₀²)</p>
                                        <p class="mt-2">W = ({{ $detail['m'] }} / 2) * (({{ $detail['v1'] }})² -
                                            ({{ $detail['v0'] }})²)</p>
                                        <p class="mt-2">W = ({{ $detail['s1'] }}) * ({{ $detail['s2'] }} -
                                            {{ $detail['s3'] }})</p>
                                        <p class="mt-2">W = ({{ $detail['s1'] }}) * ({{ $detail['s4'] }})</p>
                                        <p class="mt-2">W = <strong>{{ $detail['w'] }}</strong></p>
                                    @elseif(isset($detail['i_v']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">v₀ = v₁² - ((2/m) * w)</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">w = {{ $detail['w'] }}, m = {{ $detail['m'] }}, v₁ =
                                            {{ $detail['v1'] }}, v₀ = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">v₀ = &radic;<span class="b_t">v₁² - ((2/m) * w)</span></p>
                                        <p class="mt-2">v₀ = &radic;<span class="b_t">({{ $detail['v1'] }})² -
                                                ((2/{{ $detail['m'] }}) * {{ $detail['w'] }})</span></p>
                                        <p class="mt-2">v₀ = &radic;<span class="b_t">({{ $detail['s1'] }}) -
                                                ({{ $detail['s2'] }} * {{ $detail['w'] }})</span></p>
                                        <p class="mt-2">v₀ = &radic;<span class="b_t">{{ $detail['s1'] }} -
                                                {{ $detail['s3'] }}</span></p>
                                        <p class="mt-2">v₀ = &radic;<span class="b_t">{{ $detail['s4'] }}</span></p>
                                        <p class="mt-2">v₀ = <strong>{{ $detail['v0'] }}</strong></p>
                                    @elseif(isset($detail['f_v']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">v₁ = v₀² + ((2/m) * w)</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">w = {{ $detail['w'] }}, m = {{ $detail['m'] }}, v₀ =
                                            {{ $detail['v0'] }}, v₁ = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">v₁ = &radic;<span class="b_t">v₀² + ((2/m) * w)</span></p>
                                        <p class="mt-2">v₁ = &radic;<span class="b_t">({{ $detail['v0'] }})² +
                                                ((2/{{ $detail['m'] }}) * {{ $detail['w'] }})</span></p>
                                        <p class="mt-2">v₁ = &radic;<span class="b_t">({{ $detail['s1'] }}) +
                                                ({{ $detail['s2'] }} * {{ $detail['w'] }})</span></p>
                                        <p class="mt-2">v₁ = &radic;<span class="b_t">{{ $detail['s1'] }} +
                                                {{ $detail['s3'] }}</span></p>
                                        <p class="mt-2">v₁ = &radic;<span class="b_t">{{ $detail['s4'] }}</span></p>
                                        <p class="mt-2">v₁ = <strong>{{ $detail['v1'] }}</strong></p>
                                    @elseif(isset($detail['mass']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">m = 2w / (v₁² - v₀²)</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">w = {{ $detail['w'] }}, v₀ = {{ $detail['v0'] }}, v₁ =
                                            {{ $detail['v1'] }}, m = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">m = 2w / (v₁² - v₀²)</p>
                                        <p class="mt-2">m = (2*{{ $detail['w'] }}) / (({{ $detail['v1'] }})² -
                                            ({{ $detail['v0'] }})²)</p>
                                        <p class="mt-2">m = {{ $detail['s1'] }} / ({{ $detail['s2'] }} -
                                            {{ $detail['s3'] }})</p>
                                        <p class="mt-2">m = {{ $detail['s1'] }} / {{ $detail['s4'] }}</p>
                                        <p class="mt-2">m = <strong>{{ $detail['m'] }}</strong></p>
                                    @elseif(isset($detail['power']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">P = W / T</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">W = {{ $detail['w'] }}, T = {{ $detail['t'] }}, P = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">P = W / T</p>
                                        <p class="mt-2">P = {{ $detail['w'] }} / {{ $detail['t'] }}</p>
                                        <p class="mt-2">P = <strong>{{ $detail['p'] }}</strong></p>
                                    @elseif(isset($detail['work2']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">W = P * T</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">P = {{ $detail['p'] }}, T = {{ $detail['t'] }}, W = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">W = P * T</p>
                                        <p class="mt-2">W = {{ $detail['p'] }} * {{ $detail['t'] }}</p>
                                        <p class="mt-2">W = <strong>{{ $detail['w'] }}</strong></p>
                                    @elseif(isset($detail['time']))
                                        <p class="mt-2"><strong>{{ $lang['13'] }}</strong></p>
                                        <p class="mt-2">T = W / P</p>
                                        <p class="mt-2"><strong>{{ $lang['14'] }}</strong></p>
                                        <p class="mt-2">W = {{ $detail['w'] }}, P = {{ $detail['p'] }}, T = ?</p>
                                        <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                                        <p class="mt-2">T = W / P</p>
                                        <p class="mt-2">T = {{ $detail['w'] }} / {{ $detail['p'] }}</p>
                                        <p class="mt-2">T = <strong>{{ $detail['t'] }}</strong></p>
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
