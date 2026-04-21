<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Column Size -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="size_unit" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Column size' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="size_unit" id="size_unit" class="input">
                                @foreach (["6 (15.24 cm)", "8 (20.32 cm)", "10 (25.40 cm)", "12 (30.48 cm)", "14 (35.56 cm)", "16 (40.64 cm)", "18 (45.72 cm)", "20 (50.80 cm)", "22 (55.88 cm)", "24 (60.96 cm)", "26 (66.04 cm)", "28 (71.12 cm)", "30 (76.20 cm)", "32 (81.28 cm)", "34 (86.36 cm)", "36 (91.44 cm)", "40 (101.60 cm)", "42 (106.68 cm)", "48 (121.91 cm)", "54 (137.16 cm)", "60 (152.40 cm)"] as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Height -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="height" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Total height' }}:</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="height" id="height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('height_unit_dropdown')">{{ $height_unit }} ▾</label>
                            @if ($showDropdown === 'height_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                    @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('height_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="quantity" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Quantity' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="quantity" id="quantity" class="input" placeholder="00" />
                            <span class="text-blue input_unit">{{ $lang['4'] ?? 'columns' }}</span>
                        </div>
                    </div>

                    <!-- Concrete Mix Type -->
                    <div class="col-span-12 mt-4 font-bold text-blue border-b pb-1">{{ $lang['5'] ?? 'Concrete mix' }}</div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="concerete_mix_unit" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Mix unit' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="concerete_mix_unit" id="concerete_mix_unit" class="input">
                                <option value="{{ $lang['7'] ?? "I'll get pre-mixed concrete bags" }}">{{ $lang['7'] ?? "I'll get pre-mixed concrete bags" }}</option>
                                <option value="{{ $lang['8'] ?? "I'll mix my own concrete" }}">{{ $lang['8'] ?? "I'll mix my own concrete" }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Conditional Fields for Pre-mixed Bags -->
                    @if ($concerete_mix_unit === ($lang['7'] ?? "I'll get pre-mixed concrete bags"))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="density" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Concrete density' }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="density" id="density" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('density_unit_dropdown')">{{ $density_unit }} ▾</label>
                                @if ($showDropdown === 'density_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["kg/m³", "lb/cu ft", "lb/cu yd", "g/cm³"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('density_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="bag_size" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Bag size' }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="bag_size" id="bag_size" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('bag_size_unit_dropdown')">{{ $bag_size_unit }} ▾</label>
                                @if ($showDropdown === 'bag_size_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["kg", "lb"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('bag_size_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <!-- Conditional Fields for Custom Mix -->
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="concrete_ratio_unit" class="font-s-14 text-blue">{{ $lang['15'] ?? 'Concrete ratio' }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="concrete_ratio_unit" id="concrete_ratio_unit" class="input">
                                    @foreach (["1:5:10 (5.0 MPa or 725 psi)", "1:4:8 (7.5 MPa or 1085 psi)", "1:3:6 (10.0 MPa or 1450 psi)", "1:2:4 (15.0 MPa or 2175 psi)", "1:1.5:3 (20.0 MPa or 2900 psi)"] as $opt)
                                        <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="waste" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Wastage' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="waste" id="waste" class="input" placeholder="00" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>

                    <!-- Cost Fields -->
                    <div class="col-span-12 mt-4 font-bold text-blue border-b pb-1">{{ $lang['12'] ?? 'Costs' }}</div>
                    @if ($concerete_mix_unit === ($lang['7'] ?? "I'll get pre-mixed concrete bags"))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="Cost_bag_mix" class="font-s-14 text-blue">{{ $lang['13'] ?? 'Price per bag' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model="Cost_bag_mix" id="Cost_bag_mix" class="input" placeholder="00" />
                                <span class="text-blue input_unit">{{ $currancy }}/{{ $lang['14'] ?? 'bag' }}</span>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="font-s-14 text-blue">{{ $lang['16'] ?? 'Cost of cement' }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="Cost_of_cement" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('cement_cost_dropdown')">{{ $Cost_of_cement_unit }} ▾</label>
                                @if ($showDropdown === 'cement_cost_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cm³", "m³", "cu ft", "cu yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('Cost_of_cement_unit', '{{ $currancy }} {{ $u }}')">{{ $currancy }} {{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="font-s-14 text-blue">{{ $lang['17'] ?? 'Cost of sand' }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="Cost_of_sand" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('sand_cost_dropdown')">{{ $Cost_of_sand_unit }} ▾</label>
                                @if ($showDropdown === 'sand_cost_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cm³", "m³", "cu ft", "cu yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('Cost_of_sand_unit', '{{ $currancy }} {{ $u }}')">{{ $currancy }} {{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="font-s-14 text-blue">{{ $lang['18'] ?? 'Cost of gravel' }}:</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="Cost_of_gravel" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('gravel_cost_dropdown')">{{ $Cost_of_gravel_unit }} ▾</label>
                                @if ($showDropdown === 'gravel_cost_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cm³", "m³", "cu ft", "cu yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('Cost_of_gravel_unit', '{{ $currancy }} {{ $u }}')">{{ $currancy }} {{ $u }}</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-1">
                                <div class="w-full md:w-[90%] lg:w-[80%] overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td width="60%" class="pt-2 font-bold">{{ $lang['19'] ?? 'Concrete volume' }} :</td>
                                            <td class="pt-2">{{ number_format($detail['volume'], 4) }} <span class="font-s-14 text-gray-500">{{ $lang['21'] ?? 'cu ft' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-4 pb-1 text-sm text-blue font-semibold">{{ $lang['20'] ?? 'Volume in other units' }} :</td>
                                        </tr>
                                        <tr class="text-sm">
                                            <td class="border-b py-1 pl-4 italic text-gray-600">cm³ :</td>
                                            <td class="border-b py-1">{{ number_format($detail['volume'] * 28320, 2) }}</td>
                                        </tr>
                                        <tr class="text-sm">
                                            <td class="border-b py-1 pl-4 italic text-gray-600">{{ $lang['23'] ?? 'm³' }} :</td>
                                            <td class="border-b py-1">{{ number_format($detail['volume'] / 35.315, 4) }}</td>
                                        </tr>
                                        <tr class="text-sm">
                                            <td class="border-b py-1 pl-4 italic text-gray-600">{{ $lang['24'] ?? 'cu in' }} :</td>
                                            <td class="border-b py-1">{{ number_format($detail['volume'] * 1728, 2) }}</td>
                                        </tr>
                                        <tr class="text-sm">
                                            <td class="border-b py-1 pl-4 italic text-gray-600">{{ $lang['25'] ?? 'cu yd' }} :</td>
                                            <td class="border-b py-1">{{ number_format($detail['volume'] / 27, 4) }}</td>
                                        </tr>

                                        @if ($concerete_mix_unit === ($lang['7'] ?? "I'll get pre-mixed concrete bags"))
                                            @if (isset($detail['weghits']))
                                                <tr>
                                                    <td class="pt-6 font-bold">{{ $lang['26'] ?? 'Concrete weight' }} :</td>
                                                    <td class="pt-6">{{ number_format($detail['weghits'], 2) }} <span class="font-s-14 text-gray-500">{{ $lang['35'] ?? 'lbs' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pt-4 pb-1 text-sm text-blue font-semibold">{{ $lang['27'] ?? 'Weight in other units' }} :</td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border-b py-1 pl-4 italic text-gray-600">{{ $lang['28'] ?? 'kg' }} :</td>
                                                    <td class="border-b py-1">{{ number_format($detail['weghits'] / 2.20462, 2) }}</td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border-b py-1 pl-4 italic text-gray-600">{{ $lang['29'] ?? 'metric tons' }} :</td>
                                                    <td class="border-b py-1">{{ number_format($detail['weghits'] / 2204.62, 4) }}</td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border-b py-1 pl-4 italic text-gray-600">Stone :</td>
                                                    <td class="border-b py-1">{{ number_format($detail['weghits'] / 14, 4) }}</td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border-b py-1 pl-4 italic text-gray-600">{{ $lang['31'] ?? 'US short tons' }} :</td>
                                                    <td class="border-b py-1">{{ number_format($detail['weghits'] / 2000, 4) }}</td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border-b py-1 pl-4 italic text-gray-600">Long ton :</td>
                                                    <td class="border-b py-1">{{ number_format($detail['weghits'] / 2240, 4) }}</td>
                                                </tr>
                                            @endif

                                            @if (isset($detail['bagsz']))
                                                <tr>
                                                    <td class="border-b pt-6 pb-2 font-bold">{{ $lang['33'] ?? 'Total bags needed' }} :</td>
                                                    <td class="border-b pt-6 pb-2 text-blue font-bold">{{ number_format($detail['bagsz']) }} <span class="font-s-14 text-gray-500">{{ $lang['34'] ?? 'bags' }}</span></td>
                                                </tr>
                                            @endif
                                            
                                            @if (isset($detail['per_units']))
                                                <tr>
                                                    <td class="py-2 font-semibold">{{ $lang['36'] ?? 'Cost per volume' }} :</td>
                                                    <td class="py-2 text-green-600">{{ $currancy . number_format($detail['per_units'], 2) }} <span class="font-s-12 text-gray-400">/ {{ $lang['21'] ?? 'cu ft' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pt-4 pb-1 text-sm text-blue font-semibold">Cost in other units :</td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border-b py-1 pl-4 italic text-gray-600">cm³ :</td>
                                                    <td class="border-b py-1">{{ number_format($detail['per_units'] / 28320, 6) }}</td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border-b py-1 pl-4 italic text-gray-600">m³ :</td>
                                                    <td class="border-b py-1">{{ number_format($detail['per_units'] * 35.315, 2) }}</td>
                                                </tr>
                                                <tr class="text-sm">
                                                    <td class="border-b py-1 pl-4 italic text-gray-600">cu yd :</td>
                                                    <td class="border-b py-1">{{ number_format($detail['per_units'] * 27, 2) }}</td>
                                                </tr>
                                            @endif

                                            @if (isset($detail['cost_per_colums']))
                                                <tr>
                                                    <td class="border-b py-2 font-semibold">Cost per column :</td>
                                                    <td class="border-b py-2">{{ $currancy . number_format($detail['cost_per_colums'], 2) }}</td>
                                                </tr>
                                            @endif

                                            @if (isset($detail['total_costz']))
                                                <tr>
                                                    <td class="border-b py-2 font-bold text-lg text-blue">{{ $lang['40'] ?? 'Total estimated cost' }} :</td>
                                                    <td class="border-b py-2 text-lg font-bold text-blue">{{ $currancy . number_format($detail['total_costz'], 2) }}</td>
                                                </tr>
                                            @endif
                                        @else
                                            <!-- Custom Mix Results -->
                                            @if (isset($detail['total_volume']))
                                                <tr>
                                                    <td class="pt-6 font-bold">{{ $lang['41'] ?? 'Total volume (incl. waste)' }} :</td>
                                                    <td class="pt-6">{{ number_format($detail['total_volume'], 4) }} <span class="font-s-14 text-gray-500">{{ $lang['21'] ?? 'cu ft' }}</span></td>
                                                </tr>
                                            @endif

                                            @if (isset($detail['value_cement']))
                                                <tr>
                                                    <td class="border-b py-2 pl-4 text-sm text-gray-700 italic">{{ $lang['43'] ?? 'Cement needed' }} :</td>
                                                    <td class="border-b py-2 text-sm">{{ number_format($detail['value_cement'], 4) }} cu ft</td>
                                                </tr>
                                            @endif

                                            @if (isset($detail['value_sand']))
                                                <tr>
                                                    <td class="border-b py-2 pl-4 text-sm text-gray-700 italic">{{ $lang['45'] ?? 'Sand needed' }} :</td>
                                                    <td class="border-b py-2 text-sm">{{ number_format($detail['value_sand'], 4) }} cu ft</td>
                                                </tr>
                                            @endif

                                            @if (isset($detail['value_gravel']))
                                                <tr>
                                                    <td class="border-b py-2 pl-4 text-sm text-gray-700 italic">{{ $lang['47'] ?? 'Gravel needed' }} :</td>
                                                    <td class="border-b py-2 text-sm">{{ number_format($detail['value_gravel'], 4) }} cu ft</td>
                                                </tr>
                                            @endif

                                            @if (isset($detail['total_costszz']))
                                                <tr>
                                                    <td class="border-b py-2 pt-6 font-bold text-lg text-blue">{{ $lang['40'] ?? 'Total estimated cost' }} :</td>
                                                    <td class="border-b py-2 text-lg font-bold text-blue">{{ $currancy . number_format($detail['total_costszz'], 2) }}</td>
                                                </tr>
                                            @endif
                                        @endif
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
