<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Mode Selection --}}
                    <div class="col-span-12">
                        <label for="calculation_type" class="label">{{ $lang['1'] ?? 'Calculate' }}</label>
                        <select wire:model.live="calculation_type" id="calculation_type" class="input">
                            <option value="1">Friction Coefficient</option>
                            <option value="2">Normal Force</option>
                            <option value="3">Friction</option>
                            <option value="4">Frictional Force (Inclined Plane)</option>
                        </select>
                    </div>

                    {{-- Friction Coefficient (μ) --}}
                    @if (in_array($calculation_type, ['2', '3', '4']))
                        <div class="col-span-12 md:col-span-12">
                            <label for="fr_co" class="label">{{ $lang['2'] ?? 'Friction Coefficient' }} (μ)</label>
                            <input type="number" step="any" wire:model.live="fr_co" id="fr_co" class="input" placeholder="00" />
                        </div>
                    @endif

                    {{-- Normal Force (N) --}}
                    @if (in_array($calculation_type, ['1', '3']))
                        <div class="col-span-12 md:col-span-12">
                            <label for="force" class="label">{{ $lang['3'] ?? 'Normal Force' }} (N)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="force" id="force" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('force_unit')">
                                    {{ $force_unit }} ▾
                                </label>
                                @if ($openDropdown === 'force_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                        @foreach (['N', 'kN', 'MN', 'GN', 'TN'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('force_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Friction (F) --}}
                    @if (in_array($calculation_type, ['1', '2']))
                        <div class="col-span-12 md:col-span-12">
                            <label for="fr" class="label">{{ $lang['4'] ?? 'Friction Force' }} (F)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="fr" id="fr" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('fr_unit')">
                                    {{ $fr_unit }} ▾
                                </label>
                                @if ($openDropdown === 'fr_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                        @foreach (['N', 'kN', 'MN', 'GN', 'TN'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('fr_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Inclined Plane Specifics --}}
                    @if ($calculation_type == '4')
                        <div class="col-span-12 md:col-span-6">
                            <label for="mass" class="label">{{ $lang['5'] ?? 'Mass' }} (m)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="mass" id="mass" class="input" placeholder="00" />
                                <span class="text-blue input_unit">kg</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="plane" class="label">{{ $lang['6'] ?? 'Angle' }} (θ)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="plane" id="plane" class="input" placeholder="00" />
                                <span class="text-blue input_unit">°</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12">
                            <label for="gravity" class="label">{{ $lang['7'] ?? 'Gravity' }} (g)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="gravity" id="gravity" class="input" placeholder="00" />
                                <span class="text-blue input_unit">m/s²</span>
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
                <div class="w-full mt-2 text-center">
                    @if (!empty($detail['friction_coefficient']))
                        <div class="space-y-4">
                            <p class="text-lg">{{ $lang['2'] ?? 'Friction Coefficient' }} (μ)</p>
                            <p><strong class="bg-[#2845F5] text-white rounded-lg px-4 py-2 text-3xl inline-block">{{ number_format($detail['friction_coefficient'], 4) }}</strong></p>
                        </div>
                    @endif
                    
                    @if (!empty($detail['calculate_force']))
                        <div class="space-y-4">
                            <p class="text-lg">{{ $lang['3'] ?? 'Normal Force' }}</p>
                            <p><strong class="bg-[#2845F5] text-white rounded-lg px-4 py-2 text-3xl inline-block">{{ number_format($detail['calculate_force'], 2) }} (N)</strong></p>
                        </div>
                    @endif

                    @if (!empty($detail['friction']))
                        <div class="space-y-4">
                            <p class="text-lg">{{ $lang['4'] ?? 'Friction Force' }}</p>
                            <p><strong class="bg-[#2845F5] text-white rounded-lg px-4 py-2 text-3xl inline-block">{{ number_format($detail['friction'], 2) }} (N)</strong></p>
                        </div>
                    @endif

                    @if (!empty($detail['friction2']))
                        <div class="space-y-4">
                            <p class="text-lg">{{ $lang['8'] ?? 'Friction Force (Inclined)' }}</p>
                            <p><strong class="bg-[#2845F5] text-white rounded-lg px-4 py-2 text-3xl inline-block">{{ number_format($detail['friction2'], 2) }} (N)</strong></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endisset
</div>
