<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 mt-2 gap-4">
                    <p class="mt-2"><strong class="text-blue">{{ $lang['1'] ?? 'Filled cylinder' }}</strong></p>
                </div>
                <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="f_height" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Height' }} :</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="f_height" id="f_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('f_height_units_dropdown')">{{ $f_height_units }} ▾</label>
                            @if ($showDropdown === 'f_height_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft", "km", "mi", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('f_height_units', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'km' ? 'kilometer (km)' : ($u == 'mi' ? 'miles (mi)' : 'yard (yd)')))))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="f_radius" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Radius' }} :</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="f_radius" id="f_radius" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('f_radius_units_dropdown')">{{ $f_radius_units }} ▾</label>
                            @if ($showDropdown === 'f_radius_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft", "km", "mi", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('f_radius_units', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'km' ? 'kilometer (km)' : ($u == 'mi' ? 'miles (mi)' : 'yard (yd)')))))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-4 gap-4 border-t pt-4">
                    <p class="mt-2"><strong class="text-blue">{{ $lang['4'] ?? 'Hollow cylinder' }}</strong></p>
                </div>
                <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="s_height" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Height' }} :</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="s_height" id="s_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('s_height_units_dropdown')">{{ $s_height_units }} ▾</label>
                            @if ($showDropdown === 's_height_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft", "km", "mi", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('s_height_units', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'km' ? 'kilometer (km)' : ($u == 'mi' ? 'miles (mi)' : 'yard (yd)')))))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="external" class="font-s-14 text-blue">{{ $lang['5'] ?? 'External radius (R)' }} :</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="external" id="external" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('external_units_dropdown')">{{ $external_units }} ▾</label>
                            @if ($showDropdown === 'external_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft", "km", "mi", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('external_units', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'km' ? 'kilometer (km)' : ($u == 'mi' ? 'miles (mi)' : 'yard (yd)')))))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="internal" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Internal radius (r)' }} :</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="internal" id="internal" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('internal_units_dropdown')">{{ $internal_units }} ▾</label>
                            @if ($showDropdown === 'internal_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "ft", "km", "mi", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('internal_units', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'km' ? 'kilometer (km)' : ($u == 'mi' ? 'miles (mi)' : 'yard (yd)')))))) }}
                                        </p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="col-lg-6 font-s-18">
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                        <table class="w-full">
                                            <tr>
                                                <td width="70%" class="border-b py-2"><strong>{{ $lang['7'] ?? 'Filled cylinder volume' }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['vol1'], 2) }} cm³</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="mt-3 mb-2 font-s-18">{{ $lang['8'] ?? 'In other units' }}</p>
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                        <table class="w-full">
                                            <tr>
                                                <td width="70%" class="border-b py-2">mm³ :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol1'] * 1000, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">dm³ :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol1'] / 1000, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">m³ :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol1'] / 1000000, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">cu in :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol1'] * 0.0610237, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">cu ft :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol1'] * 0.0000353147, 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                        <table class="w-full">
                                            <tr>
                                                <td width="70%" class="border-b pt-4 pb-2"><strong>{{ $lang['9'] ?? 'Hollow cylinder volume' }} :</strong></td>
                                                <td class="border-b pt-4 pb-2">{{ number_format($detail['vol2'], 2) }} cm³</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="mt-3 mb-2 font-s-18">{{ $lang['10'] ?? 'In other units' }}</p>
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                        <table class="w-full">
                                            <tr>
                                                <td width="70%" class="border-b py-2">mm³ :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol2'] * 1000, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">dm³ :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol2'] / 1000, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">m³ :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol2'] / 1000000, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">cu in :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol2'] * 0.0610237, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">cu ft :</td>
                                                <td class="border-b py-2">{{ number_format($detail['vol2'] * 0.0000353147, 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                        <p class="font-s-20 mt-2 text-blue"><strong>Solution</strong></p>
                                        <p class="mt-2"><strong>{{ $lang['12'] ?? 'Filled Cylinder' }}</strong></p>
                                        <p class="mt-2 italic">V = πr²h</p>
                                        <p class="mt-2">V = 3.14159 x {{ $f_radius }}² x {{ $f_height }}</p>
                                        <p class="mt-2">V = {{ number_format($detail['vol1'], 2) }} cm³</p>
                                        
                                        <p class="mt-4 border-t pt-4"><strong>{{ $lang['13'] ?? 'Hollow Cylinder' }}</strong></p>
                                        <p class="mt-2 italic">V = (πh(R² - r²)) / 4</p>
                                        <p class="mt-2">V = (3.14159 x {{ $s_height }} x ({{ $external }}² - {{ $internal }}²)) / 4</p>
                                        <p class="mt-2">V = {{ number_format($detail['vol2'], 2) }} cm³</p>
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
