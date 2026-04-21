<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <!-- Shape Selection -->
                <div class="grid grid-cols-1 mt-3 gap-4">
                    <div class="flex items-center mt-3 space-x-4">
                        <span>{{ $lang['fill'] ?? 'Fill' }}</span>
                        <input type="radio" wire:model.live="from" id="rec" value="rec">
                        <label for="rec" class="font-s-14 text-blue">{{ $lang['ract'] ?? 'Rectangular' }}:</label>
                        <input type="radio" wire:model.live="from" id="circle" value="cic">
                        <label for="circle" class="font-s-14 text-blue">{{ $lang['circ'] ?? 'Circular' }}:</label>
                    </div>
                </div>

                <!-- Calculation Mode (Only for Rectangular) -->
                @if ($from === 'rec')
                    <div class="grid grid-cols-1 mt-5 gap-4">
                        <div class="col-span-12">
                            <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['to_cal'] ?? 'To calculate' }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="to_calculate" id="to_calculate" class="input">
                                    <option value="1">{{ $lang['length'] ?? 'Length' }} {{ $lang['area'] ?? 'Area' }} & {{ $lang['volume'] ?? 'Volume' }}</option>
                                    <option value="2">{{ $lang['length'] ?? 'Length' }} & {{ $lang['area'] ?? 'Area' }}</option>
                                    <option value="3">{{ $lang['volume'] ?? 'Volume' }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 mt-3 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <!-- Rectangular Fields -->
                        @if ($from === 'rec')
                            @if ($to_calculate === '1')
                                <!-- Length -->
                                <div class="space-y-2">
                                    <label for="length" class="font-s-14 text-blue">{{ $lang['length'] ?? 'Length' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('l_unit_dropdown')">{{ $l_unit }} ▾</label>
                                        @if ($showDropdown === 'l_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('l_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Width -->
                                <div class="space-y-2">
                                    <label for="width" class="font-s-14 text-blue">{{ $lang['width'] ?? 'Width' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('w_unit_dropdown')">{{ $w_unit }} ▾</label>
                                        @if ($showDropdown === 'w_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('w_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($to_calculate === '2')
                                <!-- Area -->
                                <div class="space-y-2">
                                    <label for="area" class="font-s-14 text-blue">{{ $lang['area'] ?? 'Area' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('a_unit_dropdown')">{{ $a_unit }} ▾</label>
                                        @if ($showDropdown === 'a_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["m²", "yd²", "ft²"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('a_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($to_calculate === '3')
                                <!-- Volume -->
                                <div class="space-y-2">
                                    <label for="volume" class="font-s-14 text-blue">{{ $lang['volume'] ?? 'Volume' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="volume" id="volume" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('v_unit_dropdown')">{{ $v_unit }} ▾</label>
                                        @if ($showDropdown === 'v_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["m²", "yd²", "ft²"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('v_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($to_calculate !== '3')
                                <!-- Depth -->
                                <div class="space-y-2">
                                    <label for="depth" class="font-s-14 text-blue">{{ $lang['depth'] ?? 'Depth' }}:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model="depth" id="depth" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('d_unit_dropdown')">{{ $d_unit }} ▾</label>
                                        @if ($showDropdown === 'd_unit_dropdown')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                                @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('d_unit', '{{ $u }}')">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @else
                            <!-- Circular Fields -->
                            <div class="space-y-2">
                                <label for="diameter" class="font-s-14 text-blue">{{ $lang['dia'] ?? 'Diameter' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" wire:model="diameter" id="diameter" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('dia_unit_dropdown')">{{ $dia_unit }} ▾</label>
                                    @if ($showDropdown === 'dia_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                            @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('dia_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="depth_circ" class="font-s-14 text-blue">{{ $lang['depth'] ?? 'Depth' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" wire:model="depth" id="depth_circ" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('d_unit_circ_dropdown')">{{ $d_unit }} ▾</label>
                                    @if ($showDropdown === 'd_unit_circ_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                            @foreach (["cm", "m", "in", "ft", "yd"] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('d_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Common Fields (Density and Price) -->
                        <div class="space-y-2">
                            <label for="density" class="font-s-14 text-blue">{{ $lang['den'] ?? 'Density' }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="density" id="density" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('dn_unit_dropdown')">{{ $dn_unit }} ▾</label>
                                @if ($showDropdown === 'dn_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["lb/ft³", "lb/yd³", "t/yd³", "kg/m³"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('dn_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="price" class="font-s-14 text-blue">{{ $lang['price'] ?? 'Price' }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="price" id="price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('p_unit_dropdown')">{{ $p_unit }} ▾</label>
                                @if ($showDropdown === 'p_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["kg", "t", "lbs", "g"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('p_unit', '{{ $currancy }} {{ $u }}')">{{ $currancy }} {{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="flex items-center justify-center pl-3">
                        @if ($from === 'rec')
                            <img src="{{ asset('images/react.webp') }}" alt="Rectangular" class="max-w-full h-auto" style="width: 280px;">
                        @else
                            <img src="{{ asset('images/circle.webp') }}" alt="Circular" class="max-w-full h-auto" style="width: 280px;">
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-1">
                                <div class="w-full md:w-[90%] lg:w-[80%] overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td width="50%" class="border-b py-2 font-bold">{{ $lang['vol_n'] ?? 'Volume needed' }} :</td>
                                            <td class="border-b py-2">
                                                {{ number_format($detail['volume'] / 27, 3) }} <span class="font-s-14 text-gray-500">cu³</span> 
                                                ({{ number_format($detail['volume'], 2) }} <span class="font-s-14 text-gray-500">ft³</span>)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 font-bold">{{ $lang['we_n'] ?? 'Weight needed' }} :</td>
                                            <td class="border-b py-2">
                                                {{ number_format($detail['weight'] / 2000, 3) }} <span class="font-s-14 text-gray-500">tons</span> 
                                                ({{ number_format($detail['weight'], 2) }} <span class="font-s-14 text-gray-500">lbs</span>)
                                            </td>
                                        </tr>
                                        @if (isset($detail['price']))
                                            <tr>
                                                <td class="border-b py-2 font-bold text-blue">{{ $lang['cost'] ?? 'Estimated cost' }} :</td>
                                                <td class="border-b py-2 text-blue font-bold">{{ $currancy . number_format($detail['price'], 2) }}</td>
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
