<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="width" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Wall Width' }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_unit_dropdown')">{{ $width_unit }} ▾</label>
                            @if ($showDropdown === 'width_unit_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_unit', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : 'feet (ft)'))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="height" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Wall Height' }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="height" id="height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('height_unit_dropdown')">{{ $height_unit }} ▾</label>
                            @if ($showDropdown === 'height_unit_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('height_unit', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : 'feet (ft)'))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="block_size" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Block Size' }}</label>
                        <select wire:model="block_size" id="block_size" class="input">
                            <option value="16x8">16 x 8 Block</option>
                            <option value="8x8">8 x 8 Block</option>
                            <option value="12x8">12 x 8 Block</option>
                            <option value="8x4">8 x 4 Block</option>
                            <option value="12x4">12 x 4 Block</option>
                            <option value="16x4">16 x 4 Block</option>
                        </select>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="block_price" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Price per Block' }}</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="block_price" id="block_price" class="input pr-10" />
                            <span class="absolute right-3 top-3 text-blue">{{ $currancy }}</span>
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="col-lg-7 font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td width="70%" class="border-b py-2"><strong>{{ $lang['5'] ?? 'Blocks Needed' }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['blocks_needed'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['6'] ?? 'Total Block Cost' }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy . number_format($detail['total_block_cost'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['7'] ?? 'Mortar Estimation' }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['mortar_estimation'] }} bags (approx)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['8'] ?? 'Wall Area' }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['wall_area'] / 144, 2) }} ft²</td>
                                        </tr>
                                    </table>
                                    <p class="font-s-20 mt-3 mb-2"><strong>{{ $lang['9'] ?? 'Area Conversions' }}</strong></p>
                                    <table class="w-full">
                                        <tr>
                                            <td width="70%" class="border-b py-2">{{ $lang['10'] ?? 'Square Meters' }} :</td>
                                            <td class="border-b py-2">{{ round(($detail['wall_area'] / 144) * 0.0929, 2) }} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] ?? 'Square Kilometers' }} :</td>
                                            <td class="border-b py-2">{{ round(($detail['wall_area'] / 144) * 0.0000000929, 5) }} km²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['12'] ?? 'Square Inches' }} :</td>
                                            <td class="border-b py-2">{{ round(($detail['wall_area'] / 144) * 144, 2) }} in²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['13'] ?? 'Square Yards' }} :</td>
                                            <td class="border-b py-2">{{ round(($detail['wall_area'] / 144) * 0.1111, 2) }} yd²</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
