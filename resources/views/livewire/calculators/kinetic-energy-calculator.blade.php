<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                {{-- Tabs --}}
                <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $submit == 'linear' ? 'bg-blue-600 text-white' : 'bg-white hover:bg-blue-50' }}"
                                wire:click="setTab('linear')">
                                {{ $lang['linear'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $submit == 'rotational' ? 'bg-blue-600 text-white' : 'bg-white hover:bg-blue-50' }}"
                                wire:click="setTab('rotational')">
                                {{ $lang['rot'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4">
                    {{-- Linear Section --}}
                    @if($submit == 'linear')
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-4">
                            <strong class="col-span-12 mt-2 px-2">To Calculate:</strong>
                            <div class="col-span-12 flex items-center space-x-4 px-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="to_cal" value="kin" class="mx-1">
                                    <span class="font-s-14 text-blue">{{ $lang['kin'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="to_cal" value="mass" class="mx-1">
                                    <span class="font-s-14 text-blue">{{ $lang['mass'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="to_cal" value="velo" class="mx-1">
                                    <span class="font-s-14 text-blue">{{ $lang['velo'] }}</span>
                                </label>
                            </div>

                            @if($to_cal != 'mass')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="mass" class="font-s-14 text-blue">{{ $lang['mass'] }}:</label>
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
                                <label for="velocity" class="font-s-14 text-blue">{{ $lang['velo'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="velocity" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_v')">{{ $unit_v }} ▾</label>
                                    @if($openDropdown === 'unit_v')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg  overflow-y-auto">
                                            @foreach(['miles/s', 'km/s', 'm/s', 'ft/s', 'in/s', 'yd/s', 'km/h', 'm/h'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_v', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($to_cal != 'kin')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="kin" class="font-s-14 text-blue">{{ $lang['kin'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="kin" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_k')">{{ $unit_k }} ▾</label>
                                    @if($openDropdown === 'unit_k')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['j', 'kJ', 'MJ', 'Wh', 'kWh'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_k', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- Rotational Section --}}
                    @if($submit == 'rotational')
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-4">
                            <strong class="col-span-12 mt-2 px-2">To Calculate:</strong>
                            <div class="col-span-12 flex items-center space-x-4 px-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="to_calr" value="r_kin" class="mx-1">
                                    <span class="font-s-14 text-blue">{{ $lang['kin'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="to_calr" value="moi" class="mx-1">
                                    <span class="font-s-14 text-blue">{{ $lang['moi'] }}</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="to_calr" value="a_v" class="mx-1">
                                    <span class="font-s-14 text-blue">{{ $lang['a_v'] }}</span>
                                </label>
                            </div>

                            @if($to_calr != 'moi')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="moment" class="font-s-14 text-blue">{{ $lang['moi'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="moment" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_i')">{{ $unit_i }} ▾</label>
                                    @if($openDropdown === 'unit_i')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['kg*m²', 'lbs*ft²'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_i', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($to_calr != 'a_v')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="a_velocity" class="font-s-14 text-blue">{{ $lang['a_v'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" step="any" wire:model.live="a_velocity" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_v_r')">{{ $unit_v_r }} ▾</label>
                                    @if($openDropdown === 'unit_v_r')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['rad/s', 'rpm', 'Hz'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_v_r', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($to_calr != 'r_kin')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="r_kin" class="font-s-14 text-blue">{{ $lang['kin'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="r_kin" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit_k_r')">{{ $unit_k_r }} ▾</label>
                                    @if($openDropdown === 'unit_k_r')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['j', 'kJ', 'MJ', 'Wh', 'kWh'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('unit_k_r', '{{ $u }}')">{{ $u }}</p>
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
                        {{-- Rotational Results --}}
                        @if(isset($detail['a_velocity']))
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['a_v'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['a_velocity'], 4) }} rad/s</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['kin'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $r_kin }} {{ $unit_k_r }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['moi'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $moment }} {{ $unit_i }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif

                        @if(isset($detail['moment']))
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['moi'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['moment'], 4) }} kg*m²</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['kin'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $r_kin }} {{ $unit_k_r }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['a_v'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $a_velocity }} rad/s</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif

                        @if(isset($detail['r_kin']))
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['kin'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['r_kin'], 4) }} J</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['moi'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $moment }} {{ $unit_i }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['a_v'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $a_velocity }} rad/s</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif

                        {{-- Linear Results --}}
                        @if(isset($detail['velocity']))
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['velo'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['velocity'], 4) }} m/s</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 mt-3 font-s-18"><strong>Result in Other Units</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['velo'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['velocity']/1609, 6) }} miles/s</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['velo'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['velocity']/1000, 6) }} km/s</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['velo'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['velocity']*3.28084, 4) }} ft/s</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['velo'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['velocity']*2.23694, 4) }} miles/h</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['velo'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['velocity']*3.6, 4) }} km/h</strong></td></tr>
                                </table>
                            </div>
                        @endif

                        @if(isset($detail['mass']))
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['mass'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['mass'], 4) }} kg</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 mt-3 font-s-18"><strong>Result in Other Units</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['mass'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['mass']*1e+6, 2) }} mg</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['mass'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['mass']*1e+3, 2) }} g</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['mass'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['mass']*2.20462, 4) }} lbs</strong></td></tr>
                                </table>
                            </div>
                        @endif

                        @if(isset($detail['kin']))
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['kin'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['kin'], 4) }} J</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 mt-3 font-s-18"><strong>Result in Other Units</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['kin'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['kin']/1000, 6) }} kJ</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['kin'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['kin']/1000000, 6) }} MJ</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['kin'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['kin']/3600, 6) }} Wh</strong></td></tr>
                                    <tr><td class="text-blue py-2 border-b">{{ $lang['kin'] }}</td><td class="py-2 border-b"><strong>{{ round($detail['kin']/3.6e+6, 8) }} kWh</strong></td></tr>
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
