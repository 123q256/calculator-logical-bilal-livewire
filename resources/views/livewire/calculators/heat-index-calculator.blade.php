<div>
    <style>
        .rc { background-color: #fd0100; }
        .result .tablesx tr td { border: 1px solid #ddd; padding: 5px; }
        .nela { background-color: #e0e9f9; }
        .kc { background-color: #fadf52; }
        .oc { background-color: #eb8d0f; }
        .kkc { background-color: #fdfc86; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Find Selector --}}
                    <div class="space-y-2">
                        <label for="find" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Find' }} </label>
                        <select wire:model.live="find" id="find" class="input">
                            <option value="1">{{ ($lang['2'] ?? 'Heat Index') . ' & ' . ($lang['3'] ?? 'RH') }}</option>
                            <option value="2">{{ ($lang['4'] ?? 'Temperature') . ' & ' . ($lang['5'] ?? 'Dew Point') }}</option>
                            <option value="3">{{ ($lang['6'] ?? 'Relative Humidity') . ' & ' . ($lang['5'] ?? 'Dew Point') }}</option>
                        </select>
                    </div>

                    {{-- Temperature Input --}}
                    @if ($find == '1' || $find == '2')
                        <div class="space-y-2 at">
                            <label for="temp" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Temperature' }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="temp" id="temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('temp_unit')">{{ $temp_unit }} ▾</label>
                                @if ($openDropdown === 'temp_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['°C', '°F', '°K'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('temp_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Humidity Input --}}
                    @if ($find == '1' || $find == '3')
                        <div class="space-y-2 rh">
                            <label for="hum" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Relative Humidity' }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="hum" id="hum" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('hum_unit')">{{ $hum_unit }} ▾</label>
                                @if ($openDropdown === 'hum_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['%', '‰', '‱'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('hum_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Dew Point Input --}}
                    @if ($find == '2' || $find == '3')
                        <div class="space-y-2 dp">
                            <label for="dew_point" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Dew Point' }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="dew_point" id="dew_point" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('dew_point_unit')">{{ $dew_point_unit }} ▾</label>
                                @if ($openDropdown === 'dew_point_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['°C', '°F', '°K'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dew_point_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
        </div>
    </form>

    <hr>

    @isset($detail)
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 mt-5">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex flex-col items-center justify-center">
                    <div class="w-full lg:p-3 md:p-3 radius-10 mt-3">
                        @php
                            $tmv = $detail['tmv'];
                            $temp_unit_val = $detail['temp_unit'];
                            if ($temp_unit_val == '1') {
                                $ans = $tmv * 1.8 + 32;
                            } elseif ($temp_unit_val == '2') {
                                $ans = $tmv;
                            } else {
                                $ans = (($tmv - 273.15) * 9) / 5 + 32;
                            }
                            $hi_val = $detail['hi'];
                        @endphp

                        <div class="w-full mt-2">
                            <table class="lg:w-[50%] md:w-[50%] w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] ?? 'Heat Index' }} </strong></td>
                                    <td class="py-2 border-b"> {{ round(($hi_val - 32) * (5 / 9), 3) }} (<sup>o</sup>C)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] ?? 'Heat Index' }} </strong></td>
                                    <td class="py-2 border-b"> {{ round($hi_val, 3) }} (<sup>o</sup>F)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] ?? 'Heat Index' }} </strong></td>
                                    <td class="py-2 border-b"> {{ round(($hi_val - 32) * (5 / 9) + 273.15, 3) }} (<sup>o</sup>K)</td>
                                </tr>
                            </table>
                        </div>

                        <div class="lg:w-[50%] md:w-[50%] w-full mt-2 my-3">
                            <table class="w-full font-s-18">
                                @if (isset($detail['dp']) && $detail['dp'] != "")
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[5] ?? 'Dew Point' }}</strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['dp'], 3) }} <sup>o</sup> (C)</td>
                                    </tr>
                                @endif
                                @if (isset($detail['hum']) && $detail['hum'] != "")
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[3] ?? 'Humidity' }}</strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['hum'], 3) }} (%)</td>
                                    </tr>
                                @endif
                                @if (isset($detail['temp']) && $detail['temp'] != "")
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[8] ?? 'Temperature' }}</strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['temp'] * (9 / 5) + 32, 3) }} (<sup>o</sup>F)/ {{round($detail['temp'], 3)}} (<sup>o</sup>C) </td>
                                    </tr>
                                @endif
                                @if (isset($detail['ans']) && $detail['ans'] != "")
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>α(T,RH) </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['ans'], 3)}} </td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        {{-- Heat Index Chart Logic --}}
                        @php
                            $highlight_styles = array_fill(1, 208, '');
                            $humm = $detail['humm'] ?? 0;
                            $hi_f = $detail['hi'] ?? 0; // The calculated Heat Index in Fahrenheit
                            // Calculate Ambient Temperature in Fahrenheit (used as 'ans' in original code's highlight logic)
                            $tmv = $detail['tmv'] ?? 0;
                            $temp_unit_val = $detail['temp_unit'] ?? '2';
                            if ($temp_unit_val == '1') {
                                $ans_f = $tmv * 1.8 + 32;
                            } elseif ($temp_unit_val == '2') {
                                $ans_f = $tmv;
                            } else {
                                $ans_f = (($tmv - 273.15) * 9) / 5 + 32;
                            }

                            // Determine row index (0-15) based on calculated Heat Index value (Fahrenheit)
                            $row_idx = 0;
                            if ($hi_f >= 109.5) $row_idx = 15;
                            elseif ($hi_f < 81) $row_idx = 0;
                            else $row_idx = floor(($hi_f - 81) / 2) + 1;

                            // Determine column index (0-12) based on Relative Humidity
                            $col_idx = 0;
                            if ($humm >= 98) $col_idx = 12;
                            elseif ($humm < 43) $col_idx = 0;
                            else $col_idx = floor(($humm - 43) / 5) + 1;

                            $target_index = ($col_idx * 16) + $row_idx + 1;
                            if ($target_index >= 1 && $target_index <= 208) {
                                $highlight_styles[$target_index] = 'border: 3px dashed #000; font-weight: 600;';
                            }
                        @endphp

                        <div class="w-full font-s-20 overflow-auto mt-5">
                            <p class="text-center text-xl font-bold mb-4 text-blue-600">Heat Index Chart (Apparent Temperature)</p>
                            <table class="table tablesx w-full text-center">
                                <thead>
                                    <tr>
                                        <td rowspan="2" class="nela font-bold">Temperature (°F)</td>
                                        <td colspan="13" class="nela font-bold">Relative Humidity (%)</td>
                                    </tr>
                                    <tr>
                                        @foreach ([40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100] as $h)
                                            <td class="nela">{{ $h }}</td>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $chart_data = [
                                            110 => [136, 143, 152, 161, 171, 182, 194, 206, 219, 233, 247, 262, 278],
                                            108 => [130, 137, 144, 153, 162, 172, 182, 193, 205, 218, 231, 245, 260],
                                            106 => [124, 130, 137, 145, 153, 162, 172, 182, 193, 204, 216, 229, 243],
                                            104 => [119, 124, 131, 137, 145, 153, 161, 171, 181, 191, 202, 214, 226],
                                            102 => [114, 119, 124, 130, 137, 144, 152, 160, 169, 179, 189, 199, 210],
                                            100 => [109, 114, 118, 124, 129, 136, 143, 150, 158, 167, 176, 185, 195],
                                            98  => [105, 109, 113, 117, 123, 128, 134, 141, 148, 156, 164, 172, 181],
                                            96  => [101, 104, 108, 112, 116, 121, 126, 132, 138, 145, 152, 160, 168],
                                            94  => [97, 100, 102, 106, 110, 114, 119, 124, 129, 135, 141, 148, 155],
                                            92  => [94, 96, 99, 101, 105, 108, 112, 116, 121, 126, 131, 137, 143],
                                            90  => [91, 93, 95, 97, 100, 103, 106, 109, 113, 117, 122, 127, 132],
                                            88  => [88, 89, 91, 93, 95, 98, 100, 103, 106, 110, 113, 117, 121],
                                            86  => [85, 87, 88, 89, 91, 93, 95, 97, 100, 102, 105, 108, 112],
                                            84  => [83, 84, 85, 86, 88, 89, 90, 92, 94, 96, 98, 100, 103],
                                            82  => [81, 82, 83, 84, 84, 85, 86, 88, 89, 90, 91, 93, 95],
                                            80  => [80, 80, 81, 81, 82, 82, 83, 84, 84, 85, 86, 86, 87],
                                        ];
                                    @endphp

                                    @foreach ($chart_data as $temp_f => $values)
                                        <tr>
                                            <td class="nela font-bold">{{ $temp_f }}</td>
                                            @foreach ($values as $c_idx => $hi_result)
                                                @php
                                                    $color_class = 'kkc';
                                                    if ($hi_result >= 130) $color_class = 'rc text-white';
                                                    elseif ($hi_result >= 105) $color_class = 'oc text-white';
                                                    elseif ($hi_result >= 91) $color_class = 'kc';
                                                    
                                                    // Map cell index to match the highlight array (1 to 208)
                                                    $current_cell_idx = ($c_idx * 16) + (($temp_f - 80) / 2) + 1;
                                                    $style = $highlight_styles[$current_cell_idx] ?? '';
                                                @endphp
                                                <td class="{{ $color_class }}" style="{{ $style }}">{{ $hi_result }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="nela font-bold" colspan="2">{{ $lang['9'] ?? 'Classification' }}:</td>
                                        <td class="kkc font-size-14" colspan="3">{{ $lang['10'] ?? 'Caution' }}</td>
                                        <td class="kc font-size-14" colspan="3">{{ $lang['11'] ?? 'Extreme Caution' }}</td>
                                        <td class="oc font-size-14 text-white" colspan="3">{{ $lang['12'] ?? 'Danger' }}</td>
                                        <td class="rc font-size-14 text-white" colspan="2">{{ $lang['13'] ?? 'Extreme Danger' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
