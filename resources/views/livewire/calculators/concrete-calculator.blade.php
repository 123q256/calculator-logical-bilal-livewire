<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column: Inputs -->
                    <div class="space-y-6">
                        <!-- Shape Selection -->
                        <div>
                            <label for="operations" class="label">{{ $lang['1'] ?? 'Select Shape' }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="operations" id="operations" class="input">
                                    <option value="3">{{ $lang['2'] ?? 'Slabs / Squares' }}</option>
                                    <option value="4">{{ $lang['3'] ?? 'Curb and Gutter' }}</option>
                                    <option value="5">{{ $lang['4'] ?? 'Wall / Footing' }}</option>
                                    <option value="6">{{ $lang['5'] ?? 'Circular Slab / Tube' }}</option>
                                    <option value="7">{{ $lang['6'] ?? 'Square Footing' }}</option>
                                    <option value="8">{{ $lang['7'] ?? 'Post Hole' }}</option>
                                    <option value="9">{{ $lang['8'] ?? 'Regular Stairs' }}</option>
                                    <option value="10">{{ $lang['9'] ?? 'Stairs with Landing' }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- First Input -->
                        <div>
                            <label class="label">
                                @if(in_array($operations, ['3', '4', '6'])) {{ $lang['10'] ?? 'Length' }}
                                @elseif(in_array($operations, ['5', '7', '8'])) {{ $lang['28'] ?? 'Height' }}
                                @elseif($operations == '9') {{ $lang['29'] ?? 'Rise' }}
                                @elseif($operations == '10') {{ $lang['32'] ?? 'Number of Steps' }}
                                @endif:
                            </label>
                            <div class="relative w-full py-2">
                                <input type="{{ $operations == '10' ? 'number' : 'number' }}" step="any" wire:model="first" class="input" />
                                @if($operations != '10')
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u1')">{{ $units1 }} ▾</label>
                                    @if ($showDropdown === 'u1')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["cm","m","in","ft","yd"] as $name)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units1', '{{ $name }}')">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <!-- Second Input -->
                        <div>
                            <label class="label">
                                @if(in_array($operations, ['3', '5', '6', '7'])) {{ $lang['11'] ?? 'Width' }}
                                @elseif(in_array($operations, ['4', '8'])) {{ $lang['27'] ?? 'Diameter' }}
                                @elseif($operations == '9') {{ $lang['30'] ?? 'Run' }}
                                @elseif($operations == '10') {{ $lang['33'] ?? 'Step Width' }}
                                @endif:
                            </label>
                            <div class="relative w-full py-2">
                                <input type="number" step="any" wire:model="second" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u2')">{{ $units2 }} ▾</label>
                                @if ($showDropdown === 'u2')
                                    <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach (["cm","m","in","ft","yd"] as $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units2', '{{ $name }}')">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Third Input (Conditional) -->
                        @if(!in_array($operations, ['4', '8']))
                        <div>
                            <label class="label">
                                @if(in_array($operations, ['3', '5', '6', '7'])) {{ $lang['12'] ?? 'Thickness' }}
                                @elseif($operations == '9') {{ $lang['31'] ?? 'Thickness' }}
                                @elseif($operations == '10') {{ $lang['34'] ?? 'Rise' }}
                                @endif:
                            </label>
                            <div class="relative w-full py-2">
                                <input type="number" step="any" wire:model="third" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u3')">{{ $units3 }} ▾</label>
                                @if ($showDropdown === 'u3')
                                    <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach (["cm","m","in","ft","yd"] as $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units3', '{{ $name }}')">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Fourth Input (Conditional) -->
                        @if(in_array($operations, ['9', '10']))
                        <div>
                            <label class="label">
                                @if($operations == '9') {{ $lang['31'] ?? 'Width' }}
                                @else {{ $lang['13'] ?? 'Run' }}
                                @endif:
                            </label>
                            <div class="relative w-full py-2">
                                <input type="number" step="any" wire:model="four" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u4')">{{ $units4 }} ▾</label>
                                @if ($showDropdown === 'u4')
                                    <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach (["cm","m","in","ft","yd"] as $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units4', '{{ $name }}')">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Fifth Input (Conditional for 10) -->
                        @if($operations == '10')
                        <div>
                            <label class="label">{{ $lang['11'] ?? 'Landing Run' }}:</label>
                            <div class="relative w-full py-2">
                                <input type="number" step="any" wire:model="five" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u5')">{{ $units5 }} ▾</label>
                                @if ($showDropdown === 'u5')
                                    <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach (["cm","m","in","ft","yd"] as $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units5', '{{ $name }}')">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- FifthB Input (Conditional for 9) -->
                        @if($operations == '9')
                        <div>
                            <label class="label">{{ $lang['15'] ?? 'Steps' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model="fiveb" class="input" />
                            </div>
                        </div>
                        @endif

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="label">{{ $lang['16'] ?? 'Quantity' }}:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model="quantity" class="input" />
                                </div>
                            </div>
                            <div>
                                <label class="label">{{ $lang['17'] ?? 'Price' }}:</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model="price" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('p_u')">{{ $price_unit }} ▾</label>
                                    @if ($showDropdown === 'p_u')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["ft³", "yd³", "m³"] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('price_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Image and Helper Text -->
                    <div class="flex flex-col items-center justify-center space-y-4">
                        @php
                            $imageName = match($operations) {
                                '3' => 'Square Slab',
                                '4' => 'Square Slab',
                                '5' => 'Footer',
                                '6' => 'Wall',
                                '7' => 'Square Column',
                                '8' => 'Round Column',
                                '9' => 'Square Column',
                                '10' => 'Example',
                                default => 'Square Slab'
                            };
                        @endphp
                        <div class="bg-white p-4 rounded-xl shadow-inner border border-gray-100">
                            <img src="{{ asset('images/' . $imageName . ($imageName == 'Example' ? '.png' : '.webp')) }}" alt="{{ $imageName }}" class="max-w-full h-auto rounded-lg shadow-sm" style="max-height: 300px;">
                        </div>
                        <p class="text-sm text-gray-500 italic text-center">
                            {{ $lang['22'] ?? 'Concrete weight varies by mix, but averages around' }} 2,130 kg/m³ {{ $lang['23'] ?? 'or' }} 133 lbs/ft³.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-8">
                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
        </div>
                            <hr>
        @isset($detail)
             <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-5">
                        <!-- Volume Results -->
                        <div class="bg-white/50 p-6 rounded-xl border border-blue-50">
                            <h3 class="font-bold text-blue-700 mb-4 border-b pb-2">{{ $lang['volume'] ?? 'Volume' }}</h3>
                            <table class="w-full text-sm">
                                <tr>
                                    <td class="py-2 text-gray-600"><strong>{{ $lang['18'] ?? 'Cubic Feet' }} :</strong></td>
                                    <td class="py-2 text-right font-semibold">{{ $detail['cubic_feet'] }} ft³</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-600"><strong>{{ $lang['19'] ?? 'Cubic Yards' }} :</strong></td>
                                    <td class="py-2 text-right font-semibold">{{ $detail['cubic_yard'] }} yd³</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-600"><strong>{{ $lang['20'] ?? 'Cubic Meters' }} :</strong></td>
                                    <td class="py-2 text-right font-semibold">{{ $detail['cubic_meter'] }} m³</td>
                                </tr>
                                @if (isset($detail['ft_price']) || isset($detail['yd_price']) || isset($detail['m_price']))
                                    <tr class="text-green-700 font-bold">
                                        <td class="pt-4 border-t">{{ $lang['21'] ?? 'Total Estimated Cost' }} :</td>
                                        <td class="pt-4 text-right border-t">
                                            {{ $currancy }} {{ $detail['ft_price'] ?? $detail['yd_price'] ?? $detail['m_price'] }}
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <!-- Weight & Bags -->
                        <div class="bg-white/50 p-6 rounded-xl border border-blue-50">
                            <h3 class="font-bold text-blue-700 mb-4 border-b pb-2">{{ $lang['24'] ?? 'Estimated Weight & Bags' }}</h3>
                            <table class="w-full text-sm">
                                <tr>
                                    <td class="py-2 text-gray-600">{{ $lang['weight'] ?? 'Total Weight' }} :</td>
                                    <td class="py-2 text-right font-semibold">{{ number_format($detail['lb'], 0) }} lbs / {{ number_format($detail['kg'], 0) }} kg</td>
                                </tr>
                                <tr class="bg-blue-50/30">
                                    <td class="py-2 px-2 text-gray-600 border-t">{{ $lang['25'] ?? 'Bags Required' }} (40 lb) :</td>
                                    <td class="py-2 text-right font-bold text-blue-600 border-t">{{ $detail['lb_40'] }} {{ $lang['26'] ?? 'bags' }}</td>
                                </tr>
                                <tr class="bg-blue-50/30">
                                    <td class="py-2 px-2 text-gray-600">{{ $lang['25'] ?? 'Bags Required' }} (60 lb) :</td>
                                    <td class="py-2 text-right font-bold text-blue-600">{{ $detail['lb_60'] }} {{ $lang['26'] ?? 'bags' }}</td>
                                </tr>
                                <tr class="bg-blue-50/30">
                                    <td class="py-2 px-2 text-gray-600">{{ $lang['25'] ?? 'Bags Required' }} (80 lb) :</td>
                                    <td class="py-2 text-right font-bold text-blue-600">{{ $detail['lb_80'] }} {{ $lang['26'] ?? 'bags' }}</td>
                                </tr>
                                <tr class="bg-green-50/30">
                                    <td class="py-2 px-2 text-gray-600 border-t">{{ $lang['25'] ?? 'Bags Required' }} (40 kg) :</td>
                                    <td class="py-2 text-right font-bold text-green-600 border-t">{{ $detail['kg_40'] }} {{ $lang['26'] ?? 'bags' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
