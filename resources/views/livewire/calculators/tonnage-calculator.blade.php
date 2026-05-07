<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Material Select --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="material" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="material" id="material" class="input">
                                <option value="2243">{{ $lang['2'] }}</option>
                                <option value="1466">{{ $lang['3'] }}</option>
                                <option value="1710">{{ $lang['4'] }}</option>
                                <option value="1625">{{ $lang['5'] }}</option>
                                <option value="721">{{ $lang['6'] }}</option>
                                <option value="1554">{{ $lang['7'] }}</option>
                                <option value="1872">{{ $lang['8'] }}</option>
                                <option value="1320">{{ $lang['9'] }}</option>
                                <option value="1602">{{ $lang['10'] }}</option>
                                <option value="1476">{{ $lang['11'] }}</option>
                                <option value="1720">{{ $lang['12'] }}</option>
                                <option value="1710">{{ $lang['13'] }}</option>
                                <option value="1642">{{ $lang['14'] }}</option>
                                <option value="2643">{{ $lang['15'] }}</option>
                                <option value="1482">{{ $lang['16'] }}</option>
                                <option value="1398">{{ $lang['17'] }}</option>
                                <option value="1788">{{ $lang['18'] }}</option>
                                <option value="1426">{{ $lang['19'] }}</option>
                                <option value="1602">{{ $lang['20'] }}</option>
                                <option value="1762">{{ $lang['21'] }}</option>
                                <option value="1682">{{ $lang['22'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Unit Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="unit_weight" class="label">{{ $lang['23'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="unit_weight" id="unit_weight" class="input" />
                            <span class="text-blue input_unit">kg/m³</span>
                        </div>
                    </div>

                    <p class="col-span-12"><strong>{{ $lang['24'] }}</strong></p>

                    {{-- Length --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="length" class="label">{{ $lang['25'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.length_units) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Width --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="width" class="label">{{ $lang['26'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.width_units) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Depth --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="depth" class="label">{{ $lang['27'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="depth" id="depth" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.depth_units) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('depth_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <p class="col-span-12"><strong>{{ $lang['28'] }}</strong></p>

                    {{-- Price Per --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="price_per" class="label">{{ $lang['29'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="price_per" id="price_per" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.price_per_units) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["kg","t","lb","st"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_per_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Wastage --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wastage" class="label">{{ $lang['30'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="wastage" id="wastage" class="input" />
                            <span class="text-blue input_unit">%</span>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang['31'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['tonnage'] }} t</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['32'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['area'] }} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['33'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['volume'] }} m³</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['34'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['weight_needed'] }} t</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['35'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy . $detail['total_cost'] }}</td>
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
