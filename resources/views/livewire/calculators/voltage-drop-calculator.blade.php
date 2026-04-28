<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- By using (Calculate Unit) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="calculate_unit" class="label">{{ $lang['1'] }}</label>
                        <select wire:model.live="calculate_unit" id="calculate_unit" class="input">
                            <option value="1">{{ $lang['2'] }}</option>
                            <option value="2">NEC {{ $lang['3'] }}</option>
                            <option value="3">{{ $lang['4'] }}</option>
                        </select>
                    </div>

                    {{-- To Find (Mode 2 only) --}}
                    @if ($calculate_unit == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="find_unit" class="label">{{ $lang['5'] }}</label>
                            <select wire:model.live="find_unit" id="find_unit" class="input">
                                <option value="1">{{ $lang['6'] }}</option>
                                <option value="2">{{ $lang['7'] }}</option>
                                <option value="3">{{ $lang['8'] }}</option>
                            </select>
                        </div>
                    @endif

                    {{-- Wire Material (Mode 1 only) --}}
                    @if ($calculate_unit == '1')
                        <div class="col-span-12 md:col-span-6">
                            <label for="wire_material_unit" class="label">{{ $lang['9'] }}</label>
                            <select wire:model.live="wire_material_unit" id="wire_material_unit" class="input">
                                @foreach($materialLabels as $val => $lbl)
                                    @if(!is_numeric($val)) <option value="{{ $val }}">{{ $lbl }}</option> @endif
                                @endforeach
                            </select>
                        </div>
                    @endif

                    {{-- Wire Material Two (Mode 2 only) --}}
                    @if ($calculate_unit == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="wire_material_unit_two" class="label">{{ $lang['9'] }}</label>
                            <select wire:model.live="wire_material_unit_two" id="wire_material_unit_two" class="input">
                                <option value="0">{{ $lang['10'] }}</option>
                                <option value="1">{{ $lang['11'] }}</option>
                            </select>
                        </div>
                    @endif

                    {{-- Resistivity (Mode 1 & 2) --}}
                    @if ($calculate_unit == '1' || $calculate_unit == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="resistivity" class="label">{{ $lang['18'] }}</label>
                            <input type="text" wire:model.live="resistivity" id="resistivity" class="input" placeholder="1.72e-8" />
                        </div>
                    @endif

                    {{-- Max Voltage Drop (Mode 2 only) --}}
                    @if ($calculate_unit == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="max_voltage_drop" class="label">{{ $lang['19'] }}</label>
                            <input type="number" step="any" wire:model.live="max_voltage_drop" id="max_voltage_drop" class="input" />
                        </div>
                    @endif

                    {{-- Cable Length (Mode 2 only) --}}
                    @if ($calculate_unit == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="cable_length" class="label">{{ $lang['21'] }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="cable_length" id="cable_length" class="input pr-24" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('cable_length_unit')">
                                    {{ $cable_length_unit }} ▾
                                </label>
                                @if ($openDropdown === 'cable_length_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('cable_length_unit', 'ft')">feet</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('cable_length_unit', 'm')">meters</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Wire Length (Mode 1 & 3) --}}
                    @if ($calculate_unit == '1' || $calculate_unit == '3')
                        <div class="col-span-12 md:col-span-6">
                            <label for="wire_length" class="label">{{ $lang['21'] }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="wire_length" id="wire_length" class="input pr-24" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('wire_length_unit')">
                                    {{ $wire_length_unit }} ▾
                                </label>
                                @if ($openDropdown === 'wire_length_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto">
                                        @foreach(['cm', 'm', 'mm', 'in', 'ft', 'yd'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('wire_length_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Gauge / Wire Size (Mode 2 only) --}}
                    @if ($calculate_unit == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="gauge" class="label">{{ $lang['22'] }}</label>
                            <input type="number" step="any" wire:model.live="gauge" id="gauge" class="input" />
                        </div>
                    @endif

                    {{-- Wire Diameter Size (Mode 1 only) --}}
                    @if ($calculate_unit == '1')
                        <div class="col-span-12 md:col-span-6">
                            <label for="wire_diameter_size" class="label">{{ $lang['23'] }}</label>
                            <div class="relative w-full">
                                <input type="text" wire:model.live="wire_diameter_size" id="wire_diameter_size" class="input pr-24" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('wire_diameter_size_unit')">
                                    {{ $wire_diameter_size_unit }} ▾
                                </label>
                                @if ($openDropdown === 'wire_diameter_size_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['AWG', 'inch', 'mm'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('wire_diameter_size_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Load Current (Always) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="load_current" class="label">{{ $lang['24'] }}</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="load_current" id="load_current" class="input pr-24" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('load_current_unit')">
                                {{ $load_current_unit }} ▾
                            </label>
                            @if ($openDropdown === 'load_current_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['am' => 'amps', 'mi' => 'milliamps', 'wa' => 'watts', 'hp' => 'hp', 'kW' => 'kW'] as $val => $lbl)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('load_current_unit', '{{ $val }}')">{{ $lbl }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Number of Conductors (Always) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="conductors" class="label">{{ $lang['25'] }}</label>
                        <input type="number" step="any" wire:model.live="conductors" id="conductors" class="input" />
                    </div>

                    {{-- Voltage (Always) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="voltage" class="label">{{ $lang['26'] }}</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="voltage" id="voltage" class="input pr-24" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('voltage_unit')">
                                {{ $voltage_unit }} ▾
                            </label>
                            @if ($openDropdown === 'voltage_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('voltage_unit', 'volts')">{{ $lang[27] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('voltage_unit', 'kilovolts')">{{ $lang[28] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Conduit Material (Mode 2 only) --}}
                    @if ($calculate_unit == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="material_of_conduit" class="label">{{ $lang['29'] }}</label>
                            <select wire:model.live="material_of_conduit" id="material_of_conduit" class="input">
                                <option value="pvc">PVC</option>
                                <option value="aluminium">{{ $lang[11] }}</option>
                                <option value="steel">{{ $lang[30] }}</option>
                            </select>
                        </div>
                    @endif

                    {{-- Power Factor (Mode 2 only) --}}
                    @if ($calculate_unit == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="power_voltage" class="label">{{ $lang['31'] }} (PF)</label>
                            <input type="number" step="any" wire:model.live="power_voltage" id="power_voltage" class="input" />
                        </div>
                    @endif

                    {{-- Wire Resistance (Mode 3 only) --}}
                    @if ($calculate_unit == '3')
                        <div class="col-span-12 md:col-span-6">
                            <label for="wire_resistance" class="label">{{ $lang['32'] }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="wire_resistance" id="wire_resistance" class="input pr-24" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('wire_resistance_unit')">
                                    {{ $wire_resistance_unit }} ▾
                                </label>
                                @if ($openDropdown === 'wire_resistance_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['km' => 'Ω/km', 'm' => 'Ω/m', 'tft' => 'Ω/1000ft', 'hft' => 'Ω/ft', 'mqm' => 'mΩ/m', 'mft' => 'mΩ/ft'] as $val => $lbl)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('wire_resistance_unit', '{{ $val }}')">{{ $lbl }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Phase (Always) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="phase_unit" class="label">{{ $lang['33'] }}</label>
                        <select wire:model.live="phase_unit" id="phase_unit" class="input">
                            <option value="1">DC</option>
                            <option value="2">AC single-phase</option>
                            <option value="3">AC three-phase</option>
                        </select>
                    </div>

                    {{-- Insulation (Always) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="insulation" class="label">{{ $lang['34'] }}</label>
                        <select wire:model.live="insulation" id="insulation" class="input">
                            <option value="0">60°C</option>
                            <option value="1">75°C</option>
                            <option value="2">90°C</option>
                        </select>
                    </div>

                    {{-- Installation (Always) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="raceway" class="label">{{ $lang['35'] }}</label>
                        <select wire:model.live="raceway" id="raceway" class="input">
                            <option value="0">Raceway / Cable / Buried</option>
                            <option value="1">Open Air</option>
                        </select>
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
    </form>

    <hr>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
            <div class="text-left space-y-6 overflow-auto">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full md:w-[70%] lg:w-[70%] mt-2">
                    <table class="w-full text-[18px]">
                        @if (!empty($detail['voltage_drop_formula']))
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[36] }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['voltage_drop_formula'], 4) }} ({{ $lang[37] }})</td>
                            </tr>
                        @endif
                        @if (!empty($detail['voltage_drop_percentage']))
                            <tr>
                                <td class="py-2 border-b"><strong>{{ $lang[38] }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['voltage_drop_percentage'] * 100, 2) }} (%)</td>
                            </tr>
                        @endif
                        @if (!empty($detail['wire_resistance']))
                            <tr>
                                <td class="py-2 border-b"><strong>{{ $lang[39] }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['wire_resistance'], 4) }} (Ω)</td>
                            </tr>
                        @endif
                        @if (!empty($detail['voltage']) && isset($detail['voltage_drop_formula']))
                            <tr>
                                <td class="py-2 border-b"><strong>{{ $lang[40] }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['voltage'] - $detail['voltage_drop_formula'], 2) }} ({{ $lang[37] }})</td>
                            </tr>
                        @endif
                        @if (!empty($detail['wire_size']))
                            <tr>
                                <td class="py-2 border-b"><strong>{{ $lang[20] }}</strong></td>
                                <td class="py-2 border-b">{{ $detail['wire_size'] }}</td>
                            </tr>
                        @endif
                        @if (!empty($detail['final']))
                            <tr>
                                <td class="py-2 border-b"><strong>{{ $lang[41] }}</strong></td>
                                <td class="py-2 border-b">{{ $detail['final'] }}</td>
                            </tr>
                        @endif
                        {{-- Mode 3 and specific Find results --}}
                        @if (!empty($detail['vv']))
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[42] ?? 'Max Length' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['vv'], 2) }} (ft)</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[42] ?? 'Max Length' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['vv'] * 0.3048, 2) }} (m)</td>
                            </tr>
                        @endif
                        @if (!empty($detail['din']) && !empty($detail['dmm']))
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[43] ?? 'Diameter' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['din'], 4) }} (in)</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[43] ?? 'Diameter' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['dmm'], 4) }} (mm)</td>
                            </tr>
                        @endif
                        @if (!empty($detail['amil']) && !empty($detail['ain']) && !empty($detail['amm']))
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[44] ?? 'Area' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['amil'], 2) }} (kcmil)</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[44] ?? 'Area' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['ain'], 4) }} (in²)</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[44] ?? 'Area' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['amm'], 4) }} (mm²)</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    @endisset
</div>