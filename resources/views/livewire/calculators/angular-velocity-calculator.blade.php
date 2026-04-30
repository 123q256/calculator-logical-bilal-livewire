<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Method Selector -->
                    <div class="col-span-12 mx-auto px-2 w-full">
                        <label for="method" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="method" class="input">
                                <option value="0">{{ $lang['2'] }}</option>
                                <option value="1">{{ $lang['3'] }}</option>
                                <option value="2">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    @if($method == '0')
                        <!-- Method 0: Standard Angular Velocity -->
                        <div class="col-span-12" wire:key="method-0-radios">
                            <strong class="block mb-2">{{ $lang[5] }}:</strong>
                            <div class="flex flex-wrap gap-4 mb-4">
                                <label class="flex items-center cursor-pointer" for="ang_vel_radio" wire:click="setG('ang_vel')">
                                    <input type="radio" id="ang_vel_radio" wire:model.live="g" value="ang_vel" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 font-s-14 text-blue">{{ $lang['6'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer" for="ang_chnge_radio" wire:click="setG('ang_chnge')">
                                    <input type="radio" id="ang_chnge_radio" wire:model.live="g" value="ang_chnge" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 font-s-14 text-blue">{{ $lang['7'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer" for="time_radio" wire:click="setG('time')">
                                    <input type="radio" id="time_radio" wire:model.live="g" value="time" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 font-s-14 text-blue">{{ $lang['8'] }}</span>
                                </label>
                            </div>
                        </div>

                        @if($g == 'ang_vel')
                            <!-- Calculate ω (ang_vel) -->
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['7'] }} (Δα):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="ac" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2" x-data="{ open: false }">
                                        <button type="button" @click="$wire.toggleDropdown('ac1')" class="text-sm underline">{{ $ac1 }} ▾</button>
                                        @if($openDropdown === 'ac1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['deg', 'rad', 'gon', 'tr', 'arcmin', 'arcsec', 'mrad', 'urad', 'pirad'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ac1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['8'] }} (t):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="t" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('t1')" class="text-sm underline">{{ $t1 }} ▾</button>
                                        @if($openDropdown === 't1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['sec', 'min', 'hrs', 'days', 'weeks', 'months', 'year'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($g == 'ang_chnge')
                            <!-- Calculate Δα (ang_chnge) -->
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['8'] }} (t):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="t" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('t1')" class="text-sm underline">{{ $t1 }} ▾</button>
                                        @if($openDropdown === 't1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['sec', 'min', 'hrs', 'days', 'weeks', 'months', 'year'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['6'] }} (ω):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="av" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('av1')" class="text-sm underline">{{ $av1 }} ▾</button>
                                        @if($openDropdown === 'av1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['rad/s', 'rpm', 'hz'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('av1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($g == 'time')
                            <!-- Calculate t (time) -->
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['7'] }} (Δα):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="ac" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('ac1')" class="text-sm underline">{{ $ac1 }} ▾</button>
                                        @if($openDropdown === 'ac1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['deg', 'rad', 'gon', 'tr', 'arcmin', 'arcsec', 'mrad', 'urad', 'pirad'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ac1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['6'] }} (ω):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="av" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('av1')" class="text-sm underline">{{ $av1 }} ▾</button>
                                        @if($openDropdown === 'av1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['rad/s', 'rpm', 'hz'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('av1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    @elseif($method == '1')
                        <!-- Method 1: Velocity/Radius Conversion -->
                        <div class="col-span-12" wire:key="method-1-radios">
                            <strong class="block mb-2">{{ $lang[5] }}:</strong>
                            <div class="flex flex-wrap gap-4 mb-4">
                                <label class="flex items-center cursor-pointer" for="ang_vel1_radio" wire:click="setGG('ang_vel1')">
                                    <input type="radio" id="ang_vel1_radio" wire:model.live="gg" value="ang_vel1" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 font-s-14 text-blue">{{ $lang['6'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer" for="velocity_radio" wire:click="setGG('velocity')">
                                    <input type="radio" id="velocity_radio" wire:model.live="gg" value="velocity" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 font-s-14 text-blue">{{ $lang['9'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer" for="radius_radio" wire:click="setGG('radius')">
                                    <input type="radio" id="radius_radio" wire:model.live="gg" value="radius" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 font-s-14 text-blue">{{ $lang['10'] }}</span>
                                </label>
                            </div>
                        </div>

                        @if($gg == 'ang_vel1')
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['9'] }} (v):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="vel" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('vel1')" class="text-sm underline">{{ $vel1 }} ▾</button>
                                        @if($openDropdown === 'vel1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['m/s', 'km/h', 'ft/s', 'mi/s', 'mi/h', 'knots'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('vel1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['10'] }} (r):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="rad" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('rad1')" class="text-sm underline">{{ $rad1 }} ▾</button>
                                        @if($openDropdown === 'rad1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'nmi'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('rad1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($gg == 'velocity')
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['6'] }} (ω):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="av" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('av1')" class="text-sm underline">{{ $av1 }} ▾</button>
                                        @if($openDropdown === 'av1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['rad/s', 'rpm', 'hz'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('av1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['10'] }} (r):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="rad" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('rad1')" class="text-sm underline">{{ $rad1 }} ▾</button>
                                        @if($openDropdown === 'rad1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'nmi'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('rad1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($gg == 'radius')
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['9'] }} (v):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="vel" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('vel1')" class="text-sm underline">{{ $vel1 }} ▾</button>
                                        @if($openDropdown === 'vel1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['m/s', 'km/h', 'ft/s', 'mi/s', 'mi/h', 'knots'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('vel1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="font-s-14 text-blue">{{ $lang['6'] }} (ω):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="av" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <div class="absolute right-2 top-2">
                                        <button type="button" wire:click="toggleDropdown('av1')" class="text-sm underline">{{ $av1 }} ▾</button>
                                        @if($openDropdown === 'av1')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                                @foreach(['rad/s', 'rpm', 'hz'] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('av1', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    @elseif($method == '2')
                        <!-- Method 2: RPM Based -->
                        <div class="col-span-6">
                            <label class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                            <div class="w-full py-2">
                                <input type="number" wire:model.live="rpm" step="any" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="rds_m" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <div class="absolute right-2 top-2">
                                    <button type="button" wire:click="toggleDropdown('rds_m1')" class="text-sm underline">{{ $rds_m1 }} ▾</button>
                                    @if($openDropdown === 'rds_m1')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg">
                                            @foreach(['m', 'cm', 'in', 'ft', 'yd'] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('rds_m1', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
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

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-6">
            <div class="w-full mt-3">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                @php
                    $ans = $detail['ans'];
                    $res_unit = $detail['res_unit'];
                    if (isset($detail['ang_chnge'])) $head = $lang['7'] . " (Δα)";
                    elseif (isset($detail['time'])) $head = $lang['8'] . " (t)";
                    elseif (isset($detail['velocity'])) $head = $lang['9'] . " (v)";
                    elseif (isset($detail['radius'])) $head = $lang['10'] . " (r)";
                    else $head = $lang['6'] . " (ω)";
                @endphp
                <div class="w-full">
                    <div class="w-full md:w-[70%] lg:w-[70%] mt-2 overflow-auto">
                        <table class="w-full font-s-18">
                            <tr>
                                <td class="text-blue py-2 border-b">{{ $head }}</td>
                                <td class="py-2 border-b text-right"><strong>{{ $ans }} {{ $res_unit }}</strong></td>
                            </tr>
                            @if (isset($detail['rpm']))
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['9']}} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['l_v'] }} m/s</strong></td>
                                </tr>
                            @endif
                        </table>
                    </div>

                    <p class="w-full mt-6 text-center font-bold text-blue">{{ $lang['12'] }}</p>
                    <div class="w-full md:w-[70%] lg:w-[70%] overflow-auto mt-2">
                        <table class="w-full font-s-18">
                            @if (isset($detail['ang_vel']) || isset($detail['ang_vel1']))
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (ω)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['ang_vel_rpm'] }} {{ $lang['13'] }} (rpm)</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (ω)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['ang_vel_hertz'] }} {{ $lang['14'] }} (Hz)</strong></td>
                                </tr>
                            @elseif (isset($detail['ang_chnge']))
                                @foreach(['deg', 'gon', 'tr', 'arcmin', 'arcsec', 'mrad', 'urad', 'pirad'] as $u)
                                    @php $key = 'ang_chnge_' . $u; @endphp
                                    @if(isset($detail[$key]))
                                        <tr>
                                            <td class="text-blue py-2 border-b">{{ $lang['7'] }} (Δα)</td>
                                            <td class="py-2 border-b text-right"><strong>{{ $detail[$key] }} ({{ $u }})</strong></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @elseif (isset($detail['time']))
                                @foreach(['min', 'hrs', 'days', 'wks', 'mos', 'yrs'] as $u)
                                    @php $key = 't_' . $u; @endphp
                                    @if(isset($detail[$key]))
                                        <tr>
                                            <td class="text-blue py-2 border-b">{{ $lang['8'] }} (t)</td>
                                            <td class="py-2 border-b text-right"><strong>{{ $detail[$key] }} ({{ $u }})</strong></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @elseif (isset($detail['velocity']))
                                @foreach(['kmps', 'kmph', 'ftps', 'mips', 'miph', 'knots'] as $u)
                                    @php $key = 'vel_' . $u; @endphp
                                    @if(isset($detail[$key]))
                                        <tr>
                                            <td class="text-blue py-2 border-b">{{ $lang['9'] }} (v)</td>
                                            <td class="py-2 border-b text-right"><strong>{{ $detail[$key] }} ({{ $u }})</strong></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @elseif (isset($detail['radius']))
                                @foreach(['mm', 'cm', 'km', 'in', 'ft', 'yd', 'mi', 'nmi'] as $u)
                                    @php $key = 'rad_' . $u; @endphp
                                    @if(isset($detail[$key]))
                                        <tr>
                                            <td class="text-blue py-2 border-b">{{ $lang['10'] }} (r)</td>
                                            <td class="py-2 border-b text-right"><strong>{{ $detail[$key] }} ({{ $u }})</strong></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @elseif (isset($detail['rpm']))
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }} (ω)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['ang_vel_rpm'] }} rpm</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['9'] }} (v)</td>
                                    <td class="py-2 border-b text-right"><strong>{{ $detail['vel_kmph'] }} km/h</strong></td>
                                </tr>
                            @endif
                        </table>
                    </div>

                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <p class="font-bold text-blue mb-4 underline text-center">{{ $lang['42'] }}:</p>
                        <div class="space-y-4 text-center">
                            @if (isset($detail['ang_vel']))
                                <p>\[ Δα = {{ $detail['ac'] }}, \space t = {{ $detail['t'] }}, \space ω = ? \]</p>
                                <p>\[ ω = \frac{Δα}{t} \]</p>
                                <p>\[ ω = \frac{ {{ $detail['ac'] }} }{ {{ $detail['t'] }} } = {{ $detail['ans'] }} \space rad/s \]</p>
                            @elseif (isset($detail['ang_chnge']))
                                <p>\[ ω = {{ $detail['av'] }}, \space t = {{ $detail['t'] }}, \space Δα = ? \]</p>
                                <p>\[ Δα = ω \times t \]</p>
                                <p>\[ Δα = {{ $detail['av'] }} \times {{ $detail['t'] }} = {{ $detail['ans'] }} \space rad \]</p>
                            @elseif (isset($detail['time']))
                                <p>\[ Δα = {{ $detail['ac'] }}, \space ω = {{ $detail['av'] }}, \space t = ? \]</p>
                                <p>\[ t = \frac{Δα}{ω} \]</p>
                                <p>\[ t = \frac{ {{ $detail['ac'] }} }{ {{ $detail['av'] }} } = {{ $detail['ans'] }} \space s \]</p>
                            @elseif (isset($detail['ang_vel1']))
                                <p>\[ v = {{ $detail['vel'] }}, \space r = {{ $detail['rad'] }}, \space ω = ? \]</p>
                                <p>\[ ω = \frac{v}{r} \]</p>
                                <p>\[ ω = \frac{ {{ $detail['vel'] }} }{ {{ $detail['rad'] }} } = {{ $detail['ans'] }} \space rad/s \]</p>
                            @elseif (isset($detail['velocity']))
                                <p>\[ ω = {{ $detail['av'] }}, \space r = {{ $detail['rad'] }}, \space v = ? \]</p>
                                <p>\[ v = ω \times r \]</p>
                                <p>\[ v = {{ $detail['av'] }} \times {{ $detail['rad'] }} = {{ $detail['ans'] }} \space m/s \]</p>
                            @elseif (isset($detail['radius']))
                                <p>\[ ω = {{ $detail['av'] }}, \space v = {{ $detail['vel'] }}, \space r = ? \]</p>
                                <p>\[ r = \frac{v}{ω} \]</p>
                                <p>\[ r = \frac{ {{ $detail['vel'] }} }{ {{ $detail['av'] }} } = {{ $detail['ans'] }} \space m \]</p>
                            @elseif (isset($detail['rpm']))
                                <p>\[ rpm = {{ $detail['rpm'] }}, \space r = {{ $detail['rds_m'] }}, \space ω = ?, \space v = ? \]</p>
                                <p class="font-bold">1. Angular Velocity (ω):</p>
                                <p>\[ ω = \frac{2 \pi \cdot rpm}{60} \]</p>
                                <p>\[ ω = \frac{2 \pi \cdot {{ $detail['rpm'] }} }{60} = {{ $detail['ans'] }} \space rad/s \]</p>
                                <p class="font-bold">2. Linear Velocity (v):</p>
                                <p>\[ v = ω \times r \]</p>
                                <p>\[ v = {{ $detail['ans'] }} \times {{ $detail['rds_m'] }} = {{ $detail['l_v'] }} \space m/s \]</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
