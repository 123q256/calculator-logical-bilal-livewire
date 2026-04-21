<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <p class="col-span-12"><strong>{{ $lang['1'] ?? 'Wall dimensions' }}</strong></p>
                    
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wall_length" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Wall length' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="wall_length" id="wall_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('wall_length_unit_dropdown')">{{ $wall_length_unit }} ▾</label>
                            @if ($showDropdown === 'wall_length_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_length_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wall_height" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Wall height' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="wall_height" id="wall_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('wall_height_unit_dropdown')">{{ $wall_height_unit }} ▾</label>
                            @if ($showDropdown === 'wall_height_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_height_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <p class="mb-2 font-s-14">{{ $lang['4'] ?? 'Block dimensions' }}</p>
                        <label for="block_height" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Block height' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="block_height" id="block_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('block_height_unit_dropdown')">{{ $block_height_unit }} ▾</label>
                            @if ($showDropdown === 'block_height_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('block_height_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <p class="mb-2 font-s-14">{{ $lang['6'] ?? 'Cap dimensions' }}</p>
                        <label for="cap_height" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Cap height' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="cap_height" id="cap_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('cap_height_unit_dropdown')">{{ $cap_height_unit }} ▾</label>
                            @if ($showDropdown === 'cap_height_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('cap_height_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="block_length" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Block length' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="block_length" id="block_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('block_length_unit_dropdown')">{{ $block_length_unit }} ▾</label>
                            @if ($showDropdown === 'block_length_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('block_length_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="cap_length" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Cap length' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="cap_length" id="cap_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('cap_length_unit_dropdown')">{{ $cap_length_unit }} ▾</label>
                            @if ($showDropdown === 'cap_length_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('cap_length_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wall_block_price" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Block price' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="wall_block_price" id="wall_block_price" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="cap_block_price" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Cap price' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="cap_block_price" id="cap_block_price" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <p class="col-span-12"><strong>{{ $lang['8'] ?? 'Backfill dimensions' }}</strong></p>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="backfill_thickness" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Backfill thickness' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="backfill_thickness" id="backfill_thickness" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('backfill_thickness_unit_dropdown')">{{ $backfill_thickness_unit }} ▾</label>
                            @if ($showDropdown === 'backfill_thickness_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('backfill_thickness_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="backfill_length" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Backfill length' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="backfill_length" id="backfill_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('backfill_length_unit_dropdown')">{{ $backfill_length_unit }} ▾</label>
                            @if ($showDropdown === 'backfill_length_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('backfill_length_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="backfill_height" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Backfill height' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="backfill_height" id="backfill_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('backfill_height_unit_dropdown')">{{ $backfill_height_unit }} ▾</label>
                            @if ($showDropdown === 'backfill_height_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "dm", "in", "ft", "yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('backfill_height_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="backfill_price" class="font-s-14 text-blue">{{ $lang['12'] ?? 'Backfill price' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="backfill_price" id="backfill_price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('backfill_price_unit_dropdown')">{{ $currancy . ' ' . $backfill_price_unit }} ▾</label>
                            @if ($showDropdown === 'backfill_price_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["lb", "t", "oz", "stone", "Us ton", "Long ton"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('backfill_price_unit', '{{ $unit }}')">{{ $currancy . ' ' . $unit }}</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-1">
                                <div class="w-full md:w-[60%] lg:w-[60%]">
                                    <table>
                                        <tr>
                                            <td colspan="2" class=""><strong>{{ $lang['13'] ?? 'Estimation results' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td width="60%" class="border-b py-2">{{ $lang['14'] ?? 'Blocks needed' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['blocks'] ?? 0) }} <span class="font-s-14">{{ $lang['15'] ?? 'blocks' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['16'] ?? 'Caps needed' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['caps'] ?? 0) }} <span class="font-s-14">{{ $lang['15'] ?? 'blocks' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['17'] ?? 'Backfill volume' }} :</td>
                                            <td class="border-b py-2">{{ $detail['backfill_volume'] ?? 0 }} <span class="font-s-14">{{ $lang['18'] ?? 'm³' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['19'] ?? 'Backfill weight' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['backfill_weight'] ?? 0) }} <span class="font-s-14">{{ $lang['20'] ?? 'kg' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-2"><strong>{{ $lang['21'] ?? 'Cost estimation' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['22'] ?? 'Blocks price' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['blocks_price'] ?? 0) }} <span class="font-s-14">{{ $lang['23'] ?? $currancy }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['24'] ?? 'Caps price' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['caps_price'] ?? 0) }} <span class="font-s-14">{{ $lang['23'] ?? $currancy }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['25'] ?? 'Backfill price' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['backfill_total_price'] ?? 0) }} <span class="font-s-14">{{ $lang['23'] ?? $currancy }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['26'] ?? 'Total cost' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['total_cost'] ?? 0) }} <span class="font-s-14">{{ $lang['23'] ?? $currancy }}</span></td>
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
