<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Rock Type --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="rock_type" class="label">{{ $lang['rock_type'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="rock_type" id="rock_type" class="input">
                                <option value="1425">{{ $lang['s_r_r'] }}</option>
                                <option value="1483">{{ $lang['b_g'] }}</option>
                                <option value="1545">{{ $lang['c_p_g'] }}</option>
                                <option value="1314">{{ $lang['c_r_r'] }}</option>
                                <option value="1670">{{ $lang['c_b'] }}</option>
                                <option value="2098">{{ $lang['c_g_g'] }}</option>
                                <option value="721">{{ $lang['c_a'] }}</option>
                                <option value="1320">{{ $lang['c_g'] }}</option>
                                <option value="1602">{{ $lang['c_s'] }}</option>
                                <option value="1522">{{ $lang['cr_r_r'] }}</option>
                                <option value="1865">{{ $lang['d_g'] }}</option>
                                <option value="2650">{{ $lang['grnt'] }}</option>
                                <option value="1506">{{ $lang['i_c_g'] }}</option>
                                <option value="1788">{{ $lang['p_g'] }}</option>
                                <option value="1490">{{ $lang['p_r_r'] }}</option>
                                <option value="2700">{{ $lang['qrtz'] }}</option>
                                <option value="1346">{{ $lang['r_g'] }}</option>
                                <option value="1505">{{ $lang['s_g_g'] }}</option>
                                <option value="1430">{{ $lang['w_m_c'] }}</option>
                                <option value="custom">{{ $lang['custom'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Density --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="density" class="label">{{ $lang['density'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="density" id="density" step="any" class="input" placeholder="00" {{ $rock_type !== 'custom' ? 'disabled' : '' }} />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['density_unit'] = !dropdowns['density_unit']">
                                {{ $density_unit }} ▾
                            </label>
                            <div x-show="dropdowns['density_unit']" @click.away="dropdowns['density_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                @foreach (['kg/m³', 't/m³', 'g/cm³', 'lb/cu in', 'lb/cu ft', 'lb/cu yd'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('density_unit', '{{ $unit }}'); dropdowns['density_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Length --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="length" class="label">{{ $lang['length'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="length" id="length" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['length_unit'] = !dropdowns['length_unit']">
                                {{ $length_unit }} ▾
                            </label>
                            <div x-show="dropdowns['length_unit']" @click.away="dropdowns['length_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                @foreach (['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('length_unit', '{{ $unit }}'); dropdowns['length_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Width --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="width" class="label">{{ $lang['width'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="width" id="width" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['width_unit'] = !dropdowns['width_unit']">
                                {{ $width_unit }} ▾
                            </label>
                            <div x-show="dropdowns['width_unit']" @click.away="dropdowns['width_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                @foreach (['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('width_unit', '{{ $unit }}'); dropdowns['width_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Depth --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="depth" class="label">{{ $lang['depth'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="depth" id="depth" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['depth_unit'] = !dropdowns['depth_unit']">
                                {{ $depth_unit }} ▾
                            </label>
                            <div x-show="dropdowns['depth_unit']" @click.away="dropdowns['depth_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                @foreach (['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('depth_unit', '{{ $unit }}'); dropdowns['depth_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Wastage --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wastage" class="label">{{ $lang['wastage'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live.debounce.500ms="wastage" id="wastage" class="input" placeholder="00" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="col-span-12">
                        <label for="price" class="label">{{ $lang['mass_price'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="price" id="price" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['price_unit'] = !dropdowns['price_unit']">
                                {{ $price_unit }} ▾
                            </label>
                            <div x-show="dropdowns['price_unit']" @click.away="dropdowns['price_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                @foreach (['/kg', '/t', '/lb', '/stone', '/us_ton', '/long_ton'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('price_unit', '{{ $currancy . $unit }}'); dropdowns['price_unit'] = false">{{ $currancy . $unit }}</p>
                                @endforeach
                            </div>
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
            <hr class="my-8">
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full mt-4">
                                {{-- Volume Section --}}
                                <div class="grid grid-cols-12 mt-3 gap-4">
                                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                        <div class="bg-[#f3f4f6] p-3 rounded-lg shadow-sm border border-gray-100">
                                            <p class="text-[20px]"><strong>{{ $lang['volume'] }}</strong></p>
                                            <p class="text-25px mt-1">
                                                <strong class=" text-[24px]">{{ $detail['volume'] }}</strong>
                                                <span class="text-[23px]">m³</span>
                                            </p>
                                        </div>
                                    </div>
                                    @foreach($detail['volume_units'] as $key => $value)
                                        @php
                                            $parts = explode('@@@', $value);
                                            $isLast = $key == count($detail['volume_units']) - 1;
                                        @endphp
                                        <div class="col-span-6 md:col-span-2 lg:col-span-2 {{ !$isLast ? 'border-r border-gray-200' : '' }} px-2">
                                            <p class="font-bold">{{ $parts[0] }}</p>
                                            <p class="pb-1 text-sm"><strong>{{ $parts[1] }}</strong></p>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Weight Section --}}
                                <div class="grid grid-cols-12 mt-6 gap-4">
                                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                        <div class="bg-[#f3f4f6] p-3 rounded-lg shadow-sm border border-gray-100">
                                            <p class="text-[20px]"><strong>{{ $lang['weight'] }}</strong></p>
                                            <p class="mt-1">
                                                <strong class=" text-[24px]">{{ $detail['weight'] }}</strong>
                                                <span class="text-[18px]">ton</span>
                                            </p>
                                        </div>
                                    </div>
                                    @foreach($detail['weight_units'] as $key => $value)
                                        @php
                                            $parts = explode('@@@', $value);
                                            $isLast = $key == count($detail['weight_units']) - 1;
                                        @endphp
                                        <div class="col-span-6 md:col-span-2 lg:col-span-2 {{ !$isLast ? 'border-r border-gray-200' : '' }} px-2">
                                            <p class="font-bold 0">{{ $parts[0] }}</p>
                                            <p class="pb-1 text-sm"><strong>{{ $parts[1] }}</strong></p>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Area Section --}}
                                <div class="grid grid-cols-12 mt-6 gap-4">
                                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                        <div class="bg-[#f3f4f6] p-3 rounded-lg shadow-sm border border-gray-100">
                                            <p class="text-[20px]"><strong>{{ $lang['area'] }}</strong></p>
                                            <p class="mt-1">
                                                <strong class=" text-[24px]">{{ $detail['area'] }}</strong>
                                                <span class="text-[18px]">m²</span>
                                            </p>
                                        </div>
                                    </div>
                                    @foreach($detail['area_units'] as $key => $value)
                                        @php
                                            $parts = explode('@@@', $value);
                                            $isLast = $key == count($detail['area_units']) - 1;
                                        @endphp
                                        <div class="col-span-6 md:col-span-2 lg:col-span-2 {{ !$isLast ? 'border-r border-gray-200' : '' }} px-2">
                                            <p class="font-bold 0">{{ $parts[0] }}</p>
                                            <p class="pb-1 text-sm "><strong>{{ $parts[1] }}</strong></p>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Price & Cost Section --}}
                                @if(!empty($detail['price_v']))
                                    <div class="grid grid-cols-12 mt-6 gap-4 items-center">
                                        <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                            <div class="bg-gray-100 p-3 rounded-lg shadow-sm border">
                                                <p class="text-[20px]"><strong>{{ $lang['v_price'] }}</strong></p>
                                                <p class="mt-1">
                                                    <strong class=" text-[24px]">{{ $detail['price_v'] }}</strong>
                                                    <span class="font-s-20">{{ $currancy }}/m³</span>
                                                </p>
                                            </div>
                                        </div>
                                        @foreach($detail['price_v_units'] as $key => $value)
                                            @php
                                                $parts = explode('@@@', $value);
                                                $isLast = $key == count($detail['price_v_units']) - 1;
                                            @endphp
                                            <div class="col-span-6 md:col-span-2 lg:col-span-2 {{ !$isLast ? 'border-r border-gray-200' : '' }} px-2">
                                                <p class="font-bold 0">{{ $parts[0] }}</p>
                                                <p class="pb-1 text-sm "><strong>{{ $parts[1] }}</strong></p>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="w-full text-center mt-10">
                                        <p class="text-[24px]"><strong>{{ $lang['cost'] }}</strong></p>
                                        <div class="flex justify-center mt-2">
                                            <p class="text-[30px] bg-[#2845F5] text-white px-8 py-3 rounded-lg">
                                                <strong class="text-white"><span>{{ $currancy }}</span> {{ $detail['total_cost'] }}</strong>
                                            </p>
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
