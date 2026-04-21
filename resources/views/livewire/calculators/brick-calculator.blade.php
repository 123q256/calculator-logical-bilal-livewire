<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Wall Type -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wall_type" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Wall Type' }}</label>
                        <div class="w-full py-2">
                            <select wire:model.live="wall_type" id="wall_type" class="input">
                                <option value="single">{{ $lang['3'] ?? 'Single' }}</option>
                                <option value="double">{{ $lang['4'] ?? 'Double' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Wall Dimensions -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wall_length" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Wall Length' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="wall_length" id="wall_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('wall_length_unit_dropdown')">{{ $wall_length_unit }} ▾</label>
                            @if ($showDropdown === 'wall_length_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["ft","in","cm","mm","dm","m","yd"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_length_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wall_width" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Wall Width' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="wall_width" id="wall_width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('wall_width_unit_dropdown')">{{ $wall_width_unit }} ▾</label>
                            @if ($showDropdown === 'wall_width_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["ft","in","cm","mm","dm","m","yd"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_width_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wall_height" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Wall Height' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="wall_height" id="wall_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('wall_height_unit_dropdown')">{{ $wall_height_unit }} ▾</label>
                            @if ($showDropdown === 'wall_height_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["ft","in","cm","mm","dm","m","yd"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_height_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <p class="col-span-12 my-1"><strong>{{ $lang['8'] ?? 'Brick Details' }}</strong></p>

                    <!-- Brick Type -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="brick_type" class="font-s-14 text-blue">{{ $lang['type'] ?? 'Type' }}</label>
                        <div class="w-full py-2">
                            <select wire:model.live="brick_type" id="brick_type" class="input">
                                <option value="7.625x3.625">{{ $lang['9'] ?? 'Standard' }} (7 5/8" x 2 1/4")</option>
                                <option value="8x2.25">{{ $lang['10'] ?? 'Modular' }} (8" x 2 1/4")</option>
                                <option value="8x2.75">{{ $lang['11'] ?? 'Engineer' }} (8" x 2 3/4")</option>
                                <option value="9.625x2.625">{{ $lang['12'] ?? 'Economy' }} (9 5/8" x 2 5/8")</option>
                                <option value="11.625x1.625">{{ $lang['13'] ?? 'Roman' }} (11 5/8" x 1 5/8")</option>
                                <option value="11.625x2.25">{{ $lang['14'] ?? 'Norman' }} (11 5/8" x 2 1/4")</option>
                                <option value="11.625x3.625">{{ $lang['15'] ?? 'Utility' }} (11 5/8" x 3 5/8")</option>
                                <option value="1">{{ $lang['16'] ?? 'Custom' }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="brick_wastage" class="font-s-14 text-blue">{{ $lang['17'] ?? 'Brick Wastage' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="brick_wastage" id="brick_wastage" class="input" />
                            <span class="input_unit text-blue">%</span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="mortar_joint_thickness" class="font-s-14 text-blue">{{ $lang['18'] ?? 'Mortar Joint' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="mortar_joint_thickness" id="mortar_joint_thickness" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('mortar_joint_thickness_unit_dropdown')">{{ $mortar_joint_thickness_unit }} ▾</label>
                            @if ($showDropdown === 'mortar_joint_thickness_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["in","cm","mm"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mortar_joint_thickness_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Custom Brick Dimensions -->
                    @if ($brick_type == '1')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="brick_length" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Brick Length' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="brick_length" id="brick_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('brick_length_unit_dropdown')">{{ $brick_length_unit }} ▾</label>
                                @if ($showDropdown === 'brick_length_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["ft","in","cm","mm","dm","m","yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('brick_length_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="brick_width" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Brick Width' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="brick_width" id="brick_width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('brick_width_unit_dropdown')">{{ $brick_width_unit }} ▾</label>
                                @if ($showDropdown === 'brick_width_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["ft","in","cm","mm","dm","m","yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('brick_width_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="brick_height" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Brick Height' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="brick_height" id="brick_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('brick_height_unit_dropdown')">{{ $brick_height_unit }} ▾</label>
                                @if ($showDropdown === 'brick_height_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["ft","in","cm","mm","dm","m","yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('brick_height_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <p class="col-span-12 my-1"><strong>{{ $lang['19'] ?? 'Mortar Details' }}</strong></p>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="with_motar" class="font-s-14 text-blue">{{ $lang['20'] ?? 'Include Mortar' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="with_motar" id="with_motar" class="input">
                                <option value="no">{{ $lang['21'] ?? 'No' }}</option>
                                <option value="yes">{{ $lang['22'] ?? 'Yes' }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($with_motar == 'yes')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="wet_volume" class="font-s-14 text-blue">{{ $lang['23'] ?? 'Wet Volume' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="wet_volume" id="wet_volume" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('wet_volume_unit_dropdown')">{{ $wet_volume_unit }} ▾</label>
                                @if ($showDropdown === 'wet_volume_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["m³","cm³","cu ft","cu yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wet_volume_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="mortar_wastage" class="font-s-14 text-blue">{{ $lang['24'] ?? 'Mortar Wastage' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model="mortar_wastage" id="mortar_wastage" class="input" />
                                <span class="input_unit text-blue">%</span>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="mortar_ratio" class="font-s-14 text-blue">{{ $lang['25'] ?? 'Mortar Ratio' }}</label>
                            <div class="w-full py-2">
                                <select wire:model="mortar_ratio" id="mortar_ratio" class="input">
                                    <option value="1:5">1:5 ({{ $lang['26'] ?? 'Standard' }})</option>
                                    <option value="1:6">1:6 ({{ $lang['27'] ?? 'Lean' }})</option>
                                    <option value="1:4">1:4 ({{ $lang['28'] ?? 'Rich' }})</option>
                                    <option value="1:3">1:3 ({{ $lang['29'] ?? 'Strong' }})</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="bag_size" class="font-s-14 text-blue">{{ $lang['30'] ?? 'Cement Bag Size' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="bag_size" id="bag_size" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('bag_size_unit_dropdown')">{{ $bag_size_unit }} ▾</label>
                                @if ($showDropdown === 'bag_size_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["kg","g","lb","t","stone"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('bag_size_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <p class="col-span-12 my-1"><strong>{{ $lang['31'] ?? 'Cost Estimation' }}</strong></p>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="price_per_brick" class="font-s-14 text-blue">{{ $lang['32'] ?? 'Price per Brick' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="price_per_brick" id="price_per_brick" class="input" />
                            <span class="input_unit text-blue">{{ $currancy }}</span>
                        </div>
                    </div>

                    @if ($with_motar == 'yes')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="price_of_cement" class="font-s-14 text-blue">{{ $lang['33'] ?? 'Price per Bag' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model="price_of_cement" id="price_of_cement" class="input" />
                                <span class="input_unit text-blue">{{ $currancy }}</span>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="price_sand_per_volume" class="font-s-14 text-blue">{{ $lang['34'] ?? 'Price of Sand' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="price_sand_per_volume" id="price_sand_per_volume" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('price_sand_volume_unit_dropdown')">{{ $price_sand_volume_unit }} ▾</label>
                                @if ($showDropdown === 'price_sand_volume_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["m³","cm³","cu ft","cu yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_sand_volume_unit', '{{ $u }}')">{{ $currancy . ' ' . $u }}</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full">
                            <div class="w-full md:w-[70%] lg:w-[70%] font-s-18">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['36'] ?? 'Total Bricks (incl. wastage)' }} :</strong></td>
                                        <td class="border-b py-2">{{ number_format($detail['no_of_bricks_with_wastage'] ?? 0) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['40'] ?? 'Wall Area' }} :</strong></td>
                                        <td class="border-b py-2">{{ number_format($detail['wall_area'] ?? 0, 2) }} m²</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['41'] ?? 'Base Bricks' }} :</strong></td>
                                        <td class="border-b py-2">{{ number_format($detail['no_of_bricks'] ?? 0) }}</td>
                                    </tr>
                                    
                                    @if (isset($detail['dry_volume']))
                                        <tr><td colspan="2" class="pb-2 pt-3"><strong>{{ $lang['53'] ?? 'Mortar Estimation' }}</strong></td></tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['43'] ?? 'Dry Volume' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['dry_volume'] ?? 0, 4) }} m³</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['44'] ?? 'Total Dry Volume' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['dry_volume_with_wastage'] ?? 0, 4) }} m³</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['45'] ?? 'Cement Volume' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['volume_of_cement'] ?? 0, 4) }} m³</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['46'] ?? 'Cement Bags' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['number_of_bags'] ?? 0) }} {{ $lang['48'] ?? 'bags' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['47'] ?? 'Sand Volume' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['volume_of_sand'] ?? 0, 4) }} m³</td>
                                        </tr>
                                    @endif

                                    <tr><td colspan="2" class="pb-2 pt-3"><strong>{{ $lang['54'] ?? 'Cost Summary' }}</strong></td></tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['49'] ?? 'Brick Cost' }} :</td>
                                        <td class="border-b py-2">{{ $currancy . ' ' . number_format($detail['cost_of_bricks'] ?? 0, 2) }}</td>
                                    </tr>
                                    @if (isset($detail['mortar_cost']))
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['50'] ?? 'Mortar Cost' }} :</td>
                                            <td class="border-b py-2">{{ $currancy . ' ' . number_format($detail['mortar_cost'] ?? 0, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2 pb-3">{{ $lang['51'] ?? 'Total Project Cost' }} :</td>
                                            <td class="pt-2 pb-3"><strong>{{ $currancy . ' ' . number_format($detail['total_cost'] ?? 0, 2) }}</strong></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
