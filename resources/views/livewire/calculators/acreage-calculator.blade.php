<div>
    <form class="row" wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2 relative">
                        <label for="to_cal" class="text-blue">{{ $lang['15'] }}:</label>
                        <select class="input " name="to_cal" id="to_cal" aria-label="input select" wire:model.live="to_cal">
                            <option value="1">Area</option>
                            <option value="2">Length</option>
                            <option value="3">Width</option>
                        </select>
                    </div>

                    @if($to_cal != '2')
                    <div class="space-y-2 length">
                        <label for="length" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" wire:model="length" aria-label="input" placeholder="00" />
                            <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length_unit_dropdown')">{{ $length_unit }} ▾</label>
                            @if($showDropdown === 'length_unit_dropdown')
                            <div id="length_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[40%] mt-1 right-0">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'mm')">milimeters (mm)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'ft')">feet (ft)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'in')">inches (in)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'yd')">yards (yd)</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($to_cal != '3')
                    <div class="space-y-2  width">
                        <label for="width" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" wire:model="width" aria-label="input" placeholder="00" />
                            <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_unit_dropdown')">{{ $width_unit }} ▾</label>
                            @if($showDropdown === 'width_unit_dropdown')
                            <div id="width_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[40%] mt-1 right-0">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_unit', 'mm')">milimeters (mm)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_unit', 'ft')">feet (ft)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_unit', 'in')">inches (in)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_unit', 'yd')">yards (yd)</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($to_cal != '1')
                    <div class="space-y-2  area">
                        <label for="area" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" wire:model="area" aria-label="input" placeholder="00" />
                            <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_unit_dropdown')">{{ $area_unit }} ▾</label>
                            @if($showDropdown === 'area_unit_dropdown')
                            <div id="area_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', 'mm²')">mm²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', 'cm²')">cm²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', 'm²')">m²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', 'in²')">in²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', 'ft²')">ft²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', 'yd²')">yd²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', 'ac')">ac</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', 'ha')">ha</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="space-y-2 ">
                        <label for="price" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="price" id="price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" wire:model="price" aria-label="input" placeholder="00" />
                            <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('price_unit_dropdown')">{{ $price_unit }} ▾</label>
                            @if($showDropdown === 'price_unit_dropdown')
                            <div id="price_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }}/cm²')">{{ $currancy }}/cm²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }}/m²')">{{ $currancy }}/m²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }}/in²')">{{ $currancy }}/in²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }}/ft²')">{{ $currancy }}/ft²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }}/yd²')">{{ $currancy }}/yd²</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }}/ac')">{{ $currancy }}/ac</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }}/ha')">{{ $currancy }}/ha</p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr style="height: 1px; background-color: #e5e7eb;">
           <div id="result-section" wire:loading.remove wire:target="calculate"
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="row">
                                <div class="col-lg-12 font-s-20">
                                    @if ($to_cal == 1)
                                        <div class="col-lg-7">
                                            <table class="w-100 font-s-18">
                                                <p class="mt-3 mb-2"><strong>{{ $lang['5'] }}</strong></p>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['6'] }} :</td>
                                                    <td width="60%" class="border-b py-2">
                                                        <?= round(($detail['area'] ?? 0) * 0.0002471054, 4) ?> <?= $lang['6'] ?></td>
                                                </tr>
                                            </table>
                                            <p class="mt-3 my-2"><strong>{{ $lang['16'] }}</strong></p>
                                            <table class="w-100 font-s-18">
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['7'] }}:</td>
                                                    <td width="60%" class="border-b py-2">{{ round(($detail['area'] ?? 0) * 0.0001, 4) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['8'] }} :</td>
                                                    <td class="border-b py-2">{{ round(($detail['area'] ?? 0) * 10.7639, 4) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['9'] }} :</td>
                                                    <td class="border-b py-2">{{ round($detail['area'] ?? 0, 4) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['10'] }} :</td>
                                                    <td class="border-b py-2">{{ round(($detail['area'] ?? 0) * 0.000000386102, 10) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['11'] }} :</td>
                                                    <td class="border-b py-2">{{ round(($detail['area'] ?? 0) * 0.000001, 8) }}</td>
                                                </tr>

                                            </table>
                                        </div>
                                    @elseif($to_cal == 2)
                                        <div class="col-lg-7">
                                            <table class="w-100 font-s-18">
                                                <p class="mt-3 mb-2"><strong>{{ $lang['2'] }}</strong></p>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['12'] }} :</td>
                                                    <td width="60%" class="border-b py-2">
                                                        {{ round($detail['length'] ?? 0, 4) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @elseif($to_cal == 3)
                                        <div class="col-lg-7">
                                            <table class="w-100 font-s-18">
                                                <p class="mt-3 mb-2"><strong>{{ $lang['3'] }}</strong></p>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['12'] }} :</td>
                                                    <td width="60%" class="border-b py-2">
                                                        {{ round($detail['width'] ?? 0, 4) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                    <div class="col-lg-7 col-12">
                                        <table class="w-100 font-s-18">
                                            <p class="mt-3 mb-2"><strong>{{ $lang['13'] }}</strong></p>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['12'] }} :</td>
                                                <td width="60%" class="border-b py-2">{{ round($detail['perimeter'] ?? 0, 4) }}</td>
                                            </tr>
                                        </table>
                                        @if (is_numeric($price))
                                            <table class="w-100 font-s-18">
                                                <p class="mt-3 mb-2"><strong>{{ $lang['14'] }}</strong></p>
                                                <tr>
                                                    <td class="border-b py-2">{{ $currancy }} :</td>
                                                    <td width="60%" class="border-b py-2">
                                                        {{ round($detail['final_price'] ?? 0, 2) }}</td>
                                                </tr>
                                            </table>
                                        @endif
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
