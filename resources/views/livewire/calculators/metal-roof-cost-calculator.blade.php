<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 mt-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="roof_type" class="label">{{ $lang['1'] ?? 'Flat Roof?' }}</label>
                        <select wire:model.live="roof_type" id="roof_type" class="input">
                            <option value="yes">{{ $lang['yes'] ?? 'Yes' }}</option>
                            <option value="no">{{ $lang['no'] ?? 'No' }}</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-3 gap-4">
                    <p class="mt-1"><strong>{{ $lang['2'] ?? 'Roof Dimensions' }}</strong></p>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="r_length" class="label">{{ $lang['4'] ?? 'Length' }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="r_length" id="r_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('rl_units_dropdown')">{{ $rl_units }} ▾</label>
                            @if ($showDropdown === 'rl_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('rl_units', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="r_width" class="label">{{ $lang['5'] ?? 'Width' }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="r_width" id="r_width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('rw_units_dropdown')">{{ $rw_units }} ▾</label>
                            @if ($showDropdown === 'rw_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('rw_units', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($roof_type == 'no')
                        <div class="space-y-2 col-span-2">
                            <label for="roof_pitch" class="label">{{ ($lang['6'] ?? 'Roof') . ' ' . ($lang['7'] ?? 'Pitch') }}</label>
                            <select wire:model="roof_pitch" id="roof_pitch" class="input">
                                @for ($i = 1; $i <= 30; $i++)
                                    <option value="{{ $i }}:12">{{ $i }}:12</option>
                                @endfor
                            </select>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 mt-3 gap-4">
                    <p class="mt-1"><strong>{{ $lang['8'] ?? 'Panel Dimensions' }}</strong></p>
                </div>

                <div class="grid grid-cols-2 mt-3 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="p_length" class="label">{{ $lang['4'] ?? 'Length' }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="p_length" id="p_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('pl_units_dropdown')">{{ $pl_units }} ▾</label>
                            @if ($showDropdown === 'pl_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pl_units', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="p_width" class="label">{{ $lang['5'] ?? 'Width' }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="p_width" id="p_width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('pw_units_dropdown')">{{ $pw_units }} ▾</label>
                            @if ($showDropdown === 'pw_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pw_units', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-3 gap-4">
                    <p class="mt-1"><strong>{{ $lang['10'] ?? 'Cost' }}</strong></p>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="cost" class="label">{{ ($lang['11'] ?? 'Price per') . ' ' . ($lang['8'] ?? 'Panel') }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" step="any" wire:model="cost" id="cost" class="input pr-10" />
                            <span class="absolute right-3 top-3 text-gray-500">{{ $currancy }}</span>
                        </div>
                    </div>
                </div>
            </div>

                @include('inc.button')
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang['12'] ?? 'Number of panels needed' }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['panel'] ?? 0) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['10'] ?? 'Expense' }} :</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['expense'] ?? 0, 0) }}</td>
                                        </tr>
                                        
                                        <!-- Roof Area Conversions -->
                                        <tr><td class="pt-4" colspan="2"><strong>{{ ($lang['6'] ?? 'Roof') . ' ' . ($lang['13'] ?? 'Area') }}</strong></td></tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_feet'] ?? 'Square feet' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['r_area'] ?? 0, 2) }} ft²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_meter'] ?? 'Square Meter' }} :</td>
                                            <td class="border-b py-2">{{ number_format(($detail['r_area'] ?? 0) * 0.0929, 3) }} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_yard'] ?? 'Square Yard' }} :</td>
                                            <td class="border-b py-2">{{ number_format(($detail['r_area'] ?? 0) * 0.1111, 3) }} yd²</td>
                                        </tr>

                                        <!-- Panel Area Conversions -->
                                        <tr><td class="pt-4" colspan="2"><strong>{{ ($lang['8'] ?? 'Panel') . ' ' . ($lang['13'] ?? 'Area') }}</strong></td></tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_feet'] ?? 'Square feet' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['p_area'] ?? 0, 2) }} ft²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_cm'] ?? 'Square Centimeters' }} :</td>
                                            <td class="border-b py-2">{{ number_format(($detail['p_area'] ?? 0) * 929.03, 3) }} cm²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_dm'] ?? 'Square Decimeters' }} :</td>
                                            <td class="border-b py-2">{{ number_format(($detail['p_area'] ?? 0) * 9.2903, 3) }} dm²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_meter'] ?? 'Square Meter' }} :</td>
                                            <td class="border-b py-2">{{ number_format(($detail['p_area'] ?? 0) * 0.0929, 3) }} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_inches'] ?? 'Square Inches' }} :</td>
                                            <td class="border-b py-2">{{ number_format(($detail['p_area'] ?? 0) * 144, 2) }} in²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['square_yard'] ?? 'Square Yard' }} :</td>
                                            <td class="border-b py-2">{{ number_format(($detail['p_area'] ?? 0) * 0.1111, 3) }} yd²</td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Inputs Section -->
                                <div class="mt-8 font-s-18">
                                    <p class="font-bold text-xl mb-4"><strong>{{ $lang['inputs'] ?? 'Inputs' }}</strong></p>
                                    <div class="space-y-1">
                                        <p>{{ $lang['6'] ?? 'Roof' }} {{ $lang['4'] ?? 'Length' }} = {{ $detail['r_length'] }} ft</p>
                                        <p>{{ $lang['6'] ?? 'Roof' }} {{ $lang['5'] ?? 'Width' }} = {{ $detail['r_width'] }} ft</p>
                                        @if (isset($detail['roof_pitch']))
                                            <p>{{ $lang['6'] ?? 'Roof' }} {{ $lang['7'] ?? 'pitch' }} = {{ $detail['roof_pitch'] }} - Proportional value - {{ $detail['value'] }}</p>
                                        @endif
                                        <p>{{ $lang['8'] ?? 'Panel' }} {{ $lang['4'] ?? 'Length' }} = {{ $detail['p_length'] }} ft</p>
                                        <p>{{ $lang['8'] ?? 'Panel' }} {{ $lang['5'] ?? 'Width' }} = {{ $detail['p_width'] }} ft</p>
                                        <p>{{ $lang['32'] ?? 'Cost of one Panel' }} = {{ $detail['cost'] }}</p>
                                    </div>
                                </div>

                                <!-- Solution Section -->
                                <div class="mt-8 font-s-18">
                                    <p class="font-bold text-xl mb-4"><strong>{{ $lang['solution'] ?? 'Solution' }}</strong></p>
                                    <div class="space-y-6">
                                        <div>
                                            <p class="text-blue-600">let's proceed with calculating the Roof Area.</p>
                                            <p class="mt-2 font-bold">Roof Area = {{ $lang['6'] ?? 'Roof' }} {{ $lang['4'] ?? 'Length' }} × {{ $lang['6'] ?? 'Roof' }} {{ $lang['5'] ?? 'Width' }} 
                                                @if (isset($detail['roof_pitch'])) × <strong>{{ $lang['6'] ?? 'Roof' }} {{ $lang['7'] ?? 'pitch' }}</strong> @endif
                                            </p>
                                            <p class="mt-1">Roof Area = {{ $detail['r_length'] }} × {{ $detail['r_width'] }} @if (isset($detail['roof_pitch'])) × <strong>{{ $detail['value'] }}</strong> @endif</p>
                                            <p class="mt-1 text-[#2845F5]">Roof Area = {{ number_format($detail['r_area'], 2) }} ft²</p>
                                        </div>

                                        <div>
                                            <p class="text-blue-600">let's proceed with calculating the Panel Area.</p>
                                            <p class="mt-2 font-bold">Panel Area = {{ $lang['8'] ?? 'Panel' }} {{ $lang['4'] ?? 'Length' }} × {{ $lang['8'] ?? 'Panel' }} {{ $lang['5'] ?? 'Width' }}</p>
                                            <p class="mt-1">Panel Area = {{ $detail['p_length'] }} × {{ $detail['p_width'] }}</p>
                                            <p class="mt-1 text-[#2845F5]">Panel Area = {{ number_format($detail['p_area'], 2) }} ft²</p>
                                        </div>

                                        <div>
                                            <p class="text-blue-600">let's proceed with calculating the Number of panels needed.</p>
                                            <div class="mt-2 flex items-center">
                                                <span class="mr-2">No. Panels = </span>
                                                <div class="inline-flex flex-col items-center">
                                                    <span class="border-b border-black px-2">{{ $lang['roof_area'] ?? 'Roof Area' }}</span>
                                                    <span class="px-2">{{ $lang['panel_area'] ?? 'Panel Area' }}</span>
                                                </div>
                                            </div>
                                            <div class="mt-2 flex items-center">
                                                <span class="mr-2">No. Panels = </span>
                                                <div class="inline-flex flex-col items-center">
                                                    <span class="border-b border-black px-2">{{ number_format($detail['r_area'], 2) }}</span>
                                                    <span class="px-2">{{ number_format($detail['p_area'], 2) }}</span>
                                                </div>
                                            </div>
                                            <p class="mt-2 text-[#2845F5]">No. Panels = {{ round($detail['panel']) }}</p>
                                        </div>

                                        <div>
                                            <p class="text-blue-600">let's proceed with calculating the Expense.</p>
                                            <p class="mt-2 font-bold">Expense = Cost of one Panel × No. Panels</p>
                                            <p class="mt-1">Expense = {{ $detail['cost'] }} × {{ round($detail['panel']) }}</p>
                                            <p class="mt-1 text-[#2845F5]">Expense = {{ number_format($detail['expense'], 0) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
