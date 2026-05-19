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

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                    <div class="col-span-12">
                        <label for="know" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" wire:model.live="know" id="know">
                                <option value="1">{{$lang['2']}}</option>
                                <option value="2">{{$lang['3']}}</option>
                            </select>
                        </div>
                    </div>

                    @if ($know == 1)
                        <div class="col-span-12 angle">
                            <label for="angle" class="label">{{$lang[2]}}:</label>
                            <div x-data="{ open: false }" class="relative w-full mt-[7px]">
                                <input type="number" id="angle" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" wire:model.live="angle" aria-label="input" placeholder="00" required />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $angle_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p @click="$wire.set('angle_unit', 'deg'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer">degrees (deg)</p>
                                    <p @click="$wire.set('angle_unit', 'rad'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer">radians (rad)</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($know == 2)
                        <div class="col-span-12 function">
                            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                                <p class="col-span-12 text-center mt-3 mb-1"><strong>{{ $lang['4'] }}</strong></p>
                                <div class="col-span-6">
                                    <label for="sinx" class="label">sin(x):</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" min="-1" max="1" id="sinx" wire:model.live="sinx" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="sin2x" class="label">sin²(x):</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" id="sin2x" wire:model.live="sin2x" min="0" max="1" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="cosx" class="label">cos(x):</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" min="-1" max="1" id="cosx" wire:model.live="cosx" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="cos2x" class="label">cos²(x):</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" id="cos2x" wire:model.live="cos2x" min="0" max="1" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="tanx" class="label">tan(x):</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" min="-1" max="1" id="tanx" wire:model.live="tanx" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="tan2x" class="label">tan²(x):</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" id="tan2x" wire:model.live="tan2x" min="0" max="1" class="input" aria-label="input" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @isset($detail['angle'])
                                    <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="py-2 border-b" width="60%">{{$lang[2]}}</td>
                                                <td class="py-2 border-b"><strong>{{safe_round($detail['angle'],5)}} (deg)</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%">{{$lang[2]}}</td>
                                                <td class="py-2 border-b"><strong>{{safe_round(deg2rad((float)$detail['angle']),5)}} (rad)</strong></td>
                                            </tr>
                                        </table>
                                    </div>    
                                @endisset
                                <p class="mt-3 text-[20px]"><strong>{{ $lang['5'] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>sin(x)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['sin'],5)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>cos(x)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['cos'],5)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>tan(x)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['tan'],5)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="mt-3 text-[20px]"><strong>{{ $lang['6'] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%">sin<sup class="font-s-14">2</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['sin2'],5)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">cos<sup class="font-s-14">2</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['cos2'],5)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">tan<sup class="font-s-14">2</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['tan2'],5)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">sin<sup class="font-s-14">3</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['sin3'],5)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">cos<sup class="font-s-14">3</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['cos3'],5)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">tan<sup class="font-s-14">3</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['tan3'],5)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">sin<sup class="font-s-14">4</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['sin4'],5)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">cos<sup class="font-s-14">4</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['cos4'],5)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">tan<sup class="font-s-14">4</sup>(x)</td>
                                            <td class="py-2 border-b"><strong>{{safe_round($detail['tan4'],5)}}</strong></td>
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
