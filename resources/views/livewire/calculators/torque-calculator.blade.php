<div>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">

                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2">
                        <label for="to" class="font-s-14 text-blue">To Calculate:</label>
                        <select wire:model.live="to" id="to" class="input">
                            <option value="1">{{ $lang['tor'] }}</option>
                            <option value="2">{{ $lang['coil'] }}</option>
                            <option value="3">{{ $lang['vector'] }}</option>
                        </select>
                    </div>
                </div>
                @if ($to == '1')
                    <div class="grid grid-cols-1 mt-2 gap-4">
                        <p class="w-full px-2"><strong>Note:</strong> Please! enter any three values to know the fourth
                            one.</p>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">

                        {{-- Distance --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['dis'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="distance"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('dis_u')">
                                        {{ $dis_u }} ▾
                                    </label>
                                    <input type="hidden" name="dis_u" value="{{ $dis_u }}">
                                    @if ($openDropdown === 'dis_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['m', 'mm', 'cm', 'km', 'in', 'ft', 'yd'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('dis_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Force --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['for'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="force"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('for_u')">
                                        {{ $for_u }} ▾
                                    </label>
                                    <input type="hidden" name="for_u" value="{{ $for_u }}">
                                    @if ($openDropdown === 'for_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['N', 'kN', 'MN', 'GN', 'TN'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('for_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Angle --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['ang'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="angle"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('ang_u')">
                                        {{ $ang_u }} ▾
                                    </label>
                                    <input type="hidden" name="ang_u" value="{{ $ang_u }}">
                                    @if ($openDropdown === 'ang_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['deg', 'rad', 'gon', 'tr', 'arcmin', 'arcsec', 'mrad', 'μrad'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('ang_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Torque --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['tor'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="torque"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('tor_u')">
                                        {{ $tor_u }} ▾
                                    </label>
                                    <input type="hidden" name="tor_u" value="{{ $tor_u }}">
                                    @if ($openDropdown === 'tor_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['Nm', 'kg-cm', 'J/rad', 'ft-lb'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('tor_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                @endif

                @if ($to == '2')
                    <div class="grid grid-cols-1 mt-2 gap-4">
                        <p class="px-2"><strong>Note:</strong> Please! enter any five values to know the sixth one.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">

                        {{-- Loop --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['loop'] }}:</label>
                            <input type="number" wire:model.live="loop" class="input" placeholder="00" />
                        </div>

                        {{-- Angle C --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['ang'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="angle_c"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('angc_u')">
                                        {{ $angc_u }} ▾
                                    </label>
                                    <input type="hidden" name="angc_u" value="{{ $angc_u }}">
                                    @if ($openDropdown === 'angc_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['deg', 'rad', 'gon', 'tr', 'arcmin', 'arcsec', 'mrad', 'μrad'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('angc_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Current --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['cur'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="current"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('cur_u')">
                                        {{ $cur_u }} ▾
                                    </label>
                                    <input type="hidden" name="cur_u" value="{{ $cur_u }}">
                                    @if ($openDropdown === 'cur_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['A', 'mA', 'kA', 'μA', 'boit'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('cur_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Area --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['area'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="area"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('area_u')">
                                        {{ $area_u }} ▾
                                    </label>
                                    <input type="hidden" name="area_u" value="{{ $area_u }}">
                                    @if ($openDropdown === 'area_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['m²', 'km²', 'Mile²', 'ac', 'yd²', 'ft²', 'in²', 'cm²', 'mm²'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('area_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Magnetic --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['mag'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="mag"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('mag_u')">
                                        {{ $mag_u }} ▾
                                    </label>
                                    <input type="hidden" name="mag_u" value="{{ $mag_u }}">
                                    @if ($openDropdown === 'mag_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['T', 'mT', 'μT'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('mag_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Torque (coil) --}}
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['tor'] }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="tor"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                    placeholder="00" />
                                <div class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        wire:click.stop="toggleDropdown('torc_u')">
                                        {{ $torc_u }} ▾
                                    </label>
                                    <input type="hidden" name="torc_u" value="{{ $torc_u }}">
                                    @if ($openDropdown === 'torc_u')
                                        <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0">
                                            @foreach (['Nm', 'kg-cm', 'J/rad', 'ft-lb'] as $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                    wire:click.stop="setUnit('torc_u', '{{ $val }}')">
                                                    {{ $val }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
                @if ($to == '3')
                    {{-- Vector A (r) --}}
                    <div class="grid grid-cols-1 gap-4 mt-3">
                        <div class="space-y-2">
                            <p><strong>{{ $lang['av'] }}, r:</strong></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 lg:grid-cols-3 md:grid-cols-3 gap-4">
                        <div class="space-y-2 relative">
                            <label class="font-s-14 text-blue">&nbsp;</label>
                            <input type="number" wire:model.live="ax" class="input" placeholder="00" />
                            <span class="text-blue input_unit">i</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label class="font-s-14 text-blue">&nbsp;</label>
                            <input type="number" wire:model.live="ay" class="input" placeholder="00" />
                            <span class="text-blue input_unit">j</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label class="font-s-14 text-blue">&nbsp;</label>
                            <input type="number" wire:model.live="az" class="input" placeholder="00" />
                            <span class="text-blue input_unit">k</span>
                        </div>
                    </div>

                    {{-- Vector B (F) --}}
                    <div class="grid grid-cols-1 mt-3 gap-4">
                        <div class="space-y-2">
                            <p><strong>{{ $lang['bv'] }}, F:</strong></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 lg:grid-cols-3 md:grid-cols-3 gap-4">
                        <div class="space-y-2 relative">
                            <label class="font-s-14 text-blue">&nbsp;</label>
                            <input type="number" wire:model.live="bx" class="input" placeholder="00" />
                            <span class="text-blue input_unit">i</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label class="font-s-14 text-blue">&nbsp;</label>
                            <input type="number" wire:model.live="by" class="input" placeholder="00" />
                            <span class="text-blue input_unit">j</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label class="font-s-14 text-blue">&nbsp;</label>
                            <input type="number" wire:model.live="bz" class="input" placeholder="00" />
                            <span class="text-blue input_unit">k</span>
                        </div>
                    </div>
                @endif

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
                        <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                            <div class="lg:w-7/12 mt-2">
                                @if ($to == 1)
                                    <table class="w-full text-lg">
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['dis'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['dis'] ?? '' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['for'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['force'] ?? '' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['ang'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['angle'] ?? '' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['tor'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['tor'] ?? '' }}</strong></td>
                                        </tr>
                                    </table>
                                @elseif($to == 2)
                                    <table class="w-full text-lg">
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['loop'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['loop'] ?? '' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['ang'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['angle'] ?? '' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['cur'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['current'] ?? '' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['area'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['area'] ?? '' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['mag'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['mag'] ?? '' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b  w-7/10">{{ $lang['tor'] }}</td>
                                            <td class="py-2 border-b ">
                                                <strong>{{ $detail['tor'] ?? '' }}</strong></td>
                                        </tr>
                                    </table>
                                @elseif($to == 3)
                                    <p class="mt-2">{{ $lang['vector'] }} = <strong
                                            class="text-black">{{ $detail['ans'] ?? '' }}</strong></p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
