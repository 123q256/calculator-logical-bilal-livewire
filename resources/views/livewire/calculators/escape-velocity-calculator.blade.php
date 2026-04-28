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
                        <label for="find" class="label">{{ $lang['26'] ?? 'I want to find' }}</label>
                        <select wire:model.live="find" id="find" class="input">
                            <option value="1">{{ $lang['27'] ?? 'Escape Velocity' }}</option>
                            <option value="2">{{ $lang['28'] ?? 'Mass' }}</option>
                            <option value="3">{{ $lang['29'] ?? 'Radius' }}</option>
                        </select>
                    </div>

                    {{-- Planet/Body Selection --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="planet" class="label">{{ $lang['13'] ?? 'Select Planet/Body' }}</label>
                        <select wire:model.live="planet" id="planet" class="input">
                            <option value="1">{{ $lang['14'] ?? 'Sun' }}</option>
                            <option value="2">{{ $lang['15'] ?? 'Mercury' }}</option>
                            <option value="3">{{ $lang['16'] ?? 'Venus' }}</option>
                            <option value="4">{{ $lang['17'] ?? 'Earth' }}</option>
                            <option value="5">{{ $lang['18'] ?? 'Moon' }}</option>
                            <option value="6">{{ $lang['19'] ?? 'Mars' }}</option>
                            <option value="7">{{ $lang['20'] ?? 'Phobos' }}</option>
                            <option value="8">{{ $lang['21'] ?? 'Ceres' }}</option>
                            <option value="9">{{ $lang['22'] ?? 'Jupiter' }}</option>
                            <option value="10">{{ $lang['23'] ?? 'Saturn' }}</option>
                            <option value="11">{{ $lang['24'] ?? 'Uranus' }}</option>
                            <option value="12">{{ $lang['25'] ?? 'Neptune' }}</option>
                        </select>
                    </div>

                    {{-- Mass Input --}}
                    @if (in_array($find, ['1', '3']))
                        <div class="col-span-12 md:col-span-6">
                            <label for="mass" class="label">{{ $lang['12'] ?? 'Planet Mass' }} (M)</label>
                            <div class="relative">
                                <input type="text" wire:model.live="mass" id="mass" class="input" placeholder="0.0" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('mass_unit')">
                                    {{ $mass_unit }} ▾
                                </label>
                                @if ($openDropdown === 'mass_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                        @foreach (['kg', 't', 'lb', 'oz'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mass_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Radius Input --}}
                    @if (in_array($find, ['1', '2']))
                        <div class="col-span-12 md:col-span-6">
                            <label for="radius" class="label">{{ $lang['11'] ?? 'Planet Radius' }} (r)</label>
                            <div class="relative">
                                <input type="text" wire:model.live="radius" id="radius" class="input" placeholder="0.0" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('radius_unit')">
                                    {{ $radius_unit }} ▾
                                </label>
                                @if ($openDropdown === 'radius_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                        @foreach (['m', 'km', 'yd', 'mi'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('radius_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Escape Velocity Input (when finding mass or radius) --}}
                    @if (in_array($find, ['2', '3']))
                        <div class="col-span-12">
                            <label for="escape_velocity" class="label">{{ $lang['1'] ?? 'Escape Velocity' }} (v_e)</label>
                            <div class="relative">
                                <input type="text" wire:model.live="escape_velocity" id="escape_velocity" class="input" placeholder="0.0" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('escape_unit')">
                                    {{ $escape_unit }} ▾
                                </label>
                                @if ($openDropdown === 'escape_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                        @foreach (['m/s', 'km/h', 'mph', 'km/s'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('escape_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Other Constants (Always visible as per original logic) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="orbit" class="label">{{ $lang['10'] ?? 'Orbit Radius' }} (R)</label>
                        <div class="relative">
                            <input type="text" wire:model.live="orbit" id="orbit" class="input" />
                            <span class="absolute right-6 top-4 text-sm text-gray-500">AU</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="galaxy_mass" class="label">{{ $lang['9'] ?? 'Host Mass' }} (Mc)</label>
                        <div class="relative">
                            <input type="text" wire:model.live="galaxy_mass" id="galaxy_mass" class="input" />
                            <span class="absolute right-6 top-4 text-sm text-gray-500">kg</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="gravity" class="label">{{ $lang['8'] ?? 'Gravitational Constant' }} (G)</label>
                        <input type="text" wire:model.live="gravity" id="gravity" class="input" />
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
                <div class="w-full mt-2">
                    <div class="w-full md:w-[100%] overflow-auto">
                        @if ($detail['method'] == '1')
                            <table class="w-full text-[18px]">
                                <tr class="bg-blue-50">
                                    <td class="py-3 px-4 border-b"><strong>{{ $lang[1] ?? 'Escape Velocity' }} (V<sub>e</sub>)</strong></td>
                                    <td class="py-3 px-4 border-b"><strong>{{ number_format($detail['escape_velocity'], 4) }} (km/s)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $lang['2'] ?? '1st Cosmic Velocity' }} (V<sub>1</sub>)</td>
                                    <td class="py-2 px-4 border-b">{{ number_format($detail['first_cosmic_velocity'], 4) }} (km/s)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $lang['3'] ?? 'Orbital Speed' }} (V<sub>c</sub>)</td>
                                    <td class="py-2 px-4 border-b">{{ number_format($detail['orbital_speed'] / 1000, 2) }} (km/s)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $lang['4'] ?? '3rd Cosmic Velocity' }} (V<sub>3</sub>)</td>
                                    <td class="py-2 px-4 border-b">{{ number_format(($detail['orbital_speed'] / 1000) * sqrt(2), 2) }} (km/s)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $lang['5'] ?? 'Orbital Period' }} (T<sub>c</sub>)</td>
                                    <td class="py-2 px-4 border-b">{{ number_format($detail['orbital_period'], 3) }} (years)</td>
                                </tr>
                            </table>
                        @endif

                        @if ($detail['method'] == '2')
                            <table class="w-full text-[18px]">
                                <tr class="bg-blue-50">
                                    <td class="py-3 px-4 border-b"><strong>{{ $lang[6] ?? 'Calculated Mass' }} (M)</strong></td>
                                    <td class="py-3 px-4 border-b"><strong>{{ number_format($detail['mass_value'], 2) }} (kg)</strong></td>
                                </tr>
                                {{-- ... Similar rows for other results ... --}}
                            </table>
                        @endif

                        @if ($detail['method'] == '3')
                            <table class="w-full text-[18px]">
                                <tr class="bg-blue-50">
                                    <td class="py-3 px-4 border-b"><strong>{{ $lang[7] ?? 'Calculated Radius' }} (r)</strong></td>
                                    <td class="py-3 px-4 border-b"><strong>{{ number_format($detail['mass_value'], 2) }} (m)</strong></td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
