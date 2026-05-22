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
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="number" class="label">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="number" id="number" class="input" aria-label="input"/>
                    </div>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            @php $is_perfect_cube = safe_round($detail['cube_root']) ** 3 == abs($number); @endphp
                            <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}}<sup class="font-s-14">3</sup>&radic;{{$number}}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['cube_root'], 9)}}</td>
                                    </tr>
                                </table>
                                <p class="mt-2 text-[16px]">{{$number}} {{ $is_perfect_cube ? $lang['4'] : $lang['5'] }}</p>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['3']}}</strong></p>
                                @for ($k = 0; $k < 3; $k++)
                                    @php
                                        $angle = (2 * pi() * $k) / 3;
                                        $real = $detail['cube_root'] * cos($angle);
                                        $imaginary = $detail['cube_root'] * sin($angle);
                                    @endphp
                                    <p class="mt-2">Root {{$k}}: {{safe_round($real, 9)}}, {{safe_round($imaginary, 9)}} i</p>
                                @endfor
                                <p class="mt-2"><strong>{{$lang['8']}}</strong></p>
                                <p class="mt-2">{{$lang['9']}}</p>
                                <p class="mt-2">x = &#8731;x</p>
                                <p class="mt-2">x = &#8731;{{$number}}</p>
                                <p class="mt-2">x = {{safe_round($detail['cube_root'], 9)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
