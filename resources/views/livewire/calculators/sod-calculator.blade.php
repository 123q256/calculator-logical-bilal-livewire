<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['cal_by'] ?? 'Calculate By' }}:</label>
                        <select wire:model.live="method" id="method" class="input">
                            <option value="lw">{{ ($lang['length'] ?? 'Length') . " " . ($lang['and'] ?? 'and') . " " . ($lang['width'] ?? 'Width') }}</option>
                            <option value="area">{{ $lang['area'] ?? 'Area' }}</option>
                        </select>
                    </div>

                    @if ($method === 'lw')
                        <div class="space-y-2">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['length'] ?? 'Length' }} (d):</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length_unit_dropdown')">{{ $length_unit }} ▾</label>
                                @if ($showDropdown === 'length_unit_dropdown')
                                    <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["cm", "mm", "km", "in", "yd", "mi", "ft"] as $u)
                                            <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length_unit', '{{ $u }}')">
                                                {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'km' ? 'kilometers (km)' : ($u == 'in' ? 'inches (in)' : ($u == 'yd' ? 'yards (yd)' : ($u == 'mi' ? 'miles (mi)' : 'feet (ft)'))))) }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['width'] ?? 'Width' }} (f):</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_unit_dropdown')">{{ $width_unit }} ▾</label>
                                @if ($showDropdown === 'width_unit_dropdown')
                                    <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["cm", "mm", "km", "in", "yd", "mi", "ft"] as $u)
                                            <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_unit', '{{ $u }}')">
                                                {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'km' ? 'kilometers (km)' : ($u == 'in' ? 'inches (in)' : ($u == 'yd' ? 'yards (yd)' : ($u == 'mi' ? 'miles (mi)' : 'feet (ft)'))))) }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="space-y-2">
                            <label for="area" class="font-s-14 text-blue">{{ $lang['area'] ?? 'Area' }} (f):</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_unit_dropdown')">{{ $area_unit }} ▾</label>
                                @if ($showDropdown === 'area_unit_dropdown')
                                    <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["m²", "km²", "ft²", "yd²", "mi²", "a", "da", "ha", "ac", "soccer fields"] as $u)
                                            <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('area_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="space-y-2 relative">
                        <label for="price" class="font-s-14 text-blue">{{ $lang['price'] ?? 'Price' }}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="price" id="price" class="input pr-10" />
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
                            @php
                                $isMetric = isset($detail['meter']);
                                $rolls_unit = $isMetric ? "(1 m²)" : "(10 ft²)";
                                $pallets_unit = $isMetric ? "(40 m²)" : "(450 ft²)";
                                $total_area_unit = $isMetric ? "M²" : "Ft²";
                                $acres_unit = $isMetric ? "Hectares" : "Acres";
                            @endphp
                            <div class="w-full my-2">
                                <div class="col-lg-6">
                                    <p class="font-s-20 my-2"><strong>{{ $lang['sod'] ?? 'Sod' }}</strong></p>
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="border-b py-2">{{ $detail['rolls'] }} :</td>
                                                <td class="border-b py-2">{{ ($lang['rolls'] ?? 'Rolls') . " " . $rolls_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td width="60%" class="border-b py-2">{{ $detail['pallets'] }} :</td>
                                                <td class="border-b py-2">{{ ($lang['pallets'] ?? 'Pallets') . " " . $pallets_unit }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 my-3">
                                    <div class="col-lg-6">
                                        <p class="font-s-20 my-2"><strong>{{ ($lang['total'] ?? 'Total') . " " . ($lang['area'] ?? 'Area') }}</strong></p>
                                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                            <table class="w-full font-s-18">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">{{ $detail['total_area'] }} :</td>
                                                    <td class="border-b py-2">{{ $total_area_unit }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $detail['acres'] }} :</td>
                                                    <td class="border-b py-2">{{ $acres_unit }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($detail['cost']))
                                    <div class="col-lg-6">
                                        <p class="font-s-20 my-2"><strong>{{ $lang['cost'] ?? 'Cost' }}</strong></p>
                                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                            <table class="w-full font-s-18">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">{{ ($lang['total'] ?? 'Total') . " " . ($lang['cost'] ?? 'cost') }} :</td>
                                                    <td class="border-b py-2">{{ $currancy . $detail['cost'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ ($lang['cost'] ?? 'Cost') }} per sq ft :</td>
                                                    <td class="border-b py-2">{{ $currancy . $detail['cost_ft2'] }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
