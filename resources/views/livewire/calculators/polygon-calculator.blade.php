<div>
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp

    <style>
        img {
            object-fit: none;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-6">
                        <div class="col-12">
                            <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="operations" id="operations" class="input">
                                    <option value="3">{{ $lang[2] }} (n=3)</option>
                                    <option value="4">{{ $lang[3] }} (n=4)</option>
                                    <option value="5">{{ $lang[4] }} (n=5)</option>
                                    <option value="6">{{ $lang[5] }} (n=6)</option>
                                    <option value="7">{{ $lang[6] }} (n=7)</option>
                                    <option value="8">{{ $lang[7] }} (n=8)</option>
                                    <option value="9">{{ $lang[8] }} (n=9)</option>
                                    <option value="10">{{ $lang[9] }} (n=10)</option>
                                    <option value="11">{{ $lang[10] }} (n=11)</option>
                                    <option value="12">{{ $lang[11] }} (n=12)</option>
                                    <option value="13">{{ $lang[12] }} (n=13)</option>
                                    <option value="14">{{ $lang[13] }} (n=14)</option>
                                    <option value="15">{{ $lang[14] }} (n > 14)</option>
                                </select>
                            </div>
                        </div>
                        @if ($operations == 15)
                            <div class="col-12">
                                <label for="npolygon" class="font-s-14 text-blue">{{ $lang[15] }} n:</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model.live="npolygon" id="npolygon" class="input" aria-label="input" />
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <label for="calculation" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                            <div class="w-100 py-2 position-relative">
                                <select class="input" wire:model.live="calculation" id="calculation">
                                    <option value="01">{{ $lang[17] }} a:</option>
                                    <option value="02">{{ $lang[18] }} r:</option>
                                    <option value="03">{{ $lang[19] }} R:</option>
                                    <option value="04">{{ $lang[20] }} A:</option>
                                    <option value="05">{{ $lang[21] }} P:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="labl" class="font-s-14 text-blue" id="lb">
                                @if ($calculation === '01')
                                    {{ $lang['17'] }} a:
                                @elseif ($calculation === '02')
                                    {{ $lang['18'] }} r:
                                @elseif ($calculation === '03')
                                    {{ $lang['19'] }} R:
                                @elseif ($calculation === '04')
                                    {{ $lang['20'] }} A:
                                @elseif ($calculation === '05')
                                    {{ $lang['21'] }} P:
                                @endif
                            </label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="labl" id="labl" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click.stop="open = !open">
                                    {{ $units }} ▾
                                </label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-transition style="display: none;">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'cm')">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'mm')">millimetre (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'm')">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'in')">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'ft')">feet (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'yd')">yards (yd)</p>
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-12">
                            <label for="pie" class="font-s-14 text-blue">Pi π:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="pie" id="pie" class="input" aria-label="input" placeholder="40" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 flex items-center ps-lg-3 justify-center">
                        @php
                            $imageMap = [
                                '3' => 'images/trigon.svg',
                                '4' => 'images/tetragon.svg',
                                '5' => 'images/pentagon.svg?v=0',
                                '6' => 'images/hexagon.svg',
                                '7' => 'images/heptagon.svg',
                                '8' => 'images/octagon.svg',
                                '9' => 'images/nonagon.svg',
                                '10' => 'images/decagon.svg',
                                '11' => 'images/undecagon.svg',
                                '12' => 'images/dodecagon.svg',
                                '13' => 'images/tridecagon.svg',
                                '14' => 'images/tetradecagon.svg',
                                '15' => 'images/polygonn.svg',
                            ];
                            $imagePath = asset($imageMap[$operations] ?? 'images/pentagon.svg?v=0');
                        @endphp
                        <img src="{{ $imagePath }}" id="im" alt="Polygon Calculator" width="100" height="100">
                    </div>
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type=='widget')
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
                            <div class="w-full my-2">
                                <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[22] }} (n) :</strong></td>
                                            <td class="border-b py-2">{{ safe_round($detail['nvalue']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[17] }} (a) :</strong></td>
                                            <td class="border-b py-2">{{ safe_round($detail['side_a']) }} {{ $detail['unit'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[18] }} (r) :</strong></td>
                                            <td class="border-b py-2">{{ safe_round($detail['inradius']) }} {{ $detail['unit'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[19] }} (R) :</strong></td>
                                            <td class="border-b py-2">{{ safe_round($detail['circumradius']) }} {{ $detail['unit'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[20] }} (A) :</strong></td>
                                            <td class="border-b py-2">{{ safe_round($detail['area']) }} {{ $detail['unit'] }}<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[21] }} (P) :</strong></td>
                                            <td class="border-b py-2">{{ safe_round($detail['perimeter']) }} {{ $detail['unit'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[23] }} (x) :</strong></td>
                                            <td class="border-b py-2">{{ safe_round($detail['interior']) }}°</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[24] }} (y) :</strong></td>
                                            <td class="border-b py-2">{{ safe_round($detail['extrior']) }}°</td>
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
