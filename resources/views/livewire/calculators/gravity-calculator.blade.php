<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Calculation Mode --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="calculation_type" class="label">{{ $lang['10'] ?? 'I want to calculate' }}</label>
                        <select wire:model.live="calculation_type" id="calculation_type" class="input">
                            <option value="1">{{ $lang['5'] ?? 'Gravitational Force' }} (F)</option>
                            <option value="2">{{ $lang['2'] ?? 'Mass' }} (M)</option>
                            <option value="3">{{ $lang['3'] ?? 'Mass' }} (m)</option>
                            <option value="4">{{ $lang['4'] ?? 'Distance' }} (R)</option>
                            <option value="5">{{ $lang['9'] ?? 'Local Gravity' }} (g)</option>
                        </select>
                    </div>

                    {{-- Mass 1 (M) --}}
                    @if (in_array($calculation_type, ['1', '3', '4']))
                        <div class="col-span-12 md:col-span-6">
                            <label for="mass_one" class="label">{{ $lang['2'] ?? 'Mass' }} (M)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="mass_one" id="mass_one" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('mass_one_unit')">
                                    {{ $mass_one_unit }} ▾
                                </label>
                                @if ($openDropdown === 'mass_one_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['g', 'kg', 't', 'oz', 'lb', 'stone', 'US ton', 'Long ton', 'Earths', 'Suns'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mass_one_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mass 2 (m) --}}
                    @if (in_array($calculation_type, ['1', '2', '4']))
                        <div class="col-span-12 md:col-span-6">
                            <label for="mass_two" class="label">{{ $lang['3'] ?? 'Mass' }} (m)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="mass_two" id="mass_two" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('mass_two_unit')">
                                    {{ $mass_two_unit }} ▾
                                </label>
                                @if ($openDropdown === 'mass_two_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['g', 'kg', 't', 'oz', 'lb', 'stone', 'US ton', 'Long ton', 'Earths', 'Suns'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mass_two_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Gravitational Force (F) --}}
                    @if (in_array($calculation_type, ['2', '3', '4']))
                        <div class="col-span-12 md:col-span-6">
                            <label for="gravitational_force" class="label">{{ $lang['5'] ?? 'Gravitational Force' }} (F)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="gravitational_force" id="gravitational_force" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('gravitational_force_unit')">
                                    {{ $gravitational_force_unit }} ▾
                                </label>
                                @if ($openDropdown === 'gravitational_force_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['N', 'kN', 'MN', 'GN', 'TN', 'lbf'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('gravitational_force_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Distance (R) --}}
                    @if (in_array($calculation_type, ['1', '2', '3']))
                        <div class="col-span-12 md:col-span-6">
                            <label for="distance" class="label">{{ $lang['4'] ?? 'Distance' }} (R)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="distance" id="distance" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('distance_unit')">
                                    {{ $distance_unit }} ▾
                                </label>
                                @if ($openDropdown === 'distance_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['nm', 'μm', 'mm', 'cm', 'm', 'km', 'in', 'ft', 'yd'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('distance_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Gravitational Constant (G) --}}
                    @if ($calculation_type != '5')
                        <div class="col-span-12 md:col-span-6">
                            <label for="constant" class="label">{{ $lang['6'] ?? 'Gravitational Constant' }} (G)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="constant" id="constant" class="input" />
                                <span class="absolute right-6 top-4 text-sm text-gray-500">x10⁻¹¹ N⋅m²/kg²</span>
                            </div>
                        </div>
                    @endif

                    {{-- Latitude & Height (for g) --}}
                    @if ($calculation_type == '5')
                        <div class="col-span-12 md:col-span-6">
                            <label for="latitude" class="label">{{ $lang['7'] ?? 'Latitude' }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="latitude" id="latitude" class="input" />
                                <span class="absolute right-6 top-4 text-sm text-gray-500">degree</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="height" class="label">{{ $lang['8'] ?? 'Altitude' }} (h)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="height" id="height" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('height_unit')">
                                    {{ $height_unit }} ▾
                                </label>
                                @if ($openDropdown === 'height_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                        @foreach (['ft', 'm'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('height_unit', '{{ $u }}')">{{ $u }}</p>
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
    </form>

    <hr>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
            <div class="text-left space-y-6 overflow-auto">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full mt-2">
                    <div class="w-full md:w-[100%] overflow-auto">
                        <table class="w-full text-[18px]">
                            @if (isset($detail['force']) && $detail['force'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['5'] ?? 'Gravitational Force' }} (F)</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['force'], 4) }} (N)</td>
                                </tr>
                            @endif
                            @if (isset($detail['first_mass']) && $detail['first_mass'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['2'] ?? 'Mass' }} (M)</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['first_mass'], 4) }} (kg)</td>
                                </tr>
                            @endif
                            @if (isset($detail['second_mass']) && $detail['second_mass'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['3'] ?? 'Mass' }} (m)</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['second_mass'], 4) }} (kg)</td>
                                </tr>
                            @endif
                            @if (isset($detail['distance']) && $detail['distance'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['4'] ?? 'Distance' }} (R)</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['distance'], 4) }} (m)</td>
                                </tr>
                            @endif
                            @if (isset($detail['g']) && $detail['g'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['9'] ?? 'Local Gravity' }} (g)</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['g'], 4) }} (m/s²)</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
