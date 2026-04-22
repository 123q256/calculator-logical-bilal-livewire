<div>
   <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Shape Selection -->
                    <div class="col-span-12">
                        <label for="shape" class="label">{{ $lang['1'] ?? 'Shape' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="shape" id="shape" class="input">
                                <option value="0">{{ $lang['2'] ?? 'Rectangular' }}</option>
                                <option value="1">{{ $lang['3'] ?? 'Circular' }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($shape === '0')
                        <!-- Mode Selection for Rectangular -->
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-4 flex items-center space-x-2">
                                    <input type="radio" wire:model.live="g" id="g1" value="g1">
                                    <label for="g1" class="label text-sm">{{ $lang['4'] ?? 'Dimensions' }}</label>
                                </div>
                                <div class="col-span-4 flex items-center space-x-2">
                                    <input type="radio" wire:model.live="g" id="g2" value="g2">
                                    <label for="g2" class="label text-sm">{{ $lang['5'] ?? 'Area' }}</label>
                                </div>
                                <div class="col-span-4 flex items-center space-x-2">
                                    <input type="radio" wire:model.live="g" id="g3" value="g3">
                                    <label for="g3" class="label text-sm">{{ $lang['6'] ?? 'Volume' }}</label>
                                </div>
                            </div>
                        </div>

                        <!-- Mode-specific Inputs -->
                        @if ($g === 'g1')
                            <div class="col-span-6">
                                <label for="length" class="label">{{ $lang['7'] ?? 'Length' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length_unit_dropdown')">{{ $length_unit }} ▾</label>
                                    @if ($showDropdown === 'length_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                            @foreach (["mm", "cm", "m", "in", "ft", "yd"] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="width" class="label">{{ $lang['8'] ?? 'Width' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_unit_dropdown')">{{ $width_unit }} ▾</label>
                                    @if ($showDropdown === 'width_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                            @foreach (["mm", "cm", "m", "in", "ft", "yd"] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @elseif ($g === 'g2')
                            <div class="col-span-12">
                                <label for="area" class="label">{{ $lang['9'] ?? 'Area' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" wire:model="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_unit_dropdown')">{{ $area_unit }} ▾</label>
                                    @if ($showDropdown === 'area_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                            @foreach (["mm²", "cm²", "m²", "in²", "ft²", "yd²", "hectares", "acres", "soccer fields"] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('area_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @elseif ($g === 'g3')
                            <div class="col-span-12">
                                <label for="volume" class="label">{{ $lang['10'] ?? 'Volume' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" wire:model="volume" id="volume" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('volume_unit_dropdown')">{{ $volume_unit }} ▾</label>
                                    @if ($showDropdown === 'volume_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                            @foreach (["mm³", "cm³", "m³", "in³", "ft³", "yd³"] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('volume_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Depth (Only for g1 and g2) -->
                        @if ($g !== 'g3')
                            <div class="col-span-12">
                                <label for="depth" class="label">{{ $lang['11'] ?? 'Depth' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" wire:model="depth" id="depth" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('depth_unit_dropdown')">{{ $depth_unit }} ▾</label>
                                    @if ($showDropdown === 'depth_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                            @foreach (["mm", "cm", "m", "in", "ft", "yd"] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('depth_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @else
                        <!-- Circular Inputs -->
                        <div class="col-span-6">
                            <label for="diameter" class="label">{{ $lang['12'] ?? 'Diameter' }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="diameter" id="diameter" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('diameter_unit_dropdown')">{{ $diameter_unit }} ▾</label>
                                @if ($showDropdown === 'diameter_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["mm", "cm", "m", "in", "ft", "yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('diameter_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="depth_circ" class="label">{{ $lang['11'] ?? 'Depth' }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="depth" id="depth_circ" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('depth_circ_unit_dropdown')">{{ $depth_unit }} ▾</label>
                                @if ($showDropdown === 'depth_circ_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["mm", "cm", "m", "in", "ft", "yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('depth_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Density (Always visible for shape 0) -->
                    @if ($shape === '0' || $shape === '1')
                        <div class="col-span-12">
                            <label for="density" class="label">{{ $lang['13'] ?? 'Density' }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="density" id="density" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('density_unit_dropdown')">{{ $density_unit }} ▾</label>
                                @if ($showDropdown === 'density_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["kg/m³", "t/m³", "g/cm³", "oz/in³", "lb/in³", "lb/ft³", "lb/yd³"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('density_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Price Section -->
                    <div class="col-span-12 pt-4">
                        <p class="font-bold text-blue-600 border-b pb-2 mb-4 uppercase text-sm tracking-wider">{{ $lang['14'] ?? 'Price calculations' }}</p>
                        <div class="grid grid-cols-12 gap-4">
                            @if ($shape === '0')
                                <div class="col-span-6">
                                    <label for="mass_price" class="label">{{ $lang['15'] ?? 'By Mass' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="mass_price" id="mass_price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('mass_price_unit_dropdown')">{{ $mass_price_unit }} ▾</label>
                                        @if ($showDropdown === 'mass_price_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["µg", "mg", "g", "kg", "t", "lb", "stone", "US ton", "Long ton"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('mass_price_unit', '{{ $currancy . $unit }}')">{{ $currancy . $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="volume_price" class="label">{{ $lang['16'] ?? 'By Volume' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="volume_price" id="volume_price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('volume_price_unit_dropdown')">{{ $volume_price_unit }} ▾</label>
                                        @if ($showDropdown === 'volume_price_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["mm³", "cm³", "m³", "in³", "ft³", "yd³"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('volume_price_unit', '{{ $currancy . $unit }}')">{{ $currancy . $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="col-span-12">
                                    <label for="c_price" class="label">{{ $lang['17'] ?? 'Price per unit weight' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="c_price" id="c_price" step="any" class="input" />
                                        <span class="absolute right-4 top-4 text-blue">{{ $currancy }}</span>
                                    </div>
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
   <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full">
                            <div class="w-full md:w-[90%] lg:w-[80%] overflow-auto font-s-18">
                                <table class="w-full border-collapse">
                                    <!-- Main Volume -->
                                    @if (isset($detail['volume']))
                                        <tr>
                                            <td width="50%" class="border-b py-2 font-bold">Volume</td>
                                            <td class="border-b py-2 text-blue-600 font-bold">{{ number_format($detail['volume'], 2) }} (ft³)</td>
                                        </tr>
                                    @endif

                                    <!-- Other Volume Units -->
                                    <tr>
                                        <td colspan="2" class="py-2 text-sm text-gray-500 font-semibold italic">Result in other units</td>
                                    </tr>
                                    @if (isset($detail['mm3']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Volume</td>
                                            <td class="border-b py-2">{{ number_format($detail['mm3'], 2) }} cubic milimeters (mm³)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['cm3']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Volume</td>
                                            <td class="border-b py-2">{{ number_format($detail['cm3'], 2) }} cubic centimeters (cm³)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['m3']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Volume</td>
                                            <td class="border-b py-2">{{ number_format($detail['m3'], 2) }} cubic meters (m³)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['in3']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Volume</td>
                                            <td class="border-b py-2">{{ number_format($detail['in3'], 2) }} cubic inches (in³)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['yd3']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Volume</td>
                                            <td class="border-b py-2">{{ number_format($detail['yd3'], 2) }} cubic yards (yd³)</td>
                                        </tr>
                                    @endif

                                    <!-- Main Weight -->
                                    @if (isset($detail['weight']))
                                        <tr>
                                            <td class="border-b py-2 font-bold pt-6">Weight</td>
                                            <td class="border-b py-2 text-blue-600 font-bold pt-6">{{ number_format($detail['weight'], 2) }} t</td>
                                        </tr>
                                    @endif

                                    <!-- Other Weight Units -->
                                    <tr>
                                        <td colspan="2" class="py-2 text-sm text-gray-500 font-semibold italic">Result in other units</td>
                                    </tr>
                                    @if (isset($detail['g']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Weight</td>
                                            <td class="border-b py-2">{{ number_format($detail['g'], 2) }} grams (g)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['kg']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Weight</td>
                                            <td class="border-b py-2">{{ number_format($detail['kg'], 2) }} kilograms (kg)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['oz']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Weight</td>
                                            <td class="border-b py-2">{{ number_format($detail['oz'], 2) }} ounces (oz)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['lb']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Weight</td>
                                            <td class="border-b py-2">{{ number_format($detail['lb'], 2) }} pounds (lb)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['stone']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Weight</td>
                                            <td class="border-b py-2">{{ number_format($detail['stone'], 2) }} stones (stone)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['us_ton']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Weight</td>
                                            <td class="border-b py-2">{{ number_format($detail['us_ton'], 2) }} US short tons (US ton)</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['long_ton']))
                                        <tr>
                                            <td class="border-b py-2 px-4">Weight</td>
                                            <td class="border-b py-2">{{ number_format($detail['long_ton'], 2) }} imperial tons (Long ton)</td>
                                        </tr>
                                    @endif

                                    <!-- Cost -->
                                    @if (isset($detail['cost']))
                                        <tr>
                                            <td class="border-b py-2 font-bold pt-6 text-green-700">Cost</td>
                                            <td class="border-b py-2 text-green-700 font-bold pt-6">{{ $currancy }}{{ number_format($detail['cost'], 2) }}</td>
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
