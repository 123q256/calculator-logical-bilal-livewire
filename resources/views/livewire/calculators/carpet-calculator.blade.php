<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 lg:col-span-6 md:col-span-6">
                        <div class="grid grid-cols-1 gap-4 mt-3">
                            <div class="space-y-2">
                                <label for="shape" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Shape' }}</label>
                                <select wire:model.live="shape" id="shape" class="input">
                                    <option value="{{ $lang[2] ?? 'Rectangle' }}">{{ $lang[2] ?? 'Rectangle' }}</option>
                                    <option value="{{ $lang[3] ?? 'Circle' }}">{{ $lang[3] ?? 'Circle' }}</option>
                                    <option value="{{ $lang[4] ?? 'Ellipse' }}">{{ $lang[4] ?? 'Ellipse' }}</option>
                                    <option value="{{ $lang[5] ?? 'Pentagon' }}">{{ $lang[5] ?? 'Pentagon' }}</option>
                                    <option value="{{ $lang[6] ?? 'Hexagon' }}">{{ $lang[6] ?? 'Hexagon' }}</option>
                                    <option value="{{ $lang[7] ?? 'Other' }}">{{ $lang[7] ?? 'Other' }}</option>
                                </select>
                            </div>

                            @php
                                $currentShape = 'Rectangle';
                                if ($shape === ($lang[3] ?? 'Circle')) $currentShape = 'Circle';
                                elseif ($shape === ($lang[4] ?? 'Ellipse')) $currentShape = 'Ellipse';
                                elseif ($shape === ($lang[5] ?? 'Pentagon')) $currentShape = 'Pentagon';
                                elseif ($shape === ($lang[6] ?? 'Hexagon')) $currentShape = 'Hexagon';
                                elseif ($shape === ($lang[7] ?? 'Other')) $currentShape = 'Other';
                            @endphp

                            @if ($currentShape === 'Rectangle')
                                <div class="space-y-2">
                                    <label for="length" class="font-s-14 text-blue">{{ $lang['8'] ?? 'Length' }}</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length_unit_dropdown')">{{ $length_unit }} ▾</label>
                                        @if ($showDropdown === 'length_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="width" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Width' }}</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_unit_dropdown')">{{ $width_unit }} ▾</label>
                                        @if ($showDropdown === 'width_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($currentShape === 'Circle')
                                <div class="space-y-2">
                                    <label for="radius" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Radius' }} (r)</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="radius" id="radius" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('radius_unit_dropdown')">{{ $radius_unit }} ▾</label>
                                        @if ($showDropdown === 'radius_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('radius_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($currentShape === 'Ellipse')
                                <div class="space-y-2">
                                    <label for="axis_a" class="font-s-14 text-blue">{{ $lang['12'] ?? 'Axis A' }} (A)</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="axis_a" id="axis_a" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('axis_a_unit_dropdown')">{{ $axis_a_unit }} ▾</label>
                                        @if ($showDropdown === 'axis_a_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('axis_a_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="axis_b" class="font-s-14 text-blue">{{ $lang['12'] ?? 'Axis B' }} (B)</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="axis_b" id="axis_b" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('axis_b_unit_dropdown')">{{ $axis_b_unit }} ▾</label>
                                        @if ($showDropdown === 'axis_b_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('axis_b_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($currentShape === 'Pentagon')
                                <div class="space-y-2">
                                    <label for="side" class="font-s-14 text-blue">{{ $lang['13'] ?? 'Side length' }}</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="side" id="side" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('side_unit_dropdown')">{{ $side_unit }} ▾</label>
                                        @if ($showDropdown === 'side_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('side_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($currentShape === 'Hexagon')
                                <div class="space-y-2">
                                    <label for="sides" class="font-s-14 text-blue">{{ $lang['13'] ?? 'Side length' }}</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="sides" id="sides" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('sides_unit_dropdown')">{{ $sides_unit }} ▾</label>
                                        @if ($showDropdown === 'sides_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('sides_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($currentShape === 'Other')
                                <div class="space-y-2">
                                    <label for="carpet" class="font-s-14 text-blue">{{ $lang['14'] ?? 'Carpet Area' }}</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="carpet" id="carpet" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('carpet_unit_dropdown')">{{ $carpet_unit }} ▾</label>
                                        @if ($showDropdown === 'carpet_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm²", "dm²", "m²", "in²", "ft²", "yd²"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('carpet_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-2">
                                <label for="price" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Price' }}</label>
                                <div class="relative w-full">
                                    <input type="number" wire:model="price" id="price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('price_unit_dropdown')">{{ $price_unit }} ▾</label>
                                    @if ($showDropdown === 'price_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (["cm²", "dm²", "m²", "in²", "ft²", "yd²"] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('price_unit', '{{ $currancy . ' ' . $u }}')">{{ $currancy . ' ' . $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6 md:col-span-6 flex items-center justify-center p-4">
                        @php
                            $image = 'Rectangle.webp';
                            $alt = 'Rectangle';
                            if ($currentShape === 'Circle') { $image = 'cr_Circle.webp'; $alt = 'Circle'; }
                            elseif ($currentShape === 'Ellipse') { $image = 'ellipse.webp'; $alt = 'Ellipse'; }
                            elseif ($currentShape === 'Pentagon') { $image = 'Pentagon.webp'; $alt = 'Pentagon'; }
                            elseif ($currentShape === 'Hexagon') { $image = 'Hexagon.webp'; $alt = 'Hexagon'; }
                            elseif ($currentShape === 'Other') { $image = ''; $alt = $lang[15] ?? 'Other Shape'; }
                        @endphp
                        @if ($image)
                            <img src="{{ asset('images/' . $image) }}" alt="{{ $alt }}" class="max-w-full h-auto rounded-lg shadow-sm" style="max-height: 200px;">
                        @else
                            <p class="text-gray-500 italic">{{ $alt }}</p>
                        @endif
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
                            <div class="w-full my-2">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td width="70%" class="border-b py-2"><strong>Carpet Area :</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['answer'], 4) }} <span class="font-s-14">m²</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['16'] ?? 'Total Cost' }} :</strong></td>
                                            <td class="border-b py-2">
                                                @php
                                                    $pure_price_unit = str_replace($currancy . ' ', '', $price_unit);
                                                    $cost = $detail['sub_answer'];
                                                    if ($pure_price_unit === "cm²") $cost = $cost * 10000;
                                                    elseif ($pure_price_unit === "dm²") $cost = $cost * 100;
                                                    elseif ($pure_price_unit === "in²") $cost = $cost * 1550.0031;
                                                    elseif ($pure_price_unit === "ft²") $cost = $cost * 10.7639;
                                                    elseif ($pure_price_unit === "yd²") $cost = $cost * 1.19599;
                                                @endphp
                                                {{ $currancy . ' ' . number_format($cost, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-3 pb-1"><strong>{{ $lang[17] ?? 'Area Conversions' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">cm² :</td>
                                            <td class="border-b py-2">{{ number_format($detail['answer'] * 10000, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">dm² :</td>
                                            <td class="border-b py-2">{{ number_format($detail['answer'] * 100, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">in² :</td>
                                            <td class="border-b py-2">{{ number_format($detail['answer'] * 1550.0031, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">ft² :</td>
                                            <td class="border-b py-2">{{ number_format($detail['answer'] * 10.7639, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">yd² :</td>
                                            <td class="border-b py-2">{{ number_format($detail['answer'] * 1.19599, 2) }}</td>
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
