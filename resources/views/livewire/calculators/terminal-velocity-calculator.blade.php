<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Shape Selection and Image --}}
                    <div class="col-span-12 md:col-span-12 grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-12 md:col-span-6">
                            <label for="shapes" class="label">{{ $lang[1] ?? 'Shape' }}</label>
                            <select wire:model.live="shapes" id="shapes" class="input">
                                <option value="1">{{ $lang['7'] ?? 'Sphere' }}</option>
                                <option value="2">{{ $lang['8'] ?? 'Golf Ball' }}</option>
                                <option value="3">{{ $lang['9'] ?? 'Baseball' }}</option>
                                <option value="4">{{ $lang['10'] ?? 'Half Sphere' }}</option>
                                <option value="5">{{ $lang['11'] ?? 'Cube' }}</option>
                                <option value="6">{{ $lang['12'] ?? 'Angled Cube' }}</option>
                                <option value="7">{{ $lang['13'] ?? 'Streamlined Body' }}</option>
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex justify-center">
                            @if ($shapeImage)
                                <img src="{{ $shapeImage }}" alt="Shape Preview" class="h-32 w-32 object-contain transition-all duration-300">
                            @endif
                        </div>
                    </div>

                    {{-- Mass Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="mass" class="label">{{ $lang['2'] ?? 'Mass' }} (m)</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="mass" id="mass" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('mass_unit')">
                                {{ $mass_unit }} ▾
                            </label>
                            @if ($openDropdown === 'mass_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                    @foreach (['mg', 'g', 'kg', 't', 'gr', 'oz', 'lb'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mass_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Area Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="area" class="label">{{ $lang['3'] ?? 'Projected Area' }} (A)</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="area" id="area" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('area_unit')">
                                {{ $area_unit }} ▾
                            </label>
                            @if ($openDropdown === 'area_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                    @foreach (['mm²', 'cm²', 'm²', 'in²', 'yd²'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Drag Coefficient (Auto-updated by Shape) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="drag_coefficient" class="label">{{ $lang['4'] ?? 'Drag Coefficient' }} (C_d)</label>
                        <input type="number" step="any" wire:model.live="drag_coefficient" id="drag_coefficient" class="input bg-gray-50" />
                    </div>

                    {{-- Fluid Density Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="density" class="label">{{ $lang['5'] ?? 'Fluid Density' }} (ρ)</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="density" id="density" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('density_unit')">
                                {{ $density_unit }} ▾
                            </label>
                            @if ($openDropdown === 'density_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                    @foreach (['kg/m³', 'lb cu/ft', 'g/cm³', 'kg/cm³'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('density_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Gravity Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="gravity" class="label">{{ $lang['6'] ?? 'Gravity' }} (g)</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="gravity" id="gravity" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('gravity_unit')">
                                {{ $gravity_unit }} ▾
                            </label>
                            @if ($openDropdown === 'gravity_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                    @foreach (['m/s²', 'ft/s²'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('gravity_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
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
                    <table class="w-full text-[18px]">
                        <tr>
                            <td class="py-2 border-b" width="60%"><strong>{{ $lang[14] ?? 'Terminal Velocity' }}</strong></td>
                            <td class="py-2 border-b">{{ number_format($detail['terminal_velocity'], 5) }} (m/s)</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b"><strong>{{ $lang[15] ?? 'Drag Area' }}</strong></td>
                            <td class="py-2 border-b">{{ number_format($detail['drag_coefficient_area'], 5) }} (m²)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @endisset
</div>
