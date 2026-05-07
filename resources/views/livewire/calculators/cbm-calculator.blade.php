<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 text-center">
                        <span class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['1'] }}:</span>
                        <input type="radio" wire:model.live="calc_type" id="basic" value="basic">
                        <label for="basic" class="font-s-14 text-blue pe-lg-3 pe-2 cursor-pointer">{{ $lang['2'] }}:</label>
                        <input type="radio" wire:model.live="calc_type" id="advance" value="advance">
                        <label for="advance" class="font-s-14 text-blue cursor-pointer">{{ $lang['3'] }}:</label>
                    </div>

                    @php
                        $units = ["cm", "m", "in", "ft", "yd", "mi", "km", "mm"];
                    @endphp

                    {{-- Width --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="width" class="font-s-14 text-blue one_text">{{ $lang['4'] }}:</label>
                        <div class="grid grid-cols-12 mt-3 gap-2">
                            <div class="col-span-8">
                                <input type="number" step="any" wire:model.live="width" id="width" class="input" />
                            </div>
                            <div class="col-span-4">
                                <select wire:model.live="width_unit" class="input">
                                    @foreach($units as $u)
                                        <option value="{{ $u }}">{{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Length --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="length" class="font-s-14 text-blue one_text">{{ $lang['5'] }}:</label>
                        <div class="grid grid-cols-12 mt-3 gap-2">
                            <div class="col-span-8">
                                <input type="number" step="any" wire:model.live="length" id="length" class="input" />
                            </div>
                            <div class="col-span-4">
                                <select wire:model.live="length_unit" class="input">
                                    @foreach($units as $u)
                                        <option value="{{ $u }}">{{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Height --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="heigth" class="font-s-14 text-blue one_text">{{ $lang['6'] }}:</label>
                        <div class="grid grid-cols-12 mt-3 gap-2">
                            <div class="col-span-8">
                                <input type="number" step="any" wire:model.live="heigth" id="heigth" class="input" />
                            </div>
                            <div class="col-span-4">
                                <select wire:model.live="heigth_unit" class="input">
                                    @foreach($units as $u)
                                        <option value="{{ $u }}">{{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Quantity --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="quantity" class="font-s-14 text-blue one_text">{{ $lang['8'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="quantity" id="quantity" class="input" />
                        </div>
                    </div>

                    {{-- Advance: Weight --}}
                    @if($calc_type === 'advance')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="weight" class="font-s-14 text-blue one_text">{{ $lang['7'] }}:</label>
                            <div class="grid grid-cols-12 mt-3 gap-2">
                                <div class="col-span-8">
                                    <input type="number" step="any" wire:model.live="weight" id="weight" class="input" />
                                </div>
                                <div class="col-span-4">
                                    <select wire:model.live="weight_unit" class="input">
                                        @foreach(["ug","mg","g","dag","lb","kg","t","gr","dr","oz","stone","us-ton","long-ton","earths","me","u","oz-t"] as $wu)
                                            <option value="{{ $wu }}">{{ $wu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif
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
                                @if ($calc_type == 'basic')
                                    <div class="text-center">
                                        <p class="text-[20px]"><strong>{{ $lang['9'] }}</strong></p>
                                        <div class="flex justify-center">
                                            <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3"><strong class="text-white">{{ $detail['cbm'] }} <span class="text-[20px]"> m<sup>3</sup></span></strong></p>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full lg:w-[80%] text-[18px] overflow-auto">
                                        <table class="w-full">
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                                <td class="border-b py-2">{{ $detail['cbm'] }} <span class="font-s-14"> m<sup>3</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['10'] }} :</strong></td>
                                                <td class="border-b py-2">{{ $detail['total_cbm'] }} <span class="font-s-14"> m<sup>3</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                                <td class="border-b py-2">{{ $detail['total_weight'] }}<span class="font-s-14"> Kg</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[12] }} :</strong></td>
                                                <td class="border-b py-2">{{ $detail['total_volumetric_weight'] }}<span class="font-s-14"> Kg</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">20 feet Standard Dry Container :</td>
                                                <td class="border-b py-2">{{ $detail['size_20'] }} <span class="font-s-14">Number of Cartons</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">40 feet Standard Dry Container :</td>
                                                <td class="border-b py-2">{{ $detail['size_40'] }} <span class="font-s-14">Number of Cartons</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">40 feet High Cube Dry Container :</td>
                                                <td class="border-b py-2">{{ $detail['size_40_hq'] }} <span class="font-s-14">Number of Cartons</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">45 feet High Cube Dry Container :</td>
                                                <td class="border-b py-2">{{ $detail['size_45_hq'] }} <span class="font-s-14">Number of Cartons</span></td>
                                            </tr>
                                        </table>
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
