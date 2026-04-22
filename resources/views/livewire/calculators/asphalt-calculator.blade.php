<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Calculator Mode Selection -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="cal" class="label">{{ $lang['1'] ?? 'Method' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="cal" id="cal" class="input">
                                <option value="lwt">{!! $lang['2'] ?? 'Length/Width/Thickness' !!}</option>
                                <option value="at">{!! $lang['3'] ?? 'Area/Thickness' !!}</option>
                                <option value="vad">{!! $lang['4'] ?? 'Volume/Asphalt Density' !!}</option>
                                <option value="csn">{!! $lang['5'] ?? 'Crushed Stone Needed' !!}</option>
                                <option value="dtbr">{!! $lang['6'] ?? 'Dirt to be removed' !!}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Length & Width (Only for LWT) -->
                    @if ($cal === 'lwt')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="length" class="label">{{ $lang['7'] ?? 'Length' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length_unit_dropdown')">{{ $length_unit }} ▾</label>
                                @if ($showDropdown === 'length_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cm","m","in","ft","yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="width" class="label">{{ $lang['8'] ?? 'Width' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_unit_dropdown')">{{ $width_unit }} ▾</label>
                                @if ($showDropdown === 'width_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cm","m","in","ft","yd","mi"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Area (For AT, CSN, DTBR) -->
                    @if (in_array($cal, ['at', 'csn', 'dtbr']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="area" class="label">{{ $lang['9'] ?? 'Area' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_unit_dropdown')">{{ $area_unit }} ▾</label>
                                @if ($showDropdown === 'area_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["m²","km²","in²","ft²"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('area_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Thickness/Depth (For LWT, AT, CSN, DTBR) -->
                    @if (in_array($cal, ['lwt', 'at', 'csn', 'dtbr']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="depth" class="label">{{ $lang['10'] ?? 'Depth/Thickness' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="depth" id="depth" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('depth_unit_dropdown')">{{ $depth_unit }} ▾</label>
                                @if ($showDropdown === 'depth_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cm","m","in","ft","yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('depth_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Volume (Only for VAD) -->
                    @if ($cal === 'vad')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="volume" class="label">{{ $lang['11'] ?? 'Volume' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="volume" id="volume" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('volume_unit_dropdown')">{{ $volume_unit }} ▾</label>
                                @if ($showDropdown === 'volume_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["m³","cu ft","US Gal","UK Gal"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('volume_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Asphalt Density (For LWT, AT, VAD) -->
                    @if (in_array($cal, ['lwt', 'at', 'vad']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="density" class="label">{{ $lang['12'] ?? 'Asphalt Density' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="density" id="density" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('density_unit_dropdown')">{{ $density_unit }} ▾</label>
                                @if ($showDropdown === 'density_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["kg/m³","lb/cu ft"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('density_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Stone Subbase Depth (Only for CSN) -->
                    @if ($cal === 'csn')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="cs_depth" class="label">{{ $lang['13'] ?? 'Stone Subbase Depth' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="cs_depth" id="cs_depth" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('cs_depth_unit_dropdown')">{{ $cs_depth_unit }} ▾</label>
                                @if ($showDropdown === 'cs_depth_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cm","m","in","ft","yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('cs_depth_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Dirt Removal Depth (Only for DTBR) -->
                    @if ($cal === 'dtbr')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="depth_dr" class="label">{{ $lang['14'] ?? 'Dirt Removal Depth' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="depth_dr" id="depth_dr" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('depth_dr_unit_dropdown')">{{ $depth_dr_unit }} ▾</label>
                                @if ($showDropdown === 'depth_dr_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cm","m","in","ft","yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('depth_dr_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Cost per unit weight (For LWT, AT, VAD) -->
                    @if (in_array($cal, ['lwt', 'at', 'vad']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="cost" class="label">{{ $lang['15'] ?? 'Cost per Unit Weight' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model="cost" id="cost" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('cost_unit_dropdown')">{{ $cost_unit }} ▾</label>
                                @if ($showDropdown === 'cost_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["$currancy kg","$currancy ton","$currancy lb","$currancy us_ton","$currancy long_ton"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('cost_unit', '{{ $unit }}')">{{ $unit }}</p>
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
            @else
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="rounded-lg flex items-center justify-center mt-5">
                        <div class="w-full">
                            <div class="w-full md:w-[90%] lg:w-[90%] overflow-auto font-s-18">
                                <table class="w-full border-collapse">
                                    <!-- Main Result: Asphalt Weight -->
                                    <tr>
                                        <td width="50%" class="border-b py-2 font-bold">{{ $lang['16'] ?? 'Asphalt Weight' }}</td>
                                        <td class="border-b py-2 text-blue-600 font-bold text-right">{{ number_format($detail['asphalt'], 5) }} tons</td>
                                    </tr>

                                    <!-- Mode-specific details -->
                                    @if ($cal === 'lwt')
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['9'] ?? 'Area' }}</td>
                                            <td class="border-b py-2 text-right">{{ number_format($detail['area'], 4) }} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] ?? 'Volume' }}</td>
                                            <td class="border-b py-2 text-right">{{ number_format($detail['volume'], 4) }} m³</td>
                                        </tr>
                                    @elseif ($cal === 'at')
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] ?? 'Volume' }}</td>
                                            <td class="border-b py-2 text-right">{{ number_format($detail['volume'], 4) }} m³</td>
                                        </tr>
                                    @elseif ($cal === 'csn')
                                        <tr>
                                            <td class="border-b py-2 font-bold text-green-600">{{ $lang['18'] ?? 'Crushed Stone' }}</td>
                                            <td class="border-b py-2 font-bold text-green-600 text-right">{{ number_format($detail['stone'], 5) }} tons</td>
                                        </tr>
                                    @elseif ($cal === 'dtbr')
                                        <tr>
                                            <td class="border-b py-2 font-bold text-amber-600">{{ $lang['19'] ?? 'Dirt to be Removed' }}</td>
                                            <td class="border-b py-2 font-bold text-amber-600 text-right">{{ number_format($detail['dirt'], 5) }} cu yd</td>
                                        </tr>
                                    @endif

                                    <!-- Total Cost -->
                                    @if (isset($detail['total_cost']))
                                        <tr>
                                            <td class="border-b py-2 font-bold text-green-700 pt-4">{{ $lang['17'] ?? 'Total Cost' }}</td>
                                            <td class="border-b py-2 font-bold text-green-700 text-right pt-4">{{ $currancy }} {{ number_format($detail['total_cost'], 2) }}</td>
                                        </tr>
                                    @endif

                                    <!-- Other Weight Units -->
                                    <tr>
                                        <td colspan="2" class="py-4 text-sm text-gray-500 font-semibold italic border-t mt-4 uppercase tracking-wider">{{ $lang['20'] ?? 'Result in other units' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 px-4">{{ $lang['16'] ?? 'Weight' }}</td>
                                        <td class="border-b py-2 text-right">{{ number_format($detail['kg'], 2) }} kilograms</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 px-4">{{ $lang['16'] ?? 'Weight' }}</td>
                                        <td class="border-b py-2 text-right">{{ number_format($detail['lb'], 2) }} pounds</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 px-4">{{ $lang['16'] ?? 'Weight' }}</td>
                                        <td class="border-b py-2 text-right">{{ number_format($detail['us_ton'], 4) }} US short tons</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 px-4">{{ $lang['16'] ?? 'Weight' }}</td>
                                        <td class="border-b py-2 text-right">{{ number_format($detail['long_ton'], 4) }} imperial tons</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
