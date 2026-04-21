<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="operation" class="font-s-14 text-blue">{{ $lang['1'] ?? 'What to calculate?' }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="operations" id="operation" class="input">
                                <option value="1">{{ $lang['2'] ?? 'Calculate Weight' }}</option>
                                <option value="2">{{ $lang['3'] ?? 'Calculate Area' }}</option>
                                <option value="3">{{ $lang['4'] ?? 'Calculate Volume' }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($operations == '1')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="first" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Length' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="first" id="first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units1_dropdown')">{{ $units1 }} ▾</label>
                                @if ($showDropdown === 'units1_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in","ft","cm","m","yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units1', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="second" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Width' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="second" id="second" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units2_dropdown')">{{ $units2 }} ▾</label>
                                @if ($showDropdown === 'units2_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in","ft","cm","m","yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units2', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ex_drop" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Density' }}</label>
                        <div class="w-100 py-2">
                            <select wire:model="ex_drop" id="ex_drop" class="input">
                                <option value="105">{{ ($lang['10'] ?? 'Asphalt') . " - 105 lb/ft³"}}</option>
                                <option value="150">{{ ($lang['11'] ?? 'Concrete') . " - 150 lb/ft³"}}</option>
                                <option value="160">{{ ($lang['12'] ?? 'Stone') . " - 160 lb/ft³"}}</option>
                                <option value="145">{{ ($lang['13'] ?? 'Brick') . " - 145 lb/ft³"}}</option>
                                <option value="168">{{ ($lang['14'] ?? 'Mortar') . " - 168 lb/ft³"}}</option>
                                <option value="160">{{ ($lang['15'] ?? 'Gravel') . " - 160 lb/ft³"}}</option>
                                <option value="168">{{ ($lang['16'] ?? 'Sand') . " - 168 lb/ft³"}}</option>
                                <option value="188">{{ ($lang['17'] ?? 'Iron') . " - 188 lb/ft³"}}</option>
                                <option value="100">{{ ($lang['18'] ?? 'Water') . " - 100 lb/ft³"}}</option>
                                <option value="110">{{ ($lang['20'] ?? 'Other') . " - 110 lb/ft³"}}</option>
                            </select>
                        </div>
                    </div>

                    @if ($operations == '1' || $operations == '2')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="third" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Thickness' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="third" id="third" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units3_dropdown')">{{ $units3 }} ▾</label>
                                @if ($showDropdown === 'units3_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in","ft","cm","m","yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units3', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($operations == '2')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="four" class="font-s-14 text-blue">{{ $lang['8'] ?? 'Area' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="four" id="four" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units4_dropdown')">{{ $units4 }} ▾</label>
                                @if ($showDropdown === 'units4_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in²","ft²","yd²","cm²","m²"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units4', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($operations == '3')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="five" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Volume' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="five" id="five" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units5_dropdown')">{{ $units5 }} ▾</label>
                                @if ($showDropdown === 'units5_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in³","ft³","yd³","cm³","m³"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units5', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="six" class="font-s-14 text-blue">{{ $lang['21'] ?? 'Price per mass' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="six" id="six" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units6_dropdown')">{{ $currancy . ' ' . $units6 }} ▾</label>
                            @if ($showDropdown === 'units6_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["lb","t","long t","kg"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units6', '{{ $unit }}')">{{ $currancy . ' ' . $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="seven" class="font-s-14 text-blue">{{ $lang['22'] ?? 'Price per volume' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="seven" id="seven" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units7_dropdown')">{{ $currancy . ' ' . $units7 }} ▾</label>
                            @if ($showDropdown === 'units7_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["in³","ft³","yd³","cm³","m³"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units7', '{{ $unit }}')">{{ $currancy . ' ' . $unit }}</p>
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
                            <div class="row mt-1">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="text-[18px] w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang['27'] ?? 'Total Weight' }} :</strong></td>
                                            <td class="border-b py-2">{{ round(($detail['weight'] ?? 0) / 2000, 4) }}<span class="font_size18 black-text"> tons</span></td>
                                        </tr>
                                        @if ($operations == '1')
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['5'] ?? 'Area' }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['area'] ?? 0, 4) }}<span class="font_size18 black-text"> in²</span></td>
                                            </tr>
                                        @endif
                                        @if ($operations == '1' || $operations == '2')
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['4'] ?? 'Volume' }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['volume'] ?? 0, 4) }}<span class="font_size18 black-text"> in³</span></td>
                                            </tr>
                                        @endif
                                        @isset($detail['cost_mass'])
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['24'] ?? 'Cost per mass' }} :</strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round($detail['cost_mass'], 4) }}</td>
                                            </tr>
                                        @endisset
                                        @isset($detail['cost_volume'])
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['25'] ?? 'Cost per volume' }} :</strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ round($detail['cost_volume'], 4) }}</td>
                                            </tr>
                                        @endisset
                                        <tr>
                                            <td colspan="2" class="pt-3"><strong>{{$lang['26'] ?? 'Weight Conversions'}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">lbs</td>
                                            <td class="border-b py-2">{{ round($detail['weight'] ?? 0, 4) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">long tons</td>
                                            <td class="border-b py-2">{{ round(($detail['weight'] ?? 0) / 2240, 4) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">kgs</td>
                                            <td class="border-b py-2">{{ round(($detail['weight'] ?? 0) / 2.205, 4) }}</td>
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
