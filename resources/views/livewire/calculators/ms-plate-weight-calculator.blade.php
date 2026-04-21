<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 lg:col-span-6 md:col-span-6">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <label for="st_type" class="label">{{ $lang['3'] ?? 'Steel Type' }}</label>
                                <div class="w-100 py-2">
                                    <select wire:model.live="st_type" id="st_type" class="input">
                                        @php
                                            $types = [
                                                "7715" => ($lang['1'] ?? 'Carbon steel') . " (7715 kg/m³)",
                                                "7750" => ($lang['2'] ?? 'Mild steel') . " (7750 kg/m³)",
                                                "7820" => ($lang['3'] ?? 'Tool steel') . " (7820 kg/m³)",
                                                "7830" => ($lang['4'] ?? 'Stainless steel 304') . " (7830 kg/m³)",
                                                "7840" => ($lang['5'] ?? 'Stainless steel 316') . " (7840 kg/m³)",
                                                "7850" => ($lang['6'] ?? 'Structural steel') . " (7850 kg/m³)",
                                                "7860" => ($lang['7'] ?? 'Cast steel') . " (7860 kg/m³)",
                                                "7870" => ($lang['8'] ?? 'Iron') . " (7870 kg/m³)",
                                                "8030" => ($lang['9'] ?? 'Manganese steel') . " (8030 kg/m³)",
                                            ];
                                        @endphp
                                        @foreach ($types as $val => $name)
                                            <option value="{{ $val }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12">
                                <label for="st_shape" class="label">{{ $lang['11'] ?? 'Steel Shape' }}</label>
                                <div class="w-100 py-2">
                                    <select wire:model.live="st_shape" id="st_shape" class="input">
                                        @php
                                            $shapes = [
                                                "1" => $lang['12'] ?? 'Rectangular Plate',
                                                "2" => $lang['13'] ?? 'Square Plate',
                                                "3" => $lang['14'] ?? 'Circular Plate',
                                                "4" => $lang['15'] ?? 'Custom Shape (Area)',
                                            ];
                                        @endphp
                                        @foreach ($shapes as $val => $name)
                                            <option value="{{ $val }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if ($st_shape == '1')
                                <div class="col-span-12">
                                    <label for="length" class="label">{{ $lang['16'] ?? 'Length' }} (l):</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length_unit_dropdown')">{{ $length_unit }} ▾</label>
                                        @if ($showDropdown === 'length_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <label for="width" class="label">{{ $lang['17'] ?? 'Width' }} (w):</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_unit_dropdown')">{{ $width_unit }} ▾</label>
                                        @if ($showDropdown === 'width_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($st_shape == '2')
                                <div class="col-span-12">
                                    <label for="side" class="label">{{ $lang['19'] ?? 'Side' }} (s):</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="side" id="side" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('side_unit_dropdown')">{{ $side_unit }} ▾</label>
                                        @if ($showDropdown === 'side_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('side_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($st_shape == '3')
                                <div class="col-span-12">
                                    <label for="diameter" class="label">{{ $lang['20'] ?? 'Diameter' }} (d):</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="diameter" id="diameter" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('diameter_unit_dropdown')">{{ $diameter_unit }} ▾</label>
                                        @if ($showDropdown === 'diameter_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('diameter_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($st_shape == '4')
                                <div class="col-span-12">
                                    <label for="area" class="label">{{ $lang['21'] ?? 'Area' }} (a):</label>
                                    <div class="relative w-full mt-[7px]">
                                        <input type="number" wire:model="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_unit_dropdown')">{{ $area_unit }} ▾</label>
                                        @if ($showDropdown === 'area_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm²","mm²","m²","in²","ft²","yd²"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="col-span-12">
                                <label for="thickness" class="label">{{ $lang['18'] ?? 'Thickness' }} (t):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="thickness" id="thickness" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('thickness_unit_dropdown')">{{ $thickness_unit }} ▾</label>
                                    @if ($showDropdown === 'thickness_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('thickness_unit', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6 md:col-span-6">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <label for="quantity" class="label">{{ $lang['22'] ?? 'Quantity' }}:</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model="quantity" id="quantity" class="input" />
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 mt-6 flex justify-center">
                            @php
                                $img = 'k12.webp';
                                if ($st_shape == '2') $img = 'k22.webp';
                                elseif ($st_shape == '3') $img = 'k32.webp';
                                elseif ($st_shape == '4') $img = 'k42.webp';
                            @endphp
                            <img src="{{ asset('images/' . $img) }}" alt="Shape Image" class="max-width mt-lg-5" width="500px" height="150px">
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="row my-2">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang['21'] ?? 'Area' }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['area'], 2) }} <span class="font-s-14"> (cm<sup>2</sup>)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['23'] ?? 'Volume' }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['volume'], 2) }}<span class="font-s-14"> (cm<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['24'] ?? 'Weight' }} :</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['weight'], 2) }}<span class="font-s-14"> (g)</span></td>
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
