<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="length" class="font-s-14 text-blue">{{ $lang['1'] ?? 'House length' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length_units_dropdown')">{{ $length_units }} ▾</label>
                            @if ($showDropdown === 'length_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length_units', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : 'yards (yd)')))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="width" class="font-s-14 text-blue">{{ $lang['2'] ?? 'House width' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_units_dropdown')">{{ $width_units }} ▾</label>
                            @if ($showDropdown === 'width_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_units', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : 'yards (yd)')))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-2 relative">
                        <label class="block text-sm font-medium text-gray-700">{{ $lang['3'] ?? 'Roof pitch' }}</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="pitch" id="pitch" class="input" placeholder="00" />
                            <span class="absolute right-4 top-2 text-blue font-semibold">%</span>
                        </div>
                    </div>

                    <div class="space-y-2 text-blue">
                        <label for="price" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Price' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="price" id="price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('price_units_dropdown')">{{ $price_units }} ▾</label>
                            @if ($showDropdown === 'price_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["mm²", "cm²", "m²", "in²", "ft²", "yd²"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('price_units', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center">
                        <div class="w-full md:w-[60%] lg:w-[60%] my-2">
                            <div class="w-full font-s-18">
                                <table class="w-full">
                                    <tr>
                                        <td width="70%" class="border-b py-2"><strong>{{ $lang['5'] ?? 'Total roof area' }} :</strong></td>
                                        <td class="border-b py-2">{{ number_format($detail['roof_area'], 2) }} m²</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['6'] ?? 'Estimated cost' }} :</strong></td>
                                        <td class="border-b py-2">{{ $currancy . number_format($detail['cost'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['7'] ?? 'House footprint area' }} :</strong></td>
                                        <td class="border-b py-2">{{ number_format($detail['house_area'], 2) }} m²</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['8'] ?? 'Roof pitch angle' }} :</strong></td>
                                        <td class="border-b py-2">{{ number_format($detail['pitch_deg'], 2) }} deg</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['9'] ?? 'Roof slope' }} :</strong></td>
                                        <td class="border-b py-2">{{ number_format($detail['slop'], 2) }} : 12</td>
                                    </tr>
                                </table>
                                <p class="mt-6 mb-3 font-semibold text-blue border-t pt-4">{{ $lang['10'] ?? 'Area conversions' }}</p>
                                <table class="w-full">
                                    <tr>
                                        <td width="70%" class="border-b py-2">mm²</td>
                                        <td class="border-b py-2">{{ number_format($detail['roof_area'] * 1000000, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">cm²</td>
                                        <td class="border-b py-2">{{ number_format($detail['roof_area'] * 10000, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">in²</td>
                                        <td class="border-b py-2">{{ number_format($detail['roof_area'] * 1550.0031, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">ft²</td>
                                        <td class="border-b py-2">{{ number_format($detail['roof_area'] * 10.7639, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">yd²</td>
                                        <td class="border-b py-2">{{ number_format($detail['roof_area'] * 1.19599, 2) }}</td>
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
