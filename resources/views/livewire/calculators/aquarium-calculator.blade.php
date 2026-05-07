<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class="col-12">
                            <label for="shape" class="label">{{ $lang['1'] }}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="shape" id="shape" class="input">
                                    <option value="1">{!! $lang['2'] !!}</option>
                                    <option value="2">{!! $lang['3'] !!}</option>
                                    <option value="3">{!! $lang['4'] !!}</option>
                                    <option value="4">{!! $lang['5'] !!}</option>
                                    <option value="5">{!! $lang['6'] !!}</option>
                                    <option value="6">{!! $lang['7'] !!}</option>
                                    <option value="7">{!! $lang['8'] !!}</option>
                                    <option value="8">{!! $lang['9'] !!}</option>
                                    <option value="9">{!! $lang['10'] !!}</option>
                                    <option value="10">{!! $lang['11'] !!}</option>
                                    <option value="11">{!! $lang['12'] !!}</option>
                                    <option value="12">{!! $lang['13'] !!}</option>
                                    <option value="13">{!! $lang['34'] !!}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Dynamic Inputs based on Shape --}}
                        @php
                            $show = [
                                '1' => ['length', 'width', 'height', 'fill_depth'],
                                '2' => ['length', 'fill_depth'],
                                '3' => ['length', 'width', 'height', 'fill_depth', 'front_pane'],
                                '4' => ['length', 'width', 'height', 'fill_depth', 'front_pane', 'end_pane'],
                                '5' => ['length', 'width', 'height', 'fill_depth', 'front_pane', 'end_pane'],
                                '6' => ['height', 'radius', 'fill_depth'],
                                '7' => ['height', 'radius', 'fill_depth'],
                                '8' => ['height', 'radius', 'fill_depth'],
                                '9' => ['height', 'radius_one', 'radius_two', 'fill_depth'],
                                '10' => ['height', 'long_side', 'short_side', 'fill_depth'],
                                '11' => ['height', 'len_one', 'len_two', 'wid_one', 'wid_two', 'fill_depth'],
                                '12' => ['height', 'len_one', 'len_two', 'fill_depth'],
                                '13' => ['length', 'width', 'height', 'full_width'],
                            ];
                            $curr = $show[$shape] ?? [];
                            $units = ["cm", "m", "in", "ft", "yd"];
                        @endphp

                        @foreach([
                            'length' => $lang['14'], 'width' => $lang['15'], 'height' => $lang['16'],
                            'front_pane' => $lang['17'], 'end_pane' => $lang['18'], 'radius' => $lang['19'],
                            'radius_one' => $lang['20'], 'radius_two' => $lang['21'], 'long_side' => $lang['22'],
                            'short_side' => $lang['23'], 'len_one' => $lang['24'], 'len_two' => $lang['25'],
                            'wid_one' => $lang['26'], 'wid_two' => $lang['27'], 'fill_depth' => $lang['28'].' ('.$lang['29'].')',
                            'full_width' => $lang['36']
                        ] as $field => $label)
                            @if(in_array($field, $curr))
                                <div class="col-12 mt-2">
                                    <label for="{{ $field }}" class="label">{{ $label }}:</label>
                                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                        <input type="number" step="any" wire:model.live="{{ $field }}" id="{{ $field }}" class="input" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="('{{ ${$field.'_unit'} }}') + ' ▾'"></label>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                            @foreach ($units as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('{{ $field }}_unit', '{{ $unit }}')" @click="open = false">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6 flex items-center justify-center">
                        @php
                            $images = [
                                '1' => 'pict12.png', '2' => 'pict11.png', '3' => 'pict10.png',
                                '4' => 'pict9.png', '5' => 'pict8.png', '6' => 'pict7.png',
                                '7' => 'pict6.png', '8' => 'pict5.png', '9' => 'pict4.png',
                                '10' => 'pict3.png', '11' => 'pict2.png', '12' => 'pict1.png',
                                '13' => 'pi1.webp'
                            ];
                            $img = $images[$shape] ?? 'pict12.png';
                        @endphp
                        <img src="{{ asset('images/'.$img) }}" alt="ShapeImage" class="max-width my-lg-2" width="320" height="250">
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
                                <div class="w-full lg:w-[80%] lg:text-[18px] md:text-[18px] text-[16px] overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td width="50%" class="border-b py-2"><strong>{{ $lang['30'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['volume'] * 0.000264172, 2) }} (U.S Gallons)</td>
                                        </tr>
                                    </table>
                                    <p class="mt-2">{{ $lang['31'] }}</p>
                                    <table class="w-full">
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{ $lang['32'] }} :</td>
                                            <td class="border-b py-2">{{ round($detail['volume'], 3) }} <span class="black-text font_unit2">(cm)<sup>3</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['32'] }} :</td>
                                            <td class="border-b py-2">{{ round($detail['volume'] * 0.001, 3) }} <span class="black-text font_unit2">(dm)<sup>3</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['32'] }} :</td>
                                            <td class="border-b py-2">{{ round($detail['volume'] * 0.000001, 3) }} <span class="black-text font_unit2">(m)<sup>3</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['32'] }} :</td>
                                            <td class="border-b py-2">{{ round($detail['volume'] * 0.0610237, 3) }} <span class="black-text font_unit2">(cu in)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['32'] }} :</td>
                                            <td class="border-b py-2">{{ round($detail['volume'] * 0.000035315, 3) }} <span class="black-text font_unit2">(cu ft)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['32'] }} :</td>
                                            <td class="border-b py-2">{{ round($detail['volume'] * 0.000001308, 3) }} <span class="black-text font_unit2">(cu yd)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{ $lang['32'] }} :</td>
                                            <td class="py-2">{{ round($detail['volume'] * 0.001, 3) }} <span class="black-text font_unit2">(liters)</span></td>
                                        </tr>
                                    </table>
                                    @if(!empty($detail['filled_volume']))
                                        <hr class="my-8">
                                        <table class="w-full">
                                            <tr>
                                                <td width="50%" class="border-b py-2"><strong>{{ $lang['33'] }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['filled_volume'] * 0.000264172, 2) }} (U.S Gallons)</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2">{{ $lang['31'] }}</p>
                                        <table class="w-full">
                                            <tr>
                                                <td width="50%" class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['filled_volume'], 3) }} <span class="black-text font_unit2">(cm)<sup>3</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['filled_volume'] * 0.001, 3) }} <span class="black-text font_unit2">(dm)<sup>3</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['filled_volume'] * 0.000001, 3) }} <span class="black-text font_unit2">(m)<sup>3</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['filled_volume'] * 0.0610237, 3) }} <span class="black-text font_unit2">(cu in)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['filled_volume'] * 0.000035315, 3) }} <span class="black-text font_unit2">(cu ft)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['filled_volume'] * 0.000001308, 3) }} <span class="black-text font_unit2">(cu yd)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['filled_volume'] * 0.001, 3) }} <span class="black-text font_unit2">(liters)</span></td>
                                            </tr>
                                        </table>
                                    @endif
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
