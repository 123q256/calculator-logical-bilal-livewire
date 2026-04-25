<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                {{-- Mode Selection --}}
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label class="label font-bold text-blue  text-xs tracking-wider">{!! $lang['1'] ?? 'Select Mode' !!}:</label>
                        <select wire:model.live="point_unit" class="input border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none bg-white">
                            <option value="entropy change for a reaction">{!! $lang['11'] !!}</option>
                            <option value="gibbs free energy ΔG = ΔH - T*ΔS">{!! $lang['12'] !!}</option>
                            <option value="isothermal entropy change of an ideal gas">{!! $lang['13'] !!}</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 space-y-6">
                    {{-- Mode 1: Entropy Change for a Reaction --}}
                    @if($point_unit === "entropy change for a reaction")
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="label text-sm font-medium">{{ $lang['2'] }}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="products" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('products_unit_dropdown')">
                                        {{ $products_unit }} ▾
                                    </label>
                                    @if ($showDropdown === 'products_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[120px]">
                                            @foreach(['j/mol*K', 'kj/mol*K', 'mj/mol*K', 'wh/mol*K', 'kwh/mol*K', 'ft-lb/mol*K', 'cal/mol*K', 'kcal/mol*K', 'ev/mol*K'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('products_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="label text-sm font-medium">{{ $lang['3'] }}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="reactants" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('reactants_unit_dropdown')">
                                        {{ $reactants_unit }} ▾
                                    </label>
                                    @if ($showDropdown === 'reactants_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[120px]">
                                            @foreach(['j/mol*K', 'kj/mol*K', 'mj/mol*K', 'wh/mol*K', 'kwh/mol*K', 'ft-lb/mol*K', 'cal/mol*K', 'kcal/mol*K', 'ev/mol*K'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('reactants_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Mode 2: Gibbs Free Energy --}}
                    @if($point_unit === "gibbs free energy ΔG = ΔH - T*ΔS")
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="label text-sm font-medium">{{ $lang['4'] }}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="enthalpy" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('enthalpy_unit_dropdown')">
                                        {{ $enthalpy_unit }} ▾
                                    </label>
                                    @if ($showDropdown === 'enthalpy_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[80px]">
                                            @foreach(['j', 'kj', 'mj', 'wh', 'kwh', 'ft-lb', 'cal', 'kcal', 'ev'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('enthalpy_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="label text-sm font-medium">{{ $lang['5'] }}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="temperature" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('temperature_unit_dropdown')">
                                        {{ $temperature_unit }} ▾
                                    </label>
                                    @if ($showDropdown === 'temperature_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[80px]">
                                            @foreach(['°C', '°F', 'K'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('temperature_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="label text-sm font-medium">{{ $lang['6'] }}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="entropy" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('entropy_unit_dropdown')">
                                        {{ $entropy_unit }} ▾
                                    </label>
                                    @if ($showDropdown === 'entropy_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[100px]">
                                            @foreach(['j/K', 'kj/K', 'mj/K', 'wh/K', 'kwh/K', 'ft-lb/K', 'cal/K', 'kcal/K', 'ev/K'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('entropy_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Mode 3: Isothermal Entropy Change --}}
                    @if($point_unit === "isothermal entropy change of an ideal gas")
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="label text-sm font-medium">{!! $lang['7'] !!}:</label>
                                <select wire:model.live="base_unit" class="input border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none bg-white">
                                    <option value="volume">{!! $lang['23'] !!}</option>
                                    <option value="pressure">{!! $lang['24'] !!}</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="label text-sm font-medium">{!! $lang['8'] !!}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="moles" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <span class="absolute right-6 top-4 font-bold text-gray-500 text-sm">mol</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="label text-sm font-medium">@if($base_unit == 'volume') Initial Volume @else Initial Pressure @endif:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="initial" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    @if($base_unit == 'volume')
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold text-blue" wire:click="toggleOverlay('initial_unit_dropdown')">{{ $initial_unit }} ▾</label>
                                        @if ($showDropdown === 'initial_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto min-w-[200px]">
                                                @foreach(['mm³', 'cm³', 'dm³', 'm³', 'in³', 'ft³', 'ml', 'cl', 'l', 'US gal', 'UK gal', 'US fl oz', 'UK fl oz'] as $unit)
                                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('initial_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold text-blue" wire:click="toggleOverlay('pre_one_unit_dropdown')">{{ $pre_one_unit }} ▾</label>
                                        @if ($showDropdown === 'pre_one_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto min-w-[100px]">
                                                @foreach(['Pa', 'Bar', 'psi', 'at', 'atm', 'Torr', 'hPa', 'kPa', 'MPa', 'GPa', 'inHg', 'mmHg'] as $unit)
                                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('pre_one_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="label text-sm font-medium">@if($base_unit == 'volume') Final Volume @else Final Pressure @endif:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="final" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    @if($base_unit == 'volume')
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold text-blue" wire:click="toggleOverlay('final_unit_dropdown')">{{ $final_unit }} ▾</label>
                                        @if ($showDropdown === 'final_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto min-w-[200px]">
                                                @foreach(['mm³', 'cm³', 'dm³', 'm³', 'in³', 'ft³', 'ml', 'cl', 'l', 'US gal', 'UK gal', 'US fl oz', 'UK fl oz'] as $unit)
                                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('final_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold text-blue" wire:click="toggleOverlay('pre_two_unit_dropdown')">{{ $pre_two_unit }} ▾</label>
                                        @if ($showDropdown === 'pre_two_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto min-w-[100px]">
                                                @foreach(['Pa', 'Bar', 'psi', 'at', 'atm', 'Torr', 'hPa', 'kPa', 'MPa', 'GPa', 'inHg', 'mmHg'] as $unit)
                                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('pre_two_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex justify-center items-center space-x-4 mt-12">
                    @if ($type == 'calculator')
                        @include('inc.button')
                    @elseif ($type == 'widget')
                        @include('inc.widget-button')
                    @endif
                </div>
            </div>
        </div>

        <hr>

        @if($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="mt-3">
                        @if($point_unit === "entropy change for a reaction")
                            <div class="bg-light-blue p-6 lg:p-5 text-center rounded-lg">
                                <p class="font-bold text-blue tracking-wide text-xs uppercase mb-3">{!! $lang['14'] !!}</p>
                                <p class="font-black text-[40px] lg:text-[50px] text-green leading-none">
                                    {!! round($detail['entropy_reaction'], 4) !!}
                                    <span class="text-base font-bold text-gray-500 ml-1">j/mol*K</span>
                                </p>
                            </div>
                            
                            <p class="font-bold text-blue mb-4 text-sm  tracking-widest">{!! $lang['15'] !!}</p>
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider">Unit</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider">Value</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider hidden md:table-cell">Unit</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider hidden md:table-cell">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                        @php
                                            $ent_units = [
                                                'kj/mol*K' => $detail['entropy_reaction'] / 1000,
                                                'mj/mol*K' => $detail['entropy_reaction'] / 1e+6,
                                                'wh/mol*K' => $detail['entropy_reaction'] / 3600,
                                                'kwh/mol*K' => $detail['entropy_reaction'] / 3.6e+6,
                                                'ft-lb/mol*K' => $detail['entropy_reaction'] * 0.737562149,
                                                'cal/mol*K' => $detail['entropy_reaction'] / 4.184,
                                                'kcal/mol*K' => $detail['entropy_reaction'] * 0.000239006,
                                                'ev/mol*K' => $detail['entropy_reaction'] * 6.242e+18
                                            ];
                                            $ent_chunks = array_chunk(array_keys($ent_units), 2);
                                        @endphp
                                        @foreach($ent_chunks as $chunk)
                                            <tr class="hover:bg-gray-50">
                                                @foreach($chunk as $unitKey)
                                                    <td class="border border-gray-200 px-4 py-2 font-semibold text-gray-600 bg-gray-50/30">{{ $unitKey }}</td>
                                                    <td class="border border-gray-200 px-4 py-2 text-gray-800 break-all">{{ is_numeric($ent_units[$unitKey]) ? round($ent_units[$unitKey], 6) : $ent_units[$unitKey] }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @elseif($point_unit === "gibbs free energy ΔG = ΔH - T*ΔS")
                            <div class="bg-light-blue p-6 lg:p-5 text-center rounded-lg">
                                <p class="font-bold text-blue tracking-wide text-xs uppercase mb-3">{!! $lang['16'] !!}</p>
                                <p class="font-black text-[40px] lg:text-[50px] text-green leading-none">
                                    {!! round($detail['gibbs'], 4) !!}
                                    <span class="text-base font-bold text-gray-500 ml-1">j</span>
                                </p>
                                <div class="mt-4 p-3 bg-white/50 rounded-lg inline-block border border-blue/5">
                                    @if($detail['gibbs'] < 0)
                                        <p class="text-blue font-bold text-sm">{!! $lang['18'] !!}</p>
                                    @elseif($detail['gibbs'] > 0)
                                        <p class="text-red-500 font-bold text-sm">{!! $lang['19'] !!}</p>
                                    @else
                                        <p class="text-gray-500 font-bold text-sm">{!! $lang['20'] !!}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <p class="font-bold text-blue mb-4 text-sm  tracking-widest">{!! $lang['17'] !!}</p>
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider">Unit</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider">Value</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider hidden md:table-cell">Unit</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider hidden md:table-cell">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                        @php
                                            $gibbs_units = [
                                                'kj' => $detail['gibbs'] / 1000,
                                                'mj' => $detail['gibbs'] / 1e+6,
                                                'wh' => $detail['gibbs'] / 3600,
                                                'kwh' => $detail['gibbs'] / 3.6e+6,
                                                'ft-lb' => $detail['gibbs'] * 0.737562149,
                                                'cal' => $detail['gibbs'] / 4.184,
                                                'kcal' => $detail['gibbs'] * 0.000239006,
                                                'ev' => $detail['gibbs'] * 6.242e+18
                                            ];
                                            $gibbs_chunks = array_chunk(array_keys($gibbs_units), 2);
                                        @endphp
                                        @foreach($gibbs_chunks as $chunk)
                                            <tr class="hover:bg-gray-50">
                                                @foreach($chunk as $unitKey)
                                                    <td class="border border-gray-200 px-4 py-2 font-semibold text-gray-600 bg-gray-50/30">{{ $unitKey }}</td>
                                                    <td class="border border-gray-200 px-4 py-2 text-gray-800 break-all">{{ is_numeric($gibbs_units[$unitKey]) ? round($gibbs_units[$unitKey], 6) : $gibbs_units[$unitKey] }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @elseif($point_unit === "isothermal entropy change of an ideal gas")
                            @php $ans = ($base_unit === "volume") ? $detail['answer'] : $detail['answers']; @endphp
                            <div class="bg-light-blue p-6 lg:p-5 text-center rounded-lg">
                                <p class="font-bold text-blue tracking-wide text-xs uppercase mb-3">{!! $lang['21'] !!}</p>
                                <p class="font-black text-[40px] lg:text-[50px] text-green leading-none">
                                    {!! round($ans, 4) !!}
                                    <span class="text-base font-bold text-gray-500 ml-1">j</span>
                                </p>
                            </div>
                            
                            <p class="font-bold text-blue mb-4 text-sm  tracking-widest">{!! $lang['15'] !!}</p>
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider">Unit</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider">Value</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider hidden md:table-cell">Unit</th>
                                            <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider hidden md:table-cell">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                        @php
                                            $iso_units = [
                                                'kj' => $ans / 1000,
                                                'mj' => $ans / 1e+6,
                                                'wh' => $ans / 3600,
                                                'kwh' => $ans / 3.6e+6,
                                                'ft-lb' => $ans * 0.737562149,
                                                'cal' => $ans / 4.184,
                                                'kcal' => $ans * 0.000239006,
                                                'ev' => $ans * 6.242e+18
                                            ];
                                            $iso_chunks = array_chunk(array_keys($iso_units), 2);
                                        @endphp
                                        @foreach($iso_chunks as $chunk)
                                            <tr class="hover:bg-gray-50">
                                                @foreach($chunk as $unitKey)
                                                    <td class="border border-gray-200 px-4 py-2 font-semibold text-gray-600 bg-gray-50/30">{{ $unitKey }}</td>
                                                    <td class="border border-gray-200 px-4 py-2 text-gray-800 break-all">{{ is_numeric($iso_units[$unitKey]) ? round($iso_units[$unitKey], 6) : $iso_units[$unitKey] }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
