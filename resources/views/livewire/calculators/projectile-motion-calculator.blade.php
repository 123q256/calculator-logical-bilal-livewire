<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    {{-- Method Selection --}}
                    <div class="col-span-12">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select wire:model.live="method" id="method" class="input">
                                <option value="tof">{{ $lang['2'] }}</option>
                                <option value="range">{{ $lang['3'] }}</option>
                                <option value="mh">{{ $lang['4'] }}</option>
                                <option value="fp">{{ $lang['5'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Initial Velocity (V) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                        <label for="v" class="font-s-14 text-blue">{{ $lang['12'] }} {{ $lang['8'] }} (V)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="v" step="any" min="1"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('v_unit')">{{ $v_unit }} ▾</label>
                            @if ($openDropdown === 'v_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('v_unit', 'm/s')">m/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('v_unit', 'km/h')">km/h</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('v_unit', 'ft/s')">ft/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('v_unit', 'mph')">mph</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Angle (a) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                        <label for="a" class="font-s-14 text-blue">{{ $lang['6'] }} (α)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="a" step="any" min="1"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('a_unit')">{{ $a_unit }} ▾</label>
                            @if ($openDropdown === 'a_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('a_unit', 'deg')">deg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('a_unit', 'rad')">rad</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Height (h) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                        <label for="h" class="font-s-14 text-blue">{{ $lang['12'] }} {{ $lang['7'] }} (h)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="h" step="any" min="0"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('h_unit')">{{ $h_unit }} ▾</label>
                            @if ($openDropdown === 'h_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            wire:click.stop="setUnit('h_unit', '{{ $u }}')">{{ $u }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Gravity (g) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                        <label for="g" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="g" step="any" min="1"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('g_unit')">{{ $g_unit }} ▾</label>
                            @if ($openDropdown === 'g_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('g_unit', 'm/s²')">m/s²</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('g_unit', 'g')">g</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Time (t) - Only for Final Position --}}
                    @if ($method === 'fp')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="t" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="t" step="any" min="1"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('t_unit')">{{ $t_unit }} ▾</label>
                                @if ($openDropdown === 't_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            wire:click.stop="setUnit('t_unit', 'sec')">sec</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            wire:click.stop="setUnit('t_unit', 'min')">min</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            wire:click.stop="setUnit('t_unit', 'hrs')">hrs</p>
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
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[70%] lg:w-[70%] overflow-x-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%">
                                            <strong>
                                                @if ($detail['check'] === 'tof')
                                                    {{ $lang['2'] }}
                                                @elseif($detail['check'] === 'range')
                                                    {{ $lang['3'] }}
                                                @elseif($detail['check'] === 'mh')
                                                    {{ $lang['4'] }}
                                                @elseif($detail['check'] === 'fp')
                                                    {{ $lang['8'] }}
                                                @endif
                                            </strong>
                                        </td>
                                        <td class="py-2 border-b">
                                            @php
                                                $baseVal = $detail['check'] === 'tof' ? $detail['tof'] : ($detail['check'] === 'fp' ? $detail['vel'] : $detail['r'] ?? $detail['hmax']);
                                                $baseUnit = $detail['check'] === 'tof' ? 'sec' : ($detail['check'] === 'fp' ? 'm/s' : 'm');
                                            @endphp
                                            <strong class="text-blue answer">
                                                {{ $this->convertValue($baseVal, $res_unit, $baseUnit) }}
                                            </strong>
                                            <select wire:model.live="res_unit"
                                                class="d-inline border-0 text-blue font-s-16 bg-transparent"
                                                style="outline:none;border:none;width:100px">
                                                @if ($detail['check'] === 'tof')
                                                    <option value="sec">sec</option>
                                                    <option value="min">min</option>
                                                    <option value="hrs">hrs</option>
                                                @elseif($detail['check'] === 'range' || $detail['check'] === 'mh')
                                                    <option value="m">m</option>
                                                    <option value="km">km</option>
                                                    <option value="cm">cm</option>
                                                    <option value="mm">mm</option>
                                                    <option value="ft">ft</option>
                                                    <option value="in">in</option>
                                                    <option value="yd">yd</option>
                                                    <option value="mi">mi</option>
                                                @elseif($detail['check'] === 'fp')
                                                    <option value="m/s">m/s</option>
                                                    <option value="km/h">km/h</option>
                                                    <option value="ft/s">ft/s</option>
                                                    <option value="mph">mph</option>
                                                @endif
                                            </select>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-4 overflow-x-auto">
                                <table class="w-full font-s-16">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang['12'] }} {{ $lang['13'] }}
                                            {{ $lang['8'] }} (Vx)</td>
                                        <td class="py-2 border-b whitespace-nowrap flex items-center justify-start gap-2">
                                            <span class="value-span">{{ $this->convertValue($detail['vx'], $vx_unit, 'm/s') }}</span>
                                            <select wire:model.live="vx_unit"
                                                class="unitSelect d-inline border-0 text-blue font-s-16 bg-transparent"
                                                style="outline:none;border:none;width:100px">
                                                <option value="m/s">m/s</option>
                                                <option value="km/h">km/h</option>
                                                <option value="ft/s">ft/s</option>
                                                <option value="mph">mph</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang['12'] }} {{ $lang['14'] }}
                                            {{ $lang['8'] }} (Vy)</td>
                                        <td class="py-2 border-b whitespace-nowrap flex items-center justify-start gap-2">
                                            <span class="value-span">{{ $this->convertValue($detail['vy'], $vy_unit, 'm/s') }}</span>
                                            <select wire:model.live="vy_unit"
                                                class="unitSelect d-inline border-0 text-blue font-s-16 bg-transparent"
                                                style="outline:none;border:none;width:100px">
                                                <option value="m/s">m/s</option>
                                                <option value="km/h">km/h</option>
                                                <option value="ft/s">ft/s</option>
                                                <option value="mph">mph</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang['9'] }}</td>
                                        <td class="py-2 border-b whitespace-nowrap flex items-center justify-start gap-2">
                                            <span>{{ $this->convertValue($detail['g'], $g_unit_res, 'm/s²') }}</span>
                                            <select wire:model.live="g_unit_res"
                                                class="d-inline border-0 text-blue font-s-16 bg-transparent"
                                                style="outline:none;border:none;width:100px">
                                                <option value="m/s²">m/s²</option>
                                                <option value="g">g</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @if ($detail['check'] === 'fp')
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['13'] }} {{ $lang['8'] }}</td>
                                            <td class="py-2 border-b whitespace-nowrap flex items-center justify-start gap-2">
                                                <span class="value-span">{{ $this->convertValue($detail['hv'], $hv_unit, 'm/s') }}</span>
                                                <select wire:model.live="hv_unit"
                                                    class="unitSelect d-inline border-0 text-blue font-s-16 bg-transparent"
                                                    style="outline:none;border:none;width:100px">
                                                    <option value="m/s">m/s</option>
                                                    <option value="km/h">km/h</option>
                                                    <option value="ft/s">ft/s</option>
                                                    <option value="mph">mph</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['14'] }} {{ $lang['8'] }}</td>
                                            <td class="py-2 border-b whitespace-nowrap flex items-center justify-start gap-2">
                                                <span class="value-span">{{ $this->convertValue($detail['vv'], $vv_unit, 'm/s') }}</span>
                                                <select wire:model.live="vv_unit"
                                                    class="unitSelect d-inline border-0 text-blue font-s-16 bg-transparent"
                                                    style="outline:none;border:none;width:100px">
                                                    <option value="m/s">m/s</option>
                                                    <option value="km/h">km/h</option>
                                                    <option value="ft/s">ft/s</option>
                                                    <option value="mph">mph</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['13'] }}
                                                {{ $lang['15'] }}</td>
                                            <td class="py-2 border-b whitespace-nowrap flex items-center justify-start gap-2">
                                                <span class="value-span">{{ $this->convertValue($detail['x'], $x_unit, 'm') }}</span>
                                                <select wire:model.live="x_unit"
                                                    class="unitSelect d-inline border-0 text-blue font-s-16 bg-transparent"
                                                    style="outline:none;border:none;width:100px">
                                                    <option value="m">m</option>
                                                    <option value="km">km</option>
                                                    <option value="cm">cm</option>
                                                    <option value="mm">mm</option>
                                                    <option value="ft">ft</option>
                                                    <option value="in">in</option>
                                                    <option value="yd">yd</option>
                                                    <option value="mi">mi</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['7'] }}</td>
                                            <td class="py-2 border-b whitespace-nowrap flex items-center justify-start gap-2">
                                                <span class="value-span">{{ $this->convertValue($detail['y'], $y_unit, 'm') }}</span>
                                                <select wire:model.live="y_unit"
                                                    class="unitSelect d-inline border-0 text-blue font-s-16 bg-transparent"
                                                    style="outline:none;border:none;width:100px">
                                                    <option value="m">m</option>
                                                    <option value="km">km</option>
                                                    <option value="cm">cm</option>
                                                    <option value="mm">mm</option>
                                                    <option value="ft">ft</option>
                                                    <option value="in">in</option>
                                                    <option value="yd">yd</option>
                                                    <option value="mi">mi</option>
                                                </select>
                                            </td>
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
