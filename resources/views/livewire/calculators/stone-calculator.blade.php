<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="mx-auto mt-2 w-full lg:w-[80%] md:w-[80%]">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $selection == 1 ? 'tagsUnit' : '' }}" wire:click="setSelection(1)">
                            {{ $lang['2'] ?? 'Dimensions' }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $selection == 2 ? 'tagsUnit' : '' }}" wire:click="setSelection(2)">
                            {{ $lang['3'] ?? 'Area' }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $selection == 3 ? 'tagsUnit' : '' }}" wire:click="setSelection(3)">
                            {{ $lang['4'] ?? 'Volume' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="material" class="label">{{ $lang['9'] ?? 'Material' }}</label>
                        <div class="w-full py-2">
                            <select wire:model.live="material" id="material" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full">
                                <option value="105">{{ $lang['16'] ?? 'Crushed Stone' }} (¼” – 2″)</option>
                                <option value="150">{{ $lang['17'] ?? 'Gravel' }} (2″ – 6″)</option>
                                <option value="160">{{ $lang['18'] ?? 'Limestone' }} ({{ $lang['19'] ?? 'loose' }})</option>
                                <option value="145">{{ $lang['20'] ?? 'Sand' }} ({{ $lang['21'] ?? 'dry' }})</option>
                                <option value="168">{{ $lang['22'] ?? 'Soil' }} ({{ $lang['19'] ?? 'loose' }})</option>
                                <option value="100">{{ $lang['23'] ?? 'Other' }}</option>
                            </select>
                        </div>
                    </div>

                    @if($selection == 1)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="length" class="label">{{ $lang['5'] ?? 'Length' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('length_unit')">{{ $length_unit }} ▾</label>
                                @if($showDropdown === 'length_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["cm", "m", "in", "ft", "yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="width" class="label">{{ $lang['6'] ?? 'Width' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('width_unit')">{{ $width_unit }} ▾</label>
                                @if($showDropdown === 'width_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["cm", "m", "in", "ft", "yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($selection == 2)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="area" class="label">{{ $lang['7'] ?? 'Area' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('area_unit')">{{ $area_unit }} ▾</label>
                                @if($showDropdown === 'area_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["ft²", "yd²", "m²"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($selection == 1 || $selection == 2)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="depth" class="label">{{ $lang['15'] ?? 'Depth' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="depth" id="depth" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('depth_unit')">{{ $depth_unit }} ▾</label>
                                @if($showDropdown === 'depth_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["cm", "m", "in", "ft", "yd"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('depth_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($selection == 3)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="volume" class="label">{{ $lang['8'] ?? 'Volume' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="volume" id="volume" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('volume_unit')">{{ $volume_unit }} ▾</label>
                                @if($showDropdown === 'volume_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('volume_unit', 'ft³')">ft³</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('volume_unit', 'yd³')">yd³</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('volume_unit', 'm³')">m³</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="price" class="label">{{ $lang['10'] ?? 'Price' }} ({{ $lang[11] ?? 'Optional' }}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="price" id="price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('price_unit')">{{ $price_unit }} ▾</label>
                            @if($showDropdown === 'price_unit')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }} per ton')">{{ $currancy }} per ton</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $currancy }} per cu yd')">{{ $currancy }} per cu yd</p>
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
        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full md:w-[70%] lg:w-[70%]">
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-3"><strong>{{ $lang['12'] ?? 'Tons Needed' }} :</strong></td>
                                            <td class="border-b py-3">{{ round($detail['array'][0], 3) }} - {{ round($detail['array'][1], 3) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3"><strong>{{ $lang['13'] ?? 'Cubic Yards' }} :</strong></td>
                                            <td class="border-b py-3">{{ round($detail['cubicyd1'], 4) }} yd³</td>
                                        </tr>
                                        @if ($price)
                                            <tr>
                                                <td class="border-b py-3"><strong>{{ $lang['14'] ?? 'Estimated Cost' }} :</strong></td>
                                                <td class="border-b py-3 text-blue-600 font-bold">
                                                    @if (strpos($price_unit, 'per ton') !== false)
                                                        {{ $currancy }}{{ round($detail['price_ton'][0] ?? 0) }} - {{ $currancy }}{{ round($detail['price_ton'][1] ?? 0) }}
                                                    @else
                                                        {{ $currancy }}{{ round($detail['price_cu'] ?? 0) }}
                                                    @endif
                                                </td>
                                            </tr>
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
