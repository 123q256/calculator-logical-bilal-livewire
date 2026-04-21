<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <label for="calc_type" class="font-s-14 text-blue one_text">{{ $lang['1'] ?? 'What to calculate?' }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="calc_type" id="calc_type" class="input">
                                <option value="1">{{ $lang['2'] ?? 'Price per square foot' }}</option>
                                <option value="2">{{ $lang['3'] ?? 'Square footage from price' }}</option>
                                <option value="3">{{ $lang['4'] ?? 'Total price' }}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="pp" class="font-s-14 text-blue">
                            @if ($calc_type == '1') {{ $lang['5'] ?? 'Price' }}
                            @elseif ($calc_type == '2') {{ $lang['9'] ?? 'Price per sq ft' }}
                            @else {{ $lang['18'] ?? 'Total price' }} @endif:
                        </label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" wire:model="pp" id="pp" class="input" />
                            <span class="text-blue input-unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="area_measure" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Square footage' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="area_measure" id="area_measure" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_measure_unit_dropdown')">{{ $area_measure_unit }} ▾</label>
                            @if ($showDropdown === 'area_measure_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["ft²","m²","in²","yd²"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_measure_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <p class="col-span-12 mt-2">{{ $lang['7'] ?? 'Compare with another property?' }}</p>
                    <div class="col-span-12">
                        <label for="compare" class="font-s-14 text-blue">{{ $lang['8'] ?? 'Comparison 1' }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="compare" id="compare" class="input">
                                <option value="1">{{ $lang['13'] ?? 'No' }}</option>
                                <option value="2">{{ $lang['14'] ?? 'Yes' }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($compare == '2')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="pp1" class="font-s-14 text-blue">
                                @if ($calc_type == '1') {{ $lang['5'] ?? 'Price' }}
                                @elseif ($calc_type == '2') {{ $lang['9'] ?? 'Price per sq ft' }}
                                @else {{ $lang['18'] ?? 'Total price' }} @endif:
                            </label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" wire:model="pp1" id="pp1" class="input" />
                                <span class="text-blue input-unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="area_measure1" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Square footage' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="area_measure1" id="area_measure1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_measure_unit1_dropdown')">{{ $area_measure_unit1 }} ▾</label>
                                @if ($showDropdown === 'area_measure_unit1_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["ft²","m²","in²","yd²"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_measure_unit1', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <p class="mt-2 col-span-12">{{ $lang['11'] ?? 'Add another comparison?' }}</p>
                        <div class="col-span-12 mt-0 mt-lg-2">
                            <label for="compare2" class="font-s-14 text-blue">{{ $lang['12'] ?? 'Comparison 2' }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select wire:model.live="compare2" id="compare2" class="input">
                                    <option value="1">{{ $lang['13'] ?? 'No' }}</option>
                                    <option value="2">{{ $lang['14'] ?? 'Yes' }}</option>
                                </select>
                            </div>
                        </div>

                        @if ($compare2 == '2')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="pp2" class="font-s-14 text-blue">
                                    @if ($calc_type == '1') {{ $lang['5'] ?? 'Price' }}
                                    @elseif ($calc_type == '2') {{ $lang['9'] ?? 'Price per sq ft' }}
                                    @else {{ $lang['18'] ?? 'Total price' }} @endif:
                                </label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model="pp2" id="pp2" class="input" />
                                    <span class="text-blue input-unit">{{ $currancy }}</span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="area_measure2" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Square footage' }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="area_measure2" id="area_measure2" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_measure_unit2_dropdown')">{{ $area_measure_unit2 }} ▾</label>
                                    @if ($showDropdown === 'area_measure_unit2_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (["ft²","m²","in²","yd²"] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_measure_unit2', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue result p-3 radius-10 mt-3">
                            <div class="w-full py-2">
                                <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                                    @if (($detail['calculate'] ?? '') == "1")
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong>{{ $lang['5'] ?? 'Price' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round($detail['res'] ?? 0, 2) }}</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2">{{ $lang['15'] ?? 'Conversions' }}:</p>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res'] ?? 0) * 10.7639, 3) }} <span class="font-s-14">(m)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res'] ?? 0) * 0.00694444, 3) }} <span class="font-s-14">(in)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res'] ?? 0) * 9, 3) }}<span class="font-s-14"> (yd)<sup>2</sup></span></td>
                                            </tr>
                                        </table>

                                        @if ($compare == "2")
                                            <p class="font-s-20 mt-3">{{ $lang['7'] ?? 'Property 2' }} : </p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>{{ $lang['5'] ?? 'Price' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round($detail['res1'] ?? 0, 2) }}</td>
                                                </tr>
                                            </table>
                                            <p class="mt-2">{{ $lang['15'] ?? 'Conversions' }}:</p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res1'] ?? 0) * 10.7639, 3) }} <span class="font-s-14">(m)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res1'] ?? 0) * 0.00694444, 3) }} <span class="font-s-14">(in)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res1'] ?? 0) * 9, 3) }} <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                                </tr>
                                            </table>
                                        @endif

                                        @if ($compare2 == "2")
                                            <p class="font-s-20 mt-3">{{ $lang['11'] ?? 'Property 3' }} : </p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>{{ $lang['5'] ?? 'Price' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round($detail['res2'] ?? 0, 2) }}</td>
                                                </tr>
                                            </table>
                                            <p class="mt-2">{{ $lang['15'] ?? 'Conversions' }}:</p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res2'] ?? 0) * 10.7639, 3) }} <span class="font-s-14">(m)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res2'] ?? 0) * 0.00694444, 3) }} <span class="font-s-14">(in)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['5'] ?? 'Price' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res2'] ?? 0) * 9, 3) }} <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endif

                                    @if (($detail['calculate'] ?? '') == "2")
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong>{{ $lang['9'] ?? 'Price per sq ft' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round($detail['res'] ?? 0, 2) }}</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2">{{ $lang['15'] ?? 'Conversions' }}:</p>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res'] ?? 0) * 10.7639, 3) }} <span class="font-s-14">(m)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res'] ?? 0) * 0.00694444, 3) }} <span class="font-s-14">(in)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res'] ?? 0) * 9, 3) }} <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                            </tr>
                                        </table>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong>{{ $lang['10'] ?? 'Price per sq yard' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res'] ?? 0) * 12, 2) }}</td>
                                            </tr>
                                        </table>
                                        @if ($compare == "2")
                                            <p class="font-s-20 mt-2">{{ $lang['7'] ?? 'Property 2' }} : </p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>{{ $lang['9'] ?? 'Price per sq ft' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round($detail['res1'] ?? 0, 2) }}</td>
                                                </tr>
                                            </table>
                                            <p class="mt-2">{{ $lang['15'] ?? 'Conversions' }}:</p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res1'] ?? 0) * 10.7639, 3) }} <span class="font-s-14">(m)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res1'] ?? 0) * 0.00694444, 3) }} <span class="font-s-14">(in)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res1'] ?? 0) * 9, 3) }} <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                                </tr>
                                            </table>
                                        @endif
                                        @if ($compare2 == "2")
                                            <p class="font-s-20 mt-2">{{ $lang['11'] ?? 'Property 3' }} : </p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>{{ $lang['9'] ?? 'Price per sq ft' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round($detail['res2'] ?? 0, 2) }}</td>
                                                </tr>
                                            </table>
                                            <p class="mt-2">{{ $lang['15'] ?? 'Conversions' }}:</p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res2'] ?? 0) * 10.7639, 3) }} <span class="font-s-14">(m)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res2'] ?? 0) * 0.00694444, 3) }} <span class="font-s-14">(in)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['9'] ?? 'Price per sq ft' }}</td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res2'] ?? 0) * 9, 3) }} <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endif

                                    @if (($detail['calculate'] ?? '') == "3")
                                        <table class="w-full">
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['16'] ?? 'Total price' }} <span class="font-s-14"> (ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round($detail['res'] ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['17'] ?? 'Price per sq ft' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res'] ?? 0) / 12, 2) }}</td>
                                            </tr>
                                            @if ($compare == "2")
                                                <tr>
                                                    <td colspan="2" class="pt-2">{{ $lang['7'] ?? 'Property 2' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['16'] ?? 'Total price' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round($detail['res1'] ?? 0, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['17'] ?? 'Price per sq ft' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res1'] ?? 0) / 12, 2) }}</td>
                                                </tr>
                                            @endif
                                            @if ($compare2 == "2")
                                                <tr>
                                                    <td colspan="2" class="pt-2">{{ $lang['11'] ?? 'Property 3' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['16'] ?? 'Total price' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round($detail['res2'] ?? 0, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['17'] ?? 'Price per sq ft' }} <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ round(($detail['res2'] ?? 0) / 12, 2) }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
