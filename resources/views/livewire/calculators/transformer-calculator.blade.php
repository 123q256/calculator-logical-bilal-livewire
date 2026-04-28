<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Calculation Unit (Solve For) --}}
                    <div class="col-span-full space-y-2">
                        <label for="calculation_unit" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <select wire:model.live="calculation_unit" id="calculation_unit" class="input">
                            <option value="1">{{ $lang[6] }} & {{ $lang[7] }} ({{ $lang[8] }})</option>
                            <option value="2">{{ $lang[9] }} & {{ $lang[7] }} ({{ $lang[8] }})</option>
                            <option value="3">{{ $lang[10] }} & {{ $lang[11] }} ({{ $lang[8] }})</option>
                            <option value="4">{{ $lang[12] }} & {{ $lang[11] }} ({{ $lang[8] }})</option>
                            <option value="5">{{ $lang[13] }} & {{ $lang[7] }} ({{ $lang[8] }})</option>
                            <option value="6">{{ $lang[14] }} & {{ $lang[7] }} ({{ $lang[8] }})</option>
                            <option value="7">{{ $lang[15] }} & {{ $lang[16] }} ({{ $lang[8] }})</option>
                            <option value="8">{{ $lang[15] }} & {{ $lang[17] }} ({{ $lang[8] }})</option>
                            <option value="9">{{ $lang[18] }} & {{ $lang[11] }} ({{ $lang[8] }})</option>
                            <option value="10">KVA & {{ $lang[19] }}</option>
                            <option value="11">{{ $lang[19] }} & {{ $lang[20] }}</option>
                            <option value="12">KVA & {{ $lang[20] }} </option>
                            <option value="13">{{ $lang[21] }} </option>
                            <option value="14">{{ $lang[22] }} & {{ $lang[23] }} ({{ $lang[24] }})</option>
                        </select>
                    </div>

                    {{-- Dynamic Fields based on selection --}}
                    @if (in_array($calculation_unit, ['9', '10', '11', '12']))
                        <div class="space-y-2">
                            <label for="phase_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <select wire:model.live="phase_unit" id="phase_unit" class="input">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="3">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                    @endif

                    @if ($calculation_unit == '9')
                        <div class="space-y-2">
                            <label for="transformer_rating" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                            <div class="relative w-full">
                                <input type="text" inputmode="decimal" wire:model.live="transformer_rating" id="transformer_rating" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('rating_unit')">{{ $transformer_rating_unit }} ▾</label>
                                @if ($openDropdown === 'rating_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('transformer_rating_unit', 'VA')">VA</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('transformer_rating_unit', 'kVA')">kVA</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('transformer_rating_unit', 'MVA')">MVA</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="location" class="font-s-14 text-blue">{{ $lang['25'] }}/{{ $lang['26'] }}:</label>
                            <select wire:model.live="location" id="location" class="input">
                                <option value="1">{{ $lang[25] }}</option>
                                <option value="2">{{ $lang[27] }}</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="impedance" class="font-s-14 text-blue">% {{ $lang['28'] }} {{ $lang['29'] }} % {{ $lang['30'] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="impedance" id="impedance" class="input" />
                        </div>
                    @endif

                    @if (in_array($calculation_unit, ['1', '2', '3', '4', '9']))
                        @if ($calculation_unit != '2')
                            <div class="space-y-2">
                                <label for="primary_transformer_voltage" class="font-s-14 text-blue">{{ $lang['31'] }}</label>
                                <div class="relative w-full">
                                    <input type="text" inputmode="decimal" wire:model.live="primary_transformer_voltage" id="primary_transformer_voltage" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('primary_unit')">{{ $primary_transformer_unit }} ▾</label>
                                    @if ($openDropdown === 'primary_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('primary_transformer_unit', 'V')">V</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('primary_transformer_unit', 'kV')">kV</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('primary_transformer_unit', 'MV')">MV</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($calculation_unit != '1')
                            <div class="space-y-2">
                                <label for="secondary_transformer_voltage" class="font-s-14 text-blue">{{ $lang['11'] }}</label>
                                <div class="relative w-full">
                                    <input type="text" inputmode="decimal" wire:model.live="secondary_transformer_voltage" id="secondary_transformer_voltage" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('secondary_unit')">{{ $secondary_transformer_unit }} ▾</label>
                                    @if ($openDropdown === 'secondary_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('secondary_transformer_unit', 'V')">V</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('secondary_transformer_unit', 'kV')">kV</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('secondary_transformer_unit', 'MV')">MV</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif

                    @if (in_array($calculation_unit, ['1', '2', '3', '4', '5', '6', '7', '8', '13']))
                        @if (!in_array($calculation_unit, ['4', '8']))
                            <div class="space-y-2">
                                <label for="primary_winding" class="font-s-14 text-blue">{{ $lang['32'] }}:</label>
                                <input type="text" inputmode="decimal" wire:model.live="primary_winding" id="primary_winding" class="input" />
                            </div>
                        @endif
                        @if (!in_array($calculation_unit, ['3', '7']))
                            <div class="space-y-2">
                                <label for="secondary_winding" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                                <input type="text" inputmode="decimal" wire:model.live="secondary_winding" id="secondary_winding" class="input" />
                            </div>
                        @endif
                    @endif

                    @if (in_array($calculation_unit, ['5', '7', '8', '13']))
                        <div class="space-y-2">
                            <label for="primary_current" class="font-s-14 text-blue">{{ $lang['33'] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="primary_current" id="primary_current" class="input" />
                        </div>
                    @endif

                    @if (in_array($calculation_unit, ['6', '7', '8', '13']))
                        <div class="space-y-2">
                            <label for="secondary_current" class="font-s-14 text-blue">{{ $lang['34'] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="secondary_current" id="secondary_current" class="input" />
                        </div>
                    @endif

                    @if (in_array($calculation_unit, ['10', '12']))
                        <div class="space-y-2">
                            <label for="kva" class="font-s-14 text-blue">KVA:</label>
                            <input type="text" inputmode="decimal" wire:model.live="kva" id="kva" class="input" />
                        </div>
                    @endif

                    @if (in_array($calculation_unit, ['10', '11']))
                        <div class="space-y-2">
                            <label for="volts" class="font-s-14 text-blue">{{ $lang[19] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="volts" id="volts" class="input" />
                        </div>
                    @endif

                    @if (in_array($calculation_unit, ['11', '12']))
                        <div class="space-y-2">
                            <label for="amperes" class="font-s-14 text-blue">{{ $lang[20] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="amperes" id="amperes" class="input" />
                        </div>
                    @endif

                    @if ($calculation_unit == '13')
                        <div class="space-y-2">
                            <label for="eddy_current" class="font-s-14 text-blue">{{ $lang[35] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="eddy_current" id="eddy_current" class="input" />
                        </div>
                        <div class="space-y-2">
                            <label for="thickness" class="font-s-14 text-blue">{{ $lang[36] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="thickness" id="thickness" class="input" />
                        </div>
                        <div class="space-y-2">
                            <label for="hysteresis_constant" class="font-s-14 text-blue">{{ $lang[37] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="hysteresis_constant" id="hysteresis_constant" class="input" />
                        </div>
                    @endif

                    @if (in_array($calculation_unit, ['13', '14']))
                        <div class="space-y-2">
                            <label for="flux_density" class="font-s-14 text-blue">{{ $lang[22] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="flux_density" id="flux_density" class="input" />
                        </div>
                        <div class="space-y-2">
                            <label for="frequency" class="font-s-14 text-blue">{{ $lang[23] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="frequency" id="frequency" class="input" />
                        </div>
                    @endif

                    @if ($calculation_unit == '14')
                        <div class="space-y-2">
                            <label for="number_of_turns" class="font-s-14 text-blue">{{ $lang[24] }}:</label>
                            <input type="text" inputmode="decimal" wire:model.live="number_of_turns" id="number_of_turns" class="input" />
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
                            <div class="w-full md:w-[90%] lg:w-[90%] overflow-auto mt-2">
                                <table class="w-full text-lg">
                                    @if (isset($detail['primary_full_load_current']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[38] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['primary_full_load_current'], 4) }} (A)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['secondary_full_load_current']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[39] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['secondary_full_load_current'], 4) }} (A)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['turn_ratio']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[40] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['turn_ratio'], 4) }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['type']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[41] }}</strong></td>
                                            <td class="py-2 border-b">{{ $detail['type'] }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['impedance_value']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[42] }} (kA) {{ $lang[43] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['impedance_value'], 4) }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['calculate_amps']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[20] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['calculate_amps'], 4) }} (A)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['calculate_kva']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>KVA</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['calculate_kva'], 4) }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['calculate_volts']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[19] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['calculate_volts'], 4) }} (V)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['secondary_voltage']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['secondary_voltage'], 4) }} (V)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['primary_voltage']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[31] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['primary_voltage'], 4) }} (V)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['secondary_winding']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['secondary_winding'], 4) }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['primary_winding']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[32] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['primary_winding'], 4) }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['secondary_current']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[34] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['secondary_current'], 4) }} (A)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['primary_current']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[33] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['primary_current'], 4) }} (A)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['total_copper']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[44] }} ,Pcu</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['total_copper'], 4) }} (W)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['eddy_current_loss']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[45] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['eddy_current_loss'], 4) }} (W)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['hysteresis_loss']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[46] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['hysteresis_loss'], 4) }} (W)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['rms']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>R.M.S {{ $lang[48] }} EMF</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['rms'], 4) }} (V)</td>
                                        </tr>
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
