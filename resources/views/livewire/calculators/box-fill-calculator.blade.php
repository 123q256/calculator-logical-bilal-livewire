<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Conducting Wire Size --}}
                    <div class="space-y-2">
                        <label for="conducting_wire_size" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <select wire:model.live="conducting_wire_size" id="conducting_wire_size" class="input">
                            <option value="5">6 AWG</option>
                            <option value="3">8 AWG</option>
                            <option value="2.5">10 AWG</option>
                            <option value="2.25">12 AWG</option>
                            <option value="2">14 AWG</option>
                            <option value="1.75">16 AWG</option>
                            <option value="1.5">18 AWG</option>
                        </select>
                    </div>

                    {{-- Clamps --}}
                    <div class="space-y-2">
                        <label for="clamps" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                        <select wire:model.live="clamps" id="clamps" class="input">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>

                    {{-- Conducting Wire --}}
                    <div class="space-y-2 relative">
                        <label for="conducting_wire" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                        <input type="number" step="any" wire:model.live="conducting_wire" id="conducting_wire" class="input" />
                        <span class="input_unit text-blue">{{ $lang['3'] }}</span>
                    </div>

                    {{-- Fittings --}}
                    <div class="space-y-2">
                        <label for="fittings" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                        <select wire:model.live="fittings" id="fittings" class="input">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>

                    {{-- Devices --}}
                    <div class="space-y-2 relative">
                        <label for="devices" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                        <input type="number" step="any" wire:model.live="devices" id="devices" class="input" />
                        <span class="input_unit text-blue">{{ $lang['6'] }}</span>
                    </div>

                    {{-- Grounding Conductor --}}
                    <div class="space-y-2 relative">
                        <label for="grounding_conductor" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                        <input type="number" step="any" wire:model.live="grounding_conductor" id="grounding_conductor" class="input" />
                        <span class="input_unit text-blue">{{ $lang['3'] }}</span>
                    </div>

                    {{-- Largest Wire Size --}}
                    <div class="space-y-2 relative">
                        <label for="largest_wire_size" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                        <select wire:model.live="largest_wire_size" id="largest_wire_size" class="input">
                            <option value="5">6 AWG</option>
                            <option value="3">8 AWG</option>
                            <option value="2.5">10 AWG</option>
                            <option value="2.25">12 AWG</option>
                            <option value="2">14 AWG</option>
                            <option value="1.75">16 AWG</option>
                            <option value="1.5">18 AWG</option>
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                            <div class="flex flex-wrap my-2">
                                <div class="w-full text-lg overflow-auto">
                                    <table class="w-full">
                                        @if ($detail['conducting_wire_size'] == $detail['largest_wire_size'])
                                            <tr>
                                                <td class="border-b py-2 w-7/10"><strong>{{ $lang['10'] }} :</strong></td>
                                                <td class="border-b py-2">{{ $detail['total_volume_allowance_needed'] }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="border-b py-2 w-7/10"><strong>{{ $lang['11'] }} :</strong></td>
                                                <td class="border-b py-2">{{ $detail['larg_cond_wire'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['grounding_fill_vol_allownce'], 1) }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['13'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['total_box_vol'] }} (c<sup>3</sup>)</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-lg mt-3">
                                    <table class="w-full">
                                        <tbody>
                                            <tr>
                                                <td class="border-b py-2 w-7/10">{{ $lang[14] }} :</td>
                                                <td class="border-b py-2">{{ $detail['conducting_wire'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[15] }} :</td>
                                                <td class="border-b py-2">{{ $detail['conducting_wire_size'] }} <span>(c<sup>3</sup>)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[16] }} :</td>
                                                <td class="border-b py-2">{{ $detail['conductor_fill_volume'] }} <span>(c<sup>3</sup>)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[17] }} :</td>
                                                <td class="border-b py-2">{{ $detail['clamp_vol_allownce'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[18] }} :</td>
                                                <td class="border-b py-2">{{ $detail['clamp_fill_vol'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[19] }} :</td>
                                                <td class="border-b py-2">{{ $detail['fitt_vol_allownce'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[20] }} :</td>
                                                <td class="border-b py-2">{{ $detail['fitt_fill_vol'] }} <span>(c<sup>3</sup>)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[21] }} :</td>
                                                <td class="border-b py-2">{{ $detail['device_vol_allownce'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[22] }} :</td>
                                                <td class="border-b py-2">{{ $detail['device_fill_vol'] }} <span>(c<sup>3</sup>)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[23] }} :</td>
                                                <td class="border-b py-2">{{ $detail['grounding_fill_vol_allownce'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[24] }} :</td>
                                                <td class="border-b py-2">{{ $detail['largest_wire_size'] }} <span>(c<sup>3</sup>)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[25] }} :</td>
                                                <td class="border-b py-2">{{ $detail['grounding_fill_vol'] }} <span>(c<sup>3</sup>)</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
