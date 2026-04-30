<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $tab == 'velocity' ? 'bg-blue-600 text-white' : 'bg-white hover:bg-blue-50' }}"
                                wire:click="setTab('velocity')">
                                {{ $lang['1'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $tab == 'rotational' ? 'bg-blue-600 text-white' : 'bg-white hover:bg-blue-50' }}"
                                wire:click="setTab('rotational')">
                                {{ $lang['2'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 mt-3 gap-4">
                    @if($tab == 'velocity')
                    <div class="col-span-12" wire:key="linear-radios">
                        <strong class="block mb-2">{{ $lang[3] }}:</strong>
                        <div class="flex flex-wrap gap-4 mb-4">
                            <label class="flex items-center cursor-pointer" for="mom_radio" wire:click="selectToCal('mom')">
                                <input type="radio" id="mom_radio" wire:model.live="to_cal" value="mom" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14 text-blue">{{ $lang['4'] }}</span>
                            </label>
                            <label class="flex items-center cursor-pointer" for="mass_radio" wire:click="selectToCal('mass')">
                                <input type="radio" id="mass_radio" wire:model.live="to_cal" value="mass" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14 text-blue">{{ $lang['5'] }}</span>
                            </label>
                            <label class="flex items-center cursor-pointer" for="velo_radio" wire:click="selectToCal('velo')">
                                <input type="radio" id="velo_radio" wire:model.live="to_cal" value="velo" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14 text-blue">{{ $lang['6'] }}</span>
                            </label>
                        </div>

                        <div class="grid grid-cols-12 gap-4">
                            @if($to_cal != 'mass')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="mass" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_m')">{{ $unit_m }} ▾</label>
                                    @if($openDropdown === 'unit_m')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['kg', 'mg', 'g', 'lbs'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_m', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($to_cal != 'velo')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="velocity" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_v')">{{ $unit_v }} ▾</label>
                                    @if($openDropdown === 'unit_v')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto">
                                            @foreach(['miles/s', 'km/s', 'm/s', 'in/s', 'yd/s', 'km/h', 'm/h'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_v', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($to_cal != 'mom')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="mom" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_k')">{{ $unit_k }} ▾</label>
                                    @if($openDropdown === 'unit_k')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['kg-ms', 'Ns', 'Nm', 'Nh', 'lb-ft'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_k', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="col-span-12" wire:key="rotational-radios">
                        <strong class="block mb-2">{{ $lang[3] }}:</strong>
                        <div class="flex flex-wrap gap-4 mb-4">
                            <label class="flex items-center cursor-pointer" for="momt_radio" wire:click="selectToCalr('mom_t')">
                                <input type="radio" id="momt_radio" wire:model.live="to_calr" value="mom_t" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14 text-blue">{{ $lang['4'] }}</span>
                            </label>
                            <label class="flex items-center cursor-pointer" for="force_radio" wire:click="selectToCalr('force')">
                                <input type="radio" id="force_radio" wire:model.live="to_calr" value="force" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14 text-blue">{{ $lang['7'] }} (F)</span>
                            </label>
                            <label class="flex items-center cursor-pointer" for="time_radio" wire:click="selectToCalr('time_c')">
                                <input type="radio" id="time_radio" wire:model.live="to_calr" value="time_c" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14 text-blue">{{ $lang['8'] }} (ΔT)</span>
                            </label>
                        </div>

                        <div class="grid grid-cols-12 gap-4">
                            @if($to_calr != 'mom_t')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['4'] }} (p):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="mom_t" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_mt')">{{ $unit_mt }} ▾</label>
                                    @if($openDropdown === 'unit_mt')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['kg-ms', 'Ns', 'Nm', 'Nh', 'lb-ft'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_mt', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($to_calr != 'force')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['7'] }} (F):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="force" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_i')">{{ $unit_i }} ▾</label>
                                    @if($openDropdown === 'unit_i')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['N', 'KN', 'MN'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_i', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($to_calr != 'time_c')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['8'] }} (ΔT):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="time" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_t')">{{ $unit_t }} ▾</label>
                                    @if($openDropdown === 'unit_t')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['s', 'min', 'h'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_t', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
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
    </form>

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
                        @if(isset($detail['mom']))
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['4'] }} (p)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['mom'] }} N-s (kg m/s)</strong></td>
                                </tr>
                            </table>
                            <p class="mt-4 mb-2 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['4'] }} (p)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['mom'] * 0.01666667, 5) }} N-min</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['4'] }} (p)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['mom'] * 0.000277778, 5) }} N-h</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['4'] }} (p)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['mom'] * 0.22482, 5) }} lb-ft/s</strong></td>
                                </tr>
                            </table>
                        </div>
                        @endif

                        @if(isset($detail['mass']))
                        <div class="w-full md:w-[80%] lg:w-80%] mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['5'] }} (m)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['mass'] }} kg</strong></td>
                                </tr>
                            </table>
                            <p class="mt-4 mb-2 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['5'] }} (m)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['mass'] * 2.20462, 5) }} lbs</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['5'] }} (m)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['mass'] * 1000, 5) }} g</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['5'] }} (m)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['mass'] * 1000000, 5) }} mg</strong></td>
                                </tr>
                            </table>
                        </div>
                        @endif

                        @if(isset($detail['velo']))
                        <div class="w-full md:w-[80%] lg:w-80%] mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['velo'] }} m/s</strong></td>
                                </tr>
                            </table>
                            <p class="mt-4 mb-2 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['velo'] / 1609, 5) }} miles/s</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['velo'] / 1000, 5) }} km/s</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['velo'] * 3.281, 5) }} ft/s</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['velo'] * 39.37, 5) }} in/s</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['velo'] * 1.094, 5) }} yd/s</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['velo'] * 3.6, 5) }} km/h</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['velo'] * 2.237, 5) }} m/h</strong></td>
                                </tr>
                            </table>
                        </div>
                        @endif

                        @if(isset($detail['momt']))
                        <div class="w-full md:w-[80%] lg:w-80%] mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['4'] }} (p)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['momt'] }} N-s (kg m/s)</strong></td>
                                </tr>
                            </table>
                            <p class="mt-4 mb-2 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['4'] }} (p)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['momt'] * 0.01666667, 5) }} N-min</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['4'] }} (p)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['momt'] * 0.000277778, 5) }} N-h</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['4'] }} (p)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['momt'] * 0.22482, 5) }} lb-ft/s</strong></td>
                                </tr>
                            </table>
                        </div>
                        @endif

                        @if(isset($detail['forcet']))
                        <div class="w-full md:w-[80%] lg:w-80%] mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['7'] }} (F)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['forcet'] }} N</strong></td>
                                </tr>
                            </table>
                            <p class="mt-4 mb-2 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['7'] }} (F)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['forcet'] / 1e3 }} KN</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['7'] }} (F)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['forcet'] / 1e6 }} MN</strong></td>
                                </tr>
                            </table>
                        </div>
                        @endif

                        @if(isset($detail['time']))
                        <div class="w-full md:w-[80%] lg:w-80%] mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['8'] }} (ΔT)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['time'] }} s</strong></td>
                                </tr>
                            </table>
                            <p class="mt-4 mb-2 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['8'] }} (ΔT)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['time'] / 60, 6) }} min</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['8'] }} (ΔT)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ round($detail['time'] / 3600, 6) }} h</strong></td>
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
</div>
