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
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                    <div class="col-span-12">
                        <label for="to" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select class="input" aria-label="select" wire:model.live="to" id="to">
                                <option value="1">{{$lang[2]}}</option>
                                <option value="2">{{$lang[3]}}</option>
                            </select>
                        </div>
                    </div>
                    <p class="col-span-12 text-center my-3 text-[18px]">
                        @if ($to === '2')
                            <strong id="changeText">{{$lang[6]}}: y = mx + c</strong>
                        @else
                            <strong id="changeText">{{$lang[4]}}: Ax + By + C = 0 </strong>
                        @endif
                    </p>
                    <div class="{{ $to === '2' ? 'md:col-span-6 lg:col-span-6 col-span-6' : 'md:col-span-4 lg:col-span-4 col-span-4' }} px-2 mt-0 mt-lg-2" id="aInput">
                        <label for="a" class="font-s-14 text-blue">{{$lang[5]}} <span id="enter_a">A</span></label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model="a" id="a" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="{{ $to === '2' ? 'md:col-span-6 lg:col-span-6 col-span-6' : 'md:col-span-4 lg:col-span-4 col-span-4' }} px-2 mt-0 mt-lg-2" id="bInput">
                        <label for="b" class="font-s-14 text-blue">{{$lang[5]}} <span id="enter_b">B</span></label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model="b" id="b" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="md:col-span-4 lg:col-span-4 col-span-4 {{ $to === '2' ? 'hidden' : '' }}" id="cInput">
                        <label for="c" class="font-s-14 text-blue">{{$lang[5]}} C</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model="c" id="c" class="input" aria-label="input" />
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
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @if($to === "1")
                                    <div class="col-span-12 text-center text-[18px]">
                                        <p>{{$lang['6']}}</p>
                                        <p class="my-3"><strong>y = mx + c</strong></p>
                                        <div class="flex justify-center">
                                            <p class="text-[22px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block">
                                                <strong>
                                                    y = {{safe_round($detail['m'], 3)}}x 
                                                    @php
                                                        if (is_numeric($detail['nb']) && $detail['nb'] < 0) {
                                                            echo '+ '.safe_round(abs($detail['nb']), 3);
                                                        } else {
                                                            echo '- '.safe_round($detail['nb'], 3);
                                                        }
                                                    @endphp
                                                </strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-span-12 text-[16px]">
                                        <p class="mt-2"><strong>{{ $lang[7] }}:</strong></p>
                                        <p class="mt-2">{{ $lang[4] }}:</p>
                                        <p class="mt-2">{{ $a }}x {{ ($b < 0) ? '- '.abs($b) : '+ '.$b }}y {{ $c < 0 ? '- '.abs($c) : '+ '.$c }} = 0</p>
                                        <p class="mt-2">{{ $lang[8] }} 'x' {{ $lang[9] }}:</p>
                                        <p class="mt-2">{{ $b }}y = {{ $a*(-1) }}x {{ $c < 0 ? ' + '.abs($c) : '- '.($c) }}</p>
                                        <p class="mt-2">{{ $lang[10] }} y:</p>
                                        <p class="mt-2">y = ({{ $a*(-1) }}x {{ ($c < 0) ? '+ '.abs($c) : '- '.$c }})/{{ $b }}</p>
                                        <p class="mt-2">y = ({{ $a*(-1) }}/{{ $b }})x ({{ ($c < 0) ? '+ '.abs($c) : '- '.$c }}/{{ $b }})</p>
                                        <p class="mt-2">{{ $lang[6] }}</p>
                                        <p class="mt-2">y = {{ safe_round($detail['m']) }}x {{ ($detail['nb'] < 0) ? '+ '.safe_round(abs($detail['nb'])) : '- '.safe_round($detail['nb']) }}</p>
                                    </div>
                                    <div class="col-span-6 mt-2">
                                        <table class="w-100 font-s-16">
                                            <tr>
                                                <td class="py-2 border-b" width="60%">{{$lang[11]}} (m)</td>
                                                <td class="py-2 border-b"><strong>{{(($detail['m']!='')?safe_round($detail['m']):'0.0')}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%">Y - {{$lang[12]}} (c)</td>
                                                <td class="py-2 border-b"><strong>{{ ($detail['nb'] < 0) ? '+ '.safe_round(abs($detail['nb'])) : '- '.safe_round($detail['nb']) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%">X - {{$lang[12]}}</td>
                                                <td class="py-2 border-b">
                                                    <strong>
                                                        @php
                                                            if (is_numeric($detail['nb']) && is_numeric($detail['m']) && $detail['m'] != 0) {
                                                                echo safe_round((-1)*$detail['nb']/$detail['m'], 2);
                                                            } else {
                                                                echo 'NAN';
                                                            }
                                                        @endphp
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%">{{$lang[13]}}</td>
                                                <td class="py-2 border-b">
                                                    <strong>
                                                        @php
                                                            if (is_numeric($detail['m'])) {
                                                                echo safe_round($detail['m']*100) . ' %';
                                                            } else {
                                                                echo 'NAN';
                                                            }
                                                        @endphp
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%">{{$lang[14]}} (θ)</td>
                                                <td class="py-2 border-b"><strong>{{(($detail['angle']!='')?safe_round($detail['angle']):'0.0')}} deg</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                @else
                                    <div class="col-span-12 text-center font-s-20">
                                        <p>{{$lang['4']}}</p>
                                        <p class="my-3"><strong class="font-s-20">Ax + By + C = 0</strong></p>
                                        <p class="my-3">
                                            <strong class="bg-white px-3 py-2 font-s-32 radius-10 text-blue">
                                                {{(($detail['A']!=1)?safe_round($detail['A']):'')}}x
                                                @php
                                                    if ($detail['B']<0) {
                                                        echo '- '.safe_round(abs($detail['B']));
                                                    }else{
                                                        echo '+ '.safe_round($detail['B']);
                                                    }
                                                @endphp
                                                y {{ (is_numeric($detail['C']) && $detail['C']<0) ? '- '.safe_round(abs($detail['C'])) : '+ '.safe_round($detail['C']) }} = 0
                                            </strong>
                                        </p>
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
