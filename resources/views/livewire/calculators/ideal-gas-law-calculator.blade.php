<div>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">

                    {{-- ── Method Select ── --}}
                    <div class="space-y-2 relative">
                        <label for="method" class="font-s-14 text-blue">{!! $lang['to_cal'] !!}:</label>
                        <select wire:model.live="method" id="method" class="input">
                            <option value="press">{{ $lang['p'] }}</option>
                            <option value="temp">{{ $lang['t'] }}</option>
                            <option value="volume">{{ $lang['v'] }}</option>
                            <option value="sub">{{ $lang['s'] }}</option>
                        </select>
                    </div>

                    {{-- ── X Input ── --}}
                    <div class="space-y-2">
                        <label class="font-s-14 text-blue">
                            @if ($method === 'volume')
                                {{ $lang['t'] }}
                            @else
                                {{ $lang['v'] }}
                            @endif
                        </label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="x"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            {{-- X Volume Unit (press / temp / sub) --}}
                            @if (in_array($method, ['press', 'temp', 'sub']))
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('x_v_unit')">
                                        {{ $x_v_unit }} ▾
                                    </label>
                                    <input type="hidden" name="x_v_unit" value="{{ $x_v_unit }}">
                                    @if ($openDropdown === 'x_v_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[70%] md:w-[70%] w-[90%] mt-1 right-0">
                                            @foreach ([['m³', 'cubic meters (m³)'], ['cm³', 'cubic centimeters (cm³)'], ['mm³', 'cubic millimeters (mm³)'], ['dm³', 'cubic decimeters (dm³)'], ['ft³', 'cubic feet (ft³)'], ['in³', 'cubic inches (in³)']] as [$val, $label])
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('x_v_unit', '{{ $val }}')">
                                                    {{ $label }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- X Temperature Unit (volume) --}}
                            @if ($method === 'volume')
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('x_t_unit')">
                                        {{ $x_t_unit }} ▾
                                    </label>
                                    <input type="hidden" name="x_t_unit" value="{{ $x_t_unit }}">
                                    @if ($openDropdown === 'x_t_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0">
                                            @foreach (['°C' => 'Celsius (°C)', 'K' => 'Kelvin (K)', '°F' => 'Fahrenheit (°F)'] as $val => $label)
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('x_t_unit', '{{ $val }}')">
                                                    {{ $label }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ── Y Input ── --}}
                    <div class="space-y-2">
                        <label class="font-s-14 text-blue">
                            @if ($method === 'sub')
                                {{ $lang['p'] }}
                            @else
                                {{ $lang['s'] }}
                            @endif
                        </label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="y"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            {{-- Y Substance Unit (press / volume / temp) --}}
                            @if (in_array($method, ['press', 'volume', 'temp']))
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('y_s_unit')">
                                        {{ $y_s_unit }} ▾
                                    </label>
                                    <input type="hidden" name="y_s_unit" value="{{ $y_s_unit }}">
                                    @if ($openDropdown === 'y_s_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[40%] mt-1 right-0">
                                            @foreach (['mol' => 'mol', 'μmol' => 'µmol', 'mmol' => 'mmol'] as $val => $label)
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('y_s_unit', '{{ $val }}')">
                                                    {{ $label }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- Y Pressure Unit (sub) --}}
                            @if ($method === 'sub')
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('y_p_unit')">
                                        {{ $y_p_unit }} ▾
                                    </label>
                                    <input type="hidden" name="y_p_unit" value="{{ $y_p_unit }}">
                                    @if ($openDropdown === 'y_p_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[40%] mt-1 right-0">
                                            @foreach (['Pa', 'psi', 'bar', 'atm', 'at', 'Torr', 'mmHg', 'kPa'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('y_p_unit', '{{ $val }}')">
                                                    {{ $val }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ── Z Input ── --}}
                    <div class="space-y-2">
                        <label class="font-s-14 text-blue">
                            @if ($method === 'press')
                                {{ $lang['t'] }}
                            @elseif($method === 'volume')
                                {{ $lang['p'] }}
                            @elseif($method === 'temp')
                                {{ $lang['p'] }}
                            @else
                                {{ $lang['t'] }}
                            @endif
                        </label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="z"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            {{-- Z Temperature Unit (press / sub) --}}
                            @if (in_array($method, ['press', 'sub']))
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('z_t_unit')">
                                        {{ $z_t_unit }} ▾
                                    </label>
                                    <input type="hidden" name="z_t_unit" value="{{ $z_t_unit }}">
                                    @if ($openDropdown === 'z_t_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0">
                                            @foreach (['°C' => 'Celsius (°C)', 'K' => 'Kelvin (K)', '°F' => 'Fahrenheit (°F)'] as $val => $label)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('z_t_unit', '{{ $val }}')">
                                                    {{ $label }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- Z Pressure Unit (volume / temp) --}}
                            @if (in_array($method, ['volume', 'temp']))
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('z_p_unit')">
                                        {{ $z_p_unit }} ▾
                                    </label>
                                    <input type="hidden" name="z_p_unit" value="{{ $z_p_unit }}">
                                    @if ($openDropdown === 'z_p_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0">
                                            @foreach (['Pa', 'psi', 'bar', 'atm', 'at', 'Torr', 'mmHg', 'kPa'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('z_p_unit', '{{ $val }}')">
                                                    {{ $val }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ── R Constant ── --}}
                    <div class="space-y-2 relative">
                        <label for="R" class="font-s-14 text-blue">{!! $lang['2'] !!} (R):</label>
                        <input type="number" step="any" wire:model.live="R" id="R" class="input"
                            placeholder="00" />
                        <span class="text-blue input_unit">J⋅K⁻¹⋅mol⁻¹</span>
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
        @isset($detail)
            <hr style="height: 1px; background-color: #e5e7eb;">
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full p-3 rounded-lg mt-3">
                            <div class="w-full">
                                <p class="mt-2 font-bold" id="ans"></p>
                                <p class="mb-2 text-[#119154] text-2xl font-bold">
                                    {{ isset($detail['ans']) ? $detail['ans'] : '0.0' }}</p>
                                <p class="font-bold">{{ $lang[1] }}</p>
                                <div class="w-full overflow-auto mt-2">
                                    @if ($method == 'press')
                                        <table class="w-full lg:w-7/12">
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['p'] }}</td>
                                                <td class="border-b py-2 font-bold">
                                                    {{ round($detail['ans1'] / 6894.757, 5) }} psi
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['p'] }}</td>
                                                <td class="border-b py-2 font-bold">
                                                    {{ round($detail['ans1'] / 100000, 5) }} bar
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['p'] }}</td>
                                                <td class="border-b py-2 font-bold">
                                                    {{ round($detail['ans1'] / 101325, 5) }} atm
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['p'] }}</td>
                                                <td class="border-b py-2 font-bold">
                                                    {{ round($detail['ans1'] / 98067, 5) }} at
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['p'] }}</td>
                                                <td class="border-b py-2 font-bold">
                                                    {{ round($detail['ans1'] / 133.322, 5) }} Torr
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['p'] }}</td>
                                                <td class="border-b py-2 font-bold">
                                                    {{ round($detail['ans1'] / 133.322, 5) }} mmHg
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">{{ $lang['p'] }}</td>
                                                <td class="py-2 font-bold">{{ round($detail['ans1'] / 1000, 5) }} kPa</td>
                                            </tr>
                                        </table>
                                    @elseif($method == 'sub')
                                        <table class="w-full lg:w-7/12">
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['s'] }}</td>
                                                <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 1e6, 5) }}
                                                    μmol
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">{{ $lang['s'] }}</td>
                                                <td class="py-2 font-bold">{{ round($detail['ans1'] * 1000, 5) }} mmol
                                                </td>
                                            </tr>
                                        </table>
                                    @elseif($method == 'volume')
                                        <table class="w-full lg:w-7/12">
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['v'] }}</td>
                                                <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 1e6, 5) }}
                                                    cm³
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['v'] }}</td>
                                                <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 1e9, 5) }}
                                                    mm³
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['v'] }}</td>
                                                <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 1000, 5) }}
                                                    dm³
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['v'] }}</td>
                                                <td class="border-b py-2 font-bold">
                                                    {{ round($detail['ans1'] * 35.315, 5) }} ft³
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">{{ $lang['v'] }}</td>
                                                <td class="py-2 font-bold">{{ round($detail['ans1'] * 61024, 5) }} in³
                                                </td>
                                            </tr>
                                        </table>
                                    @elseif($method == 'temp')
                                        <table class="w-full lg:w-7/12">
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['t'] }}</td>
                                                <td class="border-b py-2 font-bold">
                                                    {{ round($detail['ans1'] - 273.15, 5) }} °C
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">{{ $lang['t'] }}</td>
                                                <td class="py-2 font-bold">
                                                    {{ round((($detail['ans1'] - 273.15) * 9) / 5 + 32, 5) }}
                                                    °F</td>
                                            </tr>
                                        </table>
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
