<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Shape Selection -->
                    <div class="col-span-12">
                        <label for="m_shape" class="label">{{ $lang['1'] ?? 'Shape' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="m_shape" id="m_shape" class="input">
                                <option value="0">{{ $lang['2'] ?? 'Rectangular' }}</option>
                                <option value="1">{{ $lang['3'] ?? 'Circular' }}</option>
                                <option value="2">{{ $lang['4'] ?? 'Triangular' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Dimension/Area Mode (Only for Rectangular) -->
                    @if ($m_shape === '0')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 mt-3 gap-4">
                                <div class="col-span-12 flex items-center space-x-4">
                                    <input type="radio" wire:model.live="g" id="g1" value="g1">
                                    <label for="g1" class="label">{{ $lang['5'] ?? 'By Dimensions' }}:</label>
                                </div>
                                <div class="col-span-12 flex items-center space-x-4">
                                    <input type="radio" wire:model.live="g" id="g2" value="g2">
                                    <label for="g2" class="label">{{ $lang['6'] ?? 'By Area' }}:</label>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Conditional Input Fields -->
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-4">
                            @if ($m_shape === '0')
                                @if ($g === 'g1')
                                    <!-- Length -->
                                    <div class="col-span-6">
                                        <label for="length" class="label">{{ $lang['7'] ?? 'Length' }}:</label>
                                        <div class="relative w-full">
                                            <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length1_dropdown')">{{ $length1 }} ▾</label>
                                            @if ($showDropdown === 'length1_dropdown')
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                    @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length1', '{{ $name }}')">{{ $name }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Width -->
                                    <div class="col-span-6">
                                        <label for="width" class="label">{{ $lang['22'] ?? 'Width' }}:</label>
                                        <div class="relative w-full">
                                            <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width1_dropdown')">{{ $width1 }} ▾</label>
                                            @if ($showDropdown === 'width1_dropdown')
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                    @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width1', '{{ $name }}')">{{ $name }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <!-- Square Footage -->
                                    <div class="col-span-12">
                                        <label for="sqr_ft" class="label">{{ $lang['8'] ?? 'Area' }}:</label>
                                        <div class="relative w-full">
                                            <input type="number" wire:model="sqr_ft" id="sqr_ft" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('sqr_ft1_dropdown')">{{ $sqr_ft1 }} ▾</label>
                                            @if ($showDropdown === 'sqr_ft1_dropdown')
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                    @foreach (["sq-ft", "acres"] as $name)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('sqr_ft1', '{{ $name }}')">{{ $name }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @elseif ($m_shape === '1')
                                <!-- Diameter -->
                                <div class="col-span-12">
                                    <label for="diameter" class="label">{{ $lang['9'] ?? 'Diameter' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="diameter" id="diameter" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('diameter1_dropdown')">{{ $diameter1 }} ▾</label>
                                        @if ($showDropdown === 'diameter1_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('diameter1', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($m_shape === '2')
                                <!-- Side 1 -->
                                <div class="col-span-6">
                                    <label for="side1" class="label">{{ $lang['10'] ?? 'Side' }} 1:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="side1" id="side1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('side11_dropdown')">{{ $side11 }} ▾</label>
                                        @if ($showDropdown === 'side11_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('side11', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Side 2 -->
                                <div class="col-span-6">
                                    <label for="side2" class="label">{{ $lang['10'] ?? 'Side' }} 2:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="side2" id="side2" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('side21_dropdown')">{{ $side21 }} ▾</label>
                                        @if ($showDropdown === 'side21_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('side21', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Depth (Always visible) -->
                    <div class="col-span-12">
                        <label for="depth" class="label">{{ $lang['11'] ?? 'Depth' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="depth" id="depth" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('depth1_dropdown')">{{ $depth1 }} ▾</label>
                            @if ($showDropdown === 'depth1_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                    @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('depth1', '{{ $name }}')">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Mulch Type -->
                    <div class="col-span-12">
                        <label for="m_type" class="label">{{ $lang['12'] ?? 'Mulch Type' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="m_type" id="m_type" class="input">
                                <option value="0">Cedar</option>
                                <option value="1">Cypress</option>
                                <option value="2">Eucalyptus</option>
                                <option value="3">Hardwood</option>
                                <option value="4">Hemlock</option>
                                <option value="5">Pine</option>
                                <option value="6">Pine Needles</option>
                                <option value="7">Pine Nuggets</option>
                                <option value="8">Rubber</option>
                                <option value="9">Rubber Nuggets</option>
                                <option value="10">Wheat Straw</option>
                                <option value="11">Soil</option>
                            </select>
                        </div>
                    </div>

                    <!-- Optional Cost Section Toggle -->
                    <div class="col-span-12 cursor-pointer flex items-center justify-center my-3" wire:click="toggleOptional">
                        <strong class="pe-lg-3">{{ $lang['13'] ?? 'Cost calculations (optional)' }}:</strong>
                        <img src="{{ asset('images/new-down.webp') }}" class="button mx-3 {{ $showOptional ? 'rotate' : '' }}" alt="cost" width="16px" height="16px" style="transition: transform 0.5s ease-in-out;">
                    </div>

                    <!-- Optional Cost Inputs -->
                    @if ($showOptional)
                        <div class="col-span-12 transition-all duration-500 ease-in-out">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="price_bag" class="label">{{ $lang['14'] ?? 'Price per bag' }}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" wire:model="price_bag" id="price_bag" step="any" class="input" placeholder="0.00" />
                                        <span class="absolute right-4 top-4 text-blue">{{ $currancy }}</span>
                                    </div>
                                </div>
                                @if (!($m_type === '6' || $m_type === '10'))
                                    <div class="col-span-6">
                                        <label for="bag_size" class="label">{{ $lang['23'] ?? 'Bag size' }}:</label>
                                        <div class="relative w-full">
                                            <input type="number" wire:model="bag_size" id="bag_size" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('bag_size1_dropdown')">{{ $bag_size1 }} ▾</label>
                                            @if ($showDropdown === 'bag_size1_dropdown')
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                    @foreach (["m³", "cu ft", "cu yd", "liters"] as $name)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('bag_size1', '{{ $name }}')">{{ $name }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
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
                                <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td width="50%" class="border-b py-2 font-bold">{{ $lang['15'] ?? 'Mulch needed' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['cubic_yards'], 2) }} (cu yd)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="font-s-20 py-4 font-bold text-blue">{{ $lang['16'] ?? 'Other units' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['15'] ?? 'Mulch needed' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['cubic_ft'], 2) }} cu ft</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['15'] ?? 'Mulch needed' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['cubic_meters'], 2) }} m³</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['15'] ?? 'Mulch needed' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['liters'], 2) }} liters</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 font-bold">{{ $lang['17'] ?? 'Garden size' }} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['garden_size'], 2) }} sq.ft</td>
                                        </tr>

                                        @if (isset($detail['size1']) || isset($detail['size']))
                                            <tr>
                                                <td colspan="2" class="font-s-20 py-4 font-bold text-blue">{{ $lang['19'] ?? 'Required bags' }}</td>
                                            </tr>
                                            @if ($m_type == '6' || $m_type == '10')
                                                @if (isset($detail['size1']))
                                                    <tr>
                                                        <td class="border-b py-2">{{ $lang['18'] ?? 'Bales needed' }} :</td>
                                                        <td class="border-b py-2">{{ $detail['size1'] }}</td>
                                                    </tr>
                                                    @if (isset($detail['total_cost1']))
                                                        <tr>
                                                            <td class="border-b py-2 font-bold text-blue">{{ $lang['20'] ?? 'Total cost' }} :</td>
                                                            <td class="border-b py-2 text-blue font-bold">{{ $currancy . number_format($detail['total_cost1'], 2) }}</td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @else
                                                @if (isset($detail['size']))
                                                    <tr>
                                                        <td class="border-b py-2">{{ $lang['21'] ?? 'Bags needed' }} :</td>
                                                        <td class="border-b py-2">{{ $detail['size'] }}</td>
                                                    </tr>
                                                    @if (isset($detail['total_cost']))
                                                        <tr>
                                                            <td class="border-b py-2 font-bold text-blue">{{ $lang['20'] ?? 'Total cost' }} :</td>
                                                            <td class="border-b py-2 text-blue font-bold">{{ $currancy . number_format($detail['total_cost'], 2) }}</td>
                                                        </tr>
                                                    @endif
                                                @endif
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
